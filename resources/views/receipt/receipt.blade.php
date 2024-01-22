<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    {{-- @vite(['resources/css/app.css']) --}}
    <style>
       @media print {
         #back-to-home {
            display: none;
         }
       }
    </style>
</head>

<body class="bg-slate-100 h-screen">
    <div class="container mx-auto px-3 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 w-full">
            <h1 class="text-xl font-bold mb-4">Receipt</h1>
            <h2 class="text-lg font-semibold mb-2">Invoice Pembelian</h2>
          
            <div class="border-t border-gray-300 my-4"></div>
          
            @foreach ($transactions as $transaction )
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Nama Produk:</span>
              <span class="text-gray-600">{{ $transaction->product->name }}</span>
            </div>
           <div class="flex justify-between mb-2">
              <span class="font-semibold">Harga Produk:</span>
              <span class="text-gray-600">{{ format_to_rp($transaction->product->price) }} x {{ $transaction->quantity }}</span>
            </div>
            <div class="border-t border-gray-300 my-4"></div>
          
            @endforeach
            <p>Total Harga</p>
            <h1 class="font-semibold text-2xl">{{ format_to_rp(session('total_prices')) }} </h1>   
          </div>  
               
          
        </div>
        <div class="flex justify-end mb-8">
            <form action="{{ route('receipt.take')}}" method="POST">
                @csrf
                <button type="submit" href="{{ route('index') }}" class="btn btn-primary mr-4">Kembali</button>
            </form>
        </div>
        



    <script>
        window.print();
    </script>

</body>

</html>
