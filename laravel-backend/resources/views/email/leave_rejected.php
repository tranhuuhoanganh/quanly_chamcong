<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đơn nghỉ phép bị từ chối</title>
  <style>
    body { margin: 0; background: #f4f5f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrapper { padding: 40px 16px; }
    .card { background: #ffffff; border-radius: 12px; overflow: hidden; max-width: 540px; margin: 0 auto; border: 1px solid #e8e8e8; }
    .header { background: #c0392b; padding: 32px 40px 24px; text-align: center; }
    .header svg { display: block; margin: 0 auto 16px; }
    .header h1 { margin: 0; color: #ffffff; font-size: 20px; font-weight: 500; }
    .body { padding: 32px 40px; }
    .body p { margin: 0 0 14px; font-size: 15px; color: #555; line-height: 1.7; }
    .body p.lead { color: #111; }
    .badge { display: inline-block; background: #fdecea; color: #c0392b; font-size: 13px;
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
          <path d="M20 11a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm0 2a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm0 3a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0-1-1zm0 7.5a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" fill="white"/>
        </svg>
        <h1>Đơn nghỉ phép bị từ chối</h1>
      </div>

      <div class="body">
        <p class="lead">Xin chào,</p>
        <p>Rất tiếc, đơn xin nghỉ phép của bạn đã <strong>không được phê duyệt</strong>.</p>
        <p>Nếu bạn có thắc mắc hoặc muốn biết thêm lý do, vui lòng liên hệ trực tiếp với quản lý của bạn.</p>

        <hr class="divider">

        <p style="font-size: 13px; color: #888;">
          Nếu bạn cho rằng đây là nhầm lẫn, hãy liên hệ phòng nhân sự để được hỗ trợ.
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