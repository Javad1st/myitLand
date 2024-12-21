<?php 
include '../database/db.php';

// بررسی اینکه آیا شناسه (id) ارسال شده است یا خیر
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // بارگذاری اطلاعات نویسنده از پایگاه داده
    $select = $conn->prepare("SELECT * FROM writers WHERE id = ?");
    $select->bindValue(1, $id, PDO::PARAM_INT);
    $select->execute();
    $writer = $select->fetch(PDO::FETCH_ASSOC);

    // اگر نویسنده وجود نداشته باشد، به صفحه نویسندگان برگردید
    if (!$writer) {
        header('Location: writers.php');
        exit();
    }
}

// بررسی ارسال فرم
if (isset($_POST['sub'])) {
    $name = $_POST['username'];
    $bio = $_POST['editor1'];
    $image = $_POST['image'];

    // به‌روزرسانی اطلاعات نویسنده در پایگاه داده
    $update = $conn->prepare("UPDATE writers SET username = ?, bio = ?, image = ? WHERE id = ?");
    $update->bindValue(1, $name);
    $update->bindValue(2, $bio);
    $update->bindValue(3, $image);
    $update->bindValue(4, $id, PDO::PARAM_INT);
    $update->execute();

    // بعد از به‌روزرسانی موفق، به صفحه نویسندگان برگردید
    header('Location: writers.php');
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین-ویرایش نویسنده</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        input {
            margin: 20px 0px;
        }
    </style>
</head>
<body dir="rtl">
    <div class="container">
    <?php include 'header.php' ?>

    <h1>بخش ویرایش نویسنده</h1>
    <p>طراح سایت: امیر عزیز التجار</p> 

    <form action="" method="POST">
        <input name="username" type="text" placeholder="نام نویسنده" class="form-control" value="<?= htmlspecialchars($writer['username']) ?>">
        <br><br>
        <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
        <textarea name="editor1" id="editor1"><?= htmlspecialchars($writer['bio']) ?></textarea>
        <br><br>
        <script>
            CKEDITOR.replace('editor1');
        </script>
        <input name="image" type="text" placeholder="لینک عکس" class="form-control" value="<?= htmlspecialchars($writer['image']) ?>">
        <input name="sub" type="submit" class="btn btn-success form-control" value="به‌روزرسانی نویسنده">
    </form>
    </div>
</body>
<script src="menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
