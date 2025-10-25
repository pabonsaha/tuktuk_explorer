@extends('admin.layout.master')

@section('content')
    <div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Tour List</h3>
                <a href="{{route('admin.tours.create')}}"
                   class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                >
                    New Tour +
                </a>
            </div>

            <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            All Tours
                        </h3>
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
                            @forelse ($tours as $tour)
                                <tr>
                                    <td class="py-3 pr-5 whitespace-nowrap sm:pr-6 text-gray-800 dark:text-gray-300">
                                        {{ $tour->title ?? '—' }}
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                        @if ($tour->thumbnail)
                                            <img src="{{ getFilePath($tour->thumbnail) }}" alt="Banner Image"
                                                 class="h-12 w-20 object-cover rounded-md">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">

                                        <div x-data="toggleSwitch({{ $tour->id }}, {{ $tour->is_active ? 'true' : 'false' }}, '{{ route('admin.tours.toggle', $tour->id) }}')">

                                            <label class="flex cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                                <div class="relative">
                                                    <input type="checkbox"
                                                           class="sr-only"
                                                           :checked="switcherToggle"
                                                           @change="toggleStatus"
                                                           :disabled="loading"
                                                    />
                                                    <div
                                                        class="block h-6 w-11 rounded-full transition"
                                                        :class="switcherToggle ? 'bg-green-500 dark:bg-green-600' : 'bg-gray-300 dark:bg-gray-700'"
                                                    ></div>
                                                    <div
                                                        class="absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform duration-300 ease-in-out"
                                                        :class="switcherToggle ? 'translate-x-full' : 'translate-x-0'"
                                                    ></div>
                                                </div>

                                                <span x-text="switcherToggle ? 'Active' : 'Inactive'"></span>
                                            </label>

                                        </div>

                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a
                                                type="button"
                                                class="text-blue-500 hover:text-blue-700 font-medium edit-btn"
                                                href="{{route('admin.tours.edit',$tour->id)}}"
                                            >
                                                Edit
                                            </a>
                                            <form action="{{route('admin.tours.delete',$tour->id)}}"
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
                        {{ $tours->links('admin.vendor.pagination.tailadmin') }}
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@push('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('toggleSwitch', (id, isActive, url) => ({
                switcherToggle: isActive,
                loading: false,

                async toggleStatus() {
                    this.loading = true;
                    this.switcherToggle = !this.switcherToggle;

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                is_active: this.switcherToggle
                            })
                        });

                        if (!response.ok) throw new Error('Request failed');
                        const data = await response.json();

                        toastr.success(data.message || 'Status updated successfully!');
                    } catch (error) {
                        this.switcherToggle = !this.switcherToggle; // revert on error
                        toastr.error('Error updating status');
                    } finally {
                        this.loading = false;
                    }
                }
            }))
        });
    </script>
@endpush

