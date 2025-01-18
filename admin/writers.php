<?php 
include '../jdf.php';
include '../database/db.php';
$number = 1;

// دریافت تاریخ امروز به‌صورت شمسی
$date = jdate('Y/m/d');

// دریافت اطلاعات نویسندگان از دیتابیس
$select = $conn->prepare("SELECT * FROM writers");
$select->execute();
$blog = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین - مشاهده نویسندگان</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
       h1 {
           color: red;
       }
    </style>
</head>
<body dir="rtl">
    <div class="container">
        <?php include 'header.php'; ?>

        <h1>بخش مشاهده نویسندگان</h1>
        <?php echo $date; ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام نویسنده</th>
                    <th scope="col">عکس نویسنده</th>
                    <th scope="col">عملیات</th>
                </tr>
            </thead>
            <?php foreach ($blog as $bloginfo): ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $number++; ?></th>
                    <td><?= htmlspecialchars($bloginfo['username']); ?></td>
                    <td>
                        <?php if (!empty($bloginfo['image']) && file_exists('../writersimg/' . $bloginfo['image'])): ?>
                            <img src="../writersimg/<?= $bloginfo['image']; ?>" alt="عکس نویسنده" height="100px">
                        <?php else: ?>
                            <span>بدون تصویر</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="deletewriters.php?id=<?= $bloginfo['id']; ?>" class="btn btn-danger">حذف</a>
                        <a href="editwriters.php?id=<?= $bloginfo['id']; ?>" class="btn btn-warning">ویرایش</a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
