@extends('admin.layout.master')

@section('content')
    <div x-data="booking() ">

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            All Bookings
                        </h3>
                        <form method="GET" action="{{ route('admin.booking.index') }}"
                              class="flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-4">
                            <!-- Tour Status Filter -->
                            <div class="relative">
                                <select name="tour_status"
                                        class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    <option value="">All Tour Status</option>
                                    <option value="1" {{ request('tour_status') == '1' ? 'selected' : '' }}>Confirmed
                                    </option>
                                    <option value="2" {{ request('tour_status') == '2' ? 'selected' : '' }}>Complete
                                    </option>
                                    <option value="3" {{ request('tour_status') == '3' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </div>

                            <!-- Active Status Filter -->
                            <div class="relative">
                                <select name="active_status"
                                        class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 px-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    <option value="">All Active Status</option>
                                    <option value="1" {{ request('active_status') == '1' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ request('active_status') == '0' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <!-- Search Box -->
                            <div class="relative">
                                <input type="search" name="search" placeholder="code..."
                                       value="{{ request('search') }}"
                                       class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-10 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <span class="absolute top-1/2 left-3 -translate-y-1/2 text-gray-400">
            🔍
        </span>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                    class="h-[42px] rounded-lg bg-blue-600 px-5 text-sm font-medium text-white hover:bg-blue-700 transition-all">
                                Filter
                            </button>
                        </form>

                    </div>

                    <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6">
                        <table class="min-w-full text-left text-sm sm:table">
                            <thead class="border-y border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/30">
                            <tr>
                                <th class="font-medium text-gray-600 dark:text-gray-400">Code</th>
                                <th class="font-medium text-gray-600 dark:text-gray-400">Title</th>
                                <th class="font-medium text-gray-600 dark:text-gray-400">Package</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Date & Time</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Total Price</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Tour Status</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400">Active Status</th>
                                <th class="px-5 py-3 font-medium text-gray-600 dark:text-gray-400 text-center">View</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($bookings as $booking)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <td class="whitespace-nowrap text-gray-800 dark:text-gray-300">{{ $booking->code ?? '—' }}</td>
                                    <td class="whitespace-normal text-gray-800 dark:text-gray-300">{{ $booking->title ?? '—' }}</td>
                                    <td class="whitespace-nowrap">{{ $booking->hour ?? '—' }}</td>
                                    <td class="text-blue-500 whitespace-nowrap dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($booking->tour_date)->format('d F Y') }}<br>
                                        {{ $booking->tour_time }}
                                    </td>
                                    <td class="whitespace-nowrap text-center dark:text-gray-300">
                                        €{{ $booking->total_price ?? '—' }}</td>
                                    <td class="text-center">
                                        @if ($booking->tour_status == 1)
                                            <span
                                                class="bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400 px-3 py-1 rounded-full text-xs font-medium">Confirmed</span>
                                        @elseif($booking->tour_status == 2)
                                            <span
                                                class="bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400 px-3 py-1 rounded-full text-xs font-medium">Complete</span>
                                        @elseif($booking->tour_status == 3)
                                            <span
                                                class="bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 px-3 py-1 rounded-full text-xs font-medium">Cancelled</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-medium">N/A</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                        <span x-show="{{$booking->active_status}} == '1'" class="text-green-700">Active</span>
                                        <span x-show="{{$booking->active_status}}=='0'" class="text-red-500">Inactive</span>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="text-blue-500 hover:text-blue-700 font-medium"
                                                @click="viewDetails({{ $booking->id }})">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-6 text-gray-500 dark:text-gray-400">No Booking
                                        found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                        {{ $bookings->links('admin.vendor.pagination.tailadmin') }}
                    </div>
                </div>
            </div>
        </div>
        {{-- view Modal --}}
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


                <template x-if="booking">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Code</p>
                                <p class="font-medium" x-text="booking.code"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Title</p>
                                <p class="font-medium" x-text="booking.title"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Hour</p>
                                <p class="font-medium" x-text="booking.hour"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Passengers</p>
                                <p class="font-medium" x-text="booking.passengers"></p>

                            </div>
                            <div>
                                <p class="text-gray-500">Price (Per Passenger)</p>
                                <p class="font-medium"
                                   x-text="`${booking.per_pessenger_price} ${booking.currency}`"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Passenger Price</p>
                                <p class="font-medium"
                                   x-text="`${booking.passenger_price} ${booking.currency}`"></p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-gray-500">Additionals</p>
                                <ul class="list-disc pl-5">
                                    <template x-for="(item, index) in booking.additionals" :key="index">
                                        <li>
                                            <p x-text="item.title"></p>
                                            <span x-text="item.count"></span>* €<span x-text="item.price"></span> =
                                            €<span x-text="item.price*item.count"></span></li>
                                    </template>
                                </ul>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Price</p>
                                <p class="font-medium" x-text="`${booking.total_price} ${booking.currency}`"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Tour Date</p>
                                <p class="font-medium" x-text="booking.tour_date"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Tour Time</p>
                                <p class="font-medium" x-text="booking.tour_time"></p>
                            </div>

                            <div>
                                <p class="text-gray-500">Customer Name</p>
                                <p class="font-medium" x-text="booking.customer_name"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Email</p>
                                <p class="font-medium" x-text="booking.customer_email"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Phone</p>
                                <p class="font-medium" x-text="booking.customer_phone"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Country</p>
                                <p class="font-medium" x-text="booking.customer_country"></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Payment Status</p>
                                <select
                                    x-model="booking.payment_status"
                                    @change="updateStatus(booking.id, 'payment_status', booking.payment_status)"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 bg-transparent text-sm text-gray-800 dark:text-white">
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div>
                                <p class="text-gray-500">Tour Status</p>
                                <select
                                    x-model="booking.tour_status"
                                    @change="updateStatus(booking.id, 'tour_status', booking.tour_status)"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 bg-transparent text-sm text-gray-800 dark:text-white">
                                    <option value="1">Confirmed</option>
                                    <option value="2">Complete</option>
                                    <option value="3">Cancelled</option>
                                </select>
                            </div>
                            <div>
                                <p class="text-gray-500">Active Status</p>
                                <select
                                    x-model="booking.active_status"
                                    @change="updateStatus(booking.id, 'active_status', booking.active_status)"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 bg-transparent text-sm text-gray-800 dark:text-white">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Loading -->
                <template x-if="loading">
                    <div class="text-center py-10 text-gray-500">
                        Loading booking details...
                    </div>
                </template>


            </div>
        </div>

    </div>

@endsection

@push('script')
    @push('script')
        <script>

            function booking() {
                return {
                    isModalOpen: false,
                    loading: false,
                    booking: null,

                    async viewDetails(id) {
                        this.isModalOpen = true;
                        this.loading = true;
                        this.booking = null;

                        try {
                            const res = await fetch(`/admin/booking/details/${id}`);
                            if (!res.ok) throw new Error('Failed to fetch booking');
                            const data = await res.json();
                            console.log(data);

                            // If "additionals" is a JSON string in DB
                            if (typeof data.additionals === 'string') {
                                data.additionals = JSON.parse(data.additionals || '[]');
                            }

                            this.booking = data;
                        } catch (err) {
                            console.error(err);
                            alert('Could not load booking details.');
                        } finally {
                            this.loading = false;
                        }
                    },

                    tourStatusLabel(status) {
                        switch (status) {
                            case '1':
                                return 'Confirmed';
                            case '2':
                                return 'Complete';
                            case '0':
                                return 'Cancelled';
                            default:
                                return 'Unknown';
                        }
                    },
                    activeStatusLabel(status) {
                        switch (status) {
                            case '1':
                                return 'Active';
                            case '0':
                                return 'Inactive';
                            default:
                                return 'Unknown';
                        }
                    },
                    async updateStatus(id, field, value) {
                        try {
                            const response = await fetch(`/admin/booking/update-status/${id}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: JSON.stringify({ field, value }),
                            });

                            const data = await response.json();
                            if (!response.ok) throw new Error(data.message || 'Failed');

                            toastr.success(`${field.replace('_', ' ')} updated successfully`);
                        } catch (err) {
                            console.error(err);
                            toastr.error('Failed to update. Please try again.');
                        }
                    }

                };
            }

        </script>
    @endpush

@endpush
