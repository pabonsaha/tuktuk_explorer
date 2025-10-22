<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon.ico') }}">
    <title>Tuk Tuk</title>

    @vite(['resources/admin/js/index.js', 'resources/admin/css/style.css'])
    @stack('style')
</head>
<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
>
<!-- ===== Preloader Start ===== -->
@include('admin.layout.preloader')

<!-- ===== Preloader End ===== -->

<!-- ===== Page Wrapper Start ===== -->
<div class="flex h-screen overflow-hidden">
    <!-- ===== Sidebar Start ===== -->
    @include('admin.layout.sidebar')
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div
        class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
    >
        <!-- Small Device Overlay Start -->
        @include('admin.layout.overlay')
        <!-- Small Device Overlay End -->

        <!-- ===== Header Start ===== -->
        @include('admin.layout.header')
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                @yield('content')
            </div>
        </main>
        <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
</div>
<!-- ===== Page Wrapper End ===== -->

@stack('script')

</body>

@if (session('success'))
    <script type="module">
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script type="module">
        toastr.error("{{ session('error') }}");
    </script>
@endif

@if (session('warning'))
    <script type="module">
        toastr.warning("{{ session('warning') }}");
    </script>
@endif

@if (session('info'))
    <script type="module">
        toastr.info("{{ session('info') }}");
    </script>
@endif

</html>
