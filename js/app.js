let hamburger = document.querySelector('#hamburger')
let closes = document.querySelector('#close')
let menu = document.querySelector('.home .menu-lateral')

hamburger.addEventListener('click', () => {
    menu.classList.add('open')
})
closes.addEventListener('click', () => {
    menu.classList.remove('open')
})