<!-- filepath: e:\Laravel\Persional_project\HoaTuoc\resources\views\components\storeFront\blog-section.blade.php -->
<section class="blog-section relative bg-black py-16 px-4 overflow-hidden cyberpunk-container">
    <!-- Cyberpunk Background Effects -->
    <div class="cyber-grid"></div>
    <div class="cyber-waves"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-transparent"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>

    <!-- Content Container -->
    <div class="container mx-auto relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold cyber-text relative inline-block">
                <span class="text-cyan-400 mr-2 neon-flicker">⧫</span>
                <span
                    class="animate-text-gradient bg-gradient-to-r from-cyan-300 via-white to-cyan-400 bg-clip-text text-transparent">
                    Bí Quyết Nấu Ăn
                </span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-500 mx-auto mt-4"></div>
            <p class="text-gray-300 mt-4 max-w-xl mx-auto">Khám phá các công thức nấu ăn và mẹo vặt từ đầu bếp của chúng
                tôi</p>
        </div>

        <!-- Blog Posts Grid -->
        @if ($blogPosts && count($blogPosts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blogPosts as $post)
                    <div
                        class="blog-card relative border border-cyan-800/30 bg-gradient-to-br from-black to-cyan-900/20 rounded-lg overflow-hidden group hover:border-cyan-400/50 transition-all duration-500">
                        <!-- Top Border Gradient -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-purple-500">
                        </div>
                        <div class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-cyan-400 opacity-70">
                        </div>

                        <!-- Blog Image -->
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ asset('/storage/'.$post->thumbnail)  }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50"></div>
                        </div>

                        <!-- Blog Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-cyan-300 mb-3 line-clamp-1">{{ $post->title }}</h3>
                            {{-- <p class="text-gray-300 text-sm line-clamp-3 mb-4">Đọc thêm</p> --}}

                            <!-- Meta Information -->
                            <div class="flex justify-between items-center text-xs text-gray-400">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $post->updated_at ? $post->updated_at->format('d/m/Y') : 'N/A' }}
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $post->user ? $post->user->name : 'Không xác định' }}
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <a href=""
                                class="inline-block mt-4 text-cyan-400 text-sm font-medium hover:text-cyan-300 transition-colors duration-300 group flex items-center">
                                Đọc tiếp
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Bottom Border Gradient -->
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-cyan-400">
                        </div>

                        <!-- Glitch Effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 opacity-0 group-hover:opacity-30 transition-opacity duration-500">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-cyan-300 text-lg">Chưa có bài viết nào. Hãy quay lại sau nhé!</p>
            </div>
        @endif

        <!-- View All Button -->
        <div class="flex justify-center mt-12">
            <div class="cyber-btn-container">
                <a href=""
                    class="cyber-btn px-8 py-3 border-2 border-cyan-400 text-cyan-400 hover:bg-cyan-400/20 transition-all duration-300 rounded-md relative overflow-hidden group">
                    <span class="relative z-10">Xem tất cả bài viết</span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 via-cyan-400/30 to-cyan-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700">
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
