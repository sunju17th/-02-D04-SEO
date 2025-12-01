# DrinkStore Demo - Hệ Thống Website Tối Ưu Hóa SEO On-page

> **Đồ án môn học:** Công nghệ phần mềm
> **Sinh viên thực hiện:** Lê Vũ Quang Huy
> **Công nghệ:** Laravel Framework (Server-Side Rendering)

---

## 📑 Mục lục
1. [Giới thiệu dự án](#1-giới-thiệu-dự-án)
2. [Tính năng SEO nổi bật](#2-tính-năng-seo-nổi-bật)
3. [Yêu cầu hệ thống](#3-yêu-cầu-hệ-thống)
4. [Hướng dẫn cài đặt (Localhost)](#4-hướng-dẫn-cài-đặt-localhost)
5. [Hướng dẫn kiểm thử & Demo](#5-hướng-dẫn-kiểm-thử--demo)
6. [Cấu trúc thư mục](#6-cấu-trúc-thư-mục)
7. [Unit Testing](#7-unit-testing)

---

## 1. Giới thiệu dự án
Dự án là một website giới thiệu sản phẩm đồ uống được xây dựng với mục tiêu tối thượng là **Tối ưu hóa công cụ tìm kiếm (SEO)**. 

Khác với các Single Page Application (SPA) thường gặp khó khăn trong việc Index nội dung, dự án này sử dụng cơ chế **Server-Side Rendering (SSR)** của Laravel để đảm bảo Google Bot và các Crawler có thể đọc hiểu dữ liệu ngay lập tức. Hệ thống tập trung vào việc xử lý các thẻ Meta, cấu trúc dữ liệu Schema.org và tối ưu hóa đường dẫn (URL).

---

## 2. Tính năng SEO nổi bật

### 🚀 Kỹ thuật SEO On-page
* **Pretty URLs (Đường dẫn thân thiện):**
    * Sử dụng `Slug` thay vì ID.
    * Ví dụ: `domain.com/menu/tra-sua-tran-chau` (Thay vì `/product/1`).
* **Dynamic Meta Tags:**
    * Thẻ `Title`, `Meta Description`, `Open Graph` tự động thay đổi theo từng sản phẩm.
    * **Auto-generate:** Nếu Admin quên nhập Meta Description, hệ thống tự động trích xuất 150 ký tự từ mô tả chính.
* **Structured Data (JSON-LD):**
    * Tích hợp Schema `Product` và `Offer`.
    * Giúp hiển thị **Rich Snippets** (Giá tiền, Ảnh thumbnail, Tình trạng kho) trên kết quả tìm kiếm Google.
* **Image Optimization:**
    * Tự động đổi tên file ảnh theo tên sản phẩm khi upload (VD: `tra-sua-ngon.jpg`) để tối ưu cho Google Image Search.
    * Sử dụng thuộc tính `loading="lazy"` và thẻ `alt` tự động.

### 🛠️ Chức năng quản trị (CMS)
* Quản lý sản phẩm (Thêm/Sửa/Xóa).
* Tự động tạo Slug khi nhập tên.
* Upload ảnh và lưu trữ chuẩn quy hoạch.

---

## 3. Yêu cầu hệ thống
Để chạy dự án, máy tính cần cài đặt:
- **PHP**: >= 8.1
- **Composer**: Trình quản lý thư viện PHP.
- **XAMPP/WAMP**: Để chạy MySQL Database.
- **Node.js** (Tùy chọn): Nếu muốn dùng các tool tunnel như LocalTunnel.

---

## 4. Hướng dẫn cài đặt (Localhost)

Vui lòng thực hiện tuần tự các bước sau để tránh lỗi:

**Bước 1: Clone mã nguồn**
```bash
git clone <link-repo-cua-ban>
cd <ten-thu-muc-du-an>
Bước 2: Cài đặt thư viện

composer install

Bước 3: Cấu hình môi trường

Copy file cấu hình mẫu:

cp .env.example .env

Mở file .env và cấu hình kết nối Database (XAMPP):

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seo  <-- Hãy tạo database này trong phpMyAdmin trước
DB_USERNAME=root
DB_PASSWORD=

Bước 4: Tạo Key ứng dụng & Liên kết ảnh

php artisan key:generate
php artisan storage:link  <-- BẮT BUỘC để hiển thị ảnh

Bước 5: Khởi tạo Database & Dữ liệu mẫu

php artisan migrate:fresh --seed

(Lệnh này sẽ tạo bảng và tự động thêm các sản phẩm mẫu để test)

Bước 6: Chạy Server

php artisan serve

Truy cập: http://127.0.0.1:8000

5. Hướng dẫn kiểm thử & Demo

A. Demo quy trình quản trị (Admin)

Truy cập: http://127.0.0.1:8000/admin

Nhấn "Thêm mới".

Nhập tên sản phẩm -> Quan sát ô Slug tự động được điền.

Bỏ trống Meta Description -> Hệ thống sẽ tự động lấy từ mô tả chi tiết.

Upload ảnh -> Hệ thống sẽ tự đổi tên ảnh theo slug.

B. Demo hiệu quả SEO (Google Rich Results)
Để Google Bot truy cập được Localhost, cần sử dụng Ngrok hoặc LocalTunnel.

Mở Terminal mới, chạy Tunnel:

# Nếu dùng Ngrok
ngrok http 8000
Copy đường dẫn Public (VD: https://abcd.ngrok-free.app).

Cập nhật vào file .env (Để link ảnh hiển thị đúng):

Ini, TOML

APP_URL=[https://abcd.ngrok-free.app](https://abcd.ngrok-free.app)
Chạy lệnh xóa cache config: php artisan config:clear.

Truy cập công cụ: Google Rich Results Test.

Dán link sản phẩm (VD: /menu/tra-sua) và kiểm tra.

✅ Kết quả: Hiển thị thẻ xanh Product, xem trước có Ảnh và Giá.

6. Cấu trúc thư mục

Các file quan trọng chứa logic xử lý:

app/Models/Product.php: Cấu hình getRouteKeyName (Slug) và các fillable.

app/Http/Controllers/HomeController.php: Logic hiển thị Frontend và truyền dữ liệu Meta.

app/Http/Controllers/AdminProductController.php: Logic CRUD, xử lý upload ảnh và tự động tạo SEO data.

resources/views/layout.blade.php: Chứa thẻ <head>, Meta tags global.

resources/views/product.blade.php: Chứa mã Schema JSON-LD và hiển thị chi tiết.

routes/web.php: Định tuyến hệ thống.

7. Unit Testing
Dự án bao gồm bộ kiểm thử tự động (Unit Test) để đảm bảo các logic SEO hoạt động chính xác.

Các kịch bản test:

[x] Tự động tạo Slug từ tên.

[x] Tự động tạo Meta Description nếu bỏ trống.

[x] Upload và đổi tên ảnh chuẩn SEO.

[x] Validation dữ liệu đầu vào.

Cách chạy test:

php artisan test