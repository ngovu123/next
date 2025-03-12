<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải xuống mã nguồn PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 50px 0;
        }
        .download-card {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
        }
        .btn-download {
            background-color: #0d6efd;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-download:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="download-card">
            <div class="text-center mb-4">
                <h2 class="mb-3">Hệ thống đăng ký với xác minh email</h2>
                <p class="text-muted">Mã nguồn PHP & MySQL</p>
            </div>
            
            <div class="alert alert-info mb-4">
                <h5>Tệp đã sẵn sàng để tải xuống!</h5>
                <p>Bạn có thể tải xuống tệp ZIP chứa toàn bộ mã nguồn PHP của hệ thống đăng ký với xác minh email.</p>
            </div>
            
            <div class="text-center mb-4">
                <a href="email-verification-system.zip" download class="btn-download">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-2" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Tải xuống mã nguồn
                </a>
            </div>
            
            <div class="mt-4">
                <h5>Hướng dẫn cài đặt:</h5>
                <ol>
                    <li>Giải nén tệp ZIP vào thư mục máy chủ web của bạn</li>
                    <li>Cấu hình cơ sở dữ liệu trong <code>config/config.php</code></li>
                    <li>Chạy <code>setup.php</code> để tạo cơ sở dữ liệu và bảng</li>
                    <li>Cài đặt các phụ thuộc bằng Composer: <code>composer install</code></li>
                    <li>Truy cập ứng dụng qua trình duyệt web</li>
                </ol>
            </div>
            
            <div class="mt-4 pt-3 border-top">
                <p class="mb-0 text-center"><small>Nếu bạn gặp vấn đề khi tải xuống, hãy sử dụng trang <a href="create-zip.php">tạo ZIP</a> để tạo lại tệp.</small></p>
            </div>
        </div>
    </div>
</body>
</html>