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

                                    <td class="px-5 py-3 sm:px-6 text-center">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <!-- Dropdown Trigger -->
                                            <button
                                                @click="open = !open"
                                                class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700"
                                            >
                                                Actions
                                                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div
                                                x-show="open"
                                                @click.outside="open = false"
                                                x-transition
                                                class="absolute right-0 z-50 w-44 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-700"
                                            >
                                                <div class="py-1">
                                                    <!-- Add Hours -->
                                                    <a href="{{ route('admin.tour.hour.index', $tour->id) }}"
                                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-orange-500" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                        Add Hours
                                                    </a>

                                                    <!-- Add Additional -->
                                                    <a href="{{ route('admin.tour.additional.index', $tour->id) }}"
                                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-yellow-500" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Add Additional
                                                    </a>

                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.tours.edit', $tour->id) }}"
                                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-blue-500" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-5-9l6 6M13 3l8 8"/>
                                                        </svg>
                                                        Edit
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('admin.tours.delete', $tour->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        <button type="submit"
                                                                class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5-4h4a2 2 0 0 1 2 2v2H8V5a2 2 0 0 1 2-2z"/>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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

