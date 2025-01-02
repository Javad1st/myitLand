<?php 
include '../jdf.php';
include '../database/db.php'; 
$id = $_GET['id'];

$select = $conn->prepare('SELECT * FROM blogs WHERE id=?');
$select->bindValue(1, $id);
$select->execute();
$blogs = $select->fetchAll(PDO::FETCH_ASSOC);

$date = jdate('Y/m/d'); 
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $caption = $_POST['editor1'];
    $writer = $_POST['writer'];
    $time = $_POST['time'];
    $tags = $_POST['tags'];

    // بررسی آپلود فایل جدید
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
        // حفظ تصویر فعلی در صورت انتخاب نشدن تصویر جدید
        $imagePath = $_POST['current_image'];
    }

    $insert = $conn->prepare("UPDATE blogs SET title=?, caption=?, writer=?, date=?, readtime=?, image=?, tags=? WHERE id=?");
    $insert->bindValue(1, $title);
    $insert->bindValue(2, $caption);
    $insert->bindValue(3, $writer);
    $insert->bindValue(4, $date);
    $insert->bindValue(5, $time);
    $insert->bindValue(6, $imagePath);
    $insert->bindValue(7, $tags);
    $insert->bindValue(8, $id);
    $insert->execute();

    header('location:blogs.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین-ویرایش مقاله</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./bootstrap.css">
    <style>
        input{
            margin: 20px 0px;
        }
        textarea {
            width: 100%;
            height: 400px;
            font-size: 16px;
        }
        img{
            text-align: center;
        }
        img{
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body dir="rtl" >
    <div class="container">
    <?php  include 'header.php' ?>

    <h1>بخش افزودن مقاله</h1>
    <p>طراح سایت :امیر عزیز التجار</p> 
  
    <?php  echo $date ?>
       <form action="" method="POST" enctype="multipart/form-data">
        <?php  foreach($blogs as $blog):  ?>
        <input name="title" type="text"  placeholder="موضوع مقاله" class="form-control"   value="<?= $blog['title'];  ?>" >
        <br><br><br><br>
        <textarea name="editor1" id="editor1"><?= $blog['caption']?></textarea>  
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
     

        <input class="form-control mb-5" type="text" name="writer" value="<?= $blog['writer'];  ?>" placeholder="نویسنده">
        <input  name="time" type="number"  value="<?= $blog['readtime'];  ?>"  placeholder="زمان تقریبی مطالعه" class="form-control mb-5" >
        <img src="../uploads/<?= $blog['image'] ?>" alt="تصویر فعلی" style="width: 150px; height: auto; margin-bottom: 10px;">
        <input type="hidden" name="current_image" value="<?= $blog['image'] ?>"> <!-- ذخیره تصویر فعلی -->
        <input name="image"  type="file" placeholder="لینک عکس" class="form-control mb-5">

        <input name="tags" type="text"  placeholder="تگ ها" class="form-control mb-5" value="<?= $blog['tags'];  ?>" >
        <input  name="sub" type="submit" class="btn btn-success form-control" value="ثبت ویرایش"  >
        <?php endforeach;  ?>  
    </form>
     
    </div>
</body>
<script src="menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
