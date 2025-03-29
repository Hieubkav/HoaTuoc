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
use Illuminate\Support\Str;

class FirstSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Settings
        Setting::create([
            'brand_name' => 'Hòa Tuộc - Hải sản tươi sống',
            'address' => json_encode([
                'saigon' => [
                    'name' => 'Chi nhánh Sài Gòn',
                    'address' => '123 Nguyễn Văn Quá, Quận 12, TP. HCM',
                    'phone' => '028.1234.5678', // Hoàn chỉnh số điện thoại
                    'map' => 'https://maps.google.com/...',
                ],
                'cantho' => [
                    'name' => 'Chi nhánh Cần Thơ',
                    'address' => '456 Đường 30/4, Quận Ninh Kiều, TP. Cần Thơ',
                    'phone' => '0292.1234.5678',
                    'map' => 'https://maps.google.com/...',
                ],
            ]),
            'phone' => '1900.1234',
            'email' => 'contact@hoatuoc.com',
            'facebook_link' => 'https://facebook.com/hoatuoc',
            'zalo_link' => 'https://zalo.me/hoatuoc',
            'slogan' => 'Hải sản tươi sống số 1 Nam Bộ',
            'shipping_fee' => 30000,
        ]);

        // 2. Users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hoatuoc.com',
            'password' => bcrypt('password'),
            'role' => UserRole::ADMIN,
        ]);

        User::create([
            'name' => 'Staff SG',
            'email' => 'staff.sg@hoatuoc.com',
            'password' => bcrypt('password'),
            'role' => UserRole::STAFF,
        ]);

        User::create([
            'name' => 'Staff CT',
            'email' => 'staff.ct@hoatuoc.com',
            'password' => bcrypt('password'),
            'role' => UserRole::STAFF,
        ]);

        // 3. Sections & Categories
        $menuSection = Section::create([
            'name' => 'Thực đơn',
            'description' => 'Danh sách món ăn và đồ uống',
            'status' => 'visible',
        ]);

        $categories = [
            'Hải sản tươi sống' => ['fresh-seafood', 'Hải sản tươi sống từ các vùng biển'],
            'Hải sản nướng' => ['grilled-seafood', 'Các món nướng đặc trưng'],
            'Hải sản hấp' => ['steamed-seafood', 'Món hấp giữ nguyên vị biển'],
            'Lẩu hải sản' => ['seafood-hotpot', 'Các loại lẩu đặc biệt'],
            'Món khai vị' => ['appetizers', 'Khai vị hải sản'],
            'Đồ uống' => ['beverages', 'Đồ uống các loại'],
        ];

        foreach ($categories as $name => [$slug, $desc]) {
            Category::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $desc,
                'section_id' => $menuSection->id,
                'status' => 'visible',
            ]);
        }

        // 4. Products & Versions
        $freshSeafood = [
            'Mực một nắng đặc biệt' => ['Phần nhỏ' => 180000, 'Phần vừa' => 250000, 'Phần lớn' => 320000],
            'Tôm hùm Alaska sống' => ['500g' => 850000, '1kg' => 1650000],
            'Cua Cà Mau gạch đỏ' => ['500g' => 450000, '1kg' => 850000],
            'Ghẹ xanh Phú Quốc' => ['500g' => 350000, '1kg' => 650000],
            'Ốc hương Nha Trang' => ['300g' => 180000, '500g' => 280000],
            'Bào ngư Úc sống' => ['100g' => 450000, '300g' => 1250000],
        ];

        $freshCategory = Category::where('slug', 'fresh-seafood')->first();
        foreach ($freshSeafood as $name => $versions) {
            $product = Product::create([
                'name' => $name,
                'description' => 'Hải sản tươi sống chất lượng cao',
            ]);

            $product->categories()->attach($freshCategory->id);

            foreach ($versions as $size => $price) {
                Version::create([
                    'name' => $size,
                    'price' => $price,
                    'product_id' => $product->id,
                    'is_in_stock' => true,
                    'status' => 'available',
                ]);
            }
        }

        // 5. Rooms & Tables
        $rooms = [
            'Phòng VIP Hải Âu' => ['VIP 1' => 12, 'VIP 2' => 8],
            'Phòng Đại Dương' => ['Bàn 1' => 8, 'Bàn 2' => 8, 'Bàn 3' => 6],
            'Sảnh San Hô' => ['A1' => 4, 'A2' => 4, 'A3' => 4, 'A4' => 4],
        ];

        foreach ($rooms as $roomName => $tables) {
            $roomSG = Room::create([
                'name' => "$roomName (SG)",
                'description' => "Khu vực $roomName - Chi nhánh Sài Gòn",
            ]);

            $roomCT = Room::create([
                'name' => "$roomName (CT)",
                'description' => "Khu vực $roomName - Chi nhánh Cần Thơ",
            ]);

            foreach ($tables as $tableName => $seats) {
                Table::create([
                    'name' => $tableName,
                    'room_id' => $roomSG->id,
                    'seats' => $seats,
                    'status' => 'available',
                ]);

                Table::create([
                    'name' => $tableName,
                    'room_id' => $roomCT->id,
                    'seats' => $seats,
                    'status' => 'available',
                ]);
            }
        }

        // 6. Combos
        $combo = Combo::create([
            'name' => 'Set Hải Sản Hoàng Gia',
            'description' => 'Combo hải sản cao cấp dành cho 4-6 người',
            'price' => 2500000,
            'status' => 'available',
        ]);

        $products = Product::whereHas('categories', fn($query) => $query->where('slug', 'fresh-seafood'))->get();
        foreach ($products->take(3) as $product) {
            ComboItem::create([
                'combo_id' => $combo->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        // 7. Posts
        $blogSection = Section::create([
            'name' => 'Blog',
            'description' => 'Các bài viết về ẩm thực và văn hóa hải sản',
            'status' => 'visible',
        ]);

        $posts = [
            [
                'title' => 'Bí quyết chế biến hải sản tươi ngon',
                'slug' => 'bi-quyet-che-bien-hai-san-tuoi-ngon',
                'body' => 'Hải sản là món ăn đặc trưng của vùng biển Việt Nam...',
                'status' => 'published',
            ],
            [
                'title' => 'Top 5 món hải sản được yêu thích nhất tại Hòa Tuộc',
                'slug' => 'top-5-mon-hai-san-duoc-yeu-thich-nhat',
                'body' => 'Hòa Tuộc tự hào giới thiệu top 5 món hải sản...',
                'status' => 'published',
            ],
            [
                'title' => 'Chuyến thăm vùng biển Phú Quốc',
                'slug' => 'chuyen-tham-vung-bien-phu-quoc',
                'body' => 'Phú Quốc không chỉ là thiên đường du lịch...',
                'status' => 'published',
            ],
            [
                'title' => 'Lễ hội hải sản Hòa Tuộc',
                'slug' => 'le-hoi-hai-san-hoa-tuoc',
                'body' => 'Lễ hội hải sản Hòa Tuộc được tổ chức hàng năm...',
                'status' => 'published',
            ],
            [
                'title' => 'Cách chọn hải sản tươi ngon mỗi ngày',
                'slug' => 'cach-chon-hai-san-tuoi-ngon-moi-ngay',
                'body' => 'Làm thế nào để chọn được hải sản tươi ngon?...',
                'status' => 'draft',
            ],
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'slug' => $postData['slug'],
                'description' => $postData['body'],
                'status' => $postData['status'] === 'published' ? 'visible' : 'hidden',
                'user_id' => 1, // Admin
            ]);
        }

        // 8. Customers
        $customers = [
            ['name' => 'Nguyễn Văn An', 'email' => 'nguyenvanan@gmail.com', 'phone' => '0901234567', 'address' => '123 Nguyễn Trãi, Q.1, TP.HCM'],
            ['name' => 'Trần Thị Bình', 'email' => 'tranthibinh@gmail.com', 'phone' => '0912345678', 'address' => '456 Lê Lợi, Q.1, TP.HCM'],
            ['name' => 'Lê Văn Cường', 'email' => 'levancuong@gmail.com', 'phone' => '0923456789', 'address' => '789 Điện Biên Phủ, Q.3, TP.HCM'],
            ['name' => 'Phạm Thị Dung', 'email' => 'phamthidung@gmail.com', 'phone' => '0934567890', 'address' => '101 Võ Văn Tần, Q.3, TP.HCM'],
            ['name' => 'Hoàng Văn Em', 'email' => 'hoangvanem@gmail.com', 'phone' => '0945678901', 'address' => '202 Trần Hưng Đạo, Ninh Kiều, Cần Thơ'],
            ['name' => 'Võ Thị Phương', 'email' => 'vothiphuong@gmail.com', 'phone' => '0956789012', 'address' => '303 Mậu Thân, Ninh Kiều, Cần Thơ'],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }

        // 9. Coupons
        $coupons = [
            [
                'name' => 'Mã giảm giá chào mừng',
                'code' => 'WELCOME10',
                'description' => 'Giảm 10% cho đơn hàng từ 500.000đ',
                'value' => 10,
                'is_percentage' => true,
                'valid_until' => now()->addMonth(),
                'status' => 'active',
            ],
            [
                'name' => 'Miễn phí vận chuyển',
                'code' => 'FREESHIP',
                'description' => 'Miễn phí vận chuyển cho đơn hàng từ 300.000đ',
                'value' => 30000,
                'is_percentage' => false,
                'valid_until' => now()->addMonths(2),
                'status' => 'active',
            ],
            [
                'name' => 'Khuyến mãi mùa hè',
                'code' => 'SUMMER2025',
                'description' => 'Giảm 15% cho đơn hàng từ 1.000.000đ',
                'value' => 15,
                'is_percentage' => true,
                'valid_until' => now()->addDays(45),
                'status' => 'active',
            ],
            [
                'name' => 'Giảm giá cuối tuần',
                'code' => 'WEEKEND50',
                'description' => 'Giảm 50.000đ cho đơn hàng từ 500.000đ vào cuối tuần',
                'value' => 50000,
                'is_percentage' => false,
                'valid_until' => now()->addWeeks(3),
                'status' => 'active',
            ],
            [
                'name' => 'Ưu đãi sinh nhật',
                'code' => 'BIRTHDAY',
                'description' => 'Giảm 20% cho sinh nhật khách hàng',
                'value' => 20,
                'is_percentage' => true,
                'valid_until' => now()->addMonths(6),
                'status' => 'active',
            ],
        ];

        foreach ($coupons as $couponData) {
            Coupon::create($couponData);
        }

        // 10. Carts & CartItems
        $customers = Customer::all();
        $products = Product::with('versions')->get();

        foreach ($customers->take(5) as $customer) {
            $cart = Cart::create([
                'customer_id' => $customer->id,
                'total_items' => 0,
                'total_amount' => 0,
            ]);

            $cartTotal = 0;
            $randomProducts = $products->random(rand(2, 3));

            foreach ($randomProducts as $product) {
                $version = $product->versions->random();
                $quantity = rand(1, 3);

                CartItem::create([
                    'cart_id' => $cart->id,
                    'version_id' => $version->id,
                    'quantity' => $quantity,
                ]);

                $cartTotal += $version->price * $quantity;
            }

            $cart->update([
                'total_items' => $randomProducts->sum(fn($p) => $quantity),
                'total_amount' => $cartTotal
            ]);
        }

        // 11. Orders & OrderItems
        $statuses = ['pending', 'confirmed', 'delivered', 'cancelled'];

        foreach ($customers as $customer) {
            for ($i = 0; $i < rand(1, 2); $i++) {
                $orderDate = now()->subDays(rand(1, 30));
                
                $order = Order::create([
                    'name' => '#' . rand(1000, 9999),
                    'customer_id' => $customer->id,
                    'status' => ['pending', 'processing', 'completed', 'cancelled'][array_rand([0,1,2,3])],
                    'total_amount' => 0,
                    'total_items' => 0,
                    'payment_method' => rand(0, 1) ? 'cod' : 'bank_transfer',
                    'payment_status' => rand(0, 1) ? 'paid' : 'pending',
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

                $orderTotal = 0;
                $randomProducts = $products->random(rand(2, 4));

                foreach ($randomProducts as $product) {
                    $version = $product->versions->random();
                    $quantity = rand(1, 2);
                    $price = $version->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'version_id' => $version->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $price * $quantity,
                    ]);

                    $orderTotal += $price * $quantity;
                }

                $order->update([
                    'total_amount' => $orderTotal,
                    'total_items' => $randomProducts->sum(fn($p) => $quantity)
                ]);
            }
        }
    }
}