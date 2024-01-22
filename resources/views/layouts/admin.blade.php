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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <style>
        * {
            font-family: 'Oxygen', sans-serif;
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style-type: none !important;
        }

        tr,
        td,
        th {
            padding:
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="w-full ">
        {{-- <header class="bg-gradient-to-r from-blue-800 to-sky-900 w-full h-16 px-6 py-4 flex justify-between lg:hidden">
            <div class="flex-1">
                <a class="text-xl text-white">
                    Fintech
                    @if (Auth::user()->role->id == 4)
                        Kantin
                    @elseif(Auth::user()->role->id == 2)
                        Bank
                    @elseif(Auth::user()->role->id == 3)
                        Admin
                    @endif
                </a>
            </div>
            <button class="text-white" id="hamburger">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>

        </header> --}}
        <div class=" flex gap-4 w-full ">
            <div class="pl-4 fixed left-0 z-30 w-1/2 lg:w-1/6 bg-black pt-6 min-h-full hidden lg:block ">
                <div class="flex-1">
                    <a class="btn btn-ghost text-xl text-white">
                        505Gadget
                        @if (Auth::user()->role->id == 4)
                            Product
                        @elseif(Auth::user()->role->id == 2)
                            Bank
                        @elseif(Auth::user()->role->id == 3)
                            Admin
                        @endif
                    </a>
                </div>
                @if (Auth::user()->role->id == 3)
                    <ul class="pl-4 flex flex-col gap-4 mt-4 text-white opacity-80">
                        <li><a href="{{ route('admin.index') }}">Home</a></li>
                        <li><a href="{{ route('admin.userindex') }}">Add User</a></li>
                        <li><a href="{{ route('admin.transaction') }}">Transaction</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                @elseif(Auth::user()->role->id == 2)
                    <ul class="pl-4 flex flex-col gap-4 mt-4 text-white opacity-80">
                        <li><a href="{{ route('bank.index') }}">Home</a></li>
                        <li><a href="{{ route('bank.topup.index') }}">Top Up</a></li>
                        <li><a href="{{ route('bank.tariktunai') }}">Withdraw</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                @elseif(Auth::user()->role->id == 4)
                    <ul class="pl-4 flex flex-col gap-4 mt-4 text-white opacity-80">
                        <li><a href="{{ route('kantin.index') }}">Home</a></li>
                        <li><a href="{{ route('kantin.product.index') }}">Add Product</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                @endif

            </div>
            <main class=" w-full min-h-screen h-full flex">
                <div class="w-1/6"></div>
                <div class="w-5/6">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>
    <script src="{{ asset('js/hamburger.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    @stack('script')
</body>

</html>
