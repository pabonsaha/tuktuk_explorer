<header class="absolute top-0 left-0 w-full z-50 @if(Route::is('home')) text-white @endif">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a class="flex items-center gap-2" href="{{route('home')}}">
                    <div class="w-10 h-10 rounded">
                        <img alt="icon" src="{{asset('/logo/logo.ico')}}"/>
                    </div>
                    <span class="text-xl font-bold">TukTuk Explorer</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{route('about')}}" class=" bg-primary px-6 py-2 rounded-full transition text-white">
                   About Me
                </a>
            </div>
        </div>
    </div>
</header>
