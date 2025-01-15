<?php
session_start();

// بررسی اینکه آیا کاربر وارد شده است یا نه
if (!isset($_SESSION['logged_in']) && !isset($_COOKIE['logged_in'])) {
    // اگر سشن یا کوکی 'logged_in' وجود نداشته باشد، هدایت به صفحه ورود
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل ادمین</title>
</head>
<body>
<?php require_once './header.php'

?>
    <h1>پنل ادمین</h1>
    <p>خوش آمدید!</p>
</body>
</html>
