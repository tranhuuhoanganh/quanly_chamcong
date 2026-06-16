<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đơn nghỉ phép đã được duyệt</title>
  <style>
    body { margin: 0; background: #f4f5f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrapper { padding: 40px 16px; }
    .card { background: #ffffff; border-radius: 12px; overflow: hidden; max-width: 540px; margin: 0 auto; border: 1px solid #e8e8e8; }
    .header { background: #27ae60; padding: 32px 40px 24px; text-align: center; }
    .header svg { display: block; margin: 0 auto 16px; }
    .header h1 { margin: 0; color: #ffffff; font-size: 20px; font-weight: 500; }
    .body { padding: 32px 40px; }
    .body p { margin: 0 0 14px; font-size: 15px; color: #555; line-height: 1.7; }
    .body p.lead { color: #111; }
    .badge { display: inline-block; background: #eafaf1; color: #27ae60; font-size: 13px;
             font-weight: 500; padding: 4px 12px; border-radius: 6px; margin-bottom: 20px; }
    .divider { border: none; border-top: 1px solid #eee; margin: 24px 0; }
    .footer { padding: 16px 40px 24px; text-align: center; }
    .footer p { margin: 0; font-size: 12px; color: #aaa; line-height: 1.6; }
    .ii a[href] { color: #ffffff !important; }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="card">
      <div class="header">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
          <circle cx="20" cy="20" r="20" fill="rgba(255,255,255,0.15)"/>
          <path d="M16.5 21.5l3 3 7-7" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h1>Đơn nghỉ phép đã được duyệt</h1>
      </div>

      <div class="body">
        <p class="lead">Xin chào,</p>
        <p>Chúc mừng! Đơn xin nghỉ phép của bạn đã <strong>được phê duyệt</strong>.</p>
        <p>Bạn có thể sắp xếp công việc và nghỉ theo đúng thời gian đã đăng ký.</p>

        <hr class="divider">

        <p style="font-size: 13px; color: #888;">
          Nếu bạn cần hỗ trợ thêm, vui lòng liên hệ phòng nhân sự.
        </p>
      </div>

      <div class="footer">
        <p>Email này được gửi tự động. Vui lòng không trả lời.<br>
           © {{ date('Y') }} Ứng dụng của bạn. Bảo lưu mọi quyền.</p>
      </div>
    </div>
  </div>
</body>
</html>