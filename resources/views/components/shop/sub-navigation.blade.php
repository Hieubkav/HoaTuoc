<div x-data="{ isScrolled: false }" 
    @scroll.window="isScrolled = (window.pageYOffset > 100)"
    class="w-full">
    @if($settings && $settings->slogan)
    <div class="transition-all duration-300"
         :class="{ 
            'fixed top-0 left-0 right-0 z-50 bg-black/90 backdrop-blur-lg border-b border-cyan-500/30': isScrolled,
            'relative bg-gradient-to-r from-gray-900 via-black to-gray-900 border-y border-cyan-500/50': !isScrolled
         }">
        <div x-data="{ 
            glitch: false,
            glitchInterval: null,
            wave: 0
        }"
        x-init="() => {
            glitchInterval = setInterval(() => {
                glitch = true;
                setTimeout(() => glitch = false, 150);
            }, 3000);
            setInterval(() => {
                wave = (wave + 1) % 360;
            }, 50);
        }"
        @mouseover="glitch = true"
        @mouseleave="setTimeout(() => glitch = false, 500)"
        class="container mx-auto px-4 py-3 relative overflow-hidden">
            <!-- Neon Wave Effect -->
            <div class="absolute inset-0 opacity-20"
                 :style="`background: linear-gradient(${wave}deg, transparent 40%, cyan 45%, transparent 55%)`">
            </div>

            <p class="text-center font-cyber tracking-[0.2em] uppercase relative"
               :class="{ 
                    'text-lg': !isScrolled, 
                    'text-base': isScrolled,
                    'animate-cyber-glitch text-cyan-400': glitch,
                    'text-glow': !glitch
                }">
                <span class="relative inline-block">
                    <span class="absolute -inset-1 bg-cyan-500/20 blur rounded-lg"></span>
                    <span class="relative text-white">
                        {{ $settings->slogan }}
                        <span class="absolute top-0 left-0 w-full h-full flex items-center justify-center"
                              :class="{ 'animate-cyber-noise': glitch }">
                            {{ $settings->slogan }}
                        </span>
                    </span>
                </span>
            </p>
        </div>
    </div>
    @endif

    <style>
        @keyframes cyber-glitch {
            0% { transform: translate(0); filter: hue-rotate(0deg); }
            15% { transform: translate(-2px, 2px); filter: hue-rotate(-45deg); }
            30% { transform: translate(2px, -2px); filter: hue-rotate(45deg); }
            45% { transform: translate(-1px, -1px); filter: hue-rotate(-90deg); }
            60% { transform: translate(1px, 1px); filter: hue-rotate(90deg); }
            75% { transform: translate(-1px, 2px); filter: hue-rotate(-45deg); }
            100% { transform: translate(0); filter: hue-rotate(0deg); }
        }

        @keyframes cyber-noise {
            0%, 100% { clip-path: inset(50% 0 30% 0); }
            20% { clip-path: inset(30% 0 60% 0); }
            40% { clip-path: inset(70% 0 20% 0); }
            60% { clip-path: inset(10% 0 80% 0); }
            80% { clip-path: inset(40% 0 50% 0); }
        }

        .animate-cyber-glitch {
            animation: cyber-glitch 0.3s cubic-bezier(.4,0,.2,1) infinite;
            text-shadow: 
                0 0 5px rgba(6,182,212,0.7),
                0 0 10px rgba(6,182,212,0.5),
                0 0 15px rgba(6,182,212,0.3),
                0 0 20px rgba(6,182,212,0.2);
        }

        .animate-cyber-noise {
            animation: cyber-noise 0.2s infinite linear alternate-reverse;
            opacity: 0.5;
        }

        .text-glow {
            text-shadow: 
                0 0 5px rgba(6,182,212,0.5),
                0 0 10px rgba(6,182,212,0.3);
            transition: text-shadow 0.3s ease;
        }
    </style>
</div>