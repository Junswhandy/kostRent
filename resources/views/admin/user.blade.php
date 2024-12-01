<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS CDN -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-60 text-white fixed h-full">
        @include('admin.template.sidebar')
    </aside>

    <!-- Konten -->
    <div class="flex-grow ml-60 p-4 bg-white overflow-y-auto">
        <h1 class="text-2xl font-bold mb-4 text-center">Daftar Pengguna</h1>

        <!-- Tombol Tambah User -->
        <a href="{{route('admin.user.create')}}" class="mb-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-yellow-400">
            Tambah User
        </a>
        <button onclick="printTable()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Cetak Laporan
        </button>
        

        <table id="users-table" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Level</th>
                    <th class="border px-4 py-2">No. HP</th>
                    <th class="border px-4 py-2">Pekerjaan</th>
                    <th class="border px-4 py-2">Jenis Kelamin</th>
                    <th class="border px-4 py-2">Foto Profil</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    {{-- <td class="border px-4 py-2">{{ $user->id }}</td> --}}
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td> 
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($user->level) }}</td>
                    <td class="border px-4 py-2">{{ $user->no_hp ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $user->pekerjaan ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($user->jenis_kelamin ?? '-') }}</td>
                    <td class="border px-4 py-2">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="w-12 h-12 rounded-full">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    
                    
                    
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                "paging": true, // Pagination
                "searching": true, // Search bar
                "info": true, // Showing info at bottom
                "lengthChange": true, // Show entries dropdown
                "pageLength": 10, // Default rows per page
            });
        });

        function printTable() {
        const table = document.getElementById('users-table').outerHTML;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Cetak Laporan User</title>');
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
        printWindow.document.write('<h1 style="text-align:center;">Laporan Daftar User</h1>');
        printWindow.document.write(table);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
    </script>
</body>
</html>
