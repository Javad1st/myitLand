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




<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="loading.css">
  <link rel="stylesheet" href="Image Slider on Website/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="mobile.css">

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
  <div id="base" class="baseOf">
    <img class="moon" src="svgHa/b8420a7ec558f6cd2e796a3fabffa775.png" alt="">
    <img class="moon2" src="svgHa/—Pngtree—hazy and beautiful halo moon_5336588.png" alt="">
    <div class="bigPicture">
      <div class="bigText">
        <h2>سایت مقاله ای آیتی لند</h2>
        <p>مقالات رایگان و بروز برنامه نویسی در دنیا با آیتی لند</p>
        <a href="#slider" class="bigText1">اسکرول کنید
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="3 0 17 17"
          style="fill: var(--text-color);  border-radius: 50%;">
          <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
        </svg>
      </a>
      <a href="./maqale ha/maqale.php"><button style="background-color: green; padding: 10px; border-radius: 10px; color: white; cursor: pointer; " class="blogha" id="blogha"  >برای مشاهده تمامی مقالات کلیک کنید</button></a>
    </div>
    <img class="img1" src="svgHa/ITLand.png" alt="">
    <img class="img2 disNone" src="svgHa/ITLand2.png" alt="">
  </div>
  
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
    
    <div id="category" class="addMaqaleh block">
      <h2 class="addText">افزودن مقاله</h2>
      <div class="addContents">
        <div class="addContent rules">
          <p id="Mcontent">قوانین
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="3 0 17 17"
            style="fill: var(--text-color);  border-radius: 50%;">
            <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
          </svg>
        </p>
        <span class="Mtexts ">مقالات حتما باید از منابع موصق باشد<br> مقالات باید اخلاقی باشد</span>
      </div>
      <div class="addContent learn">
        <p id="Lcontent">آموزش
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="3 0 17 17"
          style="fill: var(--text-color);  border-radius: 50%;">
          <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
        </svg>
      </p>
      <span class="Ltexts ">مقالات حتما باید از منابع موصق باشد<br> مقالات باید اخلاقی باشد</span>
    </div>
  </div>
</div>
</div>
</footer>
</div>

<footer>
  <div class="footerSection footerSection1">
    <div class="footerImage">
      <img src="tasavir/highlight.jpg" alt="">
    </div>
    <div class="footerImage">
      <img src="tasavir/4695738.webp" alt="">
      
    </div>
  </div>
  <div class="footerSection2">

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
          <li>
            <p>👋</p>
          </li>
        </ul>
        
      </div>
      <div class="footerSection"></div>
      <div class="footerSection"></div>
    </footer>
    
    
    
  </div>
  
  
  <script type="text/javascript" src="darkmode.js"></script>
  <script src="script.js"></script>
 
</body>

</html>