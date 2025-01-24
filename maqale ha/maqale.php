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
    <link rel="stylesheet" href="../mobile2.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="st.css">
    <link rel="stylesheet" href="risponse.css">
    <link rel="shortcut icon" href="../tasavir/Untitled-2.png" type="image/x-icon">
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
            <div class="cat cat1">همه</div>
            <div class="cat cat2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color);"><path d="M11.488 21.754c.294.157.663.156.957-.001 8.012-4.304 8.581-12.713 8.574-15.104a.988.988 0 0 0-.596-.903l-8.05-3.566a1.005 1.005 0 0 0-.813.001L3.566 5.747a.99.99 0 0 0-.592.892c-.034 2.379.445 10.806 8.514 15.115zM8.674 10.293l2.293 2.293 4.293-4.293 1.414 1.414-5.707 5.707-3.707-3.707 1.414-1.414z"></path></svg><p>هک و امنیت</p></div>
            <div class="cat cat3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color)"><path d="M18.404 2.998c-.757-.754-2.077-.751-2.828.005l-1.784 1.791L11.586 7H7a.998.998 0 0 0-.939.658l-4 11c-.133.365-.042.774.232 1.049l2 2a.997.997 0 0 0 1.049.232l11-4A.998.998 0 0 0 17 17v-4.586l2.207-2.207v-.001h.001L21 8.409c.378-.378.586-.881.585-1.415 0-.535-.209-1.038-.588-1.415l-2.593-2.581zm-3.111 8.295A.996.996 0 0 0 15 12v4.3l-9.249 3.363 4.671-4.671c.026.001.052.008.078.008A1.5 1.5 0 1 0 9 13.5c0 .026.007.052.008.078l-4.671 4.671L7.7 9H12c.266 0 .52-.105.707-.293L14.5 6.914 17.086 9.5l-1.793 1.793zm3.206-3.208-2.586-2.586 1.079-1.084 2.593 2.581-1.086 1.089z"></path></svg><p>فتوشاپ</p></div>
            <div class="cat cat4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color)"><path d="M12 22c3.719 0 7.063-2.035 8.809-5.314L13 12l7.809-4.686C19.063 4.035 15.719 2 12 2 6.486 2 2 6.486 2 12s4.486 10 10 10zm-.5-16a1.5 1.5 0 1 1-.001 3.001A1.5 1.5 0 0 1 11.5 6z"></path></svg><p>گیم</p></div>
            <div class="cat cat5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color)"><path d="m7.375 16.781 1.25-1.562L4.601 12l4.024-3.219-1.25-1.562-5 4a1 1 0 0 0 0 1.562l5 4zm9.25-9.562-1.25 1.562L19.399 12l-4.024 3.219 1.25 1.562 5-4a1 1 0 0 0 0-1.562l-5-4zm-1.649-4.003-4 18-1.953-.434 4-18z"></path></svg><p>برنامه نویسی</p></div>
        </div>
        <div class="cats cats2">
            <a href="../index.php" class="cat cat6"><p>بازگشت</p> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: var(--base-color)"><path d="m5 12 7 6v-5h6v-2h-6V6z"></path></svg></a>

        </div>
    </div>

    <div class="blogs">
        <?php function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
} foreach ($blogs as $blog): 


    $rowcoment = $conn->prepare("SELECT COUNT(*) FROM coment WHERE post = ? ");
    $rowcoment->bindValue(1, $blog['id'], PDO::PARAM_INT);
    $rowcoment->execute();
    $count = $rowcoment->fetchColumn(); // استفاده از fetchColumn برای شمارش
    
?>
            <div class="blog">
                <img src="../uploads/<?= ($blog['image']) ?>" alt="تصویر مقاله" class="article-image">
             <h2>  <a href="./blog/index.php?id=<?=$blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></h2> 
                <div class="discreption">
                    <?php
                     

                     
                     
                     
                     $content = $blog['caption'];
                     
                     
                     echo   limit_words($content,5); 
                     
                     ?>
                </div>
                <div class="catSec">

                    <div class="writer">
                        نویسنده: <?= htmlspecialchars($blog['writer']) ?>
                    </div>

                    <div class="categ"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" ><path d="M11 10H9v3H6v2h3v3h2v-3h3v-2h-3z"></path><path d="M4 22h12c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2zM4 8h12l.002 12H4V8z"></path><path d="M20 2H8v2h12v12h2V4c0-1.103-.897-2-2-2z"></path></svg> <p>برنامه نویسی</p>  </div>

                </div>
                <div class="iconsSec">

                    <div class="icons">
                    <div class="like icon like-button" id="like-button-0">
       <p id="like-count-0"> 0 </p> 
       <svg id="like-icon-0"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
           <path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"/>
       </svg>
       <svg id="liked-icon-0" xmlns="http://www.w3.org/2000/svg" fill="red" width="24" height="24" viewBox="0 0 24 24" style="display: none;">
           <path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path>
       </svg>
    </div>
    
    
    
    
    
    
    
    
    <div class="comment icon"><?=$count ?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style=";transform: ;msFilter:;"><path d="M20 2H4c-1.103 0-2 .897-2 2v18l5.333-4H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14H6.667L4 18V4h16v12z"></path><circle cx="15" cy="10" r="2"></circle><circle cx="9" cy="10" r="2"></circle></svg></div>
                    </div>
                    <div class=" save icons">
                        <div id="saveIcon" class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 2H6c-1.103 0-2 .897-2 2v18l8-4.572L20 22V4c0-1.103-.897-2-2-2zm0 16.553-6-3.428-6 3.428V4h12v14.553z"></path></svg>
                        <svg id="savedIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ><path d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z"></path></svg>
                    </div>
                    </div>
                </div>
                
                <a href="blog/index.php?id=<?=$blog['id'] ?>">
                <div class="view">مشاهده</div>
                 </a>
                
            </div>
        <?php endforeach; ?>
    </div>

    
    <script src="script.js"></script>
    <script src="save.js"></script>
    <script src="../darkmode.js"></script>
    <script src="../script.js"></script>

</body>
</html>