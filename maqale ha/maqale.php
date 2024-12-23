<?php 
include '../database/db.php';
$select = $conn->prepare("SELECT * FROM blogs");
$select->execute();
$blogs = $select->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../mobile.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="st.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقالات</title>
</head>
<body>

<?php

require_once('../header.php');

?>

    <div class="categories">
        <div class="cats cats1">
            <div class="cat cat1">همه مقاله ها</div>
            <div class="cat cat2">ورزشی</div>
            <div class="cat cat3">درسی</div>
            <div class="cat cat4">تفریحی</div>
            <div class="cat cat5">تفریحی</div>
            <a href="../index.php" class="cat cat6">بازگشت -- </a>
        </div>
    </div>

    <div class="blogs">
        <?php function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
} foreach ($blogs as $blog): ?>
<a  style="text-decoration: none;" href="blog/index.php?id=<?=$blog['id'] ?>">
            <div class="blog">
            <img src="../uploads/<?= ($blog['image']) ?>" alt="تصویر مقاله" class="article-image">
            <h2><?= htmlspecialchars($blog['title']) ?></h2>
                <p>
                    <?php
                     

 
 
# Example Usage
 
$content = $blog['caption'];
 
 
                echo   limit_words($content,5); 
                    
                    ?>
                </p>
                <button>مشاهده</button>
                <p class="writer">
                    نویسنده: <?= htmlspecialchars($blog['writer']) ?>
                </p>
            </div>
            </a>
        <?php endforeach; ?>
    </div>

    
    <script src="scr.js"></script>
    <script src="../darkmode.js"></script>
    <script src="../script.js"></script>

</body>
</html>
