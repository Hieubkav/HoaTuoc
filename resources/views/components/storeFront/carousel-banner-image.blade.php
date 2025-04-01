<div class="relative w-full bg-black overflow-hidden" 
     x-data="{ 
        currentSlide: 0,
        slides: [
            'https://hoatuoc.com/wp-content/uploads/2021/11/z2931752602284_8b92ea198f80ea2870aec4b390c6a9b7-1536x1152.jpg',
            'https://hoatuoc.com/wp-content/uploads/2025/01/img_menuset_1_6-1536x1536.jpg',
            'https://hoatuoc.com/wp-content/uploads/2021/05/183152536_943949929673153_9045925660553057110_n.jpg'
        ],
        banners: [
            'https://hoatuoc.com/wp-content/uploads/2021/11/z2910511517283_ae22b5fbc1e6fe597fc58d7141ad55b3-CA-NGU-600x447.jpg',
            'https://hoatuoc.com/wp-content/uploads/2025/01/img_menuset_7_20-600x600.jpg',
            'https://theme.hstatic.net/1000030244/1001119993/14/banner_right_2_large.jpg?v=8937'
        ],
        init() {
            setInterval(() => this.nextSlide(), 5000)
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length
        }
     }">
    
    <!-- Container Grid -->
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-3 gap-4 p-4">
        
        <!-- Main Carousel (2/3 width on desktop) -->
        <div class="lg:col-span-2 relative h-[400px] lg:h-[600px] carousel-container group">
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index"
                     x-transition:enter="transition-opacity duration-500"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    <img :src="slide" 
                         :alt="'Slide ' + (index + 1)"
                         class="w-full h-full object-cover transition-all duration-700 hover:scale-105 rounded-xl shadow-lg group-hover:brightness-110"
                         loading="lazy">
                </div>
            </template>

            <!-- Navigation arrows -->
            <button @click="currentSlide = (currentSlide - 1 + slides.length) % slides.length"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 z-30 cyberpunk-btn opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <i class="fas fa-chevron-left text-cyan-500"></i>
            </button>
            <button @click="nextSlide"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 z-30 cyberpunk-btn opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <i class="fas fa-chevron-right text-cyan-500"></i>
            </button>
        </div>

        <!-- Banner Images (1/3 width on desktop) -->
        <div class="lg:col-span-1 grid grid-rows-3 gap-4 h-[600px] banner-container">
            <template x-for="(banner, index) in banners" :key="index">
                <div class="relative h-full banner-item overflow-hidden">
                    <img :src="banner" 
                         :alt="'Banner ' + (index + 1)"
                         class="w-full h-full object-cover rounded-lg transition-all duration-500 hover:brightness-110"
                         loading="lazy">
                         
                    <!-- Neon border effect -->
                    <div class="absolute inset-0 border-2 border-cyan-500 z-20 glow-border rounded-lg"></div>

                    <!-- Decorative background icon -->
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 opacity-20 transform rotate-45 pointer-events-none hover:rotate-90 transition-transform duration-1000">
                        <img src="/images/carousel_image.png" alt="Decorative"
                             class="w-full h-full object-contain filter brightness-150">
                    </div>
                </div>
            </template>
        </div>
    </div>

    <style>
        .glow-border {
            box-shadow: 0 0 10px theme('colors.cyan.500'),
                       0 0 30px theme('colors.cyan.500'),
                       inset 0 0 15px theme('colors.cyan.500');
            animation: borderGlow 2s infinite alternate;
            backdrop-filter: brightness(1.2);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes borderGlow {
            from {
                box-shadow: 0 0 10px theme('colors.cyan.500'),
                           0 0 30px theme('colors.cyan.500'),
                           inset 0 0 15px theme('colors.cyan.500');
                transform: scale(1);
            }
            to {
                box-shadow: 0 0 20px theme('colors.cyan.500'),
                           0 0 40px theme('colors.cyan.500'),
                           inset 0 0 25px theme('colors.cyan.500');
                transform: scale(1.02);
            }
        }

        .cyberpunk-btn {
            @apply p-2 rounded-lg bg-black/50 backdrop-blur-sm border-2 border-cyan-500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 0 8px theme('colors.cyan.500'));
        }

        .cyberpunk-btn:hover {
            @apply bg-cyan-500/20;
            text-shadow: 0 0 8px theme('colors.cyan.500');
            transform: translateY(-2px);
        }

        .banner-item {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(5px);
        }

        @media (min-width: 1024px) {
            .banner-item:hover {
                transform: scale(1.05) translateY(-4px);
            }

            .banner-item:hover .glow-border {
                box-shadow: 0 0 20px theme('colors.cyan.500'),
                           0 0 40px theme('colors.cyan.500'),
                           inset 0 0 20px theme('colors.cyan.500');
            }

            .banner-item:hover img {
                transform: scale(1.1);
            }
        }

        /* Mobile touch events */
        @media (max-width: 1023px) {
            .carousel-container {
                touch-action: pan-y pinch-zoom;
            }
        }

        /* Glitch effect for text */
        .glitch-text {
            animation: glitch 1s infinite;
            text-shadow: 2px 2px theme('colors.cyan.500'),
                        -2px -2px theme('colors.pink.500');
        }

        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }
    </style>
</div>