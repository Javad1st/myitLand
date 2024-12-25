<header>
      <div class="partOfHeader partOfHeader1">
        <img class="logo" src="tasavir/4695738.webp" alt="">
      </div>
      <div class="partOfHeader partOfHeader2">
        <!-- About Us Dropdown -->
        <div class="headerButton headerButton1" onclick="toggleDropdown('aboutDropdown')">درباره ما <svg
            xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
            style="fill: #1B4332; background-color: white; border-radius: 50%;">
            <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
          </svg> </div>
        <div id="aboutDropdown" class="dropdownContent">
          <a href="/overview" class="dropdownItem">Overview</a>
          <a href="/team" class="dropdownItem">Team</a>
          <a href="/careers" class="dropdownItem">Careers</a>
        </div>
        
        <!-- Support Dropdown -->
        <div class="headerButton headerButton2">پشتیبانی </div>
        
        
        <!-- Home Dropdown -->
        <div class="headerButton headerButton3" onclick="toggleDropdown('homeDropdown')">درس ها <svg
          xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
          style="fill: #1B4332;background-color: white; border-radius: 50%;">
          <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
        </svg></div>
        <div id="homeDropdown" class="dropdownContent dropdownContent1">
          <a href="maqale ha/maqale.php" class="dropdownItem dropdownItem1"><svg class="iconA" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path d="M2 7v1l11 4 9-4V7L11 4z"></path>
              <path
              d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z">
            </path>
          </svg>دوره ها</a>
          <a href="/news" class="dropdownItem dropdownItem2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 20" style="fill: var(--zed);">
            <path
                d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
              </path>
            </svg>دسته بندی ها</a>
            <a href="#category" class="dropdownItem dropdownItem3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path
                d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z">
              </path>
              <path d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z"></path>
            </svg>اخبار</a>
          <a href="/main" class="dropdownItem dropdownItem4"><svg xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path
              d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h8a.996.996 0 0 0 .707-.293l7-7a.997.997 0 0 0 .196-.293c.014-.03.022-.061.033-.093a.991.991 0 0 0 .051-.259c.002-.021.013-.041.013-.062V5c0-1.103-.897-2-2-2zM5 5h14v7h-6a1 1 0 0 0-1 1v6H5V5zm9 12.586V14h3.586L14 17.586z">
            </path>
          </svg>مقالات رایگان</a>
          <a href="/main" class="dropdownItem dropdownItem5"><svg xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" style="fill: var(--zed);">
              <path
              d="M20 13.01h-7V10h1c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h1v3.01H4V18H3v4h4v-4H6v-2.99h5V18h-1v4h4v-4h-1v-2.99h5V18h-1v4h4v-4h-1v-4.99zM10 8V4h4l.002 4H10z">
            </path>
          </svg>رود مپ</a>
          <div class="dropdownC">
            <h2>پیشنهاد آیتی لند :</h2>
            <p>مقاله جاوا اسکریپت و مقاله پی اچ پی</p>
          </div>
        </div>
        <div class="headerButton headerButton4">
        <?php if (isset($_SESSION['user_email'])) { echo '<a class="linkTwo" href="logout.php">خروج از حساب </a>'; } 
        
        
        else {  
          
          
          echo '<a class="linkOne" href="./login/login.php">ورود</a>'; 
          echo '<a class="linkTwo" href="./login/rgister.php">ثبت‌نام</a>'; 
        } 
        
        ?>
        </div>
      </div>
      <div class="partOfHeader partOfHeader3">
        <div class="headerTitle">
            
                <h4>itland</h4>
            
        </div>
        
        
      </div>
      <div class="partOfHeader partOfHeader4">
        <button id="theme-switch">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path
            d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path
            d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
          </svg>
        </button>
      </div>
      <div class="hamburger-menu">
        <div class="hamburger-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
          style="fill: white; ">
            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
          </svg></div>
          <div class="menu" id="menu">
            <div class="headOfMenu">
            <div class="close-icon" id="close-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" style="fill: var(--base-color);">
                <path
                  d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z">
                </path>
              </svg></div> <!-- آیکون ضربدر -->
            <button id="theme-switch2">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                <path
                d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                <path
                d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
              </svg>
            </button>
            <div class="headerButton headerButton4">
              <a class="linkOne" href="login/login.php">ورود</a>
              <a class="linkTwo" href="login/rgister.php">ثبت نام</a>
            </div>
          </div>
          <div class="menu-item">
            <button class="menu-btn">
              درس ها
              <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: var(--text-color);">
                <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
              </svg></span>
              
            </button>
            <div class="dropdown-content">
              <a href="maqale ha/maqale.php">مقالات</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
            </div>
          </div>
          <!-- بقیه منو ها... -->
          <div class="menu-item">
            <button class="menu-btn">
              درباره ما
              <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: var(--text-color);">
                <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
              </svg></span>
            </button>
            <div class="dropdown-content">
              <a href="#">لینک 1</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
            </div>
          </div>

          <div class="menu-item">
            <button class="menu-btn">
              پشتیبانی
              <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  style="fill: var(--text-color)">
                  <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                </svg></span>
            </button>
            <div class="dropdown-content">
              <a href="#">لینک 1</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
            </div>
          </div>
        </header>
        
