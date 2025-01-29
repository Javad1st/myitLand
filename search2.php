<?php
// اتصال به پایگاه داده
include './database/db.php';

header("Content-Type: text/html; charset=UTF-8");

// بررسی وجود مقدار جستجو
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query = trim($_GET['query']);
    $query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8'); // جلوگیری از حملات XSS

    try {
        // جستجو در پایگاه داده
        $stmt = $conn->prepare("SELECT id, title FROM blogs WHERE title LIKE :query LIMIT 10");
        $stmt->bindValue(':query', "%{$query}%", PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // نمایش نتایج جستجو
        if ($results) {
            foreach ($results as $result) {
                echo "<div class='result2-card'>";
                echo "<a href='maqale-ha/blog/index.php?id=" . htmlspecialchars($result['id']) . "'>" . htmlspecialchars($result['title']) . "</a>";
                echo "</div>";
            }
        } else {
            echo "<div class='result2-card'>نتیجه‌ای یافت نشد.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='result2-card'>خطا در پردازش جستجو</div>";
    }
} else {
    echo "<div class='result2-card'>لطفاً چیزی تایپ کنید</div>";
}
?>
