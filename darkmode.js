let darkmode = localStorage.getItem('darkmode')

const themeSwitch = document.getElementById('theme-switch')
const down =   document.getElementById('down')


const enableDarkmode = () => {
  
  document.body.classList.add('darkmode')
  localStorage.setItem('darkmode', 'active')
}

const disableDarkmode = () => {
  document.body.classList.remove('darkmode')

  localStorage.setItem('darkmode', null)
}

if(darkmode === "active") enableDarkmode()

themeSwitch.addEventListener("click", () => {
  location.reload()
  darkmode = localStorage.getItem('darkmode')
  darkmode !== "active" ? enableDarkmode() : disableDarkmode()
  
})


//////////////

let darkmode2 = localStorage.getItem('darkmode')

const themeSwitch2 = document.getElementById('theme-switch2')
const down2 =   document.getElementById('down2')


const enableDarkmode2 = () => {
  
  document.body.classList.add('darkmode')
  localStorage.setItem('darkmode', 'active')
}

const disableDarkmode2 = () => {
  document.body.classList.remove('darkmode')

  localStorage.setItem('darkmode', null)
}

if(darkmode2 === "active") enableDarkmode2()

themeSwitch2.addEventListener("click", () => {
  location.reload()
  darkmode2 = localStorage.getItem('darkmode')
  darkmode2 !== "active" ? enableDarkmode2() : disableDarkmode2()
  
})


///////////////////

let moon = document.querySelector('.moon')

if(darkmode === "active") {
  moon.classList.add('unhide')
}

let moon2 = document.querySelector('.moon2')

if(darkmode === "active") {
  moon2.classList.add('hidden')
}
/////////////
let isLand2 = document.querySelector('.img2')
let isLand1 = document.querySelector('.img1')

if(darkmode === "active") {
  isLand2.classList.add('unhide')
  isLand1.classList.add('hidden')
}
