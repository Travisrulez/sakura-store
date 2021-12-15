const form = document.querySelector('#sort')
const select = document.querySelector('#sortby')
console.log(form)
select.addEventListener('change', () => {
    form.submit()
})