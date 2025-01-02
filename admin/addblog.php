<?php 

include '../jdf.php';
include '../database/db.php'; 

$date = jdate('Y/m/d'); 
session_start();

if (isset($_POST['sub'])) {

    $title = $_POST['title'];
    $caption = $_POST['editor1'];
    $writer = $_POST['writer'];
    $time = $_POST['time'];
    $tags = $_POST['tags'];

    // مدیریت آپلود تصویر
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../uploads/'; // مسیر ذخیره عکس‌ها
        $imageName = time() . '_' . basename($_FILES['image']['name']); // تغییر نام فایل برای جلوگیری از تکراری بودن
        $uploadFile = $uploadDir . $imageName;

        // بررسی و انتقال فایل
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = $imageName; // مسیر ذخیره شده در دیتابیس
        } else {
            $imagePath = ''; // در صورت خطا در آپلود، مقدار خالی ذخیره می‌شود
        }
    } else {
        $imagePath = ''; // در صورتی که عکسی انتخاب نشده باشد
    }

    $insert = $conn->prepare("INSERT INTO blogs SET title=?, caption=?, writer=?, date=?, readtime=?, image=?, tags=?");
    $insert->bindValue(1, $title);
    $insert->bindValue(2, $caption);
    $insert->bindValue(3, $writer);
    $insert->bindValue(4, $date);
    $insert->bindValue(5, $time);
    $insert->bindValue(6, $imagePath);
    $insert->bindValue(7, $tags);
    $insert->execute();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین-افزودن مقاله</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        input {
            margin: 20px 0px;
        }
        body {
            text-align: center;
        }
    </style>
</head>
<body dir="rtl" >
    <div class="container">
        <?php include 'header.php' ?>

        <h1>بخش افزودن مقاله</h1>
        <p>طراح سایت :امیر عزیز التجار</p> 
        <?php echo $date ?>

        <form action="" method="post" enctype="multipart/form-data">
            <input name="title" type="text" placeholder="موضوع مقاله" class="form-control">
            <br><br><br><br>

            <!-- CKEditor 5 -->
            <textarea name="editor1" id="editor1"></textarea>  
            <br><br>
            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor1'), {
            ckfinder: {
                uploadUrl: './upload_image.php' // مسیر آپلود تصاویر
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
            <br>
            
            <input class="form-control" type="text" name="writer" placeholder="نویسنده">
            <br>
            <input name="time" type="number" placeholder="زمان تقریبی مطالعه" class="form-control">
            <br>
            <input name="image" type="file" class="form-control"> <!-- تغییر این فیلد به file -->
            <br>
            <input name="tags" type="text" placeholder="تگ ها" class="form-control">
            <br>
            <input name="sub" type="submit" class="btn btn-success form-control" value="ثبت مقاله">
        </form>
    </div>
</body>
</html>
