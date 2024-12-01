<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Booking</title>

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
            <h1 class="text-3xl font-bold mb-6">Daftar Booking</h1>

            {{-- <!-- Tombol Tambah Booking -->
            <a href="{{ route('owner.booking.create') }}" class="px-4 py-2 mb-4 bg-blue-500 text-white rounded hover:bg-blue-600 inline-block">
                Tambah Booking
            </a> --}}

            <!-- Tabel Data Booking -->
            <div class="overflow-x-auto">
                <table id="bookingTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Kost
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Penyewa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Masuk
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Keluar
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Durasi Sewa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->kost->nama_kost }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->tanggal_masuk }}</td>
                            <td>{{ $booking->tanggal_keluar }}</td>
                            <td>{{ $booking->durasi_sewa }} Bulan</td>
                            <td>{{ $booking->status }}</td>
                            <td>
                                <!-- Tombol Setujui -->
                                @if($booking->status === 'Menunggu Konfirmasi')
                                <form action="{{ route('owner.booking.confirm') }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <!-- Pastikan menggunakan id_booking sebagai hidden input -->
                                    <input type="hidden" name="id_booking" value="{{ $booking->id_booking }}">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Setujui</button>
                                </form>
                        
                                <!-- Tombol Tolak -->
                                <form action="{{ route('owner.booking.reject') }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <!-- Pastikan menggunakan id_booking sebagai hidden input -->
                                    <input type="hidden" name="id_booking" value="{{ $booking->id_booking }}">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Tolak</button>
                                </form>
                                @endif
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
            $('#bookingTable').DataTable({
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
        function confirmDelete(bookingId) {
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
                    document.getElementById('delete-form-' + bookingId).submit();
                }
            });
        }
    </script>
</body>

</html>
