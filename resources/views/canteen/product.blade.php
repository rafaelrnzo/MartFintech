@extends('layouts.admin')
@section('content')
    <div class="px-12 py-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Product List ({{ $products->count() }}) </h1>
            <a href="{{ route('kantin.addproduct.index') }}" class="border-2 border-black px-4 py-2 text-black font-bold">Add
                Product</a>
        </div>
        <div class="overflow-x-auto w-full">
            <table class=" bg-white w-full ">
                <thead class="text-xs border-b border-gray-200 uppercase bg-white">
                    <tr class="">
                        <th scope="col" class="px-6 py-3" align="left">
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Thumbnail
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3" align="left">
                            Action
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr class="border-b border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                              <div class="overflow-hidden ">
                                    <img class="w-32 h-32 object-cover" src="{{ asset($product->thumbnail) }}"
                                        alt="">
                                </div>
                            </td>
                            <td class="px-6 py-1">{{ $product->name }}</td>
                            <td class="px-6 py-1">{{ $product->stock }}</td>
                            <td class="px-6 py-1">{{ $product->category->name }}</td>
                            <td class="px-6 py-1">{{ $product->price }}</td>
                            <td class="px-6 py-1">{{ $product->description }}</td>
                            <td class="flex gap-2 px-6 py-1 items-center  ">
                                <form action="{{ route('kantin.deleteproduct', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-error text-red-500"
                                        onclick="return confirm('Yakin Mau Delete?')">
                                       Delete
                                    </button>
                                </form>
                                <a class="btn btn-warning text-blue-500"
                                    href="{{ route('kantin.editproduct', $product->id) }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
