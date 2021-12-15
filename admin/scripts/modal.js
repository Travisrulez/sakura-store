// Modal Animation
const modal = document.querySelector('.modal');
setTimeout(() => {
    modal.style.transform = 'translateY(0)';
    setTimeout(() => {
        modal.style.transform = '';
    }, 3000);
}, 500);

// Show modal
const submitBtn = document.querySelector('.submit input');
submitBtn.addEventListener('click', () => {
    sessionStorage.setItem('showModal', 1);
});

checkSession();
function checkSession() {
    if (sessionStorage.getItem('showModal')) {
        modal.style.display = 'flex';
        sessionStorage.removeItem('showModal');
    }
}