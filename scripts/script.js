document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.remove('preload')
})

const menuIcon = document.querySelector('.menu-icon')
const closeMenuIcon = document.querySelector('.close-menu-icon')
const menu = document.querySelector('.mobile-menu')
const overlay = document.querySelector('.overlay')

const openMenu = () => {
    menu.classList.add('active')
    overlay.style.opacity = '1'
    overlay.style.visibility = 'visible'
    document.body.classList.add('locked')
}

const closeMenu = () => {
    menu.classList.remove('active')
    overlay.style.opacity = '0'
    overlay.style.visibility = 'hidden'
    document.body.classList.remove('locked')
}

menuIcon.addEventListener('click', openMenu)
closeMenuIcon.addEventListener('click', closeMenu)
overlay.addEventListener('click', closeMenu)