@extends('layouts.master')
@section('content')
    @if (count($transactions))
        <div class="p-12 pt-32 px">
            <div class="flex items-center justify-between py-2">
                <h1 class="font-semibold text-4xl">Your Cart</h1>
                <a href="{{ route('index') }}" class=" ">
                    <p class="underline underline-offset-2c:\Users\acer\usk_fintech\resources\views\profile.blade.php">
                        Continue Shopping
                    </p>
                </a>
            </div>
            <div class="flex justify-between gap-8">
                <div class="grid grid-cols-1 gap-3 w-full ">
                    <div class="border-b border-gray-200 py-2 flex justify-between">
                        <p class="text-sm text-black/50">Product</p>
                        <p class="text-sm text-black/50">Total Price</p>
                    </div>
                    @foreach ($transactions as $transaction)
                        <div class="flex justify-start gap-8">
                            <div class="overflow-hidden  ">
                                <img class="object-cover w-[140px] h-[140px] "
                                    src="{{ $transaction->product->thumbnail }}" />
                            </div>
                            <div class="flex gap-2 flex-col w-full">
                                <p class="font-bold text-base">{{ $transaction->product->name }}</p>
                                <div class="flex justify-between w-full">

                                    <p class="font-normal text-sm">{{ format_to_rp($transaction->product->price) }} x
                                        {{ $transaction->quantity }}</p>
                                    <p class="font-normal text-sm">{{ format_to_rp($transaction->total_price) }}</p>
                                </div>
                                <div class="">
                                    <form action="{{ route('cart.delete', $transaction->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-error text-white">
                                            <i class="fa-solid fa-trash text-black"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class=" w-1/4">
                    <div class=" w-full max-h-full gap-2 flex flex-col bg-white mt-2 rounded-lg">
                        <div class="flex justify-between items-center">
                            <p class="title font-semibold text-lg">
                                Total Price
                            </p>
                            <p class="price text-2xl font-normal ">
                                {{ format_to_rp($total_prices_all) }}
                            </p>
                        </div>
                        <div class="button">
                            <form action="{{ route('cart.pay') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $total_prices_all }}" name="total_prices">
                                <button type="submit" class="bg-black w-full py-2">
                                    <p class="text-white">
                                        Pay Now
                                    </p>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="p-12 pt-32 px">
            <div class="flex items-center justify-between py-2">
                <h1 class="font-semibold text-4xl">Your Cart</h1>
                <a href="{{ route('index') }}" class="underline " sty>
                    Continue Shopping
                </a>
            </div>
            <div class="flex justify-between gap-8">
                <div class="grid grid-cols-1 gap-3 w-full ">
                    <div class="border-b border-gray-200 py-2 flex justify-between">
                        <p class="text-sm text-black/50">Product</p>
                        <p class="text-sm text-black/50">Total Price</p>
                    </div>
                    <div class="">
                        <p>No product in cart!</p>
                    </div>
                </div>
                <div class=" w-1/4">
                    <div class=" w-full max-h-full gap-2 flex flex-col bg-white mt-2 rounded-lg">
                        <div class="flex justify-between items-center">
                            <p class="title font-semibold text-lg">
                                Total Price
                            </p>
                            <p class="price text-2xl font-normal ">
                                {{ format_to_rp($total_prices_all) }}
                            </p>
                        </div>
                        <div class="button">
                            <form action="{{ route('cart.pay') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $total_prices_all }}" name="total_prices">
                                <button type="submit" class="bg-black w-full py-2">
                                    <p class="text-white">
                                        Pay Now
                                    </p>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif



@endsection
