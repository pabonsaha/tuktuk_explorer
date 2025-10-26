@extends('admin.layout.master')

@section('content')
    <div x-data="{ isModalOpen: {{ $errors->any() ? 'true' : 'false' }}, isEditModalOpen:false } ">

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Additional List for - {{$tour->title}}</h3>
                <button
                    class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                    @click="isModalOpen = !isModalOpen"
                >
                    New Additional +
                </button>
            </div>

            <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            All Additional
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
                                <th class="py-3 pr-5 font-medium text-gray-600 dark:text-gray-400">Description</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Price</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Status</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400 text-center">Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($additionals as $additional)
                                <tr>
                                    <td class="py-3 pr-5 whitespace-nowrap sm:pr-6 text-gray-800 dark:text-gray-300" >
                                        {{ $additional->title ?? '—' }}
                                    </td>
                                    <td class="py-3 pr-5 sm:pr-6 text-gray-800 dark:text-gray-300 whitespace-normal break-words">
                                        {{ $additional->description ?? '—' }}
                                    </td>

                                    <td class="py-3 pr-5 whitespace-nowrap sm:pr-6 text-gray-800 dark:text-gray-300">
                                        {{ $additional->price ?? '—' }}
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                        @if ($additional->is_active)
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
                                                data-id="{{ $additional->id }}"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{route('admin.tour.additional.delete',[$tour->id,$additional->id])}}"
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
                                        No Tour Hour found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                        {{ $additionals->links('admin.vendor.pagination.tailadmin') }}
                    </div>
                </div>
            </div>
        </div>
        {{-- Add Modal --}}
        <div
            x-show="isModalOpen"
            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
        >
            <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>

            <div
                @click.outside="isModalOpen = false"
                class="relative w-full max-w-[584px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10"
            >
                <!-- Close button -->
                <button
                    @click="isModalOpen = false"
                    class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11"
                >
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6.04 16.54c-.39.39-.39 1.02 0 1.41s1.02.39 1.41 0L12 13.41l4.54 4.54c.39.39 1.02.39 1.41 0s.39-1.02 0-1.41L13.41 12l4.54-4.54a1 1 0 0 0-1.41-1.41L12 10.59 7.46 6.05a1 1 0 0 0-1.41 1.41L10.59 12l-4.55 4.54Z"/>
                    </svg>
                </button>

                <form method="POST" action="{{ route('admin.tour.additional.store',$tour->id) }}"
                      enctype="multipart/form-data">
                    @csrf

                    <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">Add New Additional</h4>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                        <!-- Title -->
                        <div class="col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Title
                            </label>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Enter title"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            />
                            @error('title')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Description
                            </label>
                            <textarea
                                name="description"
                                rows="3"
                                placeholder="Enter description"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            >{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Price -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Price</label>
                            <input
                                type="number"
                                step="0.01"
                                name="price"
                                value="{{ old('price', 0.00) }}"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm focus:border-blue-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            />
                            @error('price')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                            <select
                                name="is_active"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            >
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('is_active')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" @click="isModalOpen = false"
                                class="flex justify-center w-full sm:w-auto rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="flex justify-center w-full sm:w-auto px-4 py-3 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-700"
                        >
                            Save Hour
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div
            x-show="isEditModalOpen"
            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
        >
            <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>

            <div
                @click.outside="isEditModalOpen = false"
                class="relative w-full max-w-[584px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10"
            >
                <!-- Close Button -->
                <button
                    @click="isEditModalOpen = false"
                    class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11"
                >
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6.04 16.54c-.39.39-.39 1.02 0 1.41s1.02.39 1.41 0L12 13.41l4.54 4.54c.39.39 1.02.39 1.41 0s.39-1.02 0-1.41L13.41 12l4.54-4.54a1 1 0 0 0-1.41-1.41L12 10.59 7.46 6.05a1 1 0 0 0-1.41 1.41L10.59 12l-4.55 4.54Z"/>
                    </svg>
                </button>

                <form id="editHourForm" method="POST" enctype="multipart/form-data">
                    @csrf


                    <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">Edit Additional</h4>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                        <!-- Title -->
                        <div class="col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Title</label>
                            <input type="text" name="title" id="edit_title"
                                   class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                            <textarea name="description" id="edit_description" rows="3"
                                      class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"></textarea>
                        </div>


                        <!-- Price -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Price</label>
                            <input type="number" step="0.01" name="price" id="edit_price"
                                   class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        </div>

                        <!-- Status -->
                        <div class="col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                            <select id="edit_is_active" name="is_active"
                                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="validation-errors">

                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" @click="isEditModalOpen = false"
                                class="flex justify-center w-full sm:w-auto rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="flex justify-center w-full sm:w-auto px-4 py-3 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-700"
                        >
                            Update Additional
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
                        url: `/admin/tour/{{$tour->id}}}/additional/${id}/edit`,
                        type: 'GET',
                        success: function (res) {
                            // Populate modal fields
                            $('#edit_title').val(res.title);
                            $('#edit_is_active').val(res.is_active);
                            $('#edit_description').val(res.description);
                            $('#edit_price').val(res.price);
                            $('#editHourForm').attr('action', `/admin/tour/{{$tour->id}}}/additional/${id}/update`);
                        },
                        error: function (xhr) {
                            console.error(xhr);

                            toastr.error('Something went wrong');
                        }
                    });
                });

                // 🔹 Handle Edit Form Submit
                $('#editHourForm').on('submit', function (e) {
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
                                $('#editHourForm').find('.validation-errors').html(errorText);
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
