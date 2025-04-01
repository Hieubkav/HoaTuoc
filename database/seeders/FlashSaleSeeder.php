<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;

class FlashSaleSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo section nếu chưa có
        $section = Section::firstOrCreate(
            ['name' => 'Flash Sale Section'],
            [
                'description' => 'Khu vực chứa các sản phẩm Flash Sale',
                'status' => 'visible'
            ]
        );

        // Tạo category Flash Sale
        $flashSaleCategory = Category::firstOrCreate(
            ['name' => 'Flash Sale'],
            [
                'slug' => 'flash-sale',
                'description' => 'Danh mục sản phẩm Flash Sale',
                'status' => 'visible',
                'section_id' => $section->id
            ]
        );

        // Tạo các sản phẩm mẫu cho Flash Sale
        $products = [
            [
                'name' => 'Bó Hoa Hồng Ngọc Valentine',
                'description' => 'Bó hoa hồng đẹp dành cho Valentine',
                'thumbnail' => 'https://hoatuoc.com/wp-content/uploads/2025/03/472785676_1045396797626650_6973978503830019096_n.jpg',
                'price' => 899000,
                'sale_price' => 629000
            ],
            [
                'name' => 'Bó Hoa Hồng Đỏ Rực Rỡ',
                'description' => 'Bó hoa hồng đỏ tươi thắm',
                'thumbnail' => 'https://hoatuoc.com/images/products/20230419/12/10-canh-hong-do-500.jpg',
                'price' => 799000,
                'sale_price' => 479000
            ],
            // Thêm các sản phẩm khác tương tự...
        ];

        foreach ($products as $productData) {
            $product = Product::firstOrCreate(
                ['name' => $productData['name']],
                $productData
            );
            
            // Gán sản phẩm vào category Flash Sale
            if (!$product->categories->contains($flashSaleCategory->id)) {
                $product->categories()->attach($flashSaleCategory->id);
            }
        }
    }
}