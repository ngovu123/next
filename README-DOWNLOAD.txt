HỆ THỐNG ĐĂNG KÝ VỚI XÁC MINH EMAIL
===============================

Đây là hệ thống đăng ký người dùng an toàn sử dụng PHP và MySQL, với tính năng xác minh email và giao diện người dùng thân thiện.

CÁC TÍNH NĂNG
-----------

1. Biểu mẫu đăng ký với xác thực đầu vào
2. Xác minh email bằng mã xác nhận
3. Khóa tài khoản sau 5 lần thử không thành công
4. Mã xác minh hết hạn sau 30 phút
5. Bảo mật mật khẩu với bcrypt

CÀI ĐẶT
------

1. Giải nén tệp ZIP vào thư mục máy chủ web của bạn

2. Cấu hình cơ sở dữ liệu trong config/config.php:
   - DB_HOST: Máy chủ cơ sở dữ liệu (thường là "localhost")
   - DB_USER: Tên người dùng cơ sở dữ liệu (thường là "root")
   - DB_PASS: Mật khẩu cơ sở dữ liệu
   - DB_NAME: Tên cơ sở dữ liệu (mặc định là "registration_system")

3. Cấu hình email trong config/config.php (để gửi email xác minh):
   - MAIL_HOST: Máy chủ SMTP
   - MAIL_PORT: Cổng SMTP
   - MAIL_USERNAME: Tên người dùng email
   - MAIL_PASSWORD: Mật khẩu email
   - MAIL_FROM_ADDRESS: Địa chỉ email gửi
   - MAIL_FROM_NAME: Tên người gửi

4. Cài đặt các phụ thuộc bằng Composer:
   ```
   composer install
   ```

5. Chạy tệp setup.php để tạo cơ sở dữ liệu và bảng:
   - Truy cập http://your-domain.com/setup.php
   - Hoặc chạy từ dòng lệnh: php setup.php

6. Truy cập ứng dụng qua trình duyệt web:
   http://your-domain.com

CẤU TRÚC THƯ MỤC
-------------

- assets/: CSS và JavaScript
- config/: Cấu hình ứng dụng và cơ sở dữ liệu
- includes/: Các tệp được bao gồm (header, footer, mailer)
- pages/: Các trang chính (đăng ký, xác minh, thành công, khóa)

YÊU CẦU HỆ THỐNG
-------------

- PHP 7.4 trở lên
- MySQL 5.7 trở lên
- Composer
- Thư viện PHPMailer

LƯU Ý
----

- Đây là phiên bản cơ bản, bạn có thể cần điều chỉnh để phù hợp với nhu cầu cụ thể của mình
- Trong môi trường sản xuất, hãy đảm bảo bảo mật thêm (HTTPS, bảo vệ CSRF, v.v.)
- Mã xác minh được lưu trữ trong phiên cho mục đích demo, trong ứng dụng thực tế, nên sử dụng PHPMailer để gửi mã qua email
