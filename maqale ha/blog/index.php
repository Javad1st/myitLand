<?php
session_start();
include '../../database/db.php';

// دریافت id مقاله از URL
$id = intval($_GET['id']);

// چک کردن وجود مقاله
$selectblog = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$selectblog->bindValue(1, $id, PDO::PARAM_INT);
$selectblog->execute();
$blogs = $selectblog->fetchAll(PDO::FETCH_ASSOC);

if (!$blogs) {
    die('مقاله‌ای با این شناسه یافت نشد.');
}
// پردازش فرم ارسال نظر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userid = htmlspecialchars(trim($_POST['userid']));
    $text = htmlspecialchars(trim($_POST['text']));
  $user_email = $_SESSION['user_email'];

    // بررسی اینکه فیلدها خالی نباشند
    if (!empty($userid) && !empty($text)) {
        $coment = $conn->prepare("INSERT INTO coment (post, userid, text , user_email) VALUES (?, ?, ? , ?)");
        $coment->bindValue(1, $id, PDO::PARAM_INT);
        $coment->bindValue(2, $userid, PDO::PARAM_STR);
        $coment->bindValue(3, $text, PDO::PARAM_STR);
        $coment->bindValue(4, $user_email, PDO::PARAM_STR);
        $coment->bindValue(4, $user_email, PDO::PARAM_STR);
        $coment->execute();

        // پیام موفقیت
        $_SESSION['message'] = 'نظر شما با موفقیت ثبت شد.';
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
        exit;
    } else {
        $_SESSION['error'] = 'لطفاً تمام فیلدها را پر کنید.';
    }
}

// انتخاب نظرات مرتبط با مقاله
$select = $conn->prepare("SELECT * FROM coment WHERE post = ? ORDER BY id DESC");
$select->bindValue(1, $id, PDO::PARAM_INT);
$select->execute();
$comnts = $select->fetchAll(PDO::FETCH_ASSOC);

foreach ($blogs as $b) {
    $tagss = explode(',', $b['tags']);
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blogs[0]['title']) ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./comment.css">
    <link rel="shortcut icon" href="../../tasavir/Untitled-2.png" type="image/x-icon">
    <style>
        .error { color: red; }
        .success { color: green; }
        .comment-form { margin-top: 20px; }
        .comment { border-bottom: 1px solid #ccc; padding: 10px 0; }
       .image{
        display: flex;
justify-content: center;   

 }
 .image>img{
  width: 800px;
  height: 400px;
 }
 textarea{
  height: 200px;
 }
    </style>
</head>
<body>
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
  <div class="hamburger-menu">
<div class="hamburger-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
  style="fill: var(--base-color); ">
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
  </div>
  <div class="menu-item">
    <button class="menu-btn">
      خانه
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
  </div>
</div>
    <div class="container" dir="rtl">
        <?php foreach ($blogs as $blog): ?>
            <h1><?= $blog['title'] ?></h1>
            <img src="../../uploads/<?= $blog['image'] ?>" alt="تصویر مقاله" class="article-image">
            <p><p> <?= $caption = str_replace('../uploads/', '../../uploads/', $blog['caption']);
     $caption;
    ?></p>
            </p>
            <h2>برچسب‌ها</h2>
            <?php foreach ($tagss as $tags): ?>
                <span>#<?= htmlspecialchars($tags) ?></span>
            <?php endforeach; ?>
            <p class="nevisande"> نویسنده: <?= htmlspecialchars($blog['writer']) ?></p>
            <p class="nevisande"> تاریخ انتشار: <?= htmlspecialchars($blog['date']) ?></p>
        <?php endforeach; ?>

        <a href="../maqale.php"><button class="read-more">بازگشت</button></a>
        <?php if (isset($_SESSION['user_email'])):?>
    <div style="text-align: center; margin-top: 20px;">
        <form action="../../pdf.php" method="post" target="_blank">
            <input type="hidden" name="blog_id" value="<?= htmlspecialchars($id) ?>">
            <button dir="rtl" type="submit" class="download-pdf down"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color)"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg> <p>دانلود این مقاله با فرمت pdf</p></button>
        </form>
    </div>
    <?php else:?>
      <div class="not-login">
  <a  target="_blank" href="../../login/login.php"><button id="login-pdf" class="down" >برای دانلود مقاله باید ورود کنید</button></a>

  </div> 
      <?php endif;?>
        

        
      
     
    </div>
    <div class="coment-body">
            <div class="comments-section">
                <h2>نظرات</h2>
        <?php if (isset($_SESSION['user_email'])):?>
                <?php if (isset($_SESSION['message'])): ?>
                    <p class="success"><?= $_SESSION['message'] ?></p>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error"><?= $_SESSION['error'] ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form class="comment-form" method="post" dir="rtl">
                    <input type="text" name="userid" placeholder="نام خود را وارد کنید..." required>
                    <textarea name="text" placeholder="نظر خود را اینجا بنویسید..." required></textarea>
                    <button type="submit" name="submit">ارسال نظر</button>
                </form>


                <?php else:?>
                  <h4> <a style="text-decoration: none;"  href="../../login/login.php">برای ثبت نظر ورود کنید </a></h4>
                <?php endif;?>


                <div id="comments-list">
                    <?php foreach ($comnts as $co): ?>
                        <div class="comment">
                            <p><strong><?= htmlspecialchars($co['userid']) ?>:</strong> <?= nl2br(htmlspecialchars($co['text'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <script src="script.js"></script>
<script src="../../script.js"></script>
<script src="../../darkmode.js"></script>

</body>
</html>
