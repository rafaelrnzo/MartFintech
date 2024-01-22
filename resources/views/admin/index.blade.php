@extends('layouts.admin')
@section('content')
    <div class="px-12 p-6">

        <h1 class="text-2xl font-semibold">Admin</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4 shadow-sm">
            <div class="bg-black  p-4">
                <p class="text-lg font-semibold text-white">Total Transactions</p>
                <p class="text-white">{{ count($transactions) }}</p>
            </div>
            <div class="bg-black  p-4 shadow-sm">
                <p class="text-lg font-semibold text-white">Total Users</p>
                <p class="text-white">{{ count($users) }}</p>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <p class="text-xl font-semibold mt-4 mb-4">Transaction</p>

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
                            Date
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

        <div class="relative overflow-x-auto">
            <p class="text-xl font-semibold mt-4 mb-4">Users</p>

            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->name }}

                            </td>
                            <td class="px-6 py-4">
                                {{ $user->role->name }}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
