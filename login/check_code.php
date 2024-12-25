<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $generatedCode = $_POST['generatedCode'];
    $userInput = $_POST['userInput'];

    if ($generatedCode == $userInput) {
        echo "کد صحیح است";
    } else {
        echo "کد نادرست است";
    }
}
?>
