@extends('layouts.admin')
@section('content')
    <a href="{{ route('kantin.product.index') }}" class="btn btn-primary mb-3 btn-sm">Kembali</a>
    <h1 class="text-xl font-semibold">Edit Product {{ $product->name }}</h1>

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

    <div class="w-full bg-white p-8 rounded-md mt-8 mb-8">
        <form action="{{ route('kantin.updateproduct', $product->id) }}" method="POST" class="flex flex-col gap-4 w-full" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label for="">Nama Produk</label>
            <input value="{{ $product->name }}" required name="name" type="text" class="input input-bordered w-full" placeholder="Masukan Nama Produk">
            <label for="">Stok Produk</label>
            <input value="{{ $product->stock }}" required name="stock" type="number" class="input input-bordered w-full" placeholder="Masukan Stok Produk">
            <label for="">Masukan Kategori Produk</label>
            <select  required class="select select-bordered w-full" name="category">
                <option disabled selected>Pilih Category Product</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ Str::ucfirst($category->name) }}</option>
                @endforeach
            </select>
            <label for="">Harga</label>
            <input value="{{ $product->price }}" required name="harga" type="number" class="input input-bordered w-full" placeholder="Masukan Harga Produk">
            <label for="">Deskripsi</label>
            <textarea name="deskripsi" class="textarea textarea-bordered" placeholder="Masukan Deskripsi Produk">{{ $product->description }}</textarea>
            <label for="">
                Thumbnail
            </label>
            <div class="w-24 h-12 object-cover overflow-hidden">
                <img src="{{ asset($product->thumbnail)}}" alt="" class="w-full h-full object-cover">
            </div>
            <input value="" name="image" class="input input-bordered" type="file" placeholder="Masukan Thumbnail">
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
