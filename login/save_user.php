<?php
include 'database/db.php'; // اتصال به پایگاه داده

// دریافت اطلاعات از درخواست POST
if (isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['userPass']) && isset($_POST['generatedCode'])) {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $userPass = $_POST['userPass'];
    $generatedCode = $_POST['generatedCode'];

    // بررسی زمان انقضا (5 دقیقه)
    if (time() - $_SESSION['start_time'] > 300) { // 300 ثانیه = 5 دقیقه
        echo "زمان کد تمام شده است.";
        exit;
    }

    // بررسی کد تایید
    if ($userInput == $generatedCode) {
        // هش کردن پسورد
        $hashedPass = password_hash($userPass, PASSWORD_DEFAULT);

        // ذخیره اطلاعات در دیتابیس
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $userName, PDO::PARAM_STR);
        $stmt->bindValue(2, $email, PDO::PARAM_STR);
        $stmt->bindValue(3, $hashedPass, PDO::PARAM_STR);
        $stmt->execute();

        echo "ثبت نام شما با موفقیت انجام شد!";
    } else {
        echo "کد تایید اشتباه است.";
    }
} else {
    echo "اطلاعات ناقص است.";
}
?>
