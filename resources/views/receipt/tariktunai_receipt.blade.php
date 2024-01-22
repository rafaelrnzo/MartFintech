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
            <h2 class="text-lg font-semibold mb-2">Tarik Tunai</h2>
          
            <div class="border-t border-gray-300 my-4"></div>
            
            <div class="flex justify-between mb-2">
                <span class="font-semibold">Order ID:</span>
                <span class="text-gray-600">TU-123112023013846</span>
              </div>
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Nominals:</span>
              <span class="text-gray-600">{{ format_to_rp($tariktunais->nominals) }}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Status:</span>
              <span class="text-gray-600">
                @if($tariktunais->status == "unconfirmed")
                   Belum Dikonfirmasi
                @elseif($tariktunais->status == "confirmed")
                   Dikonfirmasi
                @endif
             </span>
            </div>
            <div class="flex justify-between mb-2">
              <span class="font-semibold">User:</span>
              <span class="text-gray-600">{{ $tariktunais->user->name }}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Tanggal:</span>
              <span class="text-gray-600">{{ $tariktunais->created_at }}</span>
            </div>
          </div>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('index') }}" class="btn btn-primary mr-4">Kembali</a>
    </div>




    <script>
        window.print();
    </script>

</body>

</html>
