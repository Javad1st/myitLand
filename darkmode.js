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
  
  const moon = document.querySelector('.moon');
  const moon2 = document.querySelector('.moon2');
  const isLand1 = document.querySelector('.img1');
  const isLand2 = document.querySelector('.img2');
  
  moon.classList.toggle('unhide', darkmode === 'dark');
  moon2.classList.toggle('unhide', darkmode !== 'dark');
  isLand1.classList.toggle('hidden', darkmode === 'dark');
  isLand2.classList.toggle('unhide', darkmode === 'dark');

  const down = document.getElementById('down');
  down.classList.toggle('rotate180', darkmode === 'dark');
}

function updateTheme() {
  darkmode = localStorage.getItem( 'light');
  toggleTheme();
}

document.addEventListener("DOMContentLoaded", updateTheme);



// //////////////

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

  const moon = document.querySelector('.moon');
  const moon2 = document.querySelector('.moon2');
  const isLand1 = document.querySelector('.img1');
  const isLand2 = document.querySelector('.img2');

  moon.classList.toggle('unhide', darkmode2 === 'dark');
  moon2.classList.toggle('unhide', darkmode2 !== 'dark');
  isLand1.classList.toggle('hidden', darkmode2 === 'dark');
  isLand2.classList.toggle('unhide', darkmode2 === 'dark');


  moon.classList.toggle('unhide', darkmode === 'dark');
  moon2.classList.toggle('unhide', darkmode !== 'dark');
  isLand1.classList.toggle('hidden', darkmode === 'dark');
  isLand2.classList.toggle('unhide', darkmode === 'dark');
});