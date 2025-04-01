<div x-data="{ 
    isScrolled: false,
    isMobileMenuOpen: false,
    glowIntensity: 0
}" 
@scroll.window="isScrolled = (window.pageYOffset > 100)"
class="w-full">
    <nav class="transition-all duration-300"
        :class="{
            'fixed top-0 left-0 right-0 z-50 bg-black/90 backdrop-blur-lg border-b border-cyan-500/30': isScrolled,
            'relative bg-gradient-to-r from-gray-900 via-black to-gray-900': !isScrolled
        }">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16 relative">
                <!-- Logo -->
                <a href="" 
                   class="flex-shrink-0 group relative"
                   @mouseenter="glowIntensity = 1" 
                   @mouseleave="glowIntensity = 0">
                    <div class="absolute inset-0 bg-cyan-500/20 rounded-lg blur transition-opacity duration-300"
                         :style="`opacity: ${glowIntensity}`"></div>
                    <img src="{{ asset('storage/' . $settings->logo) }}" 
                         alt="{{ $settings->brand_name }}" 
                         class="h-10 w-auto relative transition-transform duration-300 hover:scale-105">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-8">
                    <!-- Search Bar -->
                    <div class="w-96">
                        @livewire('shop.search-bar')
                    </div>

                    <!-- Cart Icon -->
                    <div class="relative" x-data="{ isHovered: false }">
                        @livewire('shop.cart-icon')
                    </div>

                    <!-- User Menu -->
                    <div class="relative">
                        @livewire('shop.user-menu')
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="lg:hidden p-2 rounded-lg hover:bg-cyan-500/20 transition-colors duration-300 relative group"
                        :class="{ 'bg-cyan-500/20': isMobileMenuOpen }">
                    <div class="absolute inset-0 bg-cyan-500/20 rounded-lg blur opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <svg class="h-6 w-6 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': isMobileMenuOpen, 'inline-flex': !isMobileMenuOpen }" stroke-linecap="round" 
                              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !isMobileMenuOpen, 'inline-flex': isMobileMenuOpen }" stroke-linecap="round" 
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="isMobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden relative" 
             @click.away="isMobileMenuOpen = false">
            <div class="px-4 pt-2 pb-5 border-t border-cyan-500/30 bg-black/95 backdrop-blur-lg space-y-4">
                <!-- Mobile Search -->
                <div class="pt-2 pb-3">
                    @livewire('shop.search-bar')
                </div>

                <!-- Mobile Icons -->
                <div class="flex items-center justify-around border-t border-cyan-500/30 pt-4">
                    @livewire('shop.cart-icon')
                    @livewire('shop.user-menu')
                </div>
            </div>
        </div>
    </nav>

    <style>
        @keyframes neon-pulse {
            0%, 100% { 
                text-shadow: 0 0 5px rgba(6,182,212,0.7),
                            0 0 10px rgba(6,182,212,0.5),
                            0 0 15px rgba(6,182,212,0.3);
            }
            50% { 
                text-shadow: 0 0 10px rgba(6,182,212,0.9),
                            0 0 20px rgba(6,182,212,0.7),
                            0 0 30px rgba(6,182,212,0.5);
            }
        }
    </style>
</div>