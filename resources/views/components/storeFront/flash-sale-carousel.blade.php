@props(['flashSaleProducts' => []])

<section class="flash-sale relative bg-black py-8 px-4 overflow-hidden" 
         x-data="{ 
           countdown: {
             days: 0,
             hours: 0,
             minutes: 0,
             seconds: 0
           },
           initCountdown() {
             const endDate = new Date('2025-04-30T00:00:00');
             const updateCounter = () => {
               const now = new Date();
               const diff = endDate - now;
               this.countdown = {
                 days: Math.floor(diff / (1000 * 60 * 60 * 24)),
                 hours: Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                 minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
                 seconds: Math.floor((diff % (1000 * 60)) / 1000)
               };
             };
             updateCounter();
             setInterval(updateCounter, 1000);
           }
         }"
         x-init="initCountdown()"
>
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-transparent"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>

    <!-- Header Section -->
    <div class="relative flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-white flex items-center">
            <span class="text-cyan-500 mr-2">⚡</span>
            Flash Sale
        </h2>
        
        <!-- Countdown Timer -->
        <div class="flex gap-4">
            <div class="countdown-item">
                <span class="countdown-value" x-text="countdown.days">00</span>
                <span class="countdown-label">Days</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" x-text="countdown.hours">00</span>
                <span class="countdown-label">Hours</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" x-text="countdown.minutes">00</span>
                <span class="countdown-label">Mins</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" x-text="countdown.seconds">00</span>
                <span class="countdown-label">Secs</span>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php
            // Sample data - replace with actual data
            $sampleProducts = [
                [
                    'image' => 'https://hoatuoc.com/wp-content/uploads/2025/03/472785676_1045396797626650_6973978503830019096_n.jpg',
                    'name' => 'Bó Hoa Hồng Ngọc Valentine',
                    'originalPrice' => 899000,
                    'salePrice' => 629000,
                    'discount' => 30,
                    'remaining' => 15
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/12/10-canh-hong-do-500.jpg',
                    'name' => 'Bó Hoa Hồng Đỏ Rực Rỡ',
                    'originalPrice' => 799000,
                    'salePrice' => 479000,
                    'discount' => 40,
                    'remaining' => 8
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/14/red-rose-bucket-500.jpg',
                    'name' => 'Bó Hồng Premium Red Romance',
                    'originalPrice' => 1299000,
                    'salePrice' => 909000,
                    'discount' => 30,
                    'remaining' => 12
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/15/pink-rose-mix-500.jpg',
                    'name' => 'Bó Hoa Hồng Mix Pastel',
                    'originalPrice' => 999000,
                    'salePrice' => 699000,
                    'discount' => 30,
                    'remaining' => 20
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/16/tulip-mix-500.jpg',
                    'name' => 'Bó Tulip Rainbow Mix',
                    'originalPrice' => 1599000,
                    'salePrice' => 959000,
                    'discount' => 40,
                    'remaining' => 5
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/17/lily-white-500.jpg',
                    'name' => 'Bó Hoa Ly Trắng Tinh Khôi',
                    'originalPrice' => 1099000,
                    'salePrice' => 769000,
                    'discount' => 30,
                    'remaining' => 18
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/18/sunflower-mix-500.jpg',
                    'name' => 'Bó Hoa Hướng Dương Mix',
                    'originalPrice' => 899000,
                    'salePrice' => 629000,
                    'discount' => 30,
                    'remaining' => 25
                ],
                [
                    'image' => 'https://hoatuoc.com/images/products/20230419/19/carnation-pink-500.jpg',
                    'name' => 'Bó Hoa Cẩm Chướng Hồng',
                    'originalPrice' => 699000,
                    'salePrice' => 489000,
                    'discount' => 30,
                    'remaining' => 10
                ],
            ];
            
            $products = $flashSaleProducts ?: $sampleProducts;
        @endphp

        @if(count($products) > 0)
            @foreach($products as $key => $product)
            <div class="product-card group opacity-100 transform-none" 
                 x-data="{ hover: false }"
                 x-on:mouseenter="hover = true"
                 x-on:mouseleave="hover = false"
            >
                <div class="relative overflow-hidden rounded-lg bg-gradient-to-br from-gray-900/90 to-black/90 p-4 backdrop-blur-md transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_0_15px_rgba(8,145,178,0.5)]">
                    <!-- Discount Badge nếu lớn hơn 0-->
                    @if($product['discount'] > 0)
                    <div class="absolute top-2 right-2 bg-cyan-500 text-black font-bold px-2 py-1 rounded-full text-sm z-10">
                        -{{ $product['discount'] }}%
                    </div>
                    @endif

                    <!-- Product Image -->
                    <div class="relative aspect-square mb-4">
                        <img src="{{ asset('/storage/'.$product['image'])  }}" class="w-full h-full object-cover rounded-lg" loading="lazy" alt="{{ $product['name'] }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>

                    <!-- Product Info -->
                    <h3 class="text-white font-semibold mb-2 line-clamp-2">{{ $product['name'] }}</h3>
                    
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400 line-through text-sm">{{ number_format($product['originalPrice'], 0, ',', '.') }}₫</span>
                            <span class="text-cyan-500 font-bold">{{ number_format($product['salePrice'], 0, ',', '.') }}₫</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="relative h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="absolute inset-y-0 left-0 bg-cyan-500 rounded-full" style="width: {{ ($product['remaining'] / 30) * 100 }}%"></div>
                        </div>
                        <span class="text-gray-400 text-xs">{{ $product['remaining'] }} items left</span>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-span-4 text-center py-8">
                <p class="text-white">No flash sale products available at this time.</p>
            </div>
        @endif
    </div>

    <!-- View All Button -->
    <div class="text-center">
        <a href="#" class="inline-block px-8 py-3 bg-transparent border-2 border-cyan-500 text-cyan-500 font-bold rounded-full 
                          transition-all duration-300 hover:bg-cyan-500 hover:text-black
                          relative overflow-hidden group">
            <span class="relative z-10">View All Products</span>
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </a>
    </div>
</section>

<style>
.countdown-item {
    @apply bg-gradient-to-br from-gray-900/90 to-black/90 p-3 rounded-lg backdrop-blur-md border border-cyan-500/20 flex flex-col items-center min-w-[60px];
}

.countdown-value {
    @apply text-2xl font-bold text-cyan-500;
}

.countdown-label {
    @apply text-xs text-gray-400;
}

/* Remove this to prevent products from being hidden initially */
/* .product-card {
    opacity: 0;
    transform: translateY(20px);
} */

@keyframes glow {
    0%, 100% {
        box-shadow: 0 0 15px rgba(8,145,178,0.5);
    }
    50% {
        box-shadow: 0 0 30px rgba(8,145,178,0.8);
    }
}

.hover\:glow:hover {
    animation: glow 2s infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    try {
        // Only run GSAP animation if GSAP is available
        if (typeof gsap !== 'undefined') {
            gsap.from('.product-card', {
                opacity: 0,
                y: 20,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power2.out'
            });
        } else {
            console.warn('GSAP not loaded, animations disabled');
        }
    } catch (e) {
        console.error('Error in flash sale animations:', e);
    }
});
</script>