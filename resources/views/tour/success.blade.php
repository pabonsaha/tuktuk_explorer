@extends('layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-16 px-4 mt-5">
        <div class="max-w-2xl w-full">
            <!-- Success Card -->
            <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 text-center">
                <!-- Success Icon -->
                <div class="mb-6">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Success Message -->
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Booking Successful!
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Your tour has been submitted successfully. You will be contacted soon by our team.
                </p>

                <!-- Booking Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Booking Details</h2>
                    <div class="space-y-3">
                        <div class="flex items-start justify-between">
                            <span class="text-gray-600">Tour Name:</span>
                            <span class="font-semibold text-gray-900 text-right">{{ $booking->name }}</span>
                        </div>
                        <div class="flex items-start justify-between">
                            <span class="text-gray-600">Booking ID:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->code }}</span>
                        </div>
                        <div class="flex items-start justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->tour_date)->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-start justify-between">
                            <span class="text-gray-600">Time:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->tour_time }}</span>
                        </div>
                        <div class="flex items-start justify-between">
                            <span class="text-gray-600">Guests:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->passengers }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6 mb-8">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-bold text-gray-900 mb-1">Have any questions?</h3>
                            <p class="text-gray-600 text-sm mb-2">Contact us for any queries</p>
                            <a href="tel:+351920204443" class="text-orange-500 font-semibold text-lg hover:underline">
                                +351 920 204 443
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{route('home')}}"
                       class="bg-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                        Back to Home
                    </a>
                </div>

                <!-- Email Notification -->
                <p class="text-sm text-gray-500 mt-8">
                    A confirmation email has been sent to <span
                        class="font-semibold">{{ $booking->customer_email }}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
