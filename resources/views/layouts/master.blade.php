<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HolyMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/app.css">
    <script src="https://kit.fontawesome.com/36fd3a6ee4.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Oxygen&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Oxygen', sans-serif;
            padding: 0;
            margin: 0;
            text-decoration: none ;
            list-style-type: none !important;
        }
    </style>
</head>


<body>
    @include('sweetalert::alert')

    <div class="mx-auto w-full">
        <div class="w-full h-auto">

            <div class="p-6 w-full h-auto bg-white px-12 flex-row flex items-center justify-between fixed border-b border-gray-200">
                <div class="flex flex-row items-center gap-6">
                    <a href="{{ route('index') }}" class="text-2xl text-black font-bold">505Gadget</a>
                    {{-- <div class="">
                        <ul class="flex-row flex text-black gap-4 text-sm">
                            <li><a href="">Home</a></li>
                            <li><a href="">Profile</a></li>
                        </ul>
                    </div> --}}
                </div>
                <ul class="menu menu-horizontal px-1 flex items-center">
                    @if (Auth::user())
                        <div class="flex flex-row text-black gap-1">
                            <div class="flex flex-row items-center gap-1 ">
                                <p class="font-semibold text-sm text-black">
                                    {{ format_to_rp(Auth::user()->wallet->credit) }}</p>
                                <a href="{{ route('topup.index') }}" class="px-2 rounded-md hover:bg-white/75">
                                    <i class="fa-regular fa-credit-card "></i>
                                </a>

                            </div>
                            <div class="flex flex-row items-center gap-1 ">
                                <a href="{{ route('cart.index') }}" class="bg-white rounded-md hover:bg-white/75">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                            <a href="{{ route('profile') }}"
                                class="flex flex-row items-center gap-3 bg-white p-2 px-3 rounded-md hover:bg-black/75">
                                <p class="font-semibold text-sm"> {{ Auth::user()->name }}</p>
                                <i class="fa-regular fa-user"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="py-1.5 px-6 border-2 border-black">
                                <p class="font-bold text-base">Login</p>
                            </a>
                    @endif
                </ul>

            </div>
        </div>
        <div class="">
            @yield('content')
        </div>
    </div>

    </div>
</body>

</html>
