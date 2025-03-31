<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main Menu Items (Level 1)
        $home = MenuItem::create([
            'label' => 'Trang chủ',
            'type' => MenuItem::TYPE_LINK,
            'link' => '/',
            'order' => 1
        ]);

        $about = MenuItem::create([
            'label' => 'Giới thiệu', 
            'type' => MenuItem::TYPE_PAGE,
            'link' => '/about',
            'order' => 2
        ]);

        $products = MenuItem::create([
            'label' => 'Sản phẩm',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products',
            'order' => 3
        ]);

        $news = MenuItem::create([
            'label' => 'Tin tức',
            'type' => MenuItem::TYPE_CATEGORY, 
            'link' => '/news',
            'order' => 4
        ]);

        $contact = MenuItem::create([
            'label' => 'Liên hệ',
            'type' => MenuItem::TYPE_PAGE,
            'link' => '/contact',
            'order' => 5
        ]);

        // Product Categories (Level 2)
        MenuItem::create([
            'parent_id' => $products->id,
            'label' => 'Sashimi - Sushi',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products/sashimi-sushi',
            'order' => 1
        ]);

        MenuItem::create([
            'parent_id' => $products->id,
            'label' => 'Tôm - Cua - Ghẹ - Mực',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products/tom-cua-ghe-muc', 
            'order' => 2
        ]);

        MenuItem::create([
            'parent_id' => $products->id,
            'label' => 'Cá biển tươi mỗi ngày',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products/ca-bien-tuoi',
            'order' => 3
        ]);

        MenuItem::create([
            'parent_id' => $products->id,
            'label' => 'Soup Bào ngư HÒA TUỘC',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products/soup-bao-ngu',
            'order' => 4
        ]);

        MenuItem::create([
            'parent_id' => $products->id,
            'label' => 'Món kèm',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products/mon-kem',
            'order' => 5
        ]);

        MenuItem::create([
            'parent_id' => $products->id,
            'label' => 'Bò nhập khẩu',
            'type' => MenuItem::TYPE_CATEGORY,
            'link' => '/products/bo-nhap-khau',
            'order' => 6
        ]);

        // News Sub Menu Items (Level 2)
        MenuItem::create([
            'parent_id' => $news->id,
            'label' => 'Tin mới nhất',
            'type' => MenuItem::TYPE_LINK,
            'link' => '/news/latest',
            'order' => 1
        ]);

        MenuItem::create([
            'parent_id' => $news->id,
            'label' => 'Khuyến mãi',
            'type' => MenuItem::TYPE_LINK,
            'link' => '/news/promotions',
            'order' => 2
        ]);
    }
}
