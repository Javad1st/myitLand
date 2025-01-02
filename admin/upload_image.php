
<?php
if ($_FILES['upload']) {
    $uploadDir = '../uploads/'; // مسیر ذخیره عکس‌ها
    $fileName = time() . '_' . basename($_FILES['upload']['name']);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['upload']['tmp_name'], $targetFile)) {
        // مسیر تصویر برای ذخیره در دیتابیس
        $relativePath = '../uploads/' . $fileName;

        // پاسخ موفقیت‌آمیز به CKEditor
        $response = [
            "uploaded" => true,
            "url" => $relativePath // ذخیره مسیر موردنظر در دیتابیس
        ];
    } else {
        $response = [
            "uploaded" => false,
            "error" => [
                "message" => "آپلود تصویر با خطا مواجه شد."
            ]
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
