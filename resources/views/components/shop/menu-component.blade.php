<div x-data="{ 
    isMobileMenuOpen: false,
    activeSubmenu: null,
    isMobile: window.innerWidth < 1024
}" 
x-init="
    window.addEventListener('resize', () => {
        isMobile = window.innerWidth < 1024;
        if (!isMobile) activeSubmenu = null;
    });
" 
class="relative z-50">
    
    <!-- Mobile Toggle Button -->
    <button @click="isMobileMenuOpen = !isMobileMenuOpen" 
        class="lg:hidden fixed top-4 right-4 z-[100] p-2 rounded-lg bg-black/30 backdrop-blur-sm border border-cyan-500/30 hover:border-cyan-400/50 transition-transform duration-300 hover:scale-105">
        <div class="w-6 h-6 relative">
            <span class="absolute w-full h-0.5 bg-cyan-400 rounded transform transition-all duration-300"
                :class="{'rotate-45 translate-y-2.5': isMobileMenuOpen, 'translate-y-0.5': !isMobileMenuOpen}"></span>
            <span class="absolute w-full h-0.5 bg-cyan-400 rounded translate-y-2.5 transition-opacity duration-300"
                :class="{'opacity-0': isMobileMenuOpen}"></span>
            <span class="absolute w-full h-0.5 bg-cyan-400 rounded transform transition-all duration-300"
                :class="{'-rotate-45 translate-y-2.5': isMobileMenuOpen, 'translate-y-4.5': !isMobileMenuOpen}"></span>
        </div>
    </button>

    <!-- Desktop Menu -->
    <nav class="hidden lg:block w-full bg-black/90 backdrop-blur-md border-y border-cyan-500/50">
        <div class="container mx-auto">
            <ul class="flex justify-center items-center space-x-8 py-4">
                <template x-for="(item, index) in {{ json_encode($menuItems) }}" :key="index">
                    <li class="relative group">
                        <a :href="item.children.length ? '#' : item.link"
                            @click.prevent="item.children.length && (activeSubmenu = activeSubmenu === index ? null : index)"
                            class="px-4 py-2 text-white flex items-center space-x-1 rounded-lg group-hover:text-cyan-400 group-hover:bg-cyan-500/10 transition-all duration-300">
                            <span x-text="item.label" class="relative">
                                <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-cyan-400 group-hover:w-full transition-all duration-300"></span>
                            </span>
                            <template x-if="item.children.length">
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" 
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </template>
                        </a>
                        
                        <template x-if="item.children.length">
                            <div class="absolute left-0 top-full invisible group-hover:visible opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 w-48">
                                <div class="mt-2 py-2 bg-black/80 backdrop-blur-lg border border-cyan-500/30 rounded-lg shadow-lg shadow-cyan-500/20">
                                    <template x-for="child in item.children" :key="child.id">
                                        <a :href="child.link" 
                                            x-text="child.label"
                                            class="block px-4 py-2 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10 transition-all duration-300"></a>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </li>
                </template>
            </ul>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="isMobileMenuOpen" 
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 lg:hidden">
        
        <nav class="fixed inset-y-0 left-0 w-64 bg-black/95 border-r border-cyan-500/50 transform transition-transform duration-300"
            :class="{'translate-x-0': isMobileMenuOpen, '-translate-x-full': !isMobileMenuOpen}">
            
            <div class="p-4 border-b border-cyan-500/30">
                <span class="text-xl font-bold text-cyan-400 text-glow">Menu</span>
            </div>

            <ul class="py-4 overflow-y-auto h-[calc(100vh-5rem)]">
                <template x-for="(item, index) in {{ json_encode($menuItems) }}" :key="index">
                    <li class="px-4">
                        <button @click="activeSubmenu = activeSubmenu === index ? null : index"
                            class="w-full flex items-center justify-between py-3 px-4 text-white rounded-lg hover:text-cyan-400 hover:bg-cyan-500/10 transition-all duration-300"
                            :class="{'text-cyan-400 bg-cyan-500/10': activeSubmenu === index}">
                            <span x-text="item.label"></span>
                            <template x-if="item.children.length">
                                <svg class="w-4 h-4 transition-transform duration-300"
                                    :class="{'rotate-180': activeSubmenu === index}"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </template>
                        </button>
                        
                        <template x-if="item.children.length">
                            <ul x-show="activeSubmenu === index"
                                x-transition:enter="transition-all duration-300"
                                x-transition:enter-start="opacity-0 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-[500px]"
                                x-transition:leave="transition-all duration-300"
                                x-transition:leave-start="opacity-100 max-h-[500px]"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="pl-4 mt-1 border-l-2 border-cyan-500/30 overflow-hidden">
                                <template x-for="child in item.children" :key="child.id">
                                    <li>
                                        <a :href="child.link" 
                                            x-text="child.label"
                                            class="block py-2 px-4 text-sm text-gray-300 rounded-lg hover:text-cyan-400 hover:bg-cyan-500/10 transition-all duration-300"></a>
                                    </li>
                                </template>
                            </ul>
                        </template>
                    </li>
                </template>
            </ul>
        </nav>
    </div>

    <style>
        .text-glow {
            text-shadow: 
                0 0 10px rgba(6,182,212,0.7),
                0 0 20px rgba(6,182,212,0.5);
            transition: text-shadow 0.3s ease;
        }

        .group:hover .text-glow {
            text-shadow: 
                0 0 15px rgba(34,211,238,0.8),
                0 0 30px rgba(34,211,238,0.6);
        }

        .overflow-y-auto {
            scrollbar-width: thin;
            scrollbar-color: rgba(6,182,212,0.5) rgba(0,0,0,0.2);
            -webkit-overflow-scrolling: touch;
        }

        .overflow-y-auto::-webkit-scrollbar {
            width: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: rgba(6,182,212,0.5);
            border-radius: 1.5px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.2);
        }
    </style>
</div>