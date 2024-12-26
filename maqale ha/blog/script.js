
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
