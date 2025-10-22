@extends('admin.layout.master')

@section('content')
    <div x-data="{ isModalOpen: {{ $errors->any() ? 'true' : 'false' }}, isEditModalOpen:false } ">

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Banner List</h3>
                <button
                    class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                    @click="isModalOpen = !isModalOpen"
                >
                    New Banner +
                </button>
            </div>

            <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            All Banners
                        </h3>
                        <form method="GET">
                            <div class="relative">
                                <input type="search" name="search" placeholder="Search..."
                                       value="{{ request('search') }}"
                                       class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-10 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <span class="absolute top-1/2 left-3 -translate-y-1/2 text-gray-400">
                            🔍
                        </span>
                            </div>
                        </form>
                    </div>

                    <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6">
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-y border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/30">
                            <tr>
                                <th class="py-3 pr-5 font-medium text-gray-600 dark:text-gray-400">Title</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Image</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Status</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400 text-center">Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($banners as $banner)
                                <tr>
                                    <td class="py-3 pr-5 whitespace-nowrap sm:pr-6 text-gray-800 dark:text-gray-300">
                                        {{ $banner->title ?? '—' }}
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                        @if ($banner->image)
                                            <img src="{{ getFilePath($banner->image) }}" alt="Banner Image"
                                                 class="h-12 w-20 object-cover rounded-md">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                        @if ($banner->is_active)
                                            <span
                                                class="bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400 px-3 py-1 rounded-full text-xs font-medium">
                                            Active
                                        </span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 px-3 py-1 rounded-full text-xs font-medium">
                                            Inactive
                                        </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button
                                                type="button"
                                                class="text-blue-500 hover:text-blue-700 font-medium edit-btn"
                                                @click="isEditModalOpen = !isEditModalOpen"
                                                data-id="{{ $banner->id }}"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{route('admin.banner.delete',$banner->id)}}"
                                                  class="delete-form" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="text-red-500 hover:text-red-700 font-medium">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                        No banners found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                        {{ $banners->links('admin.vendor.pagination.tailadmin') }}
                    </div>
                </div>
            </div>
        </div>
        {{--        Add modal--}}
        <div
            x-show="isModalOpen"
            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
        >
            <div
                class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            ></div>
            <div
                @click.outside="isModalOpen = false"
                class="relative w-full max-w-[584px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10"
            >
                <!-- close btn -->
                <button
                    @click="isModalOpen = false"
                    class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 hover:text-gray-500 dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11"
                >
                    <svg
                        class="transition-colors fill-current group-hover:text-gray-600 dark:group-hover:text-gray-200"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                            fill=""
                        />
                    </svg>
                </button>

                <form method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                    @csrf

                    <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                        Add New Banner
                    </h4>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                        <!-- Title -->
                        <div class="col-span-1 sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Title <span class="text-error-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Enter banner title"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-blue-800"
                                required
                            />
                            @error('title')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="col-span-1 sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Banner Image <span class="text-error-500">*</span>
                            </label>
                            <input
                                type="file"
                                name="image"
                                accept="image/*"
                                required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 shadow-theme-xs focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-blue-800"
                            />
                            @error('image')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-1 sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Status
                            </label>
                            <select
                                name="is_active"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-blue-800"
                            >
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="flex items-center justify-end w-full gap-3 mt-6">
                        <a
                            href="{{ route('admin.banner.index') }}"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-blue-600 shadow-theme-xs hover:bg-blue-700 sm:w-auto"
                        >
                            Save Banner
                        </button>
                    </div>
                </form>

            </div>
        </div>
        {{--    Edit Modal--}}
        <div
            x-show="isEditModalOpen"
            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
        >
            <div
                class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            ></div>
            <div
                @click.outside="isEditModalOpen = false"
                class="relative w-full max-w-[584px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10"
            >
                <!-- close btn -->
                <button
                    @click="isEditModalOpen = false"
                    class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 hover:text-gray-500 dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11"
                >
                    <svg
                        class="transition-colors fill-current group-hover:text-gray-600 dark:group-hover:text-gray-200"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                            fill=""
                        />
                    </svg>
                </button>

                <form id="editBannerForm" method="POST" enctype="multipart/form-data" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                        Edit Banner
                    </h4>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                        <!-- Title -->
                        <div class="col-span-1 sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Title <span class="text-error-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="edit_title"
                                value="{{ old('title') }}"
                                placeholder="Enter banner title"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-blue-800"
                                required
                            />
                            @error('title')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="col-span-1 sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Banner Image <span class="text-error-500">*</span>
                            </label>
                            <input
                                type="file"
                                name="image"
                                id="edit_image"
                                accept="image/*"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 shadow-theme-xs focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-blue-800"
                            />
                            @error('image')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-1 sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Status
                            </label>
                            <select
                                id="edit_is_active"
                                name="is_active"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-blue-800"
                            >
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="validation-errors">

                    </div>

                    <div class="flex items-center justify-end w-full gap-3 mt-6">
                        <a
                            href="{{ route('admin.banner.index') }}"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-blue-600 shadow-theme-xs hover:bg-blue-700 sm:w-auto"
                        >
                            Save Banner
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('script')
    @push('script')
        <script type="module">
            $(function () {

                $(document).on('click', '.edit-btn', function () {
                    const id = $(this).data('id');

                    $.ajax({
                        url: `/admin/banner/${id}/edit`,
                        type: 'GET',
                        success: function (res) {
                            // Populate modal fields
                            $('#edit_title').val(res.title);
                            $('#edit_is_active').val(res.is_active);
                            $('#editBannerForm').attr('action', `/admin/banner/${id}/update`);
                        },
                        error: function (xhr) {
                            console.error(xhr);

                            toastr.error('Something went wrong');
                        }
                    });
                });

                // 🔹 Handle Edit Form Submit
                $('#editBannerForm').on('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const actionUrl = $(this).attr('action');

                    $.ajax({
                        url: actionUrl,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                let errorText = '';
                                $.each(errors, function (key, value) {
                                    errorText += `<p class="text-red-500 text-sm">${value[0]}</p>`;
                                });
                                $('#editBannerForm').find('.validation-errors').html(errorText);
                            } else {
                                toastr.error('Something went wrong');
                            }
                        }
                    });
                });

                // 🔹 Handle Delete
                $(document).on('submit', '.delete-form', function (e) {
                    e.preventDefault();
                    const form = this;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won’t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(form).attr('action'),
                                type: 'POST',
                                data: $(form).serialize(),
                                success: function (response) {
                                    if (response.success) {
                                        Swal.fire('success', response.message, 'success');
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        toastr.error(response.message || 'Failed to delete banner.');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error', 'Delete failed.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

@endpush
