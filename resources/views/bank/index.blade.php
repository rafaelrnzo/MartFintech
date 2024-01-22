@extends('layouts.admin')
@section('content')
    <div class="px-12 p-6">

        <h1 class="text-2xl font-semibold">Bank</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4 shadow-sm">
            <div class="bg-black  p-4">
                <p class="text-lg font-semibold text-white">Total TopUp</p>
                <p class="text-white">{{ count($topups) }}</p>
            </div>
            <div class="bg-black  p-4 shadow-sm">
                <p class="text-lg font-semibold text-white">Total WD</p>
                <p class="text-white">{{ count($tariktunais) }}</p>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <p class="text-xl font-semibold mt-4 mb-4">Top Up</p>

            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nominal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($topups as $key => $topup)
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $topup->created_at }}

                            </td>
                            <td class="px-6 py-4">
                                {{ $topup->user->name }}

                            </td>
                            <td class="px-6 py-4">
                                {{ format_to_rp($topup->nominals) }}

                            </td>
                            <td class="px-6 py-4">
                                {{ $topup->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto">
            <p class="text-xl font-semibold mt-4 mb-4">WithDraw</p>

            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nominal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($tariktunais5 as $key => $tariktunai)
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $tariktunai->created_at }}

                            </td>
                            <td class="px-6 py-4">
                                {{ $tariktunai->user->name }}

                            </td>
                            <td class="px-6 py-4">
                                {{ $tariktunai->nominals }}

                            </td>
                            <td class="px-6 py-4">
                                {{ $tariktunai->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
