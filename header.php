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
<?php

if (isset($_SESSION['user_email'])) {
    // اگر سشن ست شده باشد، این کد اجرا می‌شود
    $email = $_SESSION['user_email'];

    // دریافت نام و تصویر پروفایل کاربر از دیتابیس
    $stmt = $conn->prepare("SELECT profile_image FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $profile_image = $user['profile_image']; // نام فایل تصویر پروفایل
    } else {
        echo "کاربر یافت نشد!";
        exit();
    }
} 
?>


<a href="maqale ha/blog/index.php"></a>
<style>
   .card {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

    
</style>
<style>
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

<div class="head">


<header>
      <div class="partOfHeader partOfHeader1">
        
      </div>
     
      <div class="partOfHeader partOfHeader">
      <img class="logo" src="tasavir/Untitled-2.png" alt="">
      </div>
        <div class="partOfHeader partOfHeader5">
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
     <div class="partOfHeader partOfHeader6">
    <?php if (isset($_SESSION['user_email'])) { 
        $profileImagePath = !empty($profile_image) ? './profile/' . $profile_image : 'default-avatar.jpg'; 
    ?>
        <div class="profile1">
            <button id="profileBtn1">
                <img src="<?php echo $profileImagePath; ?>" alt="Profile Image">
            </button>
            <div id="dropdown1" class="dropdown-content1">
                <a href="./dashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"></path>
                    </svg>
                    داشبورد
                </a>
                <a href="./logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M18 2H6a1 1 0 0 0-1 1v9l5-4v3h6v2h-6v3l-5-4v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"></path>
                    </svg>
                    خروج از حساب
                </a>
            </div>
        </div>
    <?php } else { ?>
        <a class="linkOne" href="./login/login.php">
            <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.4" d="M6.67065 6.4847C6.67065 4.27199 8.53019 2.47095 10.8157 2.47095H15.3587C17.6387 2.47095 19.4935 4.26748 19.4935 6.47567V16.5109C19.4935 18.7246 17.6349 20.5265 15.3494 20.5265H10.8064C8.52646 20.5265 6.67065 18.7291 6.67065 16.52V15.6714V6.4847Z" fill="currentColor"></path>
                <path d="M14.5621 11.0056L11.8827 8.37941C11.6058 8.10858 11.1602 8.10858 10.8841 8.38122C10.6091 8.65386 10.61 9.09351 10.886 9.36434L12.3531 10.8025H3.04688C2.65717 10.8025 2.34082 11.1139 2.34082 11.4985C2.34082 11.8822 2.65717 12.1927 3.04688 12.1927H12.3531L10.886 13.6318C10.61 13.9026 10.6091 14.3423 10.8841 14.6149C11.0226 14.7512 11.2033 14.8198 11.3848 14.8198C11.5645 14.8198 11.7452 14.7512 11.8827 14.6167L14.5621 11.9905C14.695 11.8596 14.7702 11.6827 14.7702 11.4985C14.7702 11.3134 14.695 11.1365 14.5621 11.0056Z" fill="currentColor"></path>
            </svg>
            <p>ورود</p>
        </a>
        <a class="linkTwo" href="./login/rgister.php">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.4" d="M19.3827 8.78099H18.2966V7.71911C18.2966 7.26576 17.933 6.89612 17.485 6.89612C17.0379 6.89612 16.6734 7.26576 16.6734 7.71911V8.78099H15.5892C15.1412 8.78099 14.7776 9.15063 14.7776 9.60398C14.7776 10.0573 15.1412 10.427 15.5892 10.427H16.6734V11.4898C16.6734 11.9431 17.0379 12.3128 17.485 12.3128C17.933 12.3128 18.2966 11.9431 18.2966 11.4898V10.427H19.3827C19.8297 10.427 20.1943 10.0573 20.1943 9.60398C20.1943 9.15063 19.8297 8.78099 19.3827 8.78099" fill="currentColor"></path>
                <path d="M8.90975 13.681C5.25731 13.681 2.13892 14.265 2.13892 16.598C2.13892 18.9301 5.23834 19.5351 8.90975 19.5351C12.5613 19.5351 15.6806 18.9511 15.6806 16.6181C15.6806 14.2851 12.5812 13.681 8.90975 13.681" fill="currentColor"></path>
                <path opacity="0.4" d="M8.90984 11.459C11.3966 11.459 13.39 9.43996 13.39 6.92114C13.39 4.40232 11.3966 2.38232 8.90984 2.38232C6.42308 2.38232 4.42969 4.40232 4.42969 6.92114C4.42969 9.43996 6.42308 11.459 8.90984 11.459" fill="currentColor"></path>
            </svg>
            <p>ثبت نام</p>
        </a>
    <?php } ?>

        <style>
#profileBtn1 {
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0; /* رنگ پس‌زمینه */
    border: 2px solid #ddd; /* حاشیه برای دکمه */
    transition: background-color 0.3s, box-shadow 0.3s; /* انتقال نرم برای تغییرات */
}

#profileBtn1:hover {
    background-color: #e0e0e0; /* تغییر رنگ پس‌زمینه هنگام هاور */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* سایه هنگام هاور */
}

#profileBtn1 img {
    /* width: 340px; */
    height: 50p;
    border-radius: 50%;
    object-fit: cover;
    width: 55px;
    height: 55px;
}



.profile1 {
    position: relative;
    display: inline-block;
}

