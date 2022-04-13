const userMenuButton = document.getElementById('user-menu-button')
const userMenu = document.getElementById('user-menu')

userMenuButton.addEventListener('click', () => {
  userMenu.classList.toggle('hidden')
})
