@extends('layouts.master')

@section('content')
    <section class="min-h-screen max-w-6xl mx-auto px-6 py-20">

        <div class="grid md:grid-cols-2 gap-16 items-center">

            <!-- Profile Image with Decorative Elements -->
            <div class="flex justify-center relative slide-in">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-indigo-600 rounded-full blur-3xl opacity-20 float-animation"></div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full blur-lg opacity-30"></div>
                    <img
                        src="{{asset('/frontend-assets/images/know-us/image-1.png')}}"
                        alt="Tour Guide Portrait"
                        class="relative w-64 h-64 md:w-80 md:h-80 rounded-full object-cover shadow-2xl border-4 border-white"
                    >
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-full p-4 shadow-xl">
                        <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- About Text -->
            <div class="space-y-6 slide-in">
                <div>
                    <p class="text-indigo-600 font-semibold text-sm uppercase tracking-wider mb-2">Your Local Expert</p>
                    <h1 class="text-5xl md:text-6xl font-bold gradient-text mb-4">About Me</h1>
                </div>

                <p class="text-gray-700 leading-relaxed text-lg">
                    Olá! I'm <span class="font-semibold text-indigo-600">Riaz Uddin</span>, a proud Lisboeta and your personal guide to the soul of Portugal's enchanting capital.
                    I've spent years sharing the hidden stories, secret viewpoints, and authentic flavors that make Lisbon truly magical.
                </p>

                <p class="text-gray-700 leading-relaxed text-lg">
                    With a background in Portuguese history and a passion for gastronomy, I don't just show you Lisbon—I help you <span class="italic">feel</span> it.
                    From the melancholic beauty of fado echoing through narrow streets to the golden glow of sunset over the Tagus River, every tour is a carefully crafted journey through time and culture.
                </p>

                <div class="pt-4 space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-indigo-600 rounded-full"></div>
                        <p class="text-gray-700"><span class="font-semibold">3+ years</span> of guiding experience</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                        <p class="text-gray-700">Fluent in <span class="font-semibold">English, Portuguese, Spanish & French</span></p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-indigo-600 rounded-full"></div>
                        <p class="text-gray-700">Certified <span class="font-semibold">Tourism Guide License</span></p>
                    </div>
                </div>

            </div>

        </div>

        <!-- Specialties Section -->
        <div class="mt-24">
            <h2 class="text-4xl font-bold text-center gradient-text mb-12">What Makes My Tours Special</h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Authentic Stories</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Go beyond guidebooks with tales passed down through generations, local legends, and insider knowledge only a true Lisboeta can share.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Hidden Gems</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Discover secret miradouros, family-run tascas, and charming corners that most tourists never find—places I've known since childhood.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Personal Touch</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Small groups, flexible itineraries, and experiences tailored to your interests—whether you love history, food, art, or all three!
                    </p>
                </div>

            </div>
        </div>

    </section>
@endsection

