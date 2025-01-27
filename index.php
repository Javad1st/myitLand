
<?php 

session_start();
?>
<?php 
include './database/db.php';

// دریافت سه مقاله آخر
$select = $conn->prepare("SELECT * FROM blogs ORDER BY id DESC LIMIT 3");
$select->execute();
$blogs = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
include './database/db.php';

// دریافت سه مقاله آخر
$select = $conn->prepare("SELECT * FROM blogs ORDER BY id ASC LIMIT 8");
$select->execute();
$blogs = $select->fetchAll(PDO::FETCH_ASSOC);
?>









<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="loading.css">
  <link rel="stylesheet" href="Image Slider on Website/style.css">
  <link rel="stylesheet" href="blogbox.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="mobile2.css">
<link rel="shortcut icon" href="./tasavir/Untitled-2.png" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>myITLand</title>
</head>

<body>
  <div class="container">
    <!-- صفحه لودینگ -->
    <div id="loading">
      <div id="loading-text"><div class="ring">ITLand
        <span id="span1" ></span>
      </div></div>
    </div>
    <!-- محتوای صفحه اصلی -->
    <div class="gradient">
      
    </div>
    
    <?php

    require_once('header.php');
    ?>
    <div class="space">
    
    </div>
  </div>
  <div class="searchMain">
    
  <?php
// اتصال به پایگاه داده
include './database/db.php';

// بررسی پارامتر جستجو
if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);  // جلوگیری از حملات XSS

    // جستجو در پایگاه داده
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE title LIKE :query");
    $stmt->bindValue(':query', "%" . $query . "%", PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // نمایش نتایج جستجو
    if ($results) {
        echo "<div class='results-container'>";  // اضافه کردن کلاس برای کادر نتایج
        foreach ($results as $result) {
            echo "<div class='result-card'>";  // کادر هر نتیجه
            echo "<h2><a href='maqale ha/blog/index.php?id=" . $result['id'] . "'>" . htmlspecialchars($result['title']) . "</a></h2>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>نتیجه‌ای یافت نشد.</p>";
    }
}
?>

  <h2 class="title"> دنبال چه میگردی </h2>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <form id="searchForm">
    <input type="search" id="search-input" name="query" placeholder="جستجو..." autofocus required  autocomplete="off" >
    <i class="fa fa-search"></i>
    <div class='results-container'>
    <div id="results"></div>
    </div>
</form>
        </div>
<script>
    // تابع برای ارسال درخواست جستجو به سرور
    function performSearch(query) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "search.php?query=" + encodeURIComponent(query), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // نمایش نتایج در div#results
                document.getElementById('results').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // اضافه کردن رویداد input برای جستجوی آنی
    document.getElementById("search-input").addEventListener("input", function(event) {
        const query = event.target.value.trim();
        
        // اگر ورودی خالی نباشد، جستجو را شروع می‌کنیم
        if (query !== "") {
            performSearch(query); // جستجو را با هر تغییر وارد شده شروع می‌کنیم
        } else {
            document.getElementById('results').innerHTML = ''; // اگر ورودی خالی باشد، نتایج را پاک می‌کنیم
        }
    });

    // جلوگیری از ارسال فرم و رفرش صفحه (در صورت فشردن اینتر)
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault(); // جلوگیری از ارسال فرم
    });
</script>

        <script>
          
const clearInput = () => {
  const input = document.getElementsByTagName("input")[0];
  input.value = "";
}



        </script>
  <style>

