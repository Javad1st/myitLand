


<?php
include '../database/db.php'; 
session_start();

$emailError = '';
$passwordError = '';
$codeError = '';
$successMessage = '';

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $userInput = htmlspecialchars($_POST['userInput']);
    $generatedCode = htmlspecialchars($_POST['message']);
    $timestamp = intval($_POST['timestamp']);
    $currentTimestamp = time();

    // اعتبارسنجی ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'ایمیل معتبر نیست.';
    }
    // اعتبارسنجی رمز عبور
    elseif (strlen($password) < 8) {
        $passwordError = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }
    // بررسی انقضای کد
    elseif ($currentTimestamp - $timestamp > 180) { 
        $codeError = 'کد منقضی شده است.';
    }
    // بررسی صحت کد
    elseif ($generatedCode !== $userInput) {
        $codeError = 'کد تأیید نادرست است';
    } 
    else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insert->bindValue(1, $name, PDO::PARAM_STR);
        $insert->bindValue(2, $email, PDO::PARAM_STR);
        $insert->bindValue(3, $hashedPassword, PDO::PARAM_STR);

        if ($insert->execute()) {
            $successMessage = 'ثبت‌نام با موفقیت انجام شد!';
            header("location:login.php");
            exit;
        } else {
            $emailError = 'خطا در ثبت‌نام. لطفاً دوباره تلاش کنید.';
        }
    }
}
?>
<?php

if (isset($_SESSION['user_email'])) {
    // اگر کاربر وارد شده بود، هدایت به صفحه‌ای مثل homepage.php
    header("Location: /myitland/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت‌نام</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="pass.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init('P8S6N0vq6E2OOtxYh'); // User ID از EmailJS
        })();
    </script>
</head>
<body>
<div class="shape1"></div>
    <div class="wrapper">
        <h2>ثبت‌نام</h2>
        <form id="form" method="POST" action="">
            <div class="input-field">
                <input type="text" id="name" name="name" required>
                <label for="name">نام</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <?php if ($emailError): ?>
                <div class="error-message"> <?php echo $emailError; ?> </div>
            <?php endif; ?>
            <div class="input-field">
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
            <?php endif; ?>
            <button id="registerButton" type="submit" style="display:none;" name="sub">ثبت‌نام</button>
        </form>
        <?php if ($successMessage): ?>
            <div class="success-message"> <?php echo $successMessage; ?> </div>
        <?php endif; ?>
        <div class="register">
            <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="./login.php">ورود</a></p>
        </div>
    </div>
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
</body>
</html>
