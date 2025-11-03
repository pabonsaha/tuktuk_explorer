<header class="absolute top-0 left-0 w-full z-50 @if(Route::is('home')) text-white @endif">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded">
                        <img alt="icon" src="{{asset('/logo/logo.ico')}}"/>
                    </div>
                    <span class="text-xl font-bold">TukTuk Explorer</span>
                </div>
                <nav class="hidden md:flex gap-6">
                    <a href="#" class="hover:color-primary transition">About</a>
                    <a href="#" class="hover:color-primary transition">Destination</a>
                    <a href="#" class="hover:text-orange-500 transition">Tour</a>
                    <a href="#" class="hover:text-orange-500 transition">Blog</a>
                    <a href="#" class="hover:text-orange-500 transition">Pages</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <button class=" bg-primary px-6 py-2 rounded-full transition text-white" >
                    Book Now
                </button>
            </div>
        </div>
    </div>
</header>
