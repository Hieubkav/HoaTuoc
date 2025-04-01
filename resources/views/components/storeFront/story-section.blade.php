<section class="story-section relative bg-black py-16 px-4 overflow-hidden cyberpunk-container" x-data="{ showFullStory: false }">
    <!-- Cyberpunk Background Effects -->
    <div class="cyber-grid"></div>
    <div class="cyber-waves"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-cyan-600/10 to-transparent"></div>
    <div class="absolute inset-0 backdrop-blur-sm"></div>

    <!-- Content Container -->
    <div class="container mx-auto relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Image Section -->
            <div class="cyber-image-container relative aspect-[3/4] rounded-lg overflow-hidden group">
                <img src="https://hoatuoc.com/wp-content/uploads/2024/04/484918380_656979850075036_7224964468098600510_n-768x1024.jpg" 
                     alt="Hòa Tuộc" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="cyber-image-glitch"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                
                <!-- Decorative elements -->
                <div class="absolute top-4 right-4 w-20 h-20 border-t-2 border-r-2 border-cyan-400 opacity-70"></div>
                <div class="absolute bottom-4 left-4 w-20 h-20 border-b-2 border-l-2 border-cyan-400 opacity-70"></div>
            </div>

            <!-- Story Section -->
            <div class="text-white space-y-6">
                <h2 class="text-3xl md:text-4xl font-bold cyber-text mb-6 animate-pulse-subtle relative">
                    <span class="text-cyan-400 mr-2 neon-flicker">⧫</span>
                    <span class="animate-text-gradient bg-gradient-to-r from-cyan-300 via-white to-cyan-400 bg-clip-text text-transparent">Hòa Tuộc – Từ đôi tay trần đến hai cơ sở hải sản tươi sống</span>
                </h2>

                <div class="prose prose-invert max-w-none relative story-content transition-all duration-500 backdrop-blur-sm bg-cyan-900/10 p-6 rounded-lg border border-cyan-800/30 shadow-inner shadow-cyan-500/10" 
                     :class="{ 'line-clamp-[8]': !showFullStory }">
                    <p class="text-lg leading-relaxed mb-4 first-letter:text-4xl first-letter:font-bold first-letter:text-cyan-400 first-letter:mr-1">
                        Ngày xưa, ông Hòa bắt đầu với đôi tay trắng và một lời hứa:
                        <span class="italic text-cyan-300 block pl-6 my-2 border-l-2 border-cyan-500">
                            "Không tươi, tôi không bán."
                        </span>
                    </p>
                    
                    <p class="text-lg leading-relaxed mb-4">
                        Từ một sạp nhỏ ở chợ Cần Thơ, ông miệt mài từng sáng sớm ra bến chọn mối hàng, từng chiều đứng bán dưới mưa, giữ đúng một điều: bán bằng chữ tín, sống bằng tình người.
                    </p>
                    
                    <p class="text-lg leading-relaxed mb-4">
                        Khách thương vì sự thật thà, bạn chài quý vì lòng tử tế. Bão đến, kho ngập, cá chết – ông vẫn không bỏ. "Biển có lấy đi, mình gầy dựng lại", ông nói, rồi dựng nên Hòa Tuộc, không chỉ là quầy cá, mà là chốn người ta mua niềm tin.
                    </p>
                    
                    <p class="text-lg leading-relaxed mb-4">
                        Giờ đây, hai cơ sở tại Cần Thơ và TP.HCM là minh chứng cho hành trình không bỏ cuộc. Hòa Tuộc không chỉ bán hải sản – mà gửi theo đó là câu chuyện về một người đàn ông nghèo, đã sống trọn vẹn bằng cả cái tâm.
                    </p>
                </div>
                
                <!-- Read More Button -->
                <div class="text-center pt-4">
                    <button @click="showFullStory = !showFullStory" 
                            class="px-6 py-3 border-2 border-cyan-400 text-cyan-400 hover:bg-cyan-400/20 transition-all duration-300 rounded-md flex items-center mx-auto cyber-btn relative overflow-hidden group">
                        <span class="relative z-10" x-text="showFullStory ? 'Thu gọn' : 'Đọc tiếp'"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transition-transform duration-300 relative z-10" 
                             :class="{'rotate-180': showFullStory}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 via-cyan-400/30 to-cyan-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
