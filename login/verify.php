<?php
include '../database/db.php';

session_start();

$codeError = '';
$successMessage = '';
$currentTimestamp = time();

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userInput = htmlspecialchars($_POST['userInput']);

    // بررسی زمان انقضا (۳ دقیقه)
    if (!isset($_SESSION['timestamp']) || $currentTimestamp - $_SESSION['timestamp'] > 180) {
        $codeError = 'کد منقضی شده است.';
    } elseif ($userInput != $_SESSION['generatedCode']) {
        $codeError = 'کد تأیید نادرست است';
    } else {
        // ذخیره اطلاعات در دیتابیس
        $name = $_SESSION['name'];  // دریافت نام از session
        $email = $_SESSION['email'];  // دریافت ایمیل از session
        $password = $_SESSION['password'];  // دریافت رمز عبور از session
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insert->bindValue(1, $name, PDO::PARAM_STR);
        $insert->bindValue(2, $email, PDO::PARAM_STR);
        $insert->bindValue(3, $hashedPassword, PDO::PARAM_STR);

        if ($insert->execute()) {
            $successMessage = 'ثبت‌نام با موفقیت انجام شد!';
            // پاک کردن داده‌های جلسه پس از ثبت‌نام
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit;
        } else {
            $codeError = 'خطا در ثبت‌نام. لطفاً دوباره تلاش کنید.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تایید کد</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="wrapper">
        <h2>تایید کد</h2>
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" id="userInput" name="userInput" required>
                <label for="userInput">کد تأیید</label>
            </div>
            <?php if ($codeError): ?>
                <div class="error-message"><?php echo $codeError; ?></div>
            <?php endif; ?>
            <button type="submit">تأیید کد و ثبت‌نام</button>
        </form>
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
