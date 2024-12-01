<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen">
    <div class="flex h-full fon">
        <!-- Include sidebar -->
        <aside class="w-60 text-white fixed h-full">
            @include('admin.template.sidebar')
        </aside>

        <!-- Dashboard content -->
        <div class="flex-1 text-black ml-60 p-4 bg-white overflow-y-auto">
            <!-- Konten dashboard lainnya -->
            <h1 class="text-2xl font-bold">Welcome to the Dashboard</h1>
            <!-- Tambahkan konten dashboard lainnya di sini -->
        </div>
    </div>
</body>
</html>
