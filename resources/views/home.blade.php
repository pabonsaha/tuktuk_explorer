@extends('layouts.master')

@push('styles')
    <style>
        .banner-slider {
            position: relative;
            overflow: hidden;
        }

        .banner-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .banner-slide.active {
            opacity: 1;
        }


        .banner-slide.active img {
            transition: transform 6s ease-out;
            transform: scale(1.1);
        }

        .banner-slide img {
            transform-origin: center;
            will-change: transform;
            transition: transform 2s ease-in;
            transform: scale(1);
        }
    </style>
@endpush

@section('content')
    <section class="banner-slider h-screen relative"
             x-data="bannerSlider()"
             x-init="loadData({{ $banners->toJson() }});">

        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div class="banner-slide relative"
                 :class="{ 'active': currentSlide === index }">

                <img :src="`/storage/${slide.image}`"
                     alt="Banner"
                     :class="['w-full h-full object-cover']">

                <div class="absolute inset-0 pointer-events-none z-10">
                    <div class="absolute inset-x-0 top-0 h-1/3 bg-gradient-to-b from-black/80 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-black/80 to-transparent"></div>
                </div>

                <div class="absolute bottom-16 left-10 text-white max-w-xl z-20">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-3"
                        x-text="slide.title">
                    </h1>
                </div>
            </div>
        </template>

    </section>


    <!-- Why We're Your Perfect Travel Partner -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="text-orange-500 text-sm font-semibold mb-2 uppercase tracking-wider">
                        Get to know us
                    </div>
                    <h2 class="text-4xl font-bold mb-6">
                        Why We're Your<br>Perfect Travel<br>Partner
                    </h2>
                    <p class="text-gray-600 mb-6">
                        <strong>TukTuk Explorer</strong> is a boutique travel company based in Lisbon, Portugal,
                        offering fun and personal TukTuk tours since 2023. We specialize in exploring Lisbon’s most
                        iconic areas, including the historic old town, Belém, and the vibrant city center. With
                        knowledgeable local guides and comfortable electric tuk-tuks, our mission is to provide
                        travelers with an effortless, memorable, and authentic way to experience the heart and history
                        of Lisbon.
                    </p>
                    <div class="flex items-center gap-4">
                        <button class="bg-primary text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                            Read More
                        </button>
                        <div class="flex items-center gap-2 text-gray-700">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex  justify-center items-center ">
                                <svg
                                    class="h-6 w-6 text-green-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 448 512">
                                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">+351 920 204 443</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="h-60 md:h-80 rounded-lg overflow-hidden">
                            <img
                                alt="image"
                                src="{{asset('/frontend-assets/images/know-us/image-1.png')}}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="h-60 md:h-80 bg-gray-300 rounded-lg md:mt-8 overflow-hidden">
                            <img
                                alt="image"
                                src="{{asset('/frontend-assets/images/know-us/image-2.png')}}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 md:w-24 md:h-24 bg-green-500 rounded-full flex items-center justify-center shadow-lg z-10">
                        <div class="w-10 h-10 md:w-16 md:h-16 bg-white rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Best Selling Tours -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 mb-8">
            <div class="flex justify-between items-center">
                <h2 class="text-4xl font-bold">Our Tours</h2>
            </div>
        </div>

        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center">
                @foreach($tours as $tour)
                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">

                        <!-- Image -->
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ getFilePath($tour->thumbnail) }}"
                                 alt="tour image"
                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col justify-between flex-1 space-y-4">

                            <h3 class="text-xl font-bold hover:text-orange-500 transition line-clamp-2">
                                {{ $tour->title }}
                            </h3>

                            <!-- Icons Row -->
                            <div class="flex items-center justify-around text-sm text-gray-600 gap-6">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="size-6">
                                      <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>

                                    from {{ getPriceFormat($tour->starting_price) }}
                                </span>

                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="size-6">
                                      <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>

                                    {{ $tour->tour_duration }}
                                </span>

                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                    </svg>

                                    up to {{ $tour->num_of_people }}
                                </span>
                            </div>

                            <!-- Short Description -->
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-5">
                                {!! strip_tags($tour->description) !!}
                            </p>

                            <!-- Buttons -->
                            <div class="grid grid-cols-1 gap-3 mt-2">
                                <a href="{{route('tour.details',$tour->slug)}}"
                                   class="bg-white border border-primary text-primary text-center font-semibold py-3 rounded transition">
                                    BOOK TOUR NOW
                                </a>

                            </div>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>


    </section>

    <!-- Features -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <div class="w-8 h-8 bg-orange-500 rounded flex  justify-center items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/>
                            </svg>

                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">24-hour Support</h3>
                    <p class="text-gray-600 text-sm">A free services that only requires verification and identity.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <div class="w-8 h-8 bg-orange-500 rounded flex  justify-center items-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z"/>
                            </svg>

                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">No Hidden Fees</h3>
                    <p class="text-gray-600 text-sm">Matches up-front fees from competitors nationwide.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <div class="w-8 h-8 bg-orange-500 rounded flex  justify-center items-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>
                            </svg>

                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Booking Flexibility</h3>
                    <p class="text-gray-600 text-sm">If another agent can do it, we have the flexibility to do it
                        too.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <div class="w-8 h-8 bg-orange-500 rounded flex  justify-center items-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"/>
                            </svg>

                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Included Transfers</h3>
                    <p class="text-gray-600 text-sm">Includes airport pickups, hotel check-in and check-out.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations We Love -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-bold">Destinations We Love The Most</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="relative h-64 rounded-lg overflow-hidden group cursor-pointer">
                    <div class="absolute inset-0 bg-gray-300">
                        <img alt="image"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                             src="{{asset('/frontend-assets/images/destinations/lisbon.jpg')}}">
                    </div>

                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold text-lg">Lisbon</h3>

                    </div>
                </div>
                <div class="relative h-64 rounded-lg overflow-hidden group cursor-pointer">
                    <div class="absolute inset-0 bg-gray-300">
                        <img alt="image"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                             src="{{asset('/frontend-assets/images/destinations/sintra.jpg')}}">
                    </div>

                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold text-lg">Sintra</h3>
                    </div>
                </div>
                <div class="relative h-64 rounded-lg overflow-hidden group cursor-pointer">
                    <div class="absolute inset-0 bg-gray-300">
                        <img alt="image"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                             src="{{asset('/frontend-assets/images/destinations/porto.jpg')}}">
                    </div>

                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold text-lg">Porto</h3>
                    </div>
                </div>
                <div class="relative h-64 rounded-lg overflow-hidden group cursor-pointer">
                    <div class="absolute inset-0 bg-gray-300">
                        <img alt="image"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                             src="{{asset('/frontend-assets/images/destinations/algerve.jpg')}}">
                    </div>

                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold text-lg">the Algarve</h3>
                    </div>
                </div>
                <div class="relative h-64 rounded-lg overflow-hidden group cursor-pointer">
                    <div class="absolute inset-0 bg-gray-300">
                        <img alt="image"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                             src="{{asset('/frontend-assets/images/destinations/Madeira.jpeg')}}">
                    </div>

                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="font-bold text-lg">Madeira</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our Travel Community -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Join Our Travel Community</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Share your travel experiences and connect with fellow travelers from around the world
            </p>

            <div class="max-w-md mx-auto mb-12">
                <div class="flex gap-2">
                    <input type="email" placeholder="Enter your email"
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg outline-none focus:border-orange-500">
                    <button class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition">
                        Subscribe
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-1.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-2.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-3.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-4.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-5.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-6.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-7.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-8.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-9.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-10.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-11.png')}}">
                </div>
                <div class="h-48 rounded-lg"><img alt="img"
                                                  class="rounded-lg w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                  src="{{asset('/frontend-assets/images/community/image-12.png')}}">
                </div>
            </div>
        </div>
    </section>

    {{--    <!-- Our Happy Traveller -->--}}
    {{--    <section class="py-20 bg-green-50">--}}
    {{--        <div class="container mx-auto px-4">--}}
    {{--            <h2 class="text-4xl font-bold text-center mb-4">Our Happy Traveller</h2>--}}

    {{--            <div class="flex justify-center mb-8">--}}
    {{--                <div class="flex items-center gap-2 bg-white px-6 py-3 rounded-full shadow">--}}
    {{--                    <div class="w-8 h-8 bg-green-500 rounded-full"></div>--}}
    {{--                    <span class="font-semibold">TripAdvisor</span>--}}
    {{--                    <div class="flex text-green-500 text-xl">★★★★★</div>--}}
    {{--                    <span class="text-gray-600">950+ reviews</span>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="grid md:grid-cols-4 gap-6">--}}
    {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
    {{--                    <div class="flex text-yellow-400 mb-4">★★★★★</div>--}}
    {{--                    <h3 class="font-bold mb-2">It really was perfectly organized</h3>--}}
    {{--                    <p class="text-gray-600 text-sm mb-4">--}}
    {{--                        It really was perfectly organized. It was a very friendly and helpful group. We had lots of--}}
    {{--                        activities with the other tour members if desired, but we also had plenty of time for individual--}}
    {{--                        exploration.--}}
    {{--                    </p>--}}
    {{--                    <div class="flex items-center gap-3">--}}
    {{--                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>--}}
    {{--                        <div>--}}
    {{--                            <div class="font-semibold">Nikol Costa</div>--}}
    {{--                            <div class="text-sm text-gray-500">December 15, 2023</div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
    {{--                    <div class="flex text-yellow-400 mb-4">★★★★★</div>--}}
    {{--                    <h3 class="font-bold mb-2">It really was perfectly organized</h3>--}}
    {{--                    <p class="text-gray-600 text-sm mb-4">--}}
    {{--                        It really was perfectly organized. It was a very friendly and helpful group. We had lots of--}}
    {{--                        activities with the other tour members if desired, but we also had plenty of time for individual--}}
    {{--                        exploration.--}}
    {{--                    </p>--}}
    {{--                    <div class="flex items-center gap-3">--}}
    {{--                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>--}}
    {{--                        <div>--}}
    {{--                            <div class="font-semibold">Sarah Castro</div>--}}
    {{--                            <div class="text-sm text-gray-500">January 8, 2024</div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
    {{--                    <div class="flex text-yellow-400 mb-4">★★★★★</div>--}}
    {{--                    <h3 class="font-bold mb-2">It really was perfectly organized</h3>--}}
    {{--                    <p class="text-gray-600 text-sm mb-4">--}}
    {{--                        It really was perfectly organized. It was a very friendly and helpful group. We had lots of--}}
    {{--                        activities with the other tour members if desired, but we also had plenty of time for individual--}}
    {{--                        exploration.--}}
    {{--                    </p>--}}
    {{--                    <div class="flex items-center gap-3">--}}
    {{--                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>--}}
    {{--                        <div>--}}
    {{--                            <div class="font-semibold">Mark Ulrich</div>--}}
    {{--                            <div class="text-sm text-gray-500">February 20, 2024</div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
    {{--                    <div class="flex text-yellow-400 mb-4">★★★★★</div>--}}
    {{--                    <h3 class="font-bold mb-2">It really was perfectly organized</h3>--}}
    {{--                    <p class="text-gray-600 text-sm mb-4">--}}
    {{--                        It really was perfectly organized. It was a very friendly and helpful group. We had lots of--}}
    {{--                        activities with the other tour members if desired, but we also had plenty of time for individual--}}
    {{--                        exploration.--}}
    {{--                    </p>--}}
    {{--                    <div class="flex items-center gap-3">--}}
    {{--                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>--}}
    {{--                        <div>--}}
    {{--                            <div class="font-semibold">Anna Larso</div>--}}
    {{--                            <div class="text-sm text-gray-500">March 5, 2024</div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

@endsection

@push('scripts')

    <script>
        function bannerSlider(banners) {
            return {
                currentSlide: 0,
                slides: banners,
                init() {
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    }, 3000);
                },
                loadData(data) {
                    this.slides = data;
                }
            }
        }
    </script>

@endpush
