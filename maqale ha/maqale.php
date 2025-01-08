<?php 
session_start();
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

require_once('./header-maqale.php');

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
            <div class="blog">
                <img src="../uploads/<?= ($blog['image']) ?>" alt="تصویر مقاله" class="article-image">
                <h2><?= htmlspecialchars($blog['title']) ?></h2>
                <div class="discreption">
                    <?php
                     

                     
                     
                     
                     $content = $blog['caption'];
                     
                     
                     echo   limit_words($content,5); 
                     
                     ?>
                </div>
                <div class="writer">
                    نویسنده: <?= htmlspecialchars($blog['writer']) ?>
                </div>
                <div class="icons">
                <div class="like icon" id="like-button">
    14 
    <svg id="like-icon" fill="red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"/>
    </svg>
    <svg id="liked-icon" xmlns="http://www.w3.org/2000/svg" fill="red" width="24" height="24" viewBox="0 0 24 24" style="display: none;">
        <path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path>
    </svg>
</div>







                    <div class="comment icon">12 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 2H4c-1.103 0-2 .894-2 1.992v12.017C2 17.106 2.897 18 4 18h3v4l6.351-4H20c1.103 0 2-.894 2-1.992V3.992A1.998 1.998 0 0 0 20 2zm-9 8a2 2 0 1 1-2-2c.086 0 .167.015.25.025.082-.014.164-.025.25-.025A1.5 1.5 0 0 1 11 9.5c0 .086-.012.168-.025.25.01.083.025.165.025.25zm4 2a2 2 0 0 1-2-2c0-.086.015-.167.025-.25A1.592 1.592 0 0 1 13 9.5 1.5 1.5 0 0 1 14.5 8c.086 0 .168.011.25.025.083-.01.164-.025.25-.025a2 2 0 0 1 0 4z"/></svg></div>
                </div>
                
                <a href="blog/index.php?id=<?=$blog['id'] ?>">
                <div class="view">مشاهده</div>
                 </a>
                
            </div>
        <?php endforeach; ?>
    </div>

    
    <script src="script.js"></script>
    <script src="../darkmode.js"></script>
    <script src="../script.js"></script>

</body>
</html>
