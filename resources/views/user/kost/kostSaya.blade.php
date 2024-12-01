<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kost Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-60 text-white fixed h-full">
            @include('user.template.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex-1  bg-gray-100 ml-60 p-4 overflow-y-auto">
            <!-- Header -->
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Kost Saya</h1>
            <div class="mb-4">
                <button onclick="printTable()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Cetak Laporan
                </button>
            </div>
            @if($kosts)
            <div class="overflow-x-auto">
                <table id="kostTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Nama Kost</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Pemilik</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Alamat</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Harga Sewa</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Tanggal Masuk</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Tanggal Keluar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800">Sisa Hari</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kosts as $kost)
                            <tr>
                                <td class="px-6 py-4 text-gray-800">{{ $kost->nama_kost }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $kost->nama_pemilik }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $kost->alamat }}</td>
                                <td class="px-6 py-4 text-gray-800">Rp {{ number_format($kost->harga_sewa, 0, ',', '.') }} / bulan</td>
                                @if($kost->booking)
                                    <td class="px-6 py-4 text-gray-800">{{ \Carbon\Carbon::parse($kost->booking->tanggal_masuk)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-gray-800">{{ \Carbon\Carbon::parse($kost->booking->tanggal_keluar)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-gray-800">
                                        {{-- Menghitung sisa hari --}}
                                        @php
                                            $tanggalKeluar = \Carbon\Carbon::parse($kost->booking->tanggal_keluar);
                                            $tanggalMasuk = \Carbon\Carbon::parse($kost->booking->tanggal_masuk);
                                            $sisaHari = $tanggalMasuk->diffInDays($tanggalKeluar); // Menghitung selisih hari
                                        @endphp
                                        {{ $sisaHari }} hari
                                    </td>
                                @else
                                    <td class="px-6 py-4 text-gray-800">Tidak ada data</td>
                                    <td class="px-6 py-4 text-gray-800">Tidak ada data</td>
                                    <td class="px-6 py-4 text-gray-800">Tidak ada data</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <h2 class="text-xl font-semibold text-gray-800">Anda sedang tidak memiliki kost yang disewa.</h2>
            </div>
        @endif
        
        

        </div>
    </div>

    <!-- JQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#kostTable').DataTable({
                pageLength: 10, // Banyak data per halaman
                lengthChange: true,
                ordering: true,
                autoWidth: false,
                responsive: true
            });
        });


          // fungsi untuk cetak laporan dalam bentuk pdf
    function printTable() {
        const table = document.getElementById('kostTable').outerHTML;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Cetak Laporan Kost Saya</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 16px;
                text-align: left;
            }
            table, th, td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            th {
                background-color: #f4f4f4;
                font-weight: bold;
            }
        `);
        printWindow.document.write('</style></head><body>');
        printWindow.document.write('<h1 style="text-align:center;">Laporan Daftar Kost Saya</h1>');
        printWindow.document.write(table);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
    </script>
</body>
</html>
