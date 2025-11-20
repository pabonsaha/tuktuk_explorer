<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-row justify-between gap-8 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-orange-500 rounded"><img  src="{{asset('/logo/logo.ico')}}"></div>
                    <span class="text-xl font-bold">TukTuk Explorer</span>
                </div>
                <p class="text-gray-400 text-sm mb-4">
                    Need any help? Call our customer support team 24/7 at:
                </p>
                <div class="flex items-center gap-2 text-lg font-semibold">
                    <span>📞</span>
                    <span>+351 920 204 443</span>
                </div>
            </div>

            <div>
                <h3 class="font-bold mb-4">Contact</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start gap-2">
                        <span>📧</span>
                        <span>tuktuk.lisbon3400@gmail.com</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span>📱</span>
                        <span>Instagram</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span>📘</span>
                        <span>Facebook</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span>🐦</span>
                        <span>Twitter</span>
                    </li>
{{--                    <li class="flex items-start gap-2">--}}
{{--                        <span>💼</span>--}}
{{--                        <span>Youtube</span>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
            <p>© {{date('Y')}} Travel. All rights reserved.</p>
            <div class="flex gap-4 mt-4 md:mt-0">
                <span>EN</span>
                <span>•</span>
                <span>USD</span>
            </div>
        </div>
    </div>
</footer>
