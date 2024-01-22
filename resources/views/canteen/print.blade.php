<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    @vite(['resources/css/app.css'])
    <style>
       @media print {
         #back-to-home {
            display: none;
         }
       }
    </style>
</head>

<body>
    <div class="container mx-auto px-3 py-8 h-screen">
        <h1 class="card-title">Receipt</h1>
        <p>Pembelian {{ $user->name }}</p>
        <p>Produk Yang Dibeli</p>
        <ul class="mt-4">
            @foreach ($transactions as $transaction)
                <li>
                    {{ $transaction->product->name }} | {{ $transaction->product->price }} x
                    {{ $transaction->quantity }} | Total Rp. {{ $transaction->total_prices }}
                </li>
            @endforeach
        </ul>
        <hr class="mt-4">
        <div class="flex justify-end w-full" id="back-to-home">
                <a href="{{ route('admin.transaction') }}" type="submit" class="btn btn-primary">Kembali</a>
        </div>


    </div>




    <script>
        window.print();
    </script>

</body>

</html>
