@extends('layouts.shop')

@section('content')
    {{-- Banner Carousel với 2 ảnh --}}
    <x-storeFront.carousel-banner-image />

    {{-- Phân mục nổi bật --}}
    <x-storeFront.featured-category />

    {{-- Flash Sale Carousel --}}
    <x-storeFront.flash-sale-carousel />

    {{-- Video và 2 ảnh --}}
    <x-storeFront.carousel-video-image />

    {{-- Danh mục sản phẩm dạng tab --}}
    <x-storeFront.product-category-tabs />

    {{-- Câu chuyện Hòa Tước --}}
    <x-storeFront.story-section />

    {{-- Đánh giá từ khách hàng --}}
    <x-storeFront.testimonials-section />

    {{-- Đặt bàn & Liên hệ --}}
    <x-storeFront.booking-contact />

    {{-- Blog --}}
    <x-storeFront.blog-section />
@endsection