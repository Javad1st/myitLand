<?php
include '../database/db.php';

session_start();

$codeError = '';
$passwordError = '';
$successMessage = '';
$currentTimestamp = time();

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userInput = htmlspecialchars($_POST['userInput']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    
    // بررسی زمان انقضا (۳ دقیقه)
    if ($currentTimestamp - $_SESSION['timestamp'] > 180) {
        $codeError = 'کد منقضی شده است.';
    } elseif ($userInput != $_SESSION['generatedCode']) {
        $codeError = 'کد تأیید نادرست است';
    } elseif (strlen($newPassword) < 8) {
        $passwordError = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    } else {
        // تغییر رمز عبور
        $email = $_SESSION['email'];  // دریافت ایمیل از session
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $update->bindValue(1, $hashedPassword, PDO::PARAM_STR);
        $update->bindValue(2, $email, PDO::PARAM_STR);

        if ($update->execute()) {
            $successMessage = 'رمز عبور شما با موفقیت تغییر یافت!';
            // پاک کردن داده‌های جلسه پس از تغییر رمز
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit;
        } else {
            $codeError = 'خطا در تغییر رمز عبور. لطفاً دوباره تلاش کنید.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تغییر رمز عبور</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="wrapper">
        <h2>تغییر رمز عبور</h2>
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" id="userInput" name="userInput" required>
                <label for="userInput">کد تأیید</label>
            </div>
            <?php if ($codeError): ?>
                <div class="error-message"><?php echo $codeError; ?></div>
            <?php endif; ?>
            
            <div class="input-field">
                <input type="password" id="newPassword" name="newPassword" required minlength="8">
                <label for="newPassword">رمز عبور جدید</label>
            </div>
            <?php if ($passwordError): ?>
                <div class="error-message"><?php echo $passwordError; ?></div>
            <?php endif; ?>
            
            <button type="submit">تغییر رمز عبور</button>
        </form>
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
