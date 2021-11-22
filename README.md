# Đồ Án Nhóm Môn Lập Trình WEB

## Tên đồ án: Website bán rau, củ quả ,trái cây
## [Demo trang web ](https://nhatan.ga)
## [Link github của nhóm ](https://github.com/nhatan1404/app-laravel-ltw)
### Danh sách thành viên
-   Tống Khánh Nhật An - DH51804249
-   Võ Ngọc Bội - DH51804310
-   Đặng Phước Lộc - DH51804942

### Giới thiệu
 - Nhóm sử dụng framework laravel cùng với hệ quản trị cơ sở dữ liệu mysql để làm đồ án giữa kỳ.
 - Yêu cầu bài tập
    - Nhóm dùng blade template kết hợp với component của laravel để phân chia layout MasterPage
    - Nhóm dùng hệ quản trị cơ sở dữ liệu mysql truy vấn dữ liệu để trả về dữ liệu theo dạng mảng để hiển thị dữ liệu.

### Thư viện sử dụng
- [vanthao03596/laravel-hanhchinhvn](https://github.com/vanthao03596/laravel-hanhchinhvn) - Laravel đơn vị hành chính việt nam
- [unisharp/laravel-filemanager](https://unisharp.github.io/laravel-filemanager/) - Laravel file manager
## Cài đặt
Trang web yêu cầu [php ^7.4](https://www.php.net/) và [mysql 5.^](https://www.mysql.com/) để chạy
### Config database:
- Import file database app.sql (mysql) trong source code  
- Vô file **.env** thiêt lập lại config database 
 - Mặc định khi chạy xampp trong source sẽ như sau với tên  databse là  **app**
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= app
DB_USERNAME=root
DB_PASSWORD=
```
- Vô cmd hoặc terminal gõ lần lượt các lệnh sau để chạy
```sh
php artisan key:generate 
php artisan storage:link
php artisan serve
```
### Thông tin đăng nhập hệ thống
-   Trang quản trị: **domain/dashboard**
-   email: admin@gmail.com
-   password: 12345678

## Tính năng yêu cầu
### 1. Trang Người dùng:
  - :heavy_check_mark: Trang chủ
  - :heavy_check_mark: Sản phẩm
  - :heavy_check_mark: Chi Tiết Sản Phẩm 
  - :heavy_check_mark: Danh mục sản phẩm
  - :heavy_check_mark: Danh mục bài viết
  - :heavy_check_mark: Bài viết
  - :heavy_check_mark: Chi tiết tin tức
  - :heavy_check_mark: Đăng nhập 
  - :heavy_check_mark: Đăng ký 
  - :heavy_check_mark: Trang thông tin cá nhân
  - :heavy_check_mark: Trang Liên Hệ
  - :heavy_check_mark: Trang giỏ hàng
  - :heavy_check_mark: Trang thanh toán
## 2. Trang Admin:
  - :heavy_check_mark: Đăng nhập
  - :heavy_check_mark: Quản lý gười dùng (Hiển thị - Thêm - Xóa - Sửa - Xem chi tiết)
  - :heavy_check_mark: Quản lý  danh mục  (Hiển thị - Thêm - Xóa - Sửa - Xem chi tiết)
  - :heavy_check_mark: Quản lý  sản phẩm (Hiển thị - Thêm - Xóa - Sửa - Xem chi tiết)
  - :heavy_check_mark: Quản lý  đơn hàng  (Hiển thị - Thêm - Xóa - Sửa - Xem chi tiết)
  - :heavy_check_mark:Quản lý  bài viết (Hiển thị - Thêm - Xóa - Sửa - Xem chi tiết)
  - :heavy_check_mark:Quản lý danh mục bài viết (Hiển thị - Thêm - Xóa - Sửa - Xem chi tiết)
