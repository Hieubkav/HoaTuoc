@props(['sections'])

@foreach ($sections as $section)
    <section class="product-category-tabs relative bg-black py-8 px-4 overflow-hidden cyberpunk-container"
        x-data="{
            activeTab: null,
            init() {
                // Set first category as active by default
                if (this.$refs.tabs.children.length > 0) {
                    this.activeTab = this.$refs.tabs.children[0].dataset.category;
                }
            }
        }">
        <!-- Cyberpunk Background Effects -->
        <div class="cyber-grid"></div>
        <div class="cyber-waves"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-cyan-600/10 to-transparent"></div>
        <div class="absolute inset-0 backdrop-blur-sm"></div>

        <!-- Header Section -->
        <div class="relative container mx-auto flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <h2 class="text-3xl md:text-4xl font-bold text-white flex items-center cyber-text">
                <span class="text-cyan-400 mr-2 neon-flicker">⧫</span>
                {{ $section->name }}
            </h2>

            <!-- View All Button -->
            <a href="#"
                class="cyber-button px-6 py-2 bg-transparent border-2 border-cyan-400 text-cyan-400 font-bold rounded-md 
                      transition-all duration-300 hover:bg-cyan-400 hover:text-black 
                      relative overflow-hidden group">
                <span class="relative z-10">VIEW ALL</span>
                <div class="cyber-button-glitch"></div>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">
                </div>
            </a>
        </div>

        <!-- Category Tabs -->
        <div class="relative container mx-auto mb-8">
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-none cyber-tabs" x-ref="tabs">
                @foreach ($section->categories as $category)
                    @if ($category->products->count() > 0)
                        <button class="category-tab" :class="activeTab === '{{ $category->id }}' ? 'active' : ''"
                            @click="activeTab = '{{ $category->id }}'" data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Products Carousel -->
        @foreach ($section->categories as $category)
            @if ($category->products->count() > 0)
                <div class="relative container mx-auto" x-show="activeTab === '{{ $category->id }}'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-4"
                    x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($category->products->take(4) as $product)
                            @php
                                $defaultVersion = $product->versions->first();
                                $mainImage = $product->thumbnail;
                            @endphp
                            <div class="product-card group" x-data="{ hover: false }" x-on:mouseenter="hover = true"
                                x-on:mouseleave="hover = false">
                                <div
                                    class="cyber-product-card relative overflow-hidden rounded-md border border-cyan-500/30 bg-gradient-to-br from-gray-900/90 to-black/90 p-4 backdrop-blur-md transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_0_15px_rgba(8,145,178,0.5)]">
                                    <!-- Glitch Corner Effect -->
                                    <div class="cyber-corner top-0 right-0"></div>
                                    <div class="cyber-corner bottom-0 left-0"></div>

                                    <!-- Discount Badge -->
                                    @if ($defaultVersion && $defaultVersion->discount_percentage > 0)
                                        <div
                                            class="absolute top-2 right-2 bg-cyan-400 text-black font-bold px-2 py-1 rounded-sm text-sm z-10 cyber-badge">
                                            -{{ $defaultVersion->discount_percentage }}%
                                        </div>
                                    @endif

                                    <!-- Product Image -->
                                    <div class="relative aspect-square mb-4 cyber-image-container">
                                        <img src="{{ asset('/storage/' . ($mainImage ? $mainImage: "")) }}"
                                            class="w-full h-full object-cover rounded-md" loading="lazy"
                                            alt="{{ $product->name }}">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <div class="cyber-image-glitch"></div>
                                    </div>

                                    <!-- Product Info -->
                                    <h3 class="text-white font-semibold mb-2 line-clamp-2 cyber-product-title">
                                        {{ $product->name }}</h3>

                                    @if ($defaultVersion)
                                        <div class="flex items-center gap-2">
                                            @if ($defaultVersion->discount_percentage > 0)
                                                <span class="text-gray-400 line-through text-sm">
                                                    {{ number_format($defaultVersion->price, 0, ',', '.') }}₫
                                                </span>
                                                <span class="text-cyan-400 font-bold neon-text">
                                                    {{ number_format($defaultVersion->price * (1 - $defaultVersion->discount_percentage / 100), 0, ',', '.') }}₫
                                                </span>
                                            @else
                                                <span class="text-cyan-400 font-bold neon-text">
                                                    {{ number_format($defaultVersion->price, 0, ',', '.') }}₫
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </section>
@endforeach
<style>
    /* Cyberpunk Container */
    .cyberpunk-container {
        position: relative;
        isolation: isolate;
        border-top: 1px solid rgba(8, 145, 178, 0.3);
        border-bottom: 1px solid rgba(8, 145, 178, 0.3);
    }

    /* Cyber Grid Background */
    .cyber-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(8, 145, 178, 0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(8, 145, 178, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        z-index: -1;
    }

    /* Cyber Waves Animation */
    .cyber-waves {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0.15;
        background: repeating-linear-gradient(0deg,
                transparent,
                rgba(8, 145, 178, 0.2) 2px,
                transparent 4px);
        z-index: -1;
        animation: wave 10s linear infinite;
    }

    @keyframes wave {
        0% {
            background-position-y: 0;
        }

        100% {
            background-position-y: 100px;
        }
    }

    /* Neon Text Styling */
    .cyber-text {
        text-shadow: 0 0 5px rgba(8, 145, 178, 0.7),
            0 0 10px rgba(8, 145, 178, 0.5);
        letter-spacing: 1px;
    }

    .neon-text {
        text-shadow: 0 0 5px rgba(8, 145, 178, 0.7),
            0 0 10px rgba(8, 145, 178, 0.5);
        animation: neonPulse 2s infinite;
    }

    /* Neon Flicker Effect */
    .neon-flicker {
        animation: neonFlicker 3s infinite;
        font-size: 120%;
    }

    /* Category Tabs */
    .cyber-tabs {
        position: relative;
        padding-bottom: 1px;
    }

    .cyber-tabs::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, rgba(8, 145, 178, 0) 0%, rgba(8, 145, 178, 0.7) 50%, rgba(8, 145, 178, 0) 100%);
    }

    .category-tab {
        @apply px-6 py-2 font-medium rounded-sm border border-transparent transition-all duration-300 whitespace-nowrap hover:text-cyan-400 hover:border-cyan-400/30 uppercase tracking-wider text-sm font-bold;
        position: relative;
        overflow: hidden;
        background: linear-gradient(to bottom, rgba(8, 145, 178, 0.1), transparent);
        border-top: 1px solid rgba(8, 145, 178, 0.3);
        border-left: 1px solid rgba(8, 145, 178, 0.2);
        border-right: 1px solid rgba(8, 145, 178, 0.2);
        color: white;
        /* Change text color to white */
        text-shadow: 0 0 3px rgba(255, 255, 255, 0.3);
        /* Subtle text shadow for better readability */
    }

    .category-tab::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: rgba(8, 145, 178, 0.7);
        transition: width 0.3s;
        box-shadow: 0 0 8px rgba(8, 145, 178, 0.6);
    }

    .category-tab:hover::before {
        width: 80%;
    }

    .category-tab.active {
        @apply border-cyan-400/70;
        background: linear-gradient(to bottom, rgba(8, 145, 178, 0.3), rgba(8, 145, 178, 0.1));
        box-shadow: 0 0 15px rgba(8, 145, 178, 0.3);
        text-shadow: 0 0 5px rgba(8, 145, 178, 0.7);
        color: rgba(8, 145, 178, 1);
        /* Active tab text color */
    }

    .category-tab.active::before {
        width: 90%;
        height: 2px;
        background: rgba(8, 145, 178, 1);
        box-shadow: 0 0 8px rgba(8, 145, 178, 0.7);
    }

    /* Alternating tab colors for more visual interest */
    .category-tab:nth-child(odd) {
        border-top-color: rgba(8, 145, 178, 0.5);
    }

    .category-tab:nth-child(even) {
        border-top-color: rgba(56, 189, 248, 0.5);
    }

    /* Add glow effect on hover */
    .category-tab:hover {
        background: linear-gradient(to bottom, rgba(8, 145, 178, 0.2), rgba(8, 145, 178, 0.05));
        box-shadow: 0 0 10px rgba(8, 145, 178, 0.2);
    }

    /* Colorful indicators underneath tabs */
    .category-tab::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, #06b6d4, #0891b2, #0e7490);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        opacity: 0.7;
    }

    .category-tab:hover::after,
    .category-tab.active::after {
        transform: scaleX(0.8);
    }

    /* Cyber Product Card */
    .cyber-product-card {
        position: relative;
        box-shadow: 0 0 10px rgba(8, 145, 178, 0.2);
    }

    .cyber-corner {
        position: absolute;
        width: 10px;
        height: 10px;
        border: 1px solid rgba(8, 145, 178, 0.7);
        z-index: 1;
    }

    .cyber-corner.top-0.right-0 {
        border-left: none;
        border-bottom: none;
    }

    .cyber-corner.bottom-0.left-0 {
        border-top: none;
        border-right: none;
    }

    /* Cyber Badge */
    .cyber-badge {
        clip-path: polygon(0 0, 100% 0, 100% 70%, 90% 100%, 0 100%);
    }

    /* Cyber Image Container */
    .cyber-image-container {
        position: relative;
        border: 1px solid rgba(8, 145, 178, 0.3);
        overflow: hidden;
    }

    .cyber-image-glitch {
        position: absolute;
        top: 0;
        left: -5%;
        width: 110%;
        height: 100%;
        background: linear-gradient(90deg, transparent 0%, rgba(8, 145, 178, 0.2) 50%, transparent 100%);
        animation: imageGlitch 3s ease-in-out infinite;
        pointer-events: none;
        z-index: 2;
        opacity: 0;
    }

    .product-card:hover .cyber-image-glitch {
        opacity: 1;
    }

    /* Cyber Button */
    .cyber-button {
        clip-path: polygon(0 0, 100% 0, 100% 70%, 95% 100%, 0 100%);
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .cyber-button-glitch {
        position: absolute;
        top: 0;
        left: -5%;
        width: 0;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(8, 145, 178, 0.4), transparent);
        transition: width 0.3s;
    }

    .cyber-button:hover .cyber-button-glitch {
        width: 110%;
        animation: buttonGlitch 1s ease-in-out;
    }

    /* Product Title */
    .cyber-product-title {
        position: relative;
        padding-left: 8px;
    }

    .cyber-product-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 70%;
        background: rgba(8, 145, 178, 0.7);
    }

    /* Custom Scrollbar None */
    .scrollbar-none {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-none::-webkit-scrollbar {
        display: none;
    }

    /* Animations */
    @keyframes neonPulse {

        0%,
        100% {
            text-shadow: 0 0 5px rgba(8, 145, 178, 0.7),
                0 0 10px rgba(8, 145, 178, 0.5);
        }

        50% {
            text-shadow: 0 0 8px rgba(8, 145, 178, 0.9),
                0 0 15px rgba(8, 145, 178, 0.7),
                0 0 25px rgba(8, 145, 178, 0.4);
        }
    }

    @keyframes neonFlicker {

        0%,
        19%,
        21%,
        23%,
        25%,
        54%,
        56%,
        100% {
            text-shadow: 0 0 5px rgba(8, 145, 178, 0.7),
                0 0 10px rgba(8, 145, 178, 0.5);
        }

        20%,
        24%,
        55% {
            text-shadow: none;
        }
    }

    @keyframes imageGlitch {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    @keyframes buttonGlitch {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    @media (max-width: 640px) {
        .cyber-text {
            font-size: 1.5rem;
        }

        .cyber-corner {
            width: 6px;
            height: 6px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        try {
            if (typeof gsap !== 'undefined') {
                // Stagger animation for product cards
                gsap.from('.product-card', {
                    opacity: 0,
                    y: 20,
                    duration: 0.8,
                    stagger: 0.1,
                    ease: 'power2.out'
                });

                // Subtle glitch effect for section title
                const glitchText = () => {
                    gsap.to('.cyber-text', {
                        skewX: 2,
                        duration: 0.1,
                        onComplete: () => {
                            gsap.to('.cyber-text', {
                                skewX: 0,
                                duration: 0.1
                            });
                        }
                    });
                };

                // Random glitch effect
                setInterval(() => {
                    if (Math.random() > 0.7) {
                        glitchText();
                    }
                }, 3000);
            }
        } catch (e) {
            console.error('Error in category tabs animations:', e);
        }
    });
</script>
