<div class="relative w-full max-w-xl" x-data="{ focused: false }">
    <div class="relative">
        <input
            wire:model.live.debounce.300ms="searchQuery"
            type="text"
            placeholder="Tìm kiếm sản phẩm..."
            class="w-full pl-12 pr-4 py-2.5 text-sm bg-black/70 border-2 border-cyan-500/50 text-white rounded-lg 
                   placeholder-gray-400 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/25
                   transition-all duration-300 ease-in-out
                   hover:border-cyan-400 hover:shadow-[0_0_15px_rgba(34,211,238,0.3)]"
            @focus="focused = true"
            @blur="focused = false"
        >
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none
                    transition-all duration-300"
             :class="{ 'text-cyan-400': focused, 'text-gray-400': !focused }">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        
        <!-- Glowing Effect -->
        <div class="absolute -inset-0.5 bg-gradient-to-r from-cyan-500 to-cyan-300 rounded-lg opacity-0 
                    group-hover:opacity-30 blur transition-all duration-500 -z-10"
             :class="{ 'opacity-30': focused }">
        </div>
    </div>

    <!-- Responsive Design -->
    <style>
        @media (max-width: 640px) {
            input {
                @apply text-base py-2;
            }
        }
    </style>
</div>