@extends('admin.layout.master')

@section('content')
    <div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Tour List</h3>
                <button
                    class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                >
                    New Tour +
                </button>
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
                                        @if ($tour->image)
                                            <img src="{{ getFilePath($tour->image) }}" alt="Banner Image"
                                                 class="h-12 w-20 object-cover rounded-md">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                        @if ($tour->is_active)
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
                                                data-id="{{ $tour->id }}"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{route('admin.tour.delete',$tour->id)}}"
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


    </div>

@endsection

