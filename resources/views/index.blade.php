@extends('layouts.master')

@section('content')
    <div class="h-auto pt-12 ">
        <div class="">
            <banner>
                <img class="object-cover w-full max-h-[70vh] object-center"
                src="https://www.tenjin.style/cdn/shop/files/Home-Banner---Kansha---1080-x-1920.jpg?v=1704563573&width=3840"
                    alt="">
            </banner>
        </div>
        <div class="py-4 w-full flex flex-col gap-4 px-12">
            <p class="text-4xl font-bold">All Products</p>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-2">
                @foreach ($products as $product)
                    <div class=" w-full h-auto  rounded-md justify-start flex items-start flex-col gap-1 group">
                        <div class="">
                            <img src="{{ $product->thumbnail }}" alt="" srcset=""
                                class="object-cover md:w-96 w-full max-w-full h-60">
                        </div>
                        <div class="flex justify-start items-start flex-col">
                            <p class="font-semibold text-sm">{{ $product->name }}</p>
                            <p class="font-normal text-sm text-black/50">{{ $product->description }}</p>
                        </div>
                        <div class="flex justify-start items-start flex-col py-2">
                            <p class="font-normal text-sm">{{ format_to_rp($product->price) }}</p>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <input hidden value="1" min="1" name="quantity" type="number"
                                class="shadow-lg border-[1.5px] border-slate-300 h-full w-12 pl-2 rounded-lg">
                            <button type="submit"
                                class="flex justify-center items-center flex-col w-full border border-black py-3 group-hover:border-2">
                                <p class="font-semibold text-sm text-black ">Add to cart</p>
                            </button>

                        </form>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
