<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت‌نام</title>
    <link rel="stylesheet" href="loginstyle.css"> <!-- ارجاع به فایل CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function(){
            emailjs.init('P8S6N0vq6E2OOtxYh'); // User ID از EmailJS
        })();
    </script>
</head>
<body>
    <div class="wrapper">
        <h2>ثبت‌نام</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sub'])) {
            include '../database/db.php';
            
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $userInput = htmlspecialchars($_POST['userInput']);
            $generatedCode = htmlspecialchars($_POST['message']);
            $timestamp = intval($_POST['timestamp']);
            $currentTimestamp = time();
        
            // بررسی ایمیل و پسورد
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('ایمیل معتبر نیست.'); window.location.reload();</script>";
                exit;
            }
        
            if (strlen($password) < 8) {
                echo "<script>alert('رمز عبور باید حداقل ۸ کاراکتر باشد.'); window.location.reload();</script>";
                exit;
            }

            // بررسی انقضای کد
            if ($currentTimestamp - $timestamp > 180) { // 180 ثانیه = 3 دقیقه
                echo "<script>alert('کد منقضی شده است.'); window.location.reload();</script>";
                exit;
            }

            // بررسی کد تأیید
            if ($generatedCode !== $userInput) {
                echo "<script>alert('کد تأیید نادرست است.'); window.location.reload();</script>";
                exit;
            }
        
            // هش کردن رمز عبور
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
            // درج اطلاعات در پایگاه داده با استفاده از bindValue
            $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insert->bindValue(1, $name, PDO::PARAM_STR);
            $insert->bindValue(2, $email, PDO::PARAM_STR);
            $insert->bindValue(3, $hashedPassword, PDO::PARAM_STR);
        
            if ($insert->execute()) {
                echo "<script>alert('ثبت‌نام با موفقیت انجام شد!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('خطا در ثبت‌نام.'); window.location.reload();</script>";
            }
        }
        ?>
        <form id="form" method="POST" action="">
            <div class="input-field">
                <input type="text" id="name" name="name" required>
                <label for="name">نام</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" required minlength="8">
                <label for="password">رمز عبور</label>
            </div>
            <input type="hidden" id="generatedCode" name="message">
            <input type="hidden" id="to_email" name="to_email">
            <input type="hidden" id="to_name" name="to_name" value="">
            <input type="hidden" id="reply_to" name="reply_to" value="noreply@example.com">
            <input type="hidden" id="timestamp" name="timestamp">
            <button id="sendEmailButton" type="button">ارسال ایمیل</button>
            <div class="input-field" id="codeInputField" style="display:none;">
                <input type="text" id="userInput" name="userInput" required>
                <label for="userInput">کد تأیید</label>
            </div>
            <button id="registerButton" type="submit" style="display:none;" name="sub">ثبت‌نام</button>
        </form>
        <div class="register">
            <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="#">ورود</a></p>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
