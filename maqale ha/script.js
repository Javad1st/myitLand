let darkmode = localStorage.getItem('darkmode' , 'light');


const themeSwitch = document.getElementById('theme-switch');

const enableDarkmode = () => {
  document.body.classList.add('darkmode');
  localStorage.setItem('darkmode', 'active');
};

const disableDarkmode = () => {
  document.body.classList.remove('darkmode');
  localStorage.setItem('darkmode', null);
};

if (darkmode === "active") enableDarkmode();

themeSwitch.addEventListener("click", toggleTheme);

function toggleTheme() {
  darkmode = darkmode === 'light' ? 'dark' : 'light';
  localStorage.setItem('darkmode', darkmode);
  
  document.body.classList.toggle('darkmode', darkmode === 'dark');
}

//////////////////

let darkmode2 = localStorage.getItem('darkmode') || 'light';

const themeSwitch2 = document.getElementById('theme-switch2');
const down2 = document.getElementById('down2');

const enableDarkmode2 = () => {
  document.body.classList.add('darkmode');
  localStorage.setItem('darkmode', 'active');
};

const disableDarkmode2 = () => {
  document.body.classList.remove('darkmode');
  localStorage.setItem('darkmode', null);
};

if (darkmode2 === "active") enableDarkmode2();

themeSwitch2.addEventListener("click", () => {
  darkmode2 = darkmode2 === 'light' ? 'dark' : 'light';
  localStorage.setItem('darkmode', darkmode2);

  document.body.classList.toggle('darkmode', darkmode2 === 'dark');
});
//////////////////
document.querySelector('.hamburger-icon').addEventListener('click', () => {
  const menu = document.getElementById('menu');
  menu.classList.toggle('menu-open');
});

document.getElementById('close-icon').addEventListener('click', () => {
  const menu = document.getElementById('menu');
  menu.classList.remove('menu-open');
});
// کنترل باز و بسته شدن منوی همبرگری

// کنترل باز و بسته شدن زیرمنوها
document.querySelectorAll('.menu-btn').forEach(button => {
  button.addEventListener('click', () => {
      const dropdownContent = button.nextElementSibling;
      const icon = button.querySelector('.icon');

      dropdownContent.classList.toggle('show');
      icon.classList.toggle('rotate');
  });
});

/////////////

const cat1 = document.querySelector('.cat1');
const cat2 = document.querySelector('.cat2');
const cat3 = document.querySelector('.cat3');
const cat4 = document.querySelector('.cat4');
const cat5 = document.querySelector('.cat5');

cat1.document.addEventListener('click' , () => {
 
  cat1.classList.add('click')

});
cat2.document.addEventListener('click' , () => {
 
  cat2.classList.add('click')

});
cat3.document.addEventListener('click' , () => {
 
  cat3.classList.add('click')

});
cat4.document.addEventListener('click' , () => {
 
  cat4.classList.add('click')

});
cat5.document.addEventListener('click' , () => {
 
  cat5.classList.add('click')

});