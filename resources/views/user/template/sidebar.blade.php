<!-- component -->
@vite('resources/css/app.css')
<div class="h-full p-4 space-y-6 w-60 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
  <div class="flex items-center p-3 space-x-4">
    <img 
    src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : 'https://source.unsplash.com/100x100/?portrait' }}" 
    alt="Profile Photo" 
    class="w-12 h-12 rounded-full bg-gray-500"
  >
    <div>
      <h2 class="text-lg font-bold tracking-wide">{{ auth()->user()->name }}</h2> <!-- Displaying the user's name -->
      <span class="flex items-center space-x-1">
        <a rel="noopener noreferrer" href="#" class="text-xs hover:underline text-gray-200">View profile</a>
      </span>
    </div>
  </div>
  
  <div class="divide-y divide-gray-300">
    <!-- Dashboard Link -->
    <ul class="pt-4 pb-4 space-y-2 text-sm">
      <li>
        <a href="{{ route('user.dashboard') }}" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current text-gray-300">
            <path d="M3 3h8a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm10 0h8a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-8a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM3 13h8a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1zm10 3h8a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-8a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1z" />
          </svg>  
          <span>Dashboard</span>
        </a>
      </li>
    
    {{-- kost Saya --}}
    
        <a href="{{ route('user.kost') }}" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current text-gray-300">
            <path d="M10 20v-6h4v6a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-8h2.586a1 1 0 0 0 .707-1.707l-10-10a1 1 0 0 0-1.414 0l-10 10A1 1 0 0 0 1.414 12H4v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1z" />
          </svg>
          <span>Kost Saya</span>
        </a>

        {{-- <a href="{{ route('konfirmasi.index') }}" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-300">
            <path d="M68.983,382.642l171.35,98.928a32.082,32.082,0,0,0,32,0l171.352-98.929a32.093,32.093,0,0,0,16-27.713V157.071a32.092,32.092,0,0,0-16-27.713L272.334,30.429a32.086,32.086,0,0,0-32,0L68.983,129.358a32.09,32.09,0,0,0-16,27.713V354.929A32.09,32.09,0,0,0,68.983,382.642ZM272.333,67.38l155.351,89.691V334.449L272.333,246.642ZM256.282,274.327l157.155,88.828-157.1,90.7L99.179,363.125ZM84.983,157.071,240.333,67.38v179.2L84.983,334.39Z"></path>
          </svg>
          <span>Pembayaran</span>
        </a> --}}
      
    </ul>
    
    <!-- Settings Link -->
    <ul class="pt-4 pb-4 space-y-2 text-sm">
      <li>
        <a href="#" class="flex items-center p-2 space-x-3 rounded-md hover:bg-purple-700 hover:text-white transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-300">
            <path d="M245.151,168a88,88,0,1,0,88,88A88.1,88.1,0,0,0,245.151,168Zm0,144a56,56,0,1,1,56-56A56.063,56.063,0,0,1,245.151,312Z"></path>
            <path d="M464.7,322.319l-31.77-26.153a193.081,193.081,0,0,0,0-80.332l31.77-26.153a19.941,19.941,0,0,0,4.606-25.439l-32.612-56.483a19.936,19.936,0,0,0-24.337-8.73l-38.561,14.447a192.038,192.038,0,0,0-69.54-40.192L297.49,32.713A19.936,19.936,0,0,0,277.762,16H212.54a19.937,19.937,0,0,0-19.728,16.712L186.05,73.284a192.03,192.03,0,0,0-69.54,40.192L77.945,99.027a19.937,19.937,0,0,0-24.334,8.731L21,164.245a19.94,19.94,0,0,0,4.61,25.438l31.767,26.151a193.081,193.081,0,0,0,0,80.332l-31.77,26.153A19.942,19.942,0,0,0,21,347.758l32.612,56.483a19.937,19.937,0,0,0,24.337,8.73l38.562-14.447a192.03,192.03,0,0,0,69.54,40.192l6.762,40.571A19.937,19.937,0,0,0,212.54,496h65.222a19.936,19.936,0,0,0,19.728-16.712l6.763-40.572a192.038,192.038,0,0,0,69.54-40.192l38.564,14.449a19.938,19.938,0,0,0,24.334-8.731L469.3,347.755A19.939,19.939,0,0,0,464.7,322.319Zm-50.636,57.12-48.109-18.024-7.285,7.334a159.955,159.955,0,0,1-72.625,41.973l-10,2.636L267.6,464h-44.89l-8.442-50.642-10-2.636a159.955,159.955,0,0,1-72.625-41.973l-7.285-7.334L76.241,379.439,53.8,340.562l39.629-32.624-2.7-9.973a160.9,160.9,0,0,1,0-83.93l2.7-9.972L53.8,171.439l22.446-38.878,48.109,18.024,7.285-7.334a159.955,159.955,0,0,1,72.625-41.973l10-2.636L222.706,48H267.6l8.442,50.642,10,2.636a159.955,159.955,0,0,1,72.625,41.973l7.285,7.334,48.109-18.024,22.447,38.877-39.629,32.625,2.7,9.972a160.9,160.9,0,0,1,0,83.93l-2.7,9.973,39.629,32.623Z"></path>
          </svg>
          <span>Settings</span>
        </a>
      </li>

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
