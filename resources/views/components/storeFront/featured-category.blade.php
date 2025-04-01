@props(['featuredSections'])

@push('styles')
<style>
    .cyberpunk-card {
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(8, 145, 178, 0.2);
        transition: all 0.3s ease;
    }

    .neon-border {
        box-shadow: 0 0 10px rgba(8, 145, 178, 0.3),
                    inset 0 0 15px rgba(8, 145, 178, 0.2);
    }

    .neon-text {
        text-shadow: 0 0 10px rgba(8, 145, 178, 0.5);
    }
</style>
@endpush

<div 
    x-data="{
        activeSlide: 0,
        slidesCount: {{ count($featuredSections) }},
        isCarousel: {{ count($featuredSections) > 4 ? 'true' : 'false' }},
        init() {
            if (this.isCarousel) {
                setInterval(() => this.nextSlide(), 5000)
            }
            this.initGSAP()
        },
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.slidesCount
        },
        initGSAP() {
            gsap.fromTo('.section-card', 
                { opacity: 0, y: 20 },
                { 
                    opacity: 1, 
                    y: 0, 
                    duration: 0.5,
                    stagger: 0.1,
                    ease: 'power2.out'
                }
            )
        }
    }"
    class="w-full bg-black py-8 px-4 lg:px-8"
>
    <div class="max-w-7xl mx-auto">
        <!-- Grid for ≤4 sections -->
        <div x-show="!isCarousel" class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($featuredSections as $section)
                <div 
                    class="section-card cyberpunk-card neon-border rounded-lg p-4 hover:scale-105 transition-transform duration-300"
                    x-intersect="gsap.to($el, {scale: 1, opacity: 1, duration: 0.5})"
                >
                    <img 
                        src="{{ asset('/storage/'.$section->thumbnail) }}" 
                        alt="{{ $section->name }}"
                        class="w-full h-48 object-cover rounded mb-4"
                        loading="lazy"
                    >
                    <h3 class="text-white neon-text text-xl font-bold mb-2">{{ $section->name }}</h3>
                    <p class="text-gray-300 text-sm">{!! $section->description !!}</p>
                </div>
            @endforeach
        </div>

        <!-- Carousel for >4 sections -->
        <div x-show="isCarousel" class="relative">
            <div class="overflow-hidden">
                <div 
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="{ transform: `translateX(-${activeSlide * 100}%)` }"
                >
                    @foreach($featuredSections as $section)
                        <div class="w-full md:w-1/2 lg:w-1/4 flex-shrink-0 px-2">
                            <div 
                                class="section-card cyberpunk-card neon-border rounded-lg p-4"
                                @mouseenter="gsap.to($el, {
                                    scale: 1.05,
                                    boxShadow: '0 0 30px #0891b2',
                                    duration: 0.5,
                                    ease: 'power2.out'
                                })"
                                @mouseleave="gsap.to($el, {
                                    scale: 1,
                                    boxShadow: '0 0 10px rgba(8, 145, 178, 0.3)',
                                    duration: 0.5
                                })"
                            >
                                <img 
                                    src="{{ asset('/storage/'.$section->thumbnail) }}" 
                                    alt="{{ $section->name }}"
                                    class="w-full h-48 object-cover rounded mb-4"
                                    loading="lazy"
                                >
                                <h3 class="text-white neon-text text-xl font-bold mb-2">{{ $section->name }}</h3>
                                <p class="text-gray-300 text-sm">{!! $section->description !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation dots -->
            <div class="flex justify-center mt-4 gap-2">
                @foreach($featuredSections as $section)
                    <button
                        class="w-3 h-3 rounded-full transition-colors duration-200"
                        :class="activeSlide === {{ $loop->index }} ? 'bg-cyan-500' : 'bg-gray-600'"
                        @click="activeSlide = {{ $loop->index }}"
                        aria-label="Go to slide {{ $loop->iteration }}"
                    ></button>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
@endpush