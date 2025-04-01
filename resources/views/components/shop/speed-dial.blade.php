<div class="fixed bottom-24 right-4 flex flex-col gap-4 z-50 speed-dial-container">
    {{-- Phone Button --}}
    <a href="tel:{{ $settings->phone }}" 
       class="speed-dial-btn group bg-cyan-500 hover:bg-cyan-600 relative">
        <i class="fas fa-phone text-2xl"></i>
        <span class="speed-dial-tooltip">
            Gọi ngay: {{ $settings->phone }}
        </span>
        <div class="speed-dial-pulse"></div>
    </a>

    {{-- Zalo Button --}}
    <a href="{{ $settings->zalo_link }}" 
       target="_blank"
       class="speed-dial-btn group bg-blue-500 hover:bg-blue-600">
        <i class="fas fa-comments text-2xl"></i>
        <span class="speed-dial-tooltip">
            Chat Zalo với chúng tôi
        </span>
    </a>

    {{-- Facebook Button --}}
    <a href="{{ $settings->facebook_link }}" 
       target="_blank"
       class="speed-dial-btn group bg-blue-600 hover:bg-blue-700">
        <i class="fab fa-facebook-f text-2xl"></i>
        <span class="speed-dial-tooltip">
            Theo dõi trên Facebook
        </span>
    </a>

    <style>
        .speed-dial-container {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .speed-dial-btn {
            /* Tăng độ tròn và mềm mại */
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .speed-dial-btn:hover {
            transform: scale(1.15);
            box-shadow: 0 6px 20px rgba(0, 255, 255, 0.4);
        }

        .speed-dial-btn::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0, 242, 254, 0.8), rgba(79, 172, 254, 0.8));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .speed-dial-btn:hover::before {
            opacity: 1;
            animation: borderGlow 1.5s linear infinite;
        }

        @keyframes borderGlow {
            0%, 100% {
                filter: brightness(1);
            }
            50% {
                filter: brightness(1.3);
            }
        }

        .speed-dial-tooltip {
            position: absolute;
            right: calc(100% + 8px);
            padding: 6px 12px;
            background: rgba(17, 24, 39, 0.9); /* Màu nền tối với độ trong suốt nhẹ */
            color: #fff;
            font-size: 14px;
            border-radius: 8px;
            opacity: 0;
            visibility: hidden;
            white-space: nowrap;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 255, 255, 0.15);
            backdrop-filter: blur(6px);
        }

        .speed-dial-btn:hover .speed-dial-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(-5px); /* Hiệu ứng dịch nhẹ khi hiện */
        }

        .speed-dial-pulse {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(0, 255, 255, 0.25);
            animation: pulse 2s infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            70% {
                transform: scale(1.4);
                opacity: 0;
            }
            100% {
                transform: scale(1.4);
                opacity: 0;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .speed-dial-container {
                bottom: 16px;
                right: 8px;
            }
            
            .speed-dial-btn {
                width: 48px;
                height: 48px;
            }

            .speed-dial-tooltip {
                display: none; /* Ẩn tooltip trên mobile cho gọn */
            }
        }
    </style>
</div>