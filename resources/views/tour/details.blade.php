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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{$tour->location}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image Gallery -->
                    <div class="mb-8" x-data="{ mainImage: '{{getFilePath($tour->thumbnail)}}' }">
                        <div class="grid lg:grid-cols-3 gap-2">
                            <div class="lg:col-span-2 relative">
                                <img :src="mainImage" alt="Tour Image" class="w-full h-96 object-cover rounded-lg">
                            </div>
                            <div class="gallery-thumbs">
                                @foreach($tour->images as $image)
                                    @if ($loop->iteration > 4)

                                        @break
                                    @endif
                                    <img src="{{ getFilePath($image->image) }}" alt="Thumb"
                                         class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-80"
                                         @click="mainImage = '{{ getFilePath($image->image) }}'">
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-2">
                        <div class="lg:col-span-2">
                            <!-- Overview -->
                            <div class="bg-white rounded-lg p-6 mb-4">
                                <h2 class="text-2xl font-bold mb-4">Overview</h2>
                                <div class="flex gap-6 mb-6">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <span class="text-gray-600 text-sm">Duration:</span>
                                            <span class="font-semibold ml-1">{{$tour->tour_duration}}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <div>
                                            <span class="text-gray-600 text-sm">Travelers: Up to</span>
                                            <span class="font-semibold ml-1">{{$tour->num_of_people}}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             class="w-5 h-5 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.25 7.756a4.5 4.5 0 1 0 0 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>

                                        <div>
                                            <span class="text-gray-600 text-sm">Start From:</span>
                                            <span
                                                class="font-semibold ml-1">{{getPriceFormat($tour->starting_price)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ readMore: true }">
                                    <div class="text-gray-700 space-y-2" :class="{ 'line-clamp-5': readMore }">
                                        {!! $tour->description !!}
                                    </div>

                                    <button
                                        class="text-orange-500 font-semibold hover:underline mt-2"
                                        x-show="readMore"
                                        @click="readMore = false">
                                        Read more
                                    </button>

                                    <button
                                        class="text-orange-500 font-semibold hover:underline mt-2"
                                        x-show="!readMore"
                                        @click="readMore = true">
                                        View less
                                    </button>
                                </div>


                            </div>

                            <!-- Specification -->
                            <div class="bg-white rounded-lg p-6 mb-3">
                                <h2 class="text-2xl font-bold mb-4">Specifications</h2>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-2">
                                    @foreach(json_decode($tour->specifications) as $specifications)
                                        <div class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-gray-700">{{$specifications}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <!-- Requirements -->
                            <div class="bg-white rounded-lg p-6 mb-3">
                                <h2 class="text-2xl font-bold mb-4">Requirements</h2>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-2">
                                    @foreach(json_decode($tour->requirements) as $requirement)
                                        <div class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-gray-700">{{$requirement}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Highlights -->
                            <div class="bg-white rounded-lg p-6 mb-3">
                                <h2 class="text-4xl font-bold mb-4">Tour Highlights</h2>
                                <ul class="space-y-3">
                                    @foreach(json_decode($tour->tour_highlights) as $highLight)
                                        <li class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none"
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-gray-700">{{$highLight}}</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>


                            <!-- Cancellation Policy -->
                            <div class="bg-white rounded-lg p-6 mb-6">
                                <h2 class="text-2xl font-bold mb-4">Cancellation policy</h2>
                                <p class="text-gray-700">You can cancel for up to 24 hours in advance of the experience
                                    for
                                    a full refund.</p>
                            </div>

                            <!-- FAQ -->
                            <div class="bg-white rounded-lg p-6 mb-6">
                                <h2 class="text-2xl font-bold mb-4">Frequently asked questions</h2>
                                <div class="space-y-4" x-data="{ open: null }">
                                    <div class="border-b pb-4">
                                        <button @click="open = open === 1 ? null : 1"
                                                class="w-full flex items-center justify-between text-left">
                                            <span class="font-semibold text-gray-900">What to bring</span>
                                            <svg class="w-5 h-5 transition-transform"
                                                 :class="{ 'rotate-180': open === 1 }"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open === 1" x-collapse class="mt-3 text-gray-600">
                                            <p>We recommend bringing comfortable clothes, sunscreen, insect repellent,
                                                camera, and a change of clothes.</p>
                                        </div>
                                    </div>

                                    <div class="border-b pb-4">
                                        <button @click="open = open === 2 ? null : 2"
                                                class="w-full flex items-center justify-between text-left">
                                            <span class="font-semibold text-gray-900">Not allowed</span>
                                            <svg class="w-5 h-5 transition-transform"
                                                 :class="{ 'rotate-180': open === 2 }"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open === 2" x-collapse class="mt-3 text-gray-600">
                                            <p>Smoking, pets, alcohol, and touching elephants inappropriately are not
                                                allowed.</p>
                                        </div>
                                    </div>

                                    <div class="border-b pb-4">
                                        <button @click="open = open === 3 ? null : 3"
                                                class="w-full flex items-center justify-between text-left">
                                            <span class="font-semibold text-gray-900">Know before you go</span>
                                            <svg class="w-5 h-5 transition-transform"
                                                 :class="{ 'rotate-180': open === 3 }"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open === 3" x-collapse class="mt-3 text-gray-600">
                                            <p>This tour is suitable for all ages. Please arrive 10 minutes before
                                                departure
                                                time.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Meeting Point -->
                            <div class="bg-white rounded-lg p-6 mb-6">
                                <h2 class="text-2xl font-bold mb-6">Meeting Point</h2>
                                <div class="grid md:grid-cols-2 gap-6">
                                    @foreach(json_decode($tour->meeting_point) as $meeting_point)
                                        <div class="border border-gray-200 rounded-lg p-6">
                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                                                    <svg class="w-6 h-6 text-orange-500" fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                    </svg>
                                                </div>
                                                <h3 class="font-bold text-lg mb-2">{{$meeting_point->name}}</h3>
                                            </div>
                                            <div class="relative w-full overflow-hidden rounded-xl">
                                                <div
                                                    class="[&_iframe]:w-full [&_iframe]:h-64 [&_iframe]:rounded-xl [&_iframe]:border-0">
                                                    {!! $meeting_point->link !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                        <div>
                            <!-- Sidebar -->
                            <div class="lg:col-span-1">
                                @if(!$tour->hours->isEmpty())
                                    <div class="sticky top-4" x-data="priceForm()"
                                         x-init="setHour({{@$tour->hours[0]}});setTour({{$tour}});initCalendar();">
                                        <!-- Booking Card -->
                                        <!-- Tour Options Section -->
                                        <div class="max-w-md mx-auto p-4 space-y-4 border border-gray-400 rounded-xl">

                                            <!-- Duration Options -->
                                            <div class="space-y-3">
                                                <h2 class="font-semibold text-lg">Book Tour</h2>
                                                <hr/>
                                            </div>
                                            <div x-show="currentView=='priceView'">
                                                <div class="space-y-3">
                                                    <h2 class="font-bold text-gray-500 text-sm">Options</h2>
                                                    @foreach($tour->hours as $hour)
                                                        <div
                                                            class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200"
                                                            @click="setHour({{$hour}})"
                                                            :class="selectedhour?.id === {{$hour->id}} ? 'border-orange-500 ring-1 ring-orange-500 bg-orange-50/30' : 'border-gray-200 hover:border-orange-300'"
                                                        >
                                                            <h3 class="font-bold mb-1" :class="selectedhour?.id === {{$hour->id}} ? 'text-orange-600' : 'text-gray-900'">{{$hour->title}}</h3>
                                                            <p class="text-xs text-gray-600 leading-relaxed line-clamp-4">{{$hour->description}}</p>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Passenger Counter -->
                                                <div class="flex items-center justify-between rounded-xl my-5 p-4 bg-white border shadow-sm">
                                                    <div>
                                                        <p class="font-semibold">Passenger</p>
                                                        <p class="text-xs text-gray-500 text-sm">from €<span
                                                                x-text="selectedhour?.price?getPerPassengerPrice():{{$tour->starting_price}}"></span>
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center space-x-3">
                                                        <button @click="if (seletedPassenger>1)seletedPassenger--"
                                                                class="bg-gray-100 hover:bg-gray-200 transition rounded-full w-8 h-8 flex items-center justify-center text-xl cursor-pointer">
                                                            −
                                                        </button>
                                                        <input class="text-lg font-semibold w-8 text-center bg-transparent"
                                                               name="passenger"
                                                               disabled
                                                               x-model="seletedPassenger">
                                                        <button @click="seletedPassenger++"
                                                                class="bg-red-600 hover:bg-red-700 transition text-white rounded-full w-8 h-8 flex items-center cursor-pointer justify-center text-xl">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Add-ons List -->
                                                <div class="space-y-2 bg-gray-50 p-5 rounded-xl border border-gray-100">

                                                    <template x-for="addition in additioanls">
                                                        <div
                                                            class="bg-white border rounded-xl p-4 flex items-center justify-between shadow-sm">
                                                            <div>
                                                                <p class="font-semibold text-sm text-gray-800"
                                                                   x-text="addition.title"></p>
                                                                <p class="text-xs text-gray-500 mt-0.5">from
                                                                    €<span x-text="addition.price"></span></p>
                                                            </div>
                                                            <div class="flex items-center space-x-3">
                                                                <button
                                                                    @click="if (addition.count>0)addition.count--"
                                                                    class="bg-gray-100 hover:bg-gray-200 transition rounded-full w-8 h-8 flex items-center justify-center text-xl cursor-pointer">
                                                                    −
                                                                </button>
                                                                <input class="text-lg font-semibold w-8 text-center bg-transparent"
                                                                       disabled
                                                                       x-model="addition.count">
                                                                <button @click="addition.count++"
                                                                        class="bg-red-600 hover:bg-red-700 transition text-white rounded-full w-8 h-8 flex items-center cursor-pointer justify-center text-xl">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </template>

                                                </div>

                                                <div class="space-y-2 mt-6">
                                                    <div class="space-y-4">

                                                        <!-- Dynamic Full-Month Calendar -->
                                                        <div class="space-y-3">
                                                            <div class="flex items-center justify-between">
                                                                <label class="block text-sm font-semibold text-gray-800">Select Date</label>
                                                                <span class="text-xs font-bold text-orange-600" x-show="selectedDate" x-text="formatDate(selectedDate)"></span>
                                                            </div>

                                                            <!-- Calendar Component -->
                                                            <div class="bg-white border rounded-xl p-4 shadow-sm select-none">
                                                                <!-- Calendar Header -->
                                                                <div class="flex items-center justify-between mb-4">
                                                                    <button type="button"
                                                                            @click="prevMonth()"
                                                                            :disabled="month === new Date().getMonth() && year === new Date().getFullYear()"
                                                                            :class="{'opacity-30 cursor-not-allowed': month === new Date().getMonth() && year === new Date().getFullYear(), 'hover:bg-gray-100': !(month === new Date().getMonth() && year === new Date().getFullYear())}"
                                                                            class="p-2 rounded-full transition duration-150">
                                                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                                        </svg>
                                                                    </button>
                                                                    <div class="font-bold text-gray-800 text-sm uppercase tracking-wide" x-text="monthNames[month] + ' ' + year"></div>
                                                                    <button type="button" @click="nextMonth()" class="p-2 hover:bg-gray-100 rounded-full transition duration-150">
                                                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <!-- Days of Week -->
                                                                <div class="grid grid-cols-7 gap-1 mb-2">
                                                                    <template x-for="day in dayNames" :key="day">
                                                                        <div class="text-center text-xs font-semibold text-gray-400 uppercase tracking-wider" x-text="day"></div>
                                                                    </template>
                                                                </div>

                                                                <!-- Dates Grid -->
                                                                <div class="grid grid-cols-7 gap-1">
                                                                    <!-- Blank Days (Offset) -->
                                                                    <template x-for="blank in blankdays" :key="'blank-'+blank">
                                                                        <div class="h-10 w-full"></div>
                                                                    </template>

                                                                    <!-- Actual Days -->
                                                                    <template x-for="date in no_of_days" :key="'date-'+date">
                                                                        <button type="button"
                                                                                @click="selectDate(date)"
                                                                                :disabled="isPast(date)"
                                                                                :class="{
                                                                                'bg-orange-500 text-white font-bold shadow-md': isSelected(date),
                                                                                'text-gray-300 bg-gray-50 cursor-not-allowed': isPast(date) && !isSelected(date),
                                                                                'text-gray-700 hover:bg-orange-50 hover:text-orange-600': !isSelected(date) && !isPast(date)
                                                                            }"
                                                                                class="h-10 w-full rounded-lg flex items-center justify-center text-sm font-medium transition-all focus:outline-none">
                                                                            <span x-text="date"></span>
                                                                        </button>
                                                                    </template>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Time Slots -->
                                                        <div x-show="selectedDate" class="pt-4 mt-2" x-transition>
                                                            <label class="block text-sm font-semibold text-gray-800 mb-3">Available Times</label>

                                                            <div class="grid grid-cols-3 gap-3">
                                                                <template x-for="time in availableTimes" :key="time">
                                                                    <button
                                                                        @click="selectTime(time); priceFormErrors = priceFormErrors.filter(e => e !== 'Please select tour time')"
                                                                        :class="time === selectedTime
                                                                            ? 'border-orange-500 bg-orange-500 text-white shadow-md'
                                                                            : 'border-gray-200 bg-white text-gray-700 hover:border-orange-500 hover:text-orange-600'"
                                                                        class="py-2.5 px-2 rounded-xl border text-sm font-semibold transition-all flex items-center justify-center">
                                                                        <span x-text="time"></span>
                                                                    </button>
                                                                </template>
                                                            </div>
                                                        </div>

                                                        <!-- Selection Result -->
                                                        <div x-show="selectedDate && selectedTime" x-transition
                                                             class="mt-4 p-4 bg-orange-50/50 border border-orange-100 rounded-xl flex items-center gap-4 text-sm text-gray-700">
                                                            <div class="w-10 h-10 rounded-full bg-white border border-orange-200 flex items-center justify-center flex-shrink-0 shadow-sm">
                                                                <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <p class="font-bold text-orange-800 mb-0.5">Tour Schedule</p>
                                                                <p><span x-text="formatDate(selectedDate)"></span> at <span class="font-semibold text-orange-600" x-text="selectedTime"></span></p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="space-y-2 mt-3" x-show="priceFormErrors.length>0">
                                                    <template x-for="error in priceFormErrors">
                                                        <p
                                                            class="px-3 py-2 bg-red-50 border border-red-200 rounded-lg text-sm font-medium text-red-700 flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span x-text="error"></span>
                                                        </p>
                                                    </template>
                                                </div>

                                                <!-- Continue Button -->
                                                <button @click="submitPriceForm()"
                                                        class="mt-6 w-full bg-red-600 text-white rounded-lg py-3 font-medium hover:bg-red-700 transition flex items-center justify-between px-6 shadow-sm hover:shadow-md h-[52px]">
                                                    <span class="text-lg">
                                                        €<span x-text="getTotalPrice()"></span>
                                                    </span>
                                                    <span class="flex items-center gap-2 font-medium">Continue <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></span>
                                                </button>
                                            </div>


                                            <div class="m-0 p-0" x-show="currentView=='personalInformation'"
                                                 x-ref="personalInformation">
                                                <h2 class="text-sm font-semibold text-gray-500 mb-6">Contact
                                                    Details</h2>

                                                <div class="space-y-5">
                                                    <!-- Full Name -->
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Full name <span class="text-red-500">*</span>
                                                        </label>
                                                        <input
                                                            type="text"
                                                            x-model="contactFrom.fullName"
                                                            :class="personalInformationError.fullName ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500'"
                                                            class="w-full border rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 transition duration-150 focus:ring-2 focus:outline-none"
                                                            placeholder="Enter first name"
                                                        />
                                                        <span class="text-sm text-red-600 mt-1 block min-h-[20px]"
                                                              x-show="personalInformationError.fullName"
                                                              x-text="personalInformationError.fullName"></span>
                                                    </div>


                                                    <!-- Email -->
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Email <span class="text-red-500">*</span>
                                                        </label>
                                                        <input
                                                            type="email"
                                                            x-model="contactFrom.email"
                                                            :class="personalInformationError.email ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500'"
                                                            class="w-full border rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 transition duration-150 focus:ring-2 focus:outline-none"
                                                            placeholder="someone@example.com"
                                                        />
                                                        <span class="text-sm text-red-600 mt-1 block min-h-[20px]"
                                                              x-show="personalInformationError.email"
                                                              x-text="personalInformationError.email"></span>
                                                    </div>

                                                    <!-- Phone -->
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Mobile phone <span class="text-red-500">*</span>
                                                        </label>
                                                        <input
                                                            type="tel"
                                                            x-model="contactFrom.phone"

                                                            :class="personalInformationError.phone ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500'"
                                                            class="w-full border rounded-lg px-4 py-3 text-gray-900 placeholder-gray-400 transition duration-150 focus:ring-2 focus:outline-none"
                                                            placeholder="Enter phone number"
                                                        />
                                                        <span class="text-sm text-red-600 mt-1 block min-h-[20px]"
                                                              x-show="personalInformationError.phone"
                                                              x-text="personalInformationError.phone"></span>
                                                    </div>

                                                    <!-- Country -->
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Country <span class="text-red-500">*</span>
                                                        </label>
                                                        <select
                                                            x-model="contactFrom.country"

                                                            :class="personalInformationError.country ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500'"
                                                            class="w-full border rounded-lg px-4 py-3 text-gray-900 bg-white transition duration-150 focus:ring-2 focus:outline-none"
                                                        >
                                                            <option value="">Select country</option>
                                                            <option value="United States">United States</option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="France">France</option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="South Korea">South Korea</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="India">India</option>
                                                            <option value="China">China</option>
                                                            <option value="United Arab Emirates">United Arab Emirates
                                                            </option>
                                                        </select>
                                                        <span class="text-sm text-red-600 mt-1 block min-h-[20px]"
                                                              x-show="personalInformationError.country"
                                                              x-text="personalInformationError.country"></span>
                                                    </div>

                                                    <!-- Terms -->
                                                    <div class="space-y-4 pt-2">
                                                        <label class="flex items-start gap-3 cursor-pointer group">
                                                            <input
                                                                type="checkbox"
                                                                x-model="contactFrom.termsBooking"
                                                                class="w-4 h-4 mt-0.5 rounded border-gray-300 text-red-600 focus:ring-2 focus:ring-red-500 cursor-pointer"
                                                            />
                                                            <span class="text-sm text-gray-700 select-none">
                            I agree to the <a class="text-blue-600 hover:text-blue-700 underline font-medium" href="#">booking terms</a> <span
                                                                    class="text-red-500">*</span>
                        </span>
                                                        </label>
                                                        <span class="text-sm text-red-600 mt-1 block min-h-[20px]"
                                                              x-show="personalInformationError.termsBooking"
                                                              x-text="personalInformationError.termsBooking"></span>

                                                        <label class="flex items-start gap-3 cursor-pointer group">
                                                            <input
                                                                type="checkbox"
                                                                x-model="contactFrom.termsCancellation"
                                                                class="w-4 h-4 mt-0.5 rounded border-gray-300 text-red-600 focus:ring-2 focus:ring-red-500 cursor-pointer"
                                                            />
                                                            <span class="text-sm text-gray-700 select-none">
                            I agree to the <a class="text-blue-600 hover:text-blue-700 underline font-medium" href="#">cancellation terms</a> <span
                                                                    class="text-red-500">*</span>
                        </span>
                                                        </label>
                                                        <span class="text-sm text-red-600 mt-1 block min-h-[20px]"
                                                              x-show="personalInformationError.termsCancellation"
                                                              x-text="personalInformationError.termsCancellation"></span>
                                                    </div>

                                                    <div class="space-y-3 flex justify-between items-end mb-3">
                                                        <div class="text-sm font-semibold text-gray-700 m-0">
                                                            <p>Total Passenger</p>

                                                            <div class="text-xs text-gray-500"><span
                                                                    x-text="seletedPassenger"></span>*€<span
                                                                    x-text="getPerPassengerPrice()"></span></div>
                                                        </div>
                                                        <div class="text-xs font-semibold text-gray-500 m-0">€<span
                                                                x-text="totalPassengerPrice"></span></div>
                                                    </div>
                                                    <template x-for="addition in additioanls">
                                                        <div class="space-y-1 flex justify-between items-end mb-3"
                                                             x-show="addition.count>0">
                                                            <div class="text-sm font-semibold text-gray-700 m-0">
                                                                <p x-text="addition.title"></p>

                                                                <div class="text-xs text-gray-500"><span
                                                                        x-text="addition.count"></span>*€<span
                                                                        x-text="addition.price"></span></div>
                                                            </div>
                                                            <div class="text-xs font-semibold text-gray-500 m-0">€<span
                                                                    x-text="addition.count*addition.price"></span></div>
                                                        </div>

                                                    </template>

                                                    <!-- Submit Button (Optional) -->
                                                    <div class="pt-4 flex justify-between gap-3 mb-2">
                                                        <!-- Back Button -->
                                                        <button @click="currentView='priceView'"
                                                                type="button"
                                                                class="flex items-center gap-2 w-1/3 justify-center border border-gray-400
                                                            text-gray-700 bg-white hover:bg-gray-100 font-medium py-3 rounded-lg transition duration-150 h-[52px]">
                                                            ← Back
                                                        </button>

                                                        <!-- Pay Button -->
                                                        <button @click="submitPersonalInfoFrom()"
                                                                :disabled="isSubmitting"
                                                                type="button"
                                                                class="flex items-center gap-2 w-2/3 justify-around bg-red-600
               hover:bg-red-700 text-white font-medium py-3 rounded-lg transition duration-150 h-[52px]
               disabled:bg-gray-400 disabled:cursor-not-allowed">

                                                            <template x-if="isSubmitting">
                                                                <svg class="animate-spin h-5 w-5 text-white"
                                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                            stroke="currentColor"
                                                                            stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor"
                                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                </svg>
                                                            </template>

                                                            <span x-show="!isSubmitting">
                                                                €<span x-text="getTotalPrice()"></span>
                                                            </span>

                                                            <span class="flex justify-center items-center gap-2">
                                                                <template x-if="!isSubmitting">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                         viewBox="0 0 24 24"
                                                                         stroke-width="1.5" stroke="currentColor"
                                                                         class="w-5 h-5">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                              d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25
                                                                                    2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25
                                                                                    2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                                                                    </svg>
                                                                </template>
                                                                <span x-text="isSubmitting ? 'Processing...' : 'Pay →'"></span>
                                                            </span>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>


                                            <p class="text-xs text-gray-500">* Tuk Tuk tour, delays may occur due to
                                                traffic
                                                or restrictions.</p>
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        function priceForm() {
            return {
                currentView: 'priceView',
                selectedhour: null,
                isSubmitting: false,
                seletedPassenger: 1,
                totalPassengerPrice: null,
                tour: null,
                additioanls: [],
                selectedDate: '',
                selectedTime: '',
                availableTimes: [
                    '09:00 AM', '10:00 AM', '11:00 AM',
                    '12:00 PM', '01:00 PM', '02:00 PM',
                    '03:00 PM', '04:00 PM', '05:00 PM'
                ],

                // Calendar Properties
                month: new Date().getMonth(),
                year: new Date().getFullYear(),
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                dayNames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                blankdays: [],
                no_of_days: [],

                totalPrice: null,

                contactFrom: {
                    fullName: '',
                    email: '',
                    phone: '',
                    country: '',
                    termsBooking: false,
                    termsCancellation: false,
                },

                priceFormErrors: [],
                personalInformationError: [],

                initCalendar() {
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.getNoOfDays();
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                    let dayOfWeek = new Date(this.year, this.month).getDay();

                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                },

                nextMonth() {
                    if (this.month == 11) {
                        this.month = 0;
                        this.year++;
                    } else {
                        this.month++;
                    }
                    this.getNoOfDays();
                },

                prevMonth() {
                    let today = new Date();
                    if (this.year === today.getFullYear() && this.month === today.getMonth()) {
                        return;
                    }

                    if (this.month == 0) {
                        this.month = 11;
                        this.year--;
                    } else {
                        this.month--;
                    }
                    this.getNoOfDays();
                },

                isPast(date) {
                    let today = new Date();
                    today.setHours(0, 0, 0, 0);
                    let compareDate = new Date(this.year, this.month, date);
                    return compareDate < today;
                },

                selectDate(date) {
                    if (this.isPast(date)) return;
                    let selectedDateObj = new Date(this.year, this.month, date);
                    const y = selectedDateObj.getFullYear();
                    const m = String(selectedDateObj.getMonth() + 1).padStart(2, '0');
                    const d = String(selectedDateObj.getDate()).padStart(2, '0');

                    this.selectedDate = `${y}-${m}-${d}`;
                    this.priceFormErrors = this.priceFormErrors.filter(e => e !== 'Please select tour date');
                },

                isSelected(date) {
                    const y = this.year;
                    const m = String(this.month + 1).padStart(2, '0');
                    const d = String(date).padStart(2, '0');
                    return this.selectedDate === `${y}-${m}-${d}`;
                },

                setTour(data) {
                    this.tour = data;
                    data.additional.forEach(extra => {
                        this.additioanls.push({
                            id: extra.id,
                            title: extra.title,
                            price: extra.price,
                            count: 0,
                        });
                    });
                },

                setHour(data) {
                    this.selectedhour = data;
                    this.priceFormErrors = this.priceFormErrors.filter(e => e !== 'Please select Hour');
                },

                getPerPassengerPrice() {
                    this.totalPassengerPrice = Math.ceil(this.seletedPassenger / this.selectedhour?.number_of_people) * this.selectedhour.price;
                    return (this.totalPassengerPrice / this.seletedPassenger).toFixed(2);
                },

                selectTime(time) {
                    this.selectedTime = time
                },

                getTotalPrice() {
                    this.totalPrice = this.totalPassengerPrice;
                    this.additioanls.forEach(extra => {
                        if (extra.count > 0)
                            this.totalPrice += (extra.price * extra.count);
                    });
                    return this.totalPrice.toFixed(2);
                },

                formatDate(dateStr) {
                    if (!dateStr) return '';
                    const [year, month, day] = dateStr.split('-');
                    const dateObj = new Date(`${year}-${month}-${day}`);

                    return dateObj.toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                },

                submitPriceForm() {
                    this.priceFormErrors = [];

                    let hasError = false;

                    if (!this.selectedhour) {
                        this.priceFormErrors.push('Please select Hour');
                        hasError = true;
                    }
                    if (this.seletedPassenger < 1) {
                        this.priceFormErrors.push('Please select at least 1 passenger');
                        hasError = true;
                    }
                    if (!this.selectedDate) {
                        this.priceFormErrors.push('Please select tour date');
                        hasError = true;
                    }
                    if (!this.selectedTime) {
                        this.priceFormErrors.push('Please select tour time');
                        hasError = true;
                    }

                    if (hasError) {
                        return;
                    }
                    this.currentView = 'personalInformation';
                    setTimeout(() => {
                        const element = this.$refs.personalInformation;
                        if (element) {
                            element.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }, 100);
                },

                validateField(field) {
                    if (!this.contactFrom[field] || this.contactFrom[field].trim() === '') {
                        this.personalInformationError[field] = 'This field is required.';
                        return false;
                    } else {
                        delete this.personalInformationError[field];
                        return true;
                    }
                },

                validateEmail() {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!this.contactFrom.email || this.contactFrom.email.trim() === '') {
                        this.personalInformationError.email = 'This field is required.';
                        return false;
                    } else if (!emailRegex.test(this.contactFrom.email)) {
                        this.personalInformationError.email = 'Enter a valid email.';
                        return false;
                    } else {
                        delete this.personalInformationError.email;
                        return true;
                    }
                },

                validatePhone() {
                    const phoneRegex = /^\+?[1-9]\d{7,14}$/;

                    if (!this.contactFrom.phone || this.contactFrom.phone.trim() === '') {
                        this.personalInformationError.phone = 'This field is required.';
                        return false;
                    }
                    else if (!phoneRegex.test(this.contactFrom.phone.replace(/\s|-/g, ''))) {
                        this.personalInformationError.phone = 'Enter a valid international phone number with country code.';
                        return false;
                    }
                    else {
                        delete this.personalInformationError.phone;
                        return true;
                    }
                },

                validateAgreement(field) {
                    if (!this.contactFrom[field]) {
                        this.personalInformationError[field] = 'You must agree to continue.';
                        return false;
                    } else {
                        delete this.personalInformationError[field];
                        return true;
                    }
                },

                submitPersonalInfoFrom() {
                    if (this.validateField('fullName') && this.validateEmail() && this.validateField('country') && this.validatePhone('phone') && this.validateAgreement('termsCancellation') && this.validateAgreement('termsBooking')) {

                        this.isSubmitting = true;

                        const formData = new FormData();
                        formData.append('contact_form', JSON.stringify(this.contactFrom));
                        formData.append('totalPrice', this.totalPrice)
                        formData.append('tourTitle', this.tour.title)
                        formData.append('time', this.selectedTime)
                        formData.append('date', this.selectedDate)
                        formData.append('additionals', JSON.stringify(this.additioanls))
                        formData.append('perPassengerPrice', this.getPerPassengerPrice())
                        formData.append('passengerPrice', this.totalPassengerPrice)
                        formData.append('passenger', this.seletedPassenger)
                        formData.append('hour', JSON.stringify(this.selectedhour))

                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        fetch('{{route('pay.stripe')}}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
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
