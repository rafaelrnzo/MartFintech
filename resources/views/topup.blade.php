@extends('layouts.master')
@section('content')
    <div class="pt-32 px-12 flex items-center justify-center w-full">
        <div class="w-1/2">

            <a href="{{ route('index') }}" class="underline">
                back
            </a>
            <h1 class="font-bold text-xl ">Top Up</h1>
            <form action="{{ route('topup.proceed') }}" class="flex flex-col items-center mt-4 gap-2" method="POST">
                @csrf
                <input required name="nominal" type="text" class="input input-bordered w-full"
                    placeholder="Masukan Nominal">
                <button type="submit" class="text-white bg-black py-3 font-semibold w-full mt-2">Top Up</button>
            </form>
        </div>
    </div>
@endsection
