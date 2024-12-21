<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            margin-top: -6px;
            border-radius: 5px;
            padding: 20px; /* تنظیم پدینگ */
        }
        .navbar a {
            color: black;
            padding: 14px 30px; /* تنظیم پدینگ برای لینک‌ها */
        }
        .dropdown-menu {
            border-radius: 10px;
        }
        .dropdown-item:hover {
            background-color: #ddd;
        }
        h1 {
            display: flex;
            justify-content: center;
        }
        body {
            text-align: center;
        }
        .navbar-dark .navbar-nav .nav-link {
    color: rgba(255, 255, 255, .5);
    padding: 14px 45px;
}
.navbar {
    margin-top: -6px;
    border-radius: 5px;
    padding: 20px;
    display: flex;
    flex-direction: row-reverse;
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-right">
    <a class="navbar-brand" href="index.php">خانه</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          
            <li class="nav-item">
                <a class="nav-link" href="#">کاربران</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">نظرات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">منو ها</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    مقالات
                </a>
                <div class="dropdown-menu text-right w-50 float-right  " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addblog.php">افزودن مقالات</a>
                    <a class="dropdown-item" href="blogs.php">مشاهده مقالات</a>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    نویسندگان
                </a>
                <div class="dropdown-menu text-right w-50 float-right" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item" href="addwriter.php">افزودن نویسنده</a>
                    <a class="dropdown-item " href="writers.php">مشاهده نویسندگان</a>
                </div>
            </li>
       
        </ul>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
