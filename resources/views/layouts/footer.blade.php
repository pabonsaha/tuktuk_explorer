<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between gap-8 mb-8">
            <div class="max-w-full md:max-w-sm">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-orange-500 rounded flex items-center justify-center">
                        <img src="{{asset('/logo/logo.ico')}}" alt="TukTuk Explorer Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl font-bold">TukTuk Explorer</span>
                </div>
                <p class="text-gray-400 text-sm mb-4">
                    Need any help? Call our customer support team 24/7 at:
                </p>
                <div class="flex items-center gap-2 text-lg font-semibold">
                    <span>📞</span>
                    <a href="tel:+351920204443" class="hover:text-orange-500 transition">+351 920 204 443</a>
                </div>
            </div>

            <div class="max-w-full md:max-w-sm">
                <h3 class="font-bold mb-4">Contact</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="flex-shrink-0">📧</span>
                        <a href="mailto:tuktuk.lisbon3400@gmail.com"
                           class="break-all hover:text-orange-500 transition">
                            tuktuk.lisbon3400@gmail.com
                        </a>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="flex-shrink-0">📱</span>
                        <a href="https://instagram.com/yourprofile"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-orange-500 transition">
                            Instagram
                        </a>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="flex-shrink-0">📘</span>
                        <a href="https://facebook.com/yourpage"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-orange-500 transition">
                            Facebook
                        </a>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="flex-shrink-0">🐦</span>
                        <a href="https://twitter.com/yourprofile"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-orange-500 transition">
                            Twitter
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm gap-4">
            <p class="text-center md:text-left">© {{date('Y')}} TukTuk Explorer. All rights reserved.</p>
            <div class="flex gap-4">
                <span>EN</span>
                <span>•</span>
                <span>USD</span>
            </div>
        </div>
    </div>
</footer>
