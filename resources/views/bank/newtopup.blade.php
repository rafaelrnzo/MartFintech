@extends('layouts.admin')
@section('content')
    <div class="px-12 p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold">New Topup </h1>
            <a href="{{ route('bank.topup.index') }}" class="underline">Back</a>
        </div>
        <div class="w-full bg-white ">
            <form action="{{ route('bank.topup.post') }}" method="POST" class="flex flex-col gap-4 w-full"
                enctype="multipart/form-data">
                @csrf
                <div class="flex gap-1 flex-col">
                    <label for="" class="text-sm font-bold text-black/50">Nominal</label>
                    <input required name="nominals" type="text" class="input input-bordered w-full"
                        placeholder="Input Nominal">
                </div>
                <select required class="select select-bordered w-full p-2" name="user">
                    <option disabled selected>Choose User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ Str::ucfirst($user->name) }}</option>
                    @endforeach
                </select>
                <button class="bg-black text-white text-semibold py-2.5">
                    Submit
                </button>
            </form>
        </div>

    </div>
@endsection
