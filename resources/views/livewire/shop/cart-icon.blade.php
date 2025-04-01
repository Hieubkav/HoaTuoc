<div class="relative" x-data="{ hover: false }">
    <!-- Cart Icon Button -->
    <button 
        @mouseenter="hover = true" 
        @mouseleave="hover = false"
        class="relative p-2 text-white transition-all duration-300 ease-in-out 
               hover:text-cyan-400 focus:outline-none group">
        
        <!-- Cart Icon -->
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>

            <!-- Glowing Effect -->
            <div class="absolute inset-0 rounded-full blur-sm bg-cyan-400/50 opacity-0 
                      transition-opacity duration-300 -z-10"
                 :class="{ 'opacity-100': hover }">
            </div>
        </div>

        <!-- Item Count Badge -->
        <div class="absolute -top-1 -right-1 bg-gradient-to-r from-cyan-500 to-cyan-300
                    text-black text-xs font-bold px-2 py-1 rounded-full
                    shadow-[0_0_10px_rgba(34,211,238,0.5)]
                    animate-pulse">
            0
        </div>
    </button>

    <!-- Hover Animation Lines -->
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <!-- Top Line -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-2/3 h-[2px]">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-400 to-transparent
                        animate-[scanline_2s_ease-in-out_infinite]"></div>
        </div>
        <!-- Bottom Line -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-2/3 h-[2px]">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-400 to-transparent
                        animate-[scanline_2s_ease-in-out_infinite_reverse]"></div>
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