<?php 
include '../database/db.php';
if(isset($_POST['sub']))
{
   $name = $_POST['username'];
   $bio = $_POST['editor1'];

   // بررسی و آپلود فایل تصویر
   if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
       $uploadDir = '../writersimg/'; // مسیر پوشه ذخیره عکس
       $fileName = basename($_FILES['image']['name']);
       $targetFilePath = $uploadDir . $fileName;

       // انتقال فایل به پوشه مقصد
       if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
           $imagePath = $targetFilePath; // مسیر نهایی ذخیره عکس
       } else {
           echo "خطا در آپلود تصویر.";
           $imagePath = null;
       }
   } else {
       echo "لطفاً یک تصویر معتبر انتخاب کنید.";
       $imagePath = null;
   }

   // ذخیره اطلاعات در دیتابیس
   if ($imagePath !== null) {
       $insert = $conn->prepare("INSERT INTO writers SET username = ?, bio = ?, image = ?");
       $insert->bindValue(1, $name);
       $insert->bindValue(2, $bio);
       $insert->bindValue(3, $imagePath);
       $insert->execute();
       echo "نویسنده با موفقیت افزوده شد.";
   }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین-افزودن نویسنده</title>
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
        <?php include 'header.php'; ?>

        <h1>بخش افزودن نویسنده</h1>
        <p>طراح سایت: امیر عزیز التجار</p> 
  
        <form action="" method="POST" enctype="multipart/form-data">
            <input name="username" type="text" placeholder="نام نویسنده" class="form-control">
            <br><br><br><br>
            <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
            <textarea name="editor1" id="editor1"></textarea>
            <br><br>
            <script>
                CKEDITOR.replace('editor1');
            </script>
            <input name="image" type="file" class="form-control mb-5">
            <input name="sub" type="submit" class="btn btn-success form-control" value="ثبت نویسنده">
        </form>
    </div>
</body>
<script src="menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
