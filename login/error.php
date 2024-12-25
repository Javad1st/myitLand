<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>خطا</title>
    <script>
        // تابع برای شمارش معکوس
        function startCountdown(duration) {
            let timer = duration, minutes, seconds;
            const countdownElement = document.getElementById('countdown');

            const interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                countdownElement.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    document.getElementById('login-button').disabled = false; // فعال کردن دکمه ورود
                }
            }, 1000);
        }

        window.onload = function () {
            const lockoutTime = <?php echo isset($_SESSION['lockout_time']) ? $_SESSION['lockout_time'] : 0; ?>;
            const currentTime = Math.floor(Date.now() / 1000);
            const remainingTime = lockoutTime > currentTime ? lockoutTime - currentTime : 0;

            if (remainingTime > 0) {
                document.getElementById('login-button').disabled = true; // غیرفعال کردن دکمه ورود
                startCountdown(remainingTime);
            } else {
                document.getElementById('login-button').disabled = false; // فعال کردن دکمه ورود
            }
        };
    </script>
</head>
<body>
    <div class="wrapper">
        <h2>خطا در ورود</h2>
        <p>شما بیش از حد مجاز تلاش کرده‌اید. لطفاً بعد از:</p>
        <div id="countdown">05:00</div>
        <button id="login-button" onclick="window.location.href='login.php'">ورود مجدد</button>
    </div>
</body>
</html>
