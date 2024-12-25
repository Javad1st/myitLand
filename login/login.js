let generatedCode;
const generateNewCode = () => {
    let newCode;
    do {
        newCode = Math.floor(100000 + Math.random() * 900000); // تولید عدد ۶ رقمی تصادفی
    } while (newCode === generatedCode);
    generatedCode = newCode;
    $("#generatedCode").val(generatedCode); // تنظیم کد تولید شده در ورودی مخفی
}

generateNewCode(); // تولید کد جدید در ابتدای بارگذاری صفحه

const sendEmailButton = document.getElementById('sendEmailButton');
const registerButton = document.getElementById('registerButton');
const userInput = document.getElementById('userInput');
const codeInputField = document.getElementById('codeInputField');
let timestamp;

// ارسال ایمیل با EmailJS
sendEmailButton.addEventListener('click', function() {
    const password = $("#password").val();

    // بررسی طول رمز عبور
    if (password.length < 8) {
        alert('رمز عبور باید حداقل ۸ کاراکتر باشد.');
        return;
    }

    const email = $("#email").val();

    // بررسی وجود ایمیل در دیتابیس
    $.ajax({
        url: "check_email.php", // فایل PHP
        method: "POST",
        data: { email: email },
        success: function(response) {
            if (response.trim() === "ایمیل وجود دارد") {
                alert("این ایمیل قبلاً ثبت شده است. لطفا ایمیل دیگری را انتخاب کنید.");
            } else {
              generateNewCode(); // تولید کد جدید قبل از ارسال ایمیل
              $("#to_email").val($("#email").val()); // تنظیم ایمیل مقصد
              $("#to_name").val($("#name").val()); // تنظیم نام کاربر
              timestamp = Date.now();
              $("#timestamp").val(timestamp); // تنظیم زمان تولید کد

              const serviceID = 'default_service';
              const templateID = 'template_rnzukkk';

              emailjs.sendForm(serviceID, templateID, document.getElementById('form'))
                  .then(() => {
                      sendEmailButton.style.display = 'none';
                      codeInputField.style.display = 'block';
                      registerButton.style.display = 'block';
                      alert('ایمیل ارسال شد!');
                  }, (err) => {
                      alert(JSON.stringify(err));
                  });
          }
        }
    });
});

// بررسی کد با AJAX و ثبت‌نام
registerButton.addEventListener('click', function(event) {
    event.preventDefault();
    const userInputValue = $("#userInput").val();
    const currentTimestamp = Date.now();
    
    if (currentTimestamp - timestamp > 180000) { // 180000 میلی‌ثانیه = 3 دقیقه
        alert("کد منقضی شده است.");
        window.location.reload(); // بارگذاری مجدد صفحه
        return;
    }

    $.ajax({
        url: "check_code.php", // فایل PHP
        method: "POST",
        data: { generatedCode: generatedCode, userInput: userInputValue },
        success: function(response) {
            if (response.trim() === "کد صحیح است") {
                // ارسال فرم به همین فایل برای ثبت‌نام
                $.ajax({
                    url: "",
                    method: "POST",
                    data: {
                        name: $("#name").val(),
                        email: $("#email").val(),
                        password: $("#password").val(),
                        userInput: $("#userInput").val(),
                        message: generatedCode,
                        timestamp: timestamp,
                        sub: true
                    },
                    success: function(response) {
                        if (response.includes("ثبت‌نام با موفقیت انجام شد!")) {
                            window.location.href = 'login.php';
                        } else {
                            alert(response);
                        }
                    }
                });
            } else {
                alert("کد نادرست است.");
            }
        }
    });
});
