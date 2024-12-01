<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Kost</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-60 text-white fixed h-full">
            @include('admin.template.sidebar')
        </aside>

        <!-- Content -->
        <div class="flex-grow bg-gray-100 ml-60 p-4 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-6 text-center">Daftar Kost</h1>
            <div class="mb-4">
                <button onclick="printTable()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Cetak Laporan
                </button>
            </div>
            
            <!-- Tabel Data Kost -->
            <div class="overflow-x-auto">
                <table id="kostTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kost</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kota</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rekening Bank</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Rekening</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Sewa</th>
                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kost as $kost)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kost->nama_kost }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kost->nama_pemilik }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kost->kontak }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kost->kota }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $kost->jenis_kost }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $kost->jumlah_kamar }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $kost->nama_bank }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $kost->no_rekening }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Rp {{ number_format($kost->harga_sewa, 0, ',', '.') }} / bulan</td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#kostTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "paginate": {
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        // Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }


    // fungsi untuk cetak laporan dalam bentuk pdf
    function printTable() {
        const table = document.getElementById('kostTable').outerHTML;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Cetak Laporan Kost</title>');
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
        printWindow.document.write('<h1 style="text-align:center;">Laporan Daftar Kost</h1>');
        printWindow.document.write(table);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    </script>
</body>

</html>
