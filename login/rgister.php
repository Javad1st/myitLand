<?php
include '../database/db.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // شامل کتابخانه PHPMailer

session_start();

$emailError = '';
$passwordError = '';
$successMessage = '';
$generatedCode = '';
$timestamp = '';
$codeSent = false;

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $currentTimestamp = time();

    // اعتبارسنجی ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'ایمیل معتبر نیست.';
    }
    // چک کردن وجود ایمیل در دیتابیس
    else {
        $checkEmailQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $checkEmailQuery->bindValue(1, $email, PDO::PARAM_STR);
        $checkEmailQuery->execute();

        if ($checkEmailQuery->rowCount() > 0) {
            $emailError = 'ایمیل وارد شده قبلاً ثبت شده است.';
        }
    }

    // اعتبارسنجی رمز عبور
    if (!$emailError && strlen($password) < 8) {
        $passwordError = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }

    // ارسال ایمیل و کد تأیید
    if (!$emailError && !$passwordError && isset($_POST['sendCode'])) {
        // تولید کد تأیید ۶ رقمی تصادفی
        $generatedCode = rand(100000, 999999);
        $timestamp = time();  // زمان ارسال کد تأیید

        // ارسال ایمیل با PHPMailer
        $mail = new PHPMailer(true);
        try {
            // تنظیمات SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'myitland.ir@gmail.com'; 
            $mail->Password = 'gcrz eyza pcox mpuq'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // فرستنده و گیرنده
            $mail->setFrom('myitland.ir@gmail.com', 'itland');
            $mail->addAddress($email);

            // محتوای ایمیل
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; // تنظیم UTF-8 برای ایمیل
            $mail->Subject = 'کد تأیید ثبت‌نام در سایت ITLAND'; // موضوع ایمیل
            $mail->Body = "
                <div style='text-align: center;'>
                    <p><b>$name</b> سلام</p>
                    <p>به آیتی لند خوش آمدید</p>
                    <p>کد تأیید شما: <b>$generatedCode</b></p>
                    <p>Welcome to the ITLAND, $name</p>
                    <p>Your verify code: <b>$generatedCode</b></p>
                    <p><a href='http://myitland.ir/' style='color: blue;'>myitland.ir</a></p>
                </div>
            ";
            
            

            // ارسال ایمیل
            $mail->send();
            $_SESSION['generatedCode'] = $generatedCode;  // ذخیره کد در session
            $_SESSION['email'] = $email;  // ذخیره ایمیل در session
            $_SESSION['timestamp'] = $timestamp;  // ذخیره زمان ارسال در session
            $_SESSION['name'] = $name; // ذخیره نام کاربر در session
            $_SESSION['password'] = $password; // ذخیره رمز عبور کاربر در session
            header("Location: verify.php");
            exit;

        } catch (Exception $e) {
            echo "خطا در ارسال ایمیل: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت‌نام</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="pass.css">
</head>
<body>
<div class="shape1"></div>
    <div class="wrapper">
        <h2>ثبت‌نام</h2>
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" id="name" name="name" required>
                <label for="name">نام</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <?php if ($emailError): ?>
                <div class="error-message"><?php echo $emailError; ?></div>
            <?php endif; ?>
            <div class="input-field">
<<<<<<< HEAD
    <input type="password" id="password" name="password" required minlength="8">
    <label for="password">رمز عبور</label>
    <span class="toggle-password">
        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
    </span>
</div>

            <?php if ($passwordError): ?>
                <div class="error-message"> <?php echo $passwordError; ?> </div>
            <?php endif; ?>
            <input type="hidden" id="generatedCode" name="message">
            <input type="hidden" id="to_email" name="to_email">
            <input type="hidden" id="to_name" name="to_name" value="">
            <input type="hidden" id="reply_to" name="reply_to" value="noreply@example.com">
            <input type="hidden" id="timestamp" name="timestamp">
            <button id="sendEmailButton" type="button">ارسال ایمیل</button>
            
            <div class="input-field" id="codeInputField" style="display:none;">
                <input type="text" id="userInput" name="userInput" required>
                <label for="userInput">کد تأیید</label>
            </div>
            <h2 id="count">3:00</h2>
            
            <br>
            <?php if ($codeError): ?>
                <div class="error-message"> <?php echo $codeError; ?> </div>
=======
                <input type="password" id="password" name="password" required minlength="8">
                <label for="password">رمز عبور</label>
            </div>
            <?php if ($passwordError): ?>
                <div class="error-message"><?php echo $passwordError; ?></div>
>>>>>>> d0cee5467b8acbe63818eedc3242ba383c9e4b6a
            <?php endif; ?>
            <button type="submit" name="sendCode">ارسال کد تأیید به ایمیل</button>
        </form>
    </div>
<<<<<<< HEAD
    <script>
        const countElement = document.getElementById('count');
        countElement.style.display = 'none'
        let generatedCode;
        const generateNewCode = () => {
            generatedCode = Math.floor(100000 + Math.random() * 900000); // تولید کد ۶ رقمی تصادفی
            $("#generatedCode").val(generatedCode);
        };

        const sendEmailButton = document.getElementById('sendEmailButton');
        const codeInputField = document.getElementById('codeInputField');
        const registerButton = document.getElementById('registerButton');
        let timestamp;

        sendEmailButton.addEventListener('click', function() {
            const email = $("#email").val();
            const password = $("#password").val();
            

            if (password.length < 8) {
                alert('رمز عبور باید حداقل ۸ کاراکتر باشد.');
                return;
            }

            $.ajax({
                url: "check_email.php",
                method: "POST",
                data: { email },
                success: function(response) {
                    if (response.trim() === "ایمیل وجود دارد") {
                        alert("این ایمیل قبلاً ثبت شده است.");
                    } else {
                        generateNewCode();
                        $("#to_email").val(email);
                        timestamp = Date.now();
                        $("#timestamp").val(timestamp);

                        emailjs.sendForm('default_service', 'template_rnzukkk', document.getElementById('form'))
                            .then(() => {
                                sendEmailButton.style.display = 'none';
                                codeInputField.style.display = 'block';
                                registerButton.style.display = 'block';
                                alert('ایمیل ارسال شد!');
                                let time = 180; // 3 دقیقه به ثانیه
                                const countElement = document.getElementById('count');
                                
                                countElement.style.display = 'block'
        const timer = setInterval(() => {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;

            // فرمت زمان به صورت دو رقمی
            countElement.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (time <= 0) {
                clearInterval(timer);
                alert("زمان به پایان رسید!");
            }

            time--;
        }, 1000);
                            }, (err) => {
                                alert("خطا در ارسال ایمیل.");
                            });
                    }
                }
            });
        });
    </script>
    <style>
@media screen and (max-width: 1100px) {
  .wrapper{
    width: 50%;
    font-size: xx-large;
    padding: 4rem 3rem;
    gap: 2rem;
  }
  h2{
    font-size: xxx-large;
  }
  .input-field{
    margin-top: 2rem;
    padding: 1rem;
    font-size: xx-large;
  }
  .input-field{
    font-size: xx-large;
  }
  button {
    font-size: x-large;
  }
  .shape1{
    right: 15%;
    top: 30%;
  }
  .input-field input {
    font-size: 1.8rem;
  }
  .input-field label{
    font-size: 28px;
  }
}

@media screen and (max-width: 750px){
   
.shape1{
  right: 15%;
  top: 40%;
}

}


@media screen and (max-width: 700px) {
    .wrapper {
      width: 60%;
      font-size: xxx-large;
      padding: 6rem 3rem;
      gap: 2rem;
      /* margin-top: auto; */
      /* gap: 2rem; */
  }
  
  }</style>
    <script src="eyes.js"></script>
    <script src="../darkmode.js"></script>
=======
>>>>>>> d0cee5467b8acbe63818eedc3242ba383c9e4b6a
</body>
</html>
