@extends('layouts.admin')
@section('content')
    <div class="px-12 p-6">

        <a href="{{ route('kantin.product.index') }}" class="underline">Back</a>
        <h1 class="text-2xl font-semibold">Create New Product</h1>

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

        <div class="w-full bg-white py-4">
            <form action="{{ route('kantin.addproduct.store') }}" method="POST" class="flex flex-col gap-4 w-full"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="">Name</label>
                    <input required name="name" type="text" class="input input-bordered w-full"
                        placeholder="Masukan Nama Produk">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="">Stok Produk</label>
                    <input required name="stock" type="number" class="input input-bordered w-full"
                        placeholder="Masukan Stok Produk">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="">Masukan Kategori Produk</label>
                    <select required class="select select-bordered w-full" name="category">
                        <option disabled selected>Pilih Category Product</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ Str::ucfirst($category->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="">Price</label>
                    <input required name="harga" type="number" class="input input-bordered w-full"
                        placeholder="Input Price">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="">Desc</label>
                    <textarea name="deskripsi" class="textarea textarea-bordered" placeholder="Input Description"></textarea>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="">Thumbnail</label>
                    <input name="image" class="input input-bordered" type="file" placeholder="Input Thumbnail">
                </div>
                <button class="w-full bg-black text-white py-3 mt-4">
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