.card {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    /* استایل کادر نتایج جستجو */
    .results-container {
      display: none;
        margin-top: 40px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 400px; /* حداکثر ارتفاع کادر */
        overflow-y: auto; /* اگر نتایج زیاد باشد، اسکرول می‌شود */
    }

    /* استایل برای هر نتیجه */
    .result-card {
        margin-bottom: 10px;
    }

    .result-card h2 {
        font-size: 16px;
        margin: 0;
        color: #333;
    }

    .result-card a {
        text-decoration: none;
        color: #007BFF;  /* رنگ لینک */
    }

    .result-card a:hover {
        text-decoration: underline;  /* هنگام هاور کردن لینک */
    }

    .result-card hr {
        border: none;
        border-top: 1px solid #eee;
        margin: 10px 0;
    }
</style>
  <div id="base" class="baseOf">
    <img class="moon" src="svgHa/b8420a7ec558f6cd2e796a3fabffa775.png" alt="">
    <img class="moon2" src="svgHa/—Pngtree—hazy and beautiful halo moon_5336588.png" alt="">
    <div class="bigPicture">
      <img class="img1" src="svgHa/ITLand.png" alt="">
      <img class="jazir" src="svgHa/jazir.png" alt="">
      <img class="img2 disNone" src="svgHa/ITLand2.png" alt="">
      <div class="bigText">
        <h2>سایت مقاله ای آیتی لند</h2>
        <p>مقالات رایگان و بروز برنامه نویسی در دنیا با آیتی لند</p>
        <a style="font-weight: 900;" href="#slider" class="bigText1">اسکرول کنید
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="3 0 17 17"
          style="fill: var(--text-color);  border-radius: 50%;">
          <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
        </svg>
      </a>
      <a href="./maqale ha/maqale.php"><button style="background-color: green; padding: 10px; border-radius: 10px; color: white; cursor: pointer; " class="blogha" id="blogha"  >برای مشاهده تمامی مقالات کلیک کنید</button></a>
    </div>
  </div>



  <h1 class="title">مقالات پیشنهادی</h1>
  <div class="primarySection">
    <div id="slider" class="slider block">
      <section class="main swiper mySwiper">
        <div class="wrapper swiper-wrapper">
            <?php foreach (array_slice($blogs, 0, 3) as $blog): ?>
            <div class="slide swiper-slide">
            <img src="./uploads/<?= ($blog['image']) ?>" alt="تصویر مقاله" class="image" />
            <div class="image-data">
            <h2 class="sliderText">
                            <?= htmlspecialchars($blog['title']) ?>
                        </h2>
                        <a href="maqale ha/blog/index.php?id=<?= $blog['id'] ?>" class="button">ادامه</a>
               </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="swiper-button-next nav-btn"></div>
          <div class="swiper-button-prev nav-btn"></div>
          <div class="swiper-pagination"></div>
        </section>
        
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        
        <!-- Initialize Swiper -->
        <script>
          var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        </script>
      </div>

        
        <!-- Swiper JS -->
      </div>
    </div>
    <h1 class="title">مقالات اخیر</h1>
    <div class="blogs block">
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
                <img src="./uploads/<?= ($blog['image']) ?>" alt="تصویر مقاله" class="article-image">
             <h2>  <a href="./maqale ha/blog/index.php?id=<?=$blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></h2> 
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

                    <div class="categ"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ><path d="M11 10H9v3H6v2h3v3h2v-3h3v-2h-3z"></path><path d="M4 22h12c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2zM4 8h12l.002 12H4V8z"></path><path d="M20 2H8v2h12v12h2V4c0-1.103-.897-2-2-2z"></path></svg> <p>برنامه نویسی</p>  </div>

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
                
                <a href="maqale ha/blog/index.php?id=<?=$blog['id'] ?>">
                <div class="view">مشاهده</div>
                 </a>
                
            </div>
        <?php endforeach; ?>
        <a id="all" href="./maqale ha/maqale.php"><h1>مشاهده همه<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:var(--secondary-text);"><path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg> </h1></a>
    </div>
      
    
    <div id="category" class="addMaqaleh block">
      <h2 class="addText">درباره مقالات</h2>
      <div class="addContents">
        <div class="addContent rules">
          <p id="Mcontent">قوانین
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--accent-color);"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg>
        </p>
        <span class="Mtexts ">هرگونه کپی برداری از مقالات و منتشر کردن مقاله بدون ذکر منبع ممنوع میباشد</span>
      </div>
      <div class="addContent learn">
        <p id="Lcontent">آموزش
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--accent-color);"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg>
      </p>
      <span class="Ltexts "> برای خواندن مؤثر مقاله، ابتدا عنوان و چکیده را بررسی کنید، سپس به دقت متن را بخوانید و نکات کلیدی را یادداشت کنید. </span>
    </div>
  </div>
</div>
</div>
</footer>
</div>

<footer>

<div class="foot foot1">

  <div class="footerSection footerSection1">
  <h1>درباره ما</h1>
  <p> سایت آیتی‌لند در آبان ۱۴۰۳ با هدف ارائه خدمات نوین فناوری و آموزش‌های به‌روز در دنیای آی‌تی راه‌اندازی شد.
در آیتی‌لند، مرزهای دانش را جستجو می‌کنیم و تلاش داریم پلی باشیم بین شما و آینده تکنولوژی.
با ما همراه باشید تا در دنیای دیجیتال پیشرو باشید!

تمامی حقوق این سایت محفوظ است.
www.Myitland.ir</p>
  </div>

  <div class="footerSection footerSection2">
    <h1>ارتباط با ما</h1>

    <ul>
      <li> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(35, 124, 207);"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.7-8 5.334L4 8.7V6.297l8 5.333 8-5.333V8.7z"></path></svg> myitland.ir@gmail.com</li>
      <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(35, 124, 207)"><path d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"></path></svg> itland_blog</li>
    </ul>
  </div>

  <div class="footerSection footerSection3">
  <h1>محبوب ترین ها</h1>

<ul>
  <li> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(228, 185, 28);"><path d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z"></path></svg> itland@gmail.com</li>
  <li> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(228, 185, 28)"><path d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z"></path></svg> itland_blog</li>
</ul>
  </div>

</div>




<div class="foot foot2">

<div class="footSec">
  <hr>
  <img src="tasavir/Untitled-2.png" alt="">
  <hr>
</div>
<div class="footSec">

  <ul>
    <li><a href="google.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            style="fill: rgba(255, 255, 255, 1);">
            <path
            d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z">
          </path>
          </svg></a></li>
          <li><a href="google.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            style="fill: rgba(255, 255, 255, 1);">
            <path
            d="m18.73 5.41-1.28 1L12 10.46 6.55 6.37l-1.28-1A2 2 0 0 0 2 7.05v11.59A1.36 1.36 0 0 0 3.36 20h3.19v-7.72L12 16.37l5.45-4.09V20h3.19A1.36 1.36 0 0 0 22 18.64V7.05a2 2 0 0 0-3.27-1.64z">
          </path>
        </svg></a></li>
        <li><a href="google.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          style="fill: rgba(255, 255, 255, 1);">
          <path
          d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z">
        </path>
        <circle cx="11.994" cy="11.979" r="3.003"></circle>
      </svg></a></li>
      <li><a href="google.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
        style="fill: rgba(255, 255, 255, 1);">
            <path fill-rule="evenodd" clip-rule="evenodd"
            d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z">
          </path>
        </svg></a></li>
      </ul>
</div>

</div>


    </footer>
    
    
    
  </div>
  
  
  <script type="text/javascript" src="darkmode.js"></script>
  <script src="script.js"></script>
  <script src="maqale ha/script.js"></script>
 
</body>

</html>