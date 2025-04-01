<section class="video-image-carousel relative bg-black py-8 px-4 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-transparent"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>

    <!-- Main Content -->
    <div class="relative container mx-auto flex flex-col lg:flex-row gap-4">
        <!-- Video Section (2/3) -->
        <div class="lg:w-2/3 relative group">
            <div class="aspect-video rounded-lg overflow-hidden border-2 border-cyan-500/50 relative hover:border-cyan-400 transition-all duration-300">
                <!-- Video Frame with Neon Effect -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="absolute inset-0 animate-pulse">
                        <div class="absolute inset-[-2px] bg-gradient-to-r from-cyan-500 via-blue-500 to-cyan-500 rounded-lg opacity-50"></div>
                    </div>
                </div>
                
                <video 
                    class="w-full h-full object-cover"
                    controls
                    autoplay
                    muted
                    loop
                >
                    <source src="{{ asset('media/video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <!-- Images Section (1/3) -->
        <div class="lg:w-1/3 flex flex-col gap-4">
            <!-- First Image -->
            <div class="relative group h-1/2">
                <div class="h-full rounded-lg overflow-hidden border-2 border-cyan-500/50 hover:border-cyan-400 transition-all duration-300">
                    <!-- Image Frame with Neon Effect -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="absolute inset-0 animate-pulse">
                            <div class="absolute inset-[-2px] bg-gradient-to-r from-cyan-500 via-blue-500 to-cyan-500 rounded-lg opacity-50"></div>
                        </div>
                    </div>
                    <img 
                        src="https://hoatuoc.com/wp-content/uploads/2021/08/salmon_ap_1.jpg"
                        alt="Salmon Image" 
                        class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-105"
                    >
                </div>
            </div>

            <!-- Second Image -->
            <div class="relative group h-1/2">
                <div class="h-full rounded-lg overflow-hidden border-2 border-cyan-500/50 hover:border-cyan-400 transition-all duration-300">
                    <!-- Image Frame with Neon Effect -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="absolute inset-0 animate-pulse">
                            <div class="absolute inset-[-2px] bg-gradient-to-r from-cyan-500 via-blue-500 to-cyan-500 rounded-lg opacity-50"></div>
                        </div>
                    </div>
                    <img 
                        src="https://hoatuoc.com/wp-content/uploads/2022/07/maxresdefault-1-768x432.jpg"
                        alt="Restaurant Image" 
                        class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-105"
                    >
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Cyberpunk Neon Effects */
@keyframes neonPulse {
    0%, 100% {
        box-shadow: 0 0 15px rgba(8,145,178,0.5),
                   0 0 30px rgba(8,145,178,0.3),
                   0 0 45px rgba(8,145,178,0.1);
    }
    50% {
        box-shadow: 0 0 20px rgba(8,145,178,0.8),
                   0 0 40px rgba(8,145,178,0.5),
                   0 0 60px rgba(8,145,178,0.2);
    }
}

.video-image-carousel {
    position: relative;
}

.video-image-carousel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(8,145,178,0.5), transparent);
    animation: neonPulse 2s infinite;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .video-image-carousel .container {
        flex-direction: column;
    }

    .video-image-carousel .lg\:w-2/3,
    .video-image-carousel .lg\:w-1/3 {
        width: 100%;
    }
}
</style>