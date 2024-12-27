<?php include '../jdf.php';


include '../database/db.php';

$number=1;


$date=jdate('Y/m/d');


$coment=$conn->prepare("SELECT * FROM coment");

$coment->execute();

$coments=$coment->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین-مشاهده نظرات </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
     
       body{
        text-align: center;
       }
    </style>
</head>
<body dir="rtl" >
    <div class="container">
   
    <?php  include 'header.php' ?>

    <h1>بخش مشاهده نظرات   </h1>
    <p>طراح سایت :امیر عزیز التجار</p> 
    <?php  echo $date ?>
    <table class="table">
  <thead>
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">موضوع مقاله</th>
      <th class="text-center" scope="col">عکس مقاله</th>
      <th class="text-center" scope="col">ایمیل کاربر </th>
      <th class="text-center" scope="col">اسم </th>
      <th class="text-center" scope="col">نظرها </th>
      <th class="text-center" scope="col">عملیات </th>
    </tr>
  </thead>
  <?php foreach ($coments as $co):
    $select=$conn->prepare("SELECT * FROM blogs WHERE id=?");
    $select->bindValue(1,$co['post']);
    $select->execute();
    $posts=$select->fetchAll(PDO::FETCH_ASSOC);
    foreach($posts as $post);
    
    
    ?>
  <tbody>
    <tr>
      <th scope="row"> <?= $number ++; ?> </th>
      <td><?= $post['title'] ?> </td>
      <td> <img src="../uploads/<?= $post['image'] ?>" alt="" height="100px" > </td>
      <td><?= $co['user_email'] ?></td>
      <td><?= $co['userid'] ?></td>
      <td><?= $co['text'] ?></td>
      <td><a href="delcomment.php?id=<?= $co['id']; ?>"  class="btn btn-danger" >حذف</a></td>

    </tr>
   
  </tbody>
  <?php endforeach;?>
</table>
       
     
         
    </div>
</body>
<script src="menu.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>