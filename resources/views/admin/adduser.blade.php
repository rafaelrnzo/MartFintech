@extends('layouts.admin')
@section('content')
    <div class="px-12 p-6">
        <a href="{{ route('admin.userindex') }}" class="underline">Back</a>
        <h1 class="text-xl font-semibold">Create New User</h1>

        @if (session('message'))
            @if (is_array(session('message')) && count(session('message')) > 1)
                <div role="alert" class="alert alert-{{ session('message')[0] }} mt-3" id="warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>
                        {{ session('message')[1] }}
                    </span>
                </div>
            @endif
        @endif

        <div class="w-full bg-white mt-4">
            <form action="{{ route('admin.adduserstore') }}" method="POST" class="flex flex-col gap-4 w-full">
                @csrf
                <div class="flex gap-1 flex-col">

                    <label for="">Username</label>
                    <input required name="name" type="text" class="input input-bordered w-full"
                        placeholder="Input Username">
                </div>
                <div class="flex gap-1 flex-col">

                    <label for="">Password</label>
                    <input required name="password" type="password" class="input input-bordered w-full"
                        placeholder="Input Password">
                </div>
                <div class="flex gap-1 flex-col">

                    <label for="">Role</label>
                    <select required class="select select-bordered w-full p-2 px-3" name="role">
                        <option disabled selected>Choose User Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ Str::ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary mt-4 text-white bg-black py-3">
                    Submit
                </button>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            setTimeout(() => {
                document.getElementById('warning').style.display = 'none';
            }, 5000);
        </script>
    @endpush

@endsection
