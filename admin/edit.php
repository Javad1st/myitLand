
<?php 
include '../jdf.php';
include '../database/db.php'; 
$id=$_GET['id'];

$select=$conn->prepare('SELECT * FROM blogs WHERE id=?');

$select->bindValue(1,$id);
$select->execute();
$blogs=$select->fetchAll(PDO::FETCH_ASSOC);

$date=jdate('Y/m/d'); 
if(isset($_POST ['sub'])){
$title=$_POST['title'];
$caption=$_POST['editor1'];
$writer=$_POST['writer'];
$time=$_POST['time'];
$image=$_POST['image'];
$tags=$_POST['tags'];
$insert=$conn->prepare("  UPDATE  blogs SET title=? , caption=? , writer=? , date=? , readtime=? , image=? , tags=?");
$insert->bindValue(1,$title );
$insert->bindValue(2,$caption);
$insert->bindValue(3,$writer );
$insert->bindValue(4,$date );
$insert->bindValue(5,$time );
$insert->bindValue(6,$image );
$insert->bindValue(7,$tags );
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
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        input{
            margin: 20px 0px;
        }
        
    </style>
</head>
<body dir="rtl" >
    <div class="container">
    <?php  include 'header.php' ?>


    <h1>بخش افزودن مقاله</h1>
    <p>طراح سایت :امیر عزیز التجار</p> 
  
  
    <?php  echo $date ?>
       <form action="" method="POST">
        <?php  foreach($blogs as $blog):  ?>
        <input name="title" type="text"  placeholder="موضوع مقاله" class="form-control"   value="<?= $blog['title'];  ?>" >
        <br><br><br><br>
        <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

<textarea name="editor1" id="editor1"><?= $blog['caption'];  ?></textarea>   <br><br>
    <script>
  CKEDITOR.replace('editor1');
     </script>

      <select   name="writer"  class="form-control"  >
       
       <br><br><br><br><br> <option value="<?= $blog['writer'];  ?>">امیر عزیز التجار</option>
      </select>
      <input  name="time" type="number"  value="<?= $blog['readtime'];  ?>"  placeholder="زمان تقریبی مطالعه" class="form-control" >
      <input name="image"  type="text" value="<?= $blog['image'];  ?>"  placeholder="لینک عکس"class="form-control" >
      <input name="tags" type="text"  placeholder="تگ ها"class="form-control" value="<?= $blog['tags'];  ?>" >
      <input  name="sub" type="submit" class="btn btn-success form-control" value="ثبت ویرایش"  >
    <?php endforeach;  ?>  
    </form>
     
    </div>
</body>
<script src="menu.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>