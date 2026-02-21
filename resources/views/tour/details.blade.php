@extends('layouts.master')
@push('styles')
    <style>
        .gallery-main {
            position: relative;
            overflow: hidden;
        }

        .gallery-thumbs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
    </style>
@endpush
{{--@dd($tour)--}}
@section('content')

    <div class="bg-gray-40 mt-16">
        <div class="container mx-auto px-4 py-16">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Title and Rating -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{$tour->title}}
                            </h1>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-orange-600">{{$tour->location}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    <div class="grid md:grid-cols-3 gap-4 mb-8">
                        <div class="md:col-span-2">
                            <div class="gallery-main rounded-2xl aspect-[16/9]">
                                <img src="{{ asset('storage/' . $tour->image) }}" alt="Main Gallery"
                                     class="w-full h-full object-cover rounded-2xl">
                            </div>
                        </div>
                        <div class="gallery-thumbs">
                            @foreach($tour->gallery as $image)
                                <div class="aspect-square rounded-xl overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery Thumbnail"
                                         class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-8">
                        <!-- Left Side: Description -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
                                <p class="text-gray-600 leading-relaxed mb-6">
                                    {!! $tour->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- Right Side: Booking Card -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 sticky top-24"
                                 x-data="bookingForm()">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <span class="text-3xl font-bold text-gray-900">${{$tour->price}}</span>
                                        <span class="text-gray-500">/ person</span>
                                    </div>
                                    <div class="flex items-center gap-1 bg-orange-50 px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-orange-700 font-semibold">4.8</span>
                                    </div>
                                </div>

                                <form @submit.prevent="submitBooking">
                                    <div class="space-y-4 mb-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                            <input type="date" x-model="formData.date" required
                                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                                            <select x-model="formData.guests"
                                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                                                <option value="1">1 Person</option>
                                                <option value="2">2 People</option>
                                                <option value="3">3 People</option>
                                                <option value="4">4 People</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="space-y-3 mb-6">
                                        <div class="flex justify-between text-gray-600">
                                            <span>${{$tour->price}} x <span x-text="formData.guests"></span> guests</span>
                                            <span>$<span x-text="formData.guests * {{$tour->price}}"></span></span>
                                        </div>
                                        <div class="border-t border-gray-100 pt-3 flex justify-between font-bold text-lg text-gray-900">
                                            <span>Total</span>
                                            <span>$<span x-text="formData.guests * {{$tour->price}}"></span></span>
                                        </div>
                                    </div>

                                    <button type="submit"
                                            :disabled="isSubmitting"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition-colors shadow-lg shadow-green-200 flex items-center justify-center gap-2">
                                        <template x-if="!isSubmitting">
                                            <span>Book Now</span>
                                        </template>
                                        <template x-if="isSubmitting">
                                            <div class="flex items-center gap-2">
                                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span>Processing...</span>
                                            </div>
                                        </template>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function bookingForm() {
            return {
                isSubmitting: false,
                formData: {
                    date: '',
                    guests: 1,
                    tour_id: '{{$tour->id}}'
                },
                submitBooking() {
                    if (this.formData.date) {
                        this.isSubmitting = true;

                        const formData = new FormData();
                        formData.append('date', this.formData.date);
                        formData.append('guests', this.formData.guests);
                        formData.append('tour_id', this.formData.tour_id);

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('{{ route("bookings.store") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData,
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success && data.redirect_url) {
                                    window.location.href = data.redirect_url;
                                } else {
                                    this.isSubmitting = false;
                                    if (typeof toastr !== 'undefined') {
                                        toastr.error("Something went wrong");
                                    } else {
                                        alert("Something went wrong");
                                    }
                                }
                            })
                            .catch(error => {
                                this.isSubmitting = false;
                                console.error('Error:', error);
                                if (typeof toastr !== 'undefined') {
                                    toastr.error("Something went wrong");
                                } else {
                                    alert("Something went wrong");
                                }
                            });
                    }
                }
            }
        }
    </script>
@endpush
