<?php
include '../database/db.php';

$email = $_POST['email'];

$query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$query->bindValue(1, $email, PDO::PARAM_STR);
$query->execute();

if ($query->rowCount() > 0) {
    echo "ایمیل وجود دارد";
} else {
    echo "ایمیل وجود ندارد";
}
?>
