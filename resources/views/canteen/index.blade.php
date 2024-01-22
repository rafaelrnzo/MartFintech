@extends('layouts.admin')
@section('content')
    <div class="p-12 pt-6 w-full h-auto">

        <h1 class="text-2xl font-semibold">Product Admin</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4 shadow-sm">
            <div class="bg-black  p-4">
                <p class="text-lg font-semibold text-white">Total Transactions</p>
                <p class="text-white">{{ count($transactions) }}</p>
            </div>
            <div class="bg-black  p-4 shadow-sm">
                <p class="text-lg font-semibold text-white">Total Products</p>
                <p class="text-white">{{ count($products) }}</p>
            </div>
        </div>
        <div class="h-auto w-full">
            <p class="text-xl font-semibold mt-4 mb-4">Transaction</p>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Transaction Date
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $key + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $transaction->user->name }}

                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->product->name }}

                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->created_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="h-auto w-full">
            <p class="text-xl font-semibold mt-4 mb-4">Products</p>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $key + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->name }}

                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->stock }}

                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->category->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->description }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
