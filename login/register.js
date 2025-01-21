document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const userInput = document.getElementById('userInput');
    const generatedCodeInput = document.getElementById('generatedCode');
    const codeInputField = document.getElementById('codeInputField');
    const sendEmailButton = document.getElementById('sendEmailButton');
    const registerButton = document.getElementById('registerButton');
    const messageBox = document.getElementById('messageBox');

    // تابع برای نمایش پیام خطا
    function showError(message) {
        messageBox.style.color = 'red';
        messageBox.innerText = message;
    }

    // تابع برای پاک کردن پیام خطا
    function clearError() {
        messageBox.innerText = '';
    }

    // اعتبارسنجی فرم
    form.addEventListener('submit', function(event) {
        clearError(); // پاک کردن پیام خطا

        // اعتبارسنجی نام
        if (nameInput.value.trim() === '') {
            showError('لطفاً نام خود را وارد کنید.');
            event.preventDefault(); // جلوگیری از ارسال فرم
            return;
        }

        // اعتبارسنجی ایمیل
        if (!validateEmail(emailInput.value)) {
            showError('ایمیل معتبر نیست.');
            event.preventDefault(); // جلوگیری از ارسال فرم
            return;
        }

        // اعتبارسنجی رمز عبور
        if (passwordInput.value.length < 8) {
            showError('رمز عبور باید حداقل ۸ کاراکتر باشد.');
            event.preventDefault(); // جلوگیری از ارسال فرم
            return;
        }

        // اعتبارسنجی کد تأیید
        if (codeInputField.style.display !== 'none' && userInput.value.trim() === '') {
            showError('لطفاً کد تأیید را وارد کنید.');
            event.preventDefault(); // جلوگیری از ارسال فرم
            return;
        }
    });

    // تابع برای اعتبارسنجی ایمیل
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
const countElement = document.getElementById('count');
        countElement.style.display = 'none'
    // رویداد کلیک برای ارسال ایمیل
    sendEmailButton.addEventListener('click', function() {
        // اینجا می‌توانید کد ارسال ایمیل را اضافه کنید
        // بعد از ارسال ایمیل، کد تأیید را نمایش دهید
        generatedCodeInput.value = '123456'; // اینجا باید کد واقعی را قرار دهید
        codeInputField.style.display = 'block'; // نمایش فیلد کد تأیید
        registerButton.style.display = 'block'; // نمایش دکمه ثبت‌نام

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
    });
});
