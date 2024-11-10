<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Kost</title>

    <!-- Tambahkan Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Tambahkan DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Add this in your Blade layout or the specific view where the delete button is located -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <!-- Sidebar -->
        @include('owner.template.sidebar')

        <div class="flex-grow p-8">
            <h1 class="text-3xl font-bold mb-6">Daftar Kost</h1>

            <!-- Tombol Tambah Kost -->
            <a href="{{ route('kost.create') }}" class="px-4 py-2 mb-4 bg-blue-500 text-white rounded hover:bg-blue-600 inline-block">
                Tambah Kost
            </a>

            <!-- Tabel Data Kost -->
            <div class="overflow-x-auto">
                <table id="kostTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Kost
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipe
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Kamar
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Sewa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kost as $kost)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $kost->nama_kost }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $kost->tipe_kost }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $kost->jumlah_kamar }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($kost->harga_sewa, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('kost.edit', $kost->id_kost) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">
                                    Edit
                                </a>
                                <form action="{{ route('kost.destroy', $kost->id_kost) }}" method="POST" class="inline" id="delete-form-{{ $kost->id_kost }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 hover:text-red-800" onclick="confirmDelete({{ $kost->id_kost }})">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan jQuery dan DataTables JS -->
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
                    "paginate": {
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>


{{-- sweet alert --}}
<script>
    function confirmDelete(kostId) {
        // SweetAlert confirmation
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus dan tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('delete-form-' + kostId).submit();
            }
        });
    }
</script>
</body>

</html>
