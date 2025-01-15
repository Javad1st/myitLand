<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    die('لطفاً وارد شوید');
}

$id = $_POST['blog_id'];
include './database/db.php';

// شامل کردن کتابخانه TCPDF
require_once('./TCPDF/tcpdf.php');

// استخراج اطلاعات مقاله از دیتابیس
$selectblog = $conn->prepare("SELECT * FROM blogs WHERE id=?");
$selectblog->bindValue(1, $id);
$selectblog->execute();
$blog = $selectblog->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die('مقاله مورد نظر یافت نشد.');
}

// ایجاد یک شیء جدید از کلاس TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// تنظیمات اولیه مستند
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('نویسنده');
$pdf->SetTitle($blog['title']);
$pdf->SetSubject('موضوع');
$pdf->SetKeywords($blog['tags']);

// حذف هدر و فوتر پیش‌فرض
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// تنظیمات فونت
$pdf->SetFont('dejavusans', '', 12);

// افزودن یک صفحه جدید
$pdf->AddPage();

// استایل‌های CSS به صورت inline
$html = '
<style>
body { font-family: dejavusans; background-color: #81C784; margin: 0; padding: 20px; text-align: center; }
.container { max-width: 800px; margin: auto; background: #4CAF50; padding: 30px; border-radius: 15px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); }
h1 { color: #1B5E20; font-size: 2.5em; margin-bottom: 15px; text-align: center; }
.article-image { width: 800px; height: 400px; border-radius: 15px; margin-bottom: 20px; border: 5px solid #388E3C; display: block; margin-left: auto; margin-right: auto; }
p { font-weight: 600; line-height: 1.8; color:rgb(5, 5, 5); margin-top: 15px; font-size: 1.3em; text-align: center; }
p img { display: flex; justify-content: center; width: 800px; height: 400px; }  /* استایل برای وسط‌چین کردن تصویر در تگ p */
h2 { color: #388E3C; margin-top: 20px; font-size: 1.8em; text-align: center; }
span { color:rgb(6, 6, 6); margin-top: 10px; font-size: 1em; text-align: center; }
.nevisande { text-align: center; margin-top: 3rem; }
.read-more { background-color: #1B5E20; color: #C8E6C9; border: none; padding: 12px 25px; border-radius: 5px; cursor: pointer; font-size: 1.1em; display: block; margin: 20px auto; text-align: center; }
.read-more:hover { background-color: #33691E; transform: translateY(-2px); }
</style>
';

$caption = str_replace('../uploads/', './uploads/', $blog['caption']);

$html .= '<div class="container">';
$html .= '<h1>' . htmlspecialchars($blog['title']) . '</h1>';
$html .= '<img src="./uploads/' . htmlspecialchars($blog['image']) .  '" alt="تصویر مقاله" class="article-image">';

$html .= '<p>' . $caption . '</p>';  // افزودن محتوای caption داخل تگ p
$html .= '<h2>برچسب‌ها</h2>';
$tags = explode(',', $blog['tags']);
foreach ($tags as $tag) {
    $html .= '<span class="tag">' . htmlspecialchars($tag) . '# </span>';
}
$html .= '<p class="nevisande"> نویسنده: ' . htmlspecialchars($blog['writer']) . '</p>';
$html .= '<p class="nevisande"> تاریخ انتشار: ' . htmlspecialchars($blog['date']) . '</p>';
$html .= '</div>';

$pdf->writeHTML($html, true, false, true, false, '');

// خروجی فایل PDF
$pdf->Output('article_' . htmlspecialchars($id) . '.pdf', 'D');
?>
