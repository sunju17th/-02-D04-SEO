# 🍹 DrinkStore Demo — Website Đồ Uống Tối Ưu SEO On‑page
**Đồ án môn học:** Công nghệ phần mềm  
**Sinh viên thực hiện:** Lê Vũ Quang Huy  
**Công nghệ:** Laravel Framework (Server‑Side Rendering — SSR)

---

## 📑 Mục lục
1. [Giới thiệu dự án](#1-giới-thiệu-dự-án)
2. [Tính năng SEO nổi bật](#2-tính-năng-seo-nổi-bật)
3. [Yêu cầu hệ thống](#3-yêu-cầu-hệ-thống)
4. [Hướng dẫn cài đặt (Localhost)](#4-hướng-dẫn-cài-đặt-localhost)
5. [Hướng dẫn kiểm thử & Demo](#5-hướng-dẫn-kiểm-thử--demo)
6. [Cấu trúc thư mục quan trọng](#6-cấu-trúc-thư-mục-quan-trọng)
7. [Unit Testing](#7-unit-testing)

---

## 1. Giới thiệu dự án
DrinkStore là website giới thiệu sản phẩm đồ uống được xây dựng với mục tiêu **tối ưu hóa SEO on‑page**. Dự án dùng mô hình **Server‑Side Rendering (SSR)** của Laravel, giúp công cụ tìm kiếm như Google dễ dàng thu thập dữ liệu, cải thiện khả năng index nội dung.

Dự án tập trung vào:
- Tối ưu URL
- Tối ưu Meta Tags
- Tự động sinh dữ liệu cấu trúc (Schema.org)
- Tự động chuẩn hóa hình ảnh

---

## 2. Tính năng SEO nổi bật
### 🚀 Kỹ thuật SEO On‑page
- **Pretty URLs**: Dùng slug thay cho ID.  
  *Ví dụ:* `/menu/tra-sua-tran-chau` thay vì `/product/1`.

- **Dynamic Meta Tags**:  
  - Tự động thay đổi Title, Description, Open Graph theo từng sản phẩm.  
  - Tính năng *Auto‑Generate*: Nếu quên nhập Meta Description → hệ thống trích 150 ký tự đầu từ mô tả sản phẩm.

- **Structured Data (JSON‑LD Schema)**:  
  - Hỗ trợ đầy đủ schema `Product` và `Offer`.  
  - Giúp hiển thị **Rich Snippets** (giá tiền, ảnh thumbnail, rating...).

- **Tối ưu hình ảnh**:
  - Tự động đổi tên file khi upload thành dạng chuẩn SEO (VD: `tra-sua-ngon.jpg`).
  - Tự động thêm ALT text, lazy‑loading.

### 🛠️ Hệ thống quản trị (CMS)
- CRUD sản phẩm đầy đủ.
- Slug tự tạo theo tên.
- Upload ảnh tối ưu chuẩn SEO.
- Giao diện trực quan, dễ dùng.

---

## 3. Yêu cầu hệ thống
- **PHP** ≥ 8.1
- **Composer**
- **MySQL** (XAMPP/WAMP)
- **Node.js** (tùy chọn – dùng tunnel)

---

## 4. Hướng dẫn cài đặt (Localhost)
### **Bước 1: Clone dự án**
```bash
git clone <link-repo>
cd <ten-thu-muc-du-an>
```

### **Bước 2: Cài đặt thư viện**
```bash
composer install
```

### **Bước 3: Cấu hình môi trường**
```bash
cp .env.example .env
```
Mở file `.env` và chỉnh thông tin database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seo
DB_USERNAME=root
DB_PASSWORD=
```
> **Lưu ý:** Hãy tạo database `seo` trong phpMyAdmin trước.

### **Bước 4: Tạo key & liên kết thư mục ảnh**
```bash
php artisan key:generate
php artisan storage:link
```

### **Bước 5: Tạo bảng + dữ liệu mẫu**
```bash
php artisan migrate:fresh --seed
```

### **Bước 6: Chạy server**
```bash
php artisan serve
```
Truy cập: **http://127.0.0.1:8000**

---

## 5. Hướng dẫn kiểm thử & Demo
### 🧪 **A. Demo trang quản trị (Admin)**
Truy cập: `http://127.0.0.1:8000/admin`

- Nhấn **Thêm mới** để tạo sản phẩm.
- Quan sát slug tự tạo từ tên.
- Nếu bỏ trống Meta Description → hệ thống tự sinh.
- Upload ảnh → ảnh được đổi tên theo slug.

### 🌐 **B. Demo hiệu quả SEO (Rich Results – Google)**
Google không thể truy cập localhost → cần mở tunnel bằng Ngrok hoặc LocalTunnel.

#### Dùng Ngrok
```bash
ngrok http 8000
```
Lấy link public, rồi cập nhật `.env`:
```
APP_URL=https://abcd.ngrok-free.app
```
Xóa cache config:
```bash
php artisan config:clear
```
Kiểm tra bằng **Google Rich Results Test**.

---

## 6. Cấu trúc thư mục quan trọng
```
app/
 ├── Models/Product.php                 # Cấu hình slug + fillable
 ├── Http/Controllers/HomeController.php # Render giao diện + meta SEO
 └── Http/Controllers/AdminProductController.php # CRUD + xử lý ảnh

resources/views/
 ├── layout.blade.php                   # Meta tags global
 ├── product.blade.php                  # JSON‑LD + chi tiết sản phẩm

routes/
 └── web.php                            # Tất cả route chính
```

---

## 7. Unit Testing
Dự án hỗ trợ kiểm thử tự động để bảo đảm hệ thống SEO hoạt động chính xác.

### 📝 Các test case đã bao gồm:
- ✔ Tự động tạo Slug
- ✔ Tự sinh Meta Description
- ✔ Đổi tên ảnh tối ưu SEO
- ✔ Validate dữ liệu đầu vào

### Cách chạy test
```bash
php artisan test
```

---

✨ *DrinkStore — tối ưu SEO một cách tự động, đơn giản và hiệu quả.*

