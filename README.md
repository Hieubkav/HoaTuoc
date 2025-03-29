# Hoa Tước - Restaurant Management System

## Danh sách Models

### 1. User Model
```php
// Các trường
id: bigint
name: string 
email: string
email_verified_at: timestamp
password: string
role: enum(admin, staff, customer)
remember_token: string
created_at: timestamp
updated_at: timestamp

// Relationships
- hasMany(Order::class)
```

### 2. Room Model 
```php
// Các trường
id: bigint
name: string
description: text 
status: boolean
created_at: timestamp
updated_at: timestamp

// Relationships
- hasMany(RoomImage::class)
- hasMany(Table::class)
```

### 3. Table Model
```php
// Các trường
id: bigint
room_id: bigint
name: string
capacity: integer 
status: enum(available, reserved, occupied)
created_at: timestamp
updated_at: timestamp

// Relationships
- belongsTo(Room::class)
- hasMany(Order::class)
```

### 4. Category Model
```php
// Các trường
id: bigint
name: string
description: text
coupon_id: bigint nullable
created_at: timestamp  
updated_at: timestamp

// Relationships
- belongsToMany(Product::class)
- belongsTo(Coupon::class)
```

### 5. Product Model
```php
// Các trường
id: bigint
name: string
description: text
price: decimal
status: boolean 
created_at: timestamp
updated_at: timestamp

// Relationships
- belongsToMany(Category::class)
- hasMany(ProductImage::class)
- hasMany(OrderItem::class)
- hasMany(CartItem::class)
- hasMany(ComboItem::class)
```

### 6. Order Model
```php
// Các trường  
id: bigint
user_id: bigint
table_id: bigint
total: decimal
status: enum(pending, confirmed, cooking, served, completed, cancelled)
created_at: timestamp
updated_at: timestamp

// Relationships
- belongsTo(User::class)
- belongsTo(Table::class) 
- hasMany(OrderItem::class)
```

### 7. Cart Model
```php
// Các trường
id: bigint
user_id: bigint
created_at: timestamp
updated_at: timestamp

// Relationships  
- belongsTo(User::class)
- hasMany(CartItem::class)
```

### 8. Combo Model
```php
// Các trường
id: bigint
name: string
description: text
price: decimal
status: boolean
created_at: timestamp  
updated_at: timestamp

// Relationships
- hasMany(ComboItem::class)
```

## Chức năng có thể xây dựng

### 1. Quản lý Phòng/Bàn
- Tạo sơ đồ phòng và bàn
- Quản lý trạng thái bàn (trống/đã đặt/đang sử dụng)
- Upload nhiều hình ảnh cho mỗi phòng
- Phân loại bàn theo sức chứa

### 2. Quản lý Menu
- Phân loại món ăn theo danh mục
- Quản lý hình ảnh sản phẩm
- Tạo combo món ăn với giá ưu đãi
- Áp dụng mã giảm giá theo danh mục

### 3. Quản lý Đơn hàng
- Tạo đơn hàng theo bàn
- Theo dõi trạng thái đơn hàng
- Quản lý thanh toán
- Lịch sử đơn hàng theo khách hàng

### 4. Quản lý Giỏ hàng
- Thêm/xóa món từ giỏ hàng
- Tính tổng tiền tự động
- Chuyển giỏ hàng thành đơn hàng
- Lưu giỏ hàng theo user

## Đề xuất cấu trúc Filament Admin

### Resources
1. UserResource
   - Quản lý thông tin người dùng
   - Phân quyền access
   
2. RoomResource 
   - CRUD phòng
   - Upload nhiều ảnh
   - Quản lý bàn trong phòng

3. TableResource
   - CRUD bàn
   - Cập nhật trạng thái
   - Liên kết với phòng

4. CategoryResource
   - CRUD danh mục
   - Áp dụng mã giảm giá
   - Quản lý sản phẩm trong danh mục

5. ProductResource
   - CRUD sản phẩm  
   - Upload nhiều ảnh
   - Phân loại theo danh mục

6. ComboResource
   - CRUD combo
   - Thêm/xóa sản phẩm vào combo
   - Tính giá combo

7. OrderResource
   - Xem danh sách đơn hàng
   - Cập nhật trạng thái
   - Chi tiết đơn hàng

### Pages
1. Dashboard
   - Thống kê doanh thu
   - Đơn hàng mới
   - Bàn đang sử dụng
   
2. TableManager
   - Sơ đồ bàn theo phòng
   - Cập nhật trạng thái realtime
   - Tạo đơn hàng nhanh

3. KitchenDisplay
   - Danh sách món cần chế biến
   - Cập nhật trạng thái món
   - Thông báo món hoàn thành

4. Reports  
   - Báo cáo doanh thu
   - Thống kê món ăn bán chạy
   - Báo cáo theo thời gian
