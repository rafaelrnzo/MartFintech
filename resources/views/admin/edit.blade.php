@extends('layouts.admin')
@section('content')
    <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.userindex')}}">Kembali</a>
    <h1 class="text-xl font-semibold">Edit User {{ $user->name }}</h1>

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

    <div class="w-full bg-white p-8 rounded-md mt-8">
        <form action="{{ route('admin.updateuserstore', $user->id) }}" method="POST" class="flex flex-col gap-4 w-full">
            @csrf
            @method('put')
            <label for="">Username</label>
            <input value="{{ $user->name }}" required name="name" type="text" class="input input-bordered w-full" placeholder="Masukan Nama User">

            <label for="">Role</label>
            <select  required class="select select-bordered w-full" name="role">
                <option disabled selected>Pilih Role User</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if($role->id == $user->role_id ) selected @endif>{{ Str::ucfirst($role->name) }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary mt-4">
                Submit
            </button>
        </form>
    </div>

    @push('script')
        <script>
            setTimeout(() => {
                document.getElementById('warning').style.display = 'none';
            }, 5000);
        </script>
    @endpush

@endsection
