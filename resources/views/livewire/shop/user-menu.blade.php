<div class="relative" x-data="{ open: false }">
    <!-- User Menu Button -->
    <button 
        @click="open = !open"
        @click.away="open = false"
        class="relative p-2 text-white transition-all duration-300 ease-in-out 
               hover:text-cyan-400 focus:outline-none group">
        
        <!-- User Icon -->
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>

            <!-- Glowing Effect -->
            <div class="absolute inset-0 rounded-full blur-sm bg-cyan-400/50 opacity-0 
                      group-hover:opacity-100 transition-opacity duration-300 -z-10">
            </div>
        </div>

        <!-- Cyberpunk Lines -->
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-2/3 h-[2px]">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-400 to-transparent
                          animate-[scanline_2s_ease-in-out_infinite]"></div>
            </div>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-2/3 h-[2px]">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-400 to-transparent
                          animate-[scanline_2s_ease-in-out_infinite_reverse]"></div>
            </div>
        </div>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 rounded-lg bg-black/90 border-2 border-cyan-500/50
                shadow-lg shadow-cyan-500/30 overflow-hidden">
        
        <!-- Menu Items -->
        <div class="py-2">
            <a href="#" class="block px-4 py-2 text-white hover:bg-cyan-500/20 
                              hover:text-cyan-400 transition-colors duration-200">
                Thông tin tài khoản
            </a>
            <a href="#" class="block px-4 py-2 text-white hover:bg-cyan-500/20 
                              hover:text-cyan-400 transition-colors duration-200">
                Đơn hàng của tôi
            </a>
            <div class="border-t border-cyan-500/30"></div>
            <a href="#" class="block px-4 py-2 text-white hover:bg-cyan-500/20 
                              hover:text-cyan-400 transition-colors duration-200">
                Đăng xuất
            </a>
        </div>
    </div>

    <!-- Animation Keyframes -->
    <style>
        @keyframes scanline {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>
</div>