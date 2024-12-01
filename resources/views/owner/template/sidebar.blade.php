
<!-- component -->
@vite('resources/css/app.css')
<div class="h-full p-4 space-y-6 w-60 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
  <div class="flex items-center p-3 space-x-4">
    <!-- Foto Profil -->
    <img 
      src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : 'https://source.unsplash.com/100x100/?portrait' }}" 
      alt="Profile Photo" 
      class="w-12 h-12 rounded-full bg-gray-500"
    >
    <div>
      <h2 class="text-lg font-bold tracking-wide">{{ auth()->user()->name }}</h2> <!-- Menampilkan Nama -->
      <span class="flex items-center space-x-1">
        <a rel="noopener noreferrer" href="#" class="text-xs hover:underline text-gray-200">View profile</a>
      </span>
    </div>
  </div>
  
  
  <div class="divide-y divide-gray-300">
    <!-- Dashboard Link -->
    <ul class="pt-4 pb-4 space-y-2 text-sm">
      <li>
        <a href="{{ route('owner.dashboard') }}" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current text-gray-300">
            <path d="M3 3h8a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm10 0h8a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-8a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM3 13h8a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1zm10 3h8a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-8a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1z" />
          </svg>          
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{route('kost.index1')}}" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current text-gray-300">
            <path d="M10 20v-6h4v6a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-8h2.586a1 1 0 0 0 .707-1.707l-10-10a1 1 0 0 0-1.414 0l-10 10A1 1 0 0 0 1.414 12H4v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1z" />
          </svg>
          <span>Kost</span>
        </a>
        <a href="{{route('owner.booking.index')}}" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current text-gray-300">
            <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-3.33 0-10 1.67-10 5v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-2c0-3.33-6.67-5-10-5z" />
          </svg>
              <span>Penyewa</span>
        </a>
      </li>

    </ul>
    
    <!-- Settings Link -->
    <ul class="pt-4 pb-4 space-y-2 text-sm">

      <!-- Logout Link -->
      <li>
        <a href="#" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-300">
            <path d="M440,424V88H352V13.005L88,58.522V424H16v32h86.9L352,490.358V120h56V456h88V424ZM320,453.642,120,426.056V85.478L320,51Z"></path>
            <rect width="32" height="64" x="256" y="232"></rect>
          </svg>
          <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full text-left">Logout</button>
          </form>
        </a>
      </li>
    </ul>
  </div>
</div>
