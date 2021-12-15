const loupe = document.querySelectorAll('.loupe');
const fullSize = document.querySelector('.fullsize-image');
const overlay = document.querySelector('.overlay');

function openImage(e) {
    const image = e.target.parentElement.querySelector('img');
    const imagePath = image.getAttribute('src');
    fullSize.innerHTML = `<img src="${imagePath}"><div class="close-image">&times;</div>`;
    fullSize.style.cssText = `transform: translate(-50%, -50%) scale(1); opacity: 1;`;
    overlay.style.cssText = `opacity: 1; visibility: visible;`;

    const closeBtn = document.querySelector('.close-image');
    closeBtn.addEventListener('click', closeImage);
}

function closeImage() {
    fullSize.style.cssText = `transform: translate(-50%, -50%) scale(0); opacity: 0;`;
    overlay.style.cssText = `opacity: 0, visibility: hidden;`;
}

document.body.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeImage(e);
    }
});
overlay.addEventListener('click', closeImage);

loupe.forEach(item => {
    item.addEventListener('click', openImage);
});


