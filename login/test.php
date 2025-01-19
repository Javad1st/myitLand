<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Example with Fixed Code</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>AJAX Example with Fixed Code</h1>
    
    <input type="text" id="inputCode" placeholder="Enter the code">
    <button id="sendCode">Send Code</button>

    <p id="responseMessage" style="font-weight: bold; color: green;"></p>

    <script>
        // کد ثابت که در جاوااسکریپت قرار دارد
        const fixedCode = "1234"; // کد ثابت

        // ارسال کد واردشده به PHP برای بررسی
        document.getElementById("sendCode").addEventListener("click", function () {
            const userInput = document.getElementById("inputCode").value;

            // ارسال درخواست به PHP
            $.ajax({
                url: "verify.php", // آدرس فایل PHP
                type: "POST", // متد ارسال
                data: { userInput: userInput, fixedCode: fixedCode }, // داده‌های ارسال‌شده
                success: function (response) {
                    document.getElementById("responseMessage").textContent = response; // نمایش پاسخ
                },
                error: function () {
                    alert("An error occurred while sending the request.");
                }
            });
        });
    </script>
</body>
</html>