#profileBtn1 {
    padding: 20px;
    cursor: pointer;
   border-radius: 50%;
   width: 60px;
   height: 60px;
   display: flex;
   align-items: center;
   justify-content:center ;
}

.dropdown-content1 {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 10px;
    right: -30px;
}

.dropdown-content1 a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
display: flex;
font-size: medium;
  }

.dropdown-content1 a:hover {
    background-color: #f1f1f1;
    border-radius: 10px;
}



        </style>

        <script>

document.getElementById("profileBtn1").onclick = function() {
    var dropdown = document.getElementById("dropdown1");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
};

// برای بستن منو وقتی کاربر بر روی خارج از آن کلیک کند
window.onclick = function(event) {
    if (!event.target.matches('#profileBtn1')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
}


        </script>

         </div>
      <div class="partOfHeader partOfHeader4">
        <button id="theme-switch">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path
            d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path
            d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
          </svg>
        </button>
      </div>
      <div class="hamburger-menu">
        <div class="hamburger-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
          style="fill: white; ">
            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
          </svg></div>
          <div class="menu" id="menu">
            <div class="headOfMenu">
            <div class="close-icon" id="close-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" style="fill: var(--base-color);">
                <path
                  d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z">
                </path>
              </svg></div> <!-- آیکون ضربدر -->
            <button id="theme-switch2">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                <path
                d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                <path
                d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
              </svg>
            </button>
            <div class="headerButton headerButton4">
              <a class="linkOne" href="login/login.php">ورود</a>
              <a class="linkTwo" href="login/rgister.php">ثبت نام</a>
            </div>
          </div>
          <div class="menu-item">
            <button class="menu-btn">
              درس ها
              <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: var(--text-color);">
                <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
              </svg></span>
              
            </button>
            <div class="dropdown-content">
              <a href="maqale ha/maqale.php">مقالات</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
            </div>
          </div>
          <!-- بقیه منو ها... -->
          <div class="menu-item">
            <button class="menu-btn">
              درباره ما
              <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: var(--text-color);">
                <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
              </svg></span>
            </button>
            <div class="dropdown-content">
              <a href="#">لینک 1</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
            </div>
          </div>

          <div class="menu-item">
            <button class="menu-btn">
              پشتیبانی
              <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  style="fill: var(--text-color)">
                  <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                </svg></span>
            </button>
            <div class="dropdown-content">
              <a href="#">لینک 1</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
            </div>
          </div>
        </header>
        


        <div class="header2">
        <!-- About Us Dropdown -->
        <div class="headerButton headerButton1" onclick="toggleDropdown('aboutDropdown')">درباره ما <svg
            xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
            style="fill: #1B4332; background-color: white; border-radius: 50%;">
            <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
          </svg> 
        <div id="aboutDropdown" class="dropdownContent">
          <a href="/overview" class="dropdownItem">Overview</a>
          <a href="/team" class="dropdownItem">Team</a>
          <a href="/careers" class="dropdownItem">Careers</a>
        </div>
        </div>
        
        <!-- Support Dropdown -->
        <div class="headerButton headerButton2"><p>هوش مصنوعی </p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color);"><path d="M5 18v3.766l1.515-.909L11.277 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h1zM4 8h12v8h-5.277L7 18.234V16H4V8z"></path><path d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path></svg> </div>
        
        
        <!-- Home Dropdown -->
        <div class="headerButton headerButton3" onclick="toggleDropdown('homeDropdown')">درس ها <svg
          xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
          style="fill: #1B4332;background-color: white; border-radius: 50%;">
          <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
        </svg>
        <div id="homeDropdown" class="dropdownContent dropdownContent1">
          <a href="maqale ha/maqale.php" class="dropdownItem dropdownItem1"><svg class="iconA" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path d="M2 7v1l11 4 9-4V7L11 4z"></path>
              <path
              d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z">
            </path>
          </svg>دوره ها</a>
          <a href="/news" class="dropdownItem dropdownItem2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 20" style="fill: var(--zed);">
            <path
                d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
              </path>
            </svg>دسته بندی ها</a>
            <a href="#category" class="dropdownItem dropdownItem3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path
                d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z">
              </path>
              <path d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z"></path>
            </svg>اخبار</a>
          <a href="/main" class="dropdownItem dropdownItem4"><svg xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path
              d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h8a.996.996 0 0 0 .707-.293l7-7a.997.997 0 0 0 .196-.293c.014-.03.022-.061.033-.093a.991.991 0 0 0 .051-.259c.002-.021.013-.041.013-.062V5c0-1.103-.897-2-2-2zM5 5h14v7h-6a1 1 0 0 0-1 1v6H5V5zm9 12.586V14h3.586L14 17.586z">
            </path>
          </svg>مقالات رایگان</a>
          <a href="/main" class="dropdownItem dropdownItem5"><svg xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path
              d="M20 13.01h-7V10h1c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h1v3.01H4V18H3v4h4v-4H6v-2.99h5V18h-1v4h4v-4h-1v-2.99h5V18h-1v4h4v-4h-1v-4.99zM10 8V4h4l.002 4H10z">
            </path>
          </svg>رود مپ</a>
          <div class="dropdownC">
            <h2>پیشنهاد آیتی لند :</h2>
            <p>مقاله جاوا اسکریپت و مقاله پی اچ پی</p>
          </div>
        </div>
        </div>
    
      </div>
      </div>
        
