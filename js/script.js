const autBlock = document.querySelector('#aut') // autorize block
const regBlock = document.querySelector('#reg') // registration block

// смена формы регистрации/авторизации

document.querySelector('#registr').addEventListener('click', () => {
    regBlock.classList.add('active__block')
    autBlock.classList.remove('active__block')
})

document.querySelector('#autoriz').addEventListener('click', () => {
    autBlock.classList.add('active__block')
    regBlock.classList.remove('active__block')
    regBlock.style.display = 'none'
})