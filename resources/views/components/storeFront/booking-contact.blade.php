<section class="booking-contact-section relative bg-black py-16 px-4 overflow-hidden cyberpunk-container">
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
                <span class="animate-text-gradient bg-gradient-to-r from-cyan-300 via-white to-cyan-400 bg-clip-text text-transparent">
                    Đặt bàn & Liên hệ
                </span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-500 mx-auto mt-4"></div>
            <p class="text-gray-300 mt-4 max-w-xl mx-auto">Hãy đặt bàn trước để được phục vụ tốt nhất hoặc liên hệ trực tiếp với chúng tôi nếu bạn cần hỗ trợ</p>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Booking Form -->
            <div class="booking-form-container relative border border-cyan-800/30 bg-gradient-to-br from-black to-cyan-900/20 rounded-lg overflow-hidden group hover:border-cyan-400/50 transition-all duration-500">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-purple-500"></div>
                <div class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-cyan-400 opacity-70"></div>
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-cyan-300 mb-6">Đặt bàn</h3>
                    
                    <form action="#" method="POST" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="block text-cyan-300 mb-1">Họ và tên</label>
                                <input type="text" id="name" name="name" class="w-full bg-black/50 border border-cyan-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300" placeholder="Nhập họ tên của bạn">
                            </div>
                            
                            <!-- Phone -->
                            <div class="form-group">
                                <label for="phone" class="block text-cyan-300 mb-1">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" class="w-full bg-black/50 border border-cyan-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300" placeholder="0912 345 678">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Date -->
                            <div class="form-group">
                                <label for="date" class="block text-cyan-300 mb-1">Ngày</label>
                                <input type="date" id="date" name="date" class="w-full bg-black/50 border border-cyan-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <!-- Time -->
                            <div class="form-group">
                                <label for="time" class="block text-cyan-300 mb-1">Giờ</label>
                                <input type="time" id="time" name="time" class="w-full bg-black/50 border border-cyan-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                            </div>
                        </div>
                        
                        <!-- Number of people -->
                        <div class="form-group">
                            <label for="guests" class="block text-cyan-300 mb-1">Số người</label>
                            <select id="guests" name="guests" class="w-full bg-black/50 border border-cyan-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                                <option value="1">1 người</option>
                                <option value="2">2 người</option>
                                <option value="3">3 người</option>
                                <option value="4">4 người</option>
                                <option value="5">5 người</option>
                                <option value="6">6 người</option>
                                <option value="more">Trên 6 người</option>
                            </select>
                        </div>
                        
                        <!-- Message -->
                        <div class="form-group">
                            <label for="message" class="block text-cyan-300 mb-1">Ghi chú</label>
                            <textarea id="message" name="message" rows="3" class="w-full bg-black/50 border border-cyan-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300" placeholder="Yêu cầu đặc biệt hoặc ghi chú thêm"></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="w-full cyber-btn px-6 py-3 border-2 border-cyan-400 text-cyan-400 hover:bg-cyan-400/20 transition-all duration-300 rounded-md relative overflow-hidden group font-medium text-lg">
                                <span class="relative z-10">Đặt bàn ngay</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 via-cyan-400/30 to-cyan-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Glitch Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-cyan-400"></div>
            </div>
            
            <!-- Contact & Map -->
            <div class="contact-info-container">
                <!-- Contact Info -->
                <div class="contact-card relative border border-cyan-800/30 bg-gradient-to-br from-black to-cyan-900/20 rounded-lg overflow-hidden group hover:border-cyan-400/50 transition-all duration-500 mb-8">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-purple-500"></div>
                    <div class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-cyan-400 opacity-70"></div>
                    <div class="p-6 md:p-8">
                        <h3 class="text-2xl font-bold text-cyan-300 mb-6">Thông tin liên hệ</h3>
                        
                        <div class="space-y-4">
                            <!-- Phone -->
                            <div class="flex items-start">
                                <div class="p-3 bg-cyan-400/20 rounded-md mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-cyan-300 text-lg font-medium">Điện thoại</h4>
                                    <p class="text-white">0912 345 678</p>
                                    <p class="text-white">0987 654 321</p>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="flex items-start">
                                <div class="p-3 bg-cyan-400/20 rounded-md mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-cyan-300 text-lg font-medium">Địa chỉ</h4>
                                    <p class="text-white">123 Đường Nguyễn Văn Linh,</p>
                                    <p class="text-white">Phường An Khánh, Quận 2, TP. Hồ Chí Minh</p>
                                </div>
                            </div>
                            
                            <!-- Hours -->
                            <div class="flex items-start">
                                <div class="p-3 bg-cyan-400/20 rounded-md mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-cyan-300 text-lg font-medium">Giờ mở cửa</h4>
                                    <p class="text-white">Thứ 2 - Chủ nhật: 10:00 - 22:00</p>
                                    <p class="text-white">Phục vụ cả ngày lễ và cuối tuần</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Glitch Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-cyan-400"></div>
                </div>
                
                <!-- Map -->
                <div class="map-container relative border border-cyan-800/30 bg-gradient-to-br from-black to-cyan-900/20 rounded-lg overflow-hidden group hover:border-cyan-400/50 transition-all duration-500">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-purple-500"></div>
                    <div class="p-2">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5177580567147!2d106.7040374!3d10.7733648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4b3330bcc7%3A0x4db964d76bf6e18e!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2s!4v1707068745231!5m2!1svi!2s"
                                class="w-full h-full rounded-md border-0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <!-- Glitch Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-cyan-400"></div>
                </div>
            </div>
        </div>
        
        <!-- Additional Flourish -->
        <div class="flex justify-center mt-12">
            <div class="cyber-btn-container">
                <a href="#" class="cyber-btn px-8 py-3 border-2 border-cyan-400 text-cyan-400 hover:bg-cyan-400/20 transition-all duration-300 rounded-md relative overflow-hidden group">
                    <span class="relative z-10">Xem thực đơn</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 via-cyan-400/30 to-cyan-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                </a>
            </div>
        </div>
    </div>
</section>