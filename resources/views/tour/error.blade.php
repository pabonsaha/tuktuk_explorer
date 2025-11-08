@extends('layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-16 px-4 mt-5">
        <div class="max-w-2xl w-full">
            <!-- Error Card -->
            <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 text-center">
                <!-- Error Icon -->
                <div class="mb-6">
                    <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto relative">
                        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>

                <!-- Error Message -->
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Booking Failed
                </h1>
                <p class="text-lg text-gray-600 mb-6">
                    We're sorry, but we couldn't complete your booking request at this time.
                </p>

                <!-- Error Details -->
                @if(isset($errorMessage))
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-8 text-left">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-red-800 mb-1">Error Details:</p>
                                <p class="text-red-700 text-sm">{{ $errorMessage }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Possible Reasons -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                    <h2 class="font-bold text-lg text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        What Could Have Gone Wrong?
                    </h2>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>The selected date and time may no longer be available</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>There might be an issue with your internet connection</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Payment information may be incorrect or incomplete</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Maximum capacity for this tour has been reached</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Session may have expired, please refresh and try again</span>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="{{route('home')}}"
                       class="border-2 border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Back to Home
                    </a>
                </div>

                <!-- Contact Support -->
                <div class="border-t border-gray-200 pt-8">
                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="text-left flex-1">
                                <h3 class="font-bold text-gray-900 text-lg mb-2">Need Immediate Assistance?</h3>
                                <p class="text-gray-600 text-sm mb-4">Our support team is available 24/7 to help you
                                    complete your booking</p>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <a href="tel:+11234567890"
                                           class="text-orange-500 font-semibold text-lg hover:underline">
                                            +351 920 204 443
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <a href="mailto:tuktuk.lisbon3400@gmail.com"
                                           class="text-orange-500 font-semibold hover:underline">
                                            tuktuk.lisbon3400@gmail.com
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alternative Options -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                <h3 class="font-bold text-lg text-gray-900 mb-4 text-center">Still Want to Explore?</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <a href="/tours"
                       class="flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-orange-500 hover:shadow-md transition">
                        <svg class="w-8 h-8 text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="font-semibold text-gray-900">Browse Tours</span>
                        <span class="text-sm text-gray-500 mt-1">Explore other options</span>
                    </a>
                    <a href="/contact"
                       class="flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-orange-500 hover:shadow-md transition">
                        <svg class="w-8 h-8 text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <span class="font-semibold text-gray-900">Contact Us</span>
                        <span class="text-sm text-gray-500 mt-1">Get personalized help</span>
                    </a>
                    <a href="/faq"
                       class="flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-orange-500 hover:shadow-md transition">
                        <svg class="w-8 h-8 text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-gray-900">FAQ</span>
                        <span class="text-sm text-gray-500 mt-1">Find quick answers</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
