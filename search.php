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
        foreach ($results as $result) {
            echo "<div class='card'>";
            echo "<h2><a href='maqale ha/blog/index.php?id=" . $result['id'] . "'>" . htmlspecialchars($result['title']) . "</a></h2>";
            echo "</div>";
        }
    } else {
        echo "<p>نتیجه‌ای یافت نشد.</p>";
    }
}
?>
