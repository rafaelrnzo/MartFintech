@extends('layouts.master')
@section('content')
    <div class="pt-24">

        <div class="h-auto px-12 bg-black">
            <a class="btn btn-primary" href="{{ route('index') }}">Kembali</a>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </div>
        <div
            class="top flex lg:flex-row flex-col gap-8 justify-between items-center bg-white px-8 py-24 rounded-md shadow-md">
            <div class="top-left">

                <div class="profile flex items-center gap-5">
                    <div class="avatar">
                        <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="https://this-person-does-not-exist.com/static/images/fake-2.jpg" />
                        </div>
                    </div>
                    <div class="description">
                        <h1 class="text-xl font-semibold">{{ Str::ucfirst(Auth::user()->name) }}</h1>
                        <p>Joined Date: {{ Auth::user()->created_at }}</p>
                        <p class="text-2xl font-semibold">{{ format_to_rp(Auth::user()->wallet->credit) }}</p>
                    </div>
                </div>
            </div>
            <div class="top-right">
                <div class="debit flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z" />
                        <path fill-rule="evenodd"
                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg>
                    <div class="description">
                        <p class="text-md">
                            Pengeluaran Saat Ini
                        </p>
                        <p class="text-2xl font-semibold">{{ format_to_rp(Auth::user()->wallet->debit) }}</p>

                    </div>

                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-12">
            <div class="transaction-history">
                <p class="mt-6 text-xl font-semibold">
                    Riwayat Transaksi
                </p>
                @if (count($transactions))
                    <div class="grid grid-cols-1 mt-2">
                        @foreach ($transactions as $date => $transactionGroup)
                            <h2 class="my-2">{{ $date }}</h2>
                            <div class="grid grid-cols-1 my-3 gap-2 bg-white rounded-md overflow-hidden shadow-md">
                                @foreach ($transactionGroup as $transaction)
                                    <div class="card card-side h-fit w-full border-b-[1px] rounded-[0px] py-1">
                                        <div class="card-body py-3">
                                            <p class="text-xl font-semibold">{{ $transaction->product->name }}</p>
                                            <p>{{ format_to_rp($transaction->product->price) }} x
                                                {{ $transaction->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @else
                    <div role="alert" class="alert mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="stroke-info shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Belum Ada Transaksi Untuk Saat Ini</span>
                    </div>
                @endif

            </div>
            <div class="topup-history">
                <p class="mt-6 text-xl font-semibold">
                    Riwayat Top Up
                </p>
                @if (count($topups))
                    <div class="grid grid-cols-1 mt-2">
                        @foreach ($topups as $date => $topupGroup)
                            <h2 class="my-2">{{ $date }}</h2>
                            <div class="grid grid-cols-1 my-3 bg-white rounded-md shadow-md overflow-hidden">
                                @foreach ($topupGroup as $topup)
                                    <div class="card card-side h-fit shadow-lg w-full border-b-[1px] rounded-[0px] py-1">
                                        <div class="card-body">
                                            <div class="body-wrappers flex justify-between items-center">
                                                <div class="body-left">
                                                    <p>
                                                        {{ $topup->order_id }}
                                                    </p>
                                                    <p class="text-xl font-semibold text-green-500">
                                                        + {{ format_to_rp($topup->nominals) }}
                                                    </p>
                                                </div>
                                                <div class="body-right">
                                                    @if ($topup->status == 'unconfirmed')
                                                        <div class="bg-red-400 px-3 py-1 rounded-md text-white">
                                                            Belum Dikonfirmasi
                                                        </div>
                                                    @elseif($topup->status == 'confirmed')
                                                        <div class="bg-green-400 px-3 py-1 rounded-md text-white">
                                                            Terkonfirmasi
                                                        </div>
                                                    @elseif($topup->status == 'rejected')
                                                        <div class="bg-red-400 px-3 py-1 rounded-md text-white">
                                                            Ditolak
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @else
                    <div role="alert" class="alert mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="stroke-info shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Belum Ada Top Up Untuk Saat Ini</span>
                    </div>
                @endif

            </div>
            <div class="tariktunai-history">
                <p class="mt-6 text-xl font-semibold">
                    Riwayat Tarik Tunai
                </p>

                @if (count($tariktunais))
                    <div class="grid grid-cols-1 mt-2">
                        @foreach ($tariktunais as $date => $tarikTunaiGroup)
                            <h2 class="my-2">{{ $date }}</h2>
                            <div class="grid grid-cols-1 my-3 bg-white rounded-md shadow-md overflow-hidden">
                                @foreach ($tarikTunaiGroup as $tarikTunai)
                                    <div class="card card-side h-fit shadow-lg w-full border-b-[1px] rounded-[0px] py-1">
                                        <div class="card-body">
                                            <div class="body-wrappers flex justify-between items-center">
                                                <div class="body-left">
                                                    <p>
                                                        {{ $topup->order_id }}
                                                    </p>
                                                    <p class="text-xl font-semibold text-red-500">
                                                        - {{ format_to_rp($tarikTunai->nominals) }}
                                                    </p>
                                                </div>
                                                <div class="body-right">
                                                    @if ($tarikTunai->status == 'unconfirmed')
                                                        <div class="bg-red-400 px-3 py-1 rounded-md text-white">
                                                            Belum Dikonfirmasi
                                                        </div>
                                                    @elseif($tarikTunai->status == 'confirmed')
                                                        <div class="bg-green-400 px-3 py-1 rounded-md text-white">
                                                            Terkonfirmasi
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @else
                    <div role="alert" class="alert mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="stroke-info shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Belum Ada Tarik Tunai Untuk Saat Ini</span>
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection
