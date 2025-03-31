<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Combo;
use App\Models\ComboItem;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Post;
use App\Models\Product;
use App\Models\Room;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Table;
use App\Models\User;
use App\Models\Version;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSeed extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        Setting::create([
            'brand_name' => 'Hòa Tuộc - Hải sản tươi sống',
            'address' => '123 Nguyễn Văn Quá, Quận 12, TP. HCM',
            'phone' => '1900.1234',
            'email' => 'contact@hoatuoc.com',
            'facebook_link' => 'https://facebook.com/hoatuoc',
            'zalo_link' => 'https://zalo.me/hoatuoc',
            'slogan' => 'Hải sản tươi sống số 1 Nam Bộ',
            'shipping_fee' => 30000,
        ]);

        // 2. Users
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@hoatuoc.com',
            'password' => bcrypt('password'),
            'role' => UserRole::ADMIN,
        ]);

        // 3. Section & Category
        $menuSectionId = DB::table('sections')->insertGetId([
            'name' => 'Thực đơn',
            'description' => 'Danh sách món ăn và đồ uống',
            'status' => 'visible',
        ]);

        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'Hải sản tươi sống',
            'slug' => 'fresh-seafood',
            'description' => 'Hải sản tươi sống từ các vùng biển',
            'section_id' => $menuSectionId,
            'status' => 'visible',
        ]);

        // 4. Products & Versions
        // Create only one product with two versions
        $productId = DB::table('products')->insertGetId([
            'name' => 'Mực một nắng đặc biệt',
            'description' => 'Hải sản tươi sống chất lượng cao',
        ]);

        DB::table('category_product')->insert([
            'category_id' => $categoryId,
            'product_id' => $productId,
        ]);

        $versionIds = [];
        foreach (['Phần nhỏ' => 180000, 'Phần vừa' => 250000] as $size => $price) {
            $versionIds[] = DB::table('versions')->insertGetId([
                'name' => $size,
                'price' => $price,
                'product_id' => $productId,
                'is_in_stock' => true,
                'status' => 'available',
            ]);
        }

        // 5. Combo
        $comboId = DB::table('combos')->insertGetId([
            'name' => 'Set Hải Sản Hoàng Gia',
            'description' => 'Combo hải sản cao cấp dành cho 2-4 người',
            'price' => 400000,
            'status' => 'available',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'apply_discount' => true,
        ]);

        // Add first version to combo
        DB::table('combo_items')->insert([
            'combo_id' => $comboId,
            'version_id' => $versionIds[0],
            'quantity' => 1,
        ]);

        // 6. Customer with Cart and Order
        $customerId = DB::table('customers')->insertGetId([
            'name' => 'Nguyễn Văn An',
            'email' => 'nguyenvanan@gmail.com',
            'phone' => '0901234567',
            'address' => '123 Nguyễn Trãi, Q.1, TP.HCM',
        ]);

        // Create cart
        $cartId = DB::table('carts')->insertGetId([
            'customer_id' => $customerId,
            'total_items' => 1,
            'total_amount' => 180000,
        ]);

        // Add item to cart
        DB::table('cart_items')->insert([
            'cart_id' => $cartId,
            'version_id' => $versionIds[0],
            'quantity' => 1,
        ]);

        // Create order
        $orderId = DB::table('orders')->insertGetId([
            'name' => '#1001',
            'customer_id' => $customerId,
            'status' => 'pending',
            'total_amount' => 180000,
            'total_items' => 1,
            'payment_method' => 'cod',
            'payment_status' => 'pending',
        ]);

        // Add item to order
        DB::table('order_items')->insert([
            'order_id' => $orderId,
            'version_id' => $versionIds[0],
            'quantity' => 1,
            'price' => 180000,
            'subtotal' => 180000,
        ]);

        // 7. Blog
        DB::table('posts')->insert([
            'title' => 'Bí quyết chế biến hải sản tươi ngon',
            'slug' => 'bi-quyet-che-bien-hai-san-tuoi-ngon',
            'description' => 'Hải sản là món ăn đặc trưng của vùng biển Việt Nam...',
            'status' => 'visible',
            'user_id' => $adminId,
        ]);
    }
}