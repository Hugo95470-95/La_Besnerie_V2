import './bootstrap.js';
import './styles/appBase.css';

// document.addEventListener('DOMContentLoaded', function() {
//     const images = document.querySelectorAll('.img_body img');

//     images.forEach(image => {
//         image.addEventListener('click', function() {
//             this.classList.toggle('enlarged');
//         });
//     });
// });


// import './bootstrap.js';
// import './styles/appBase.css';

// Charger dynamiquement les pages
document.addEventListener('turbo:load', () => {


    // Zoomer sur l'image
    // à mettre dans les balises img que l'on veut zoomer
    const images = document.querySelectorAll('.zoomable-image');
    // trouvable sous produit.html.twig et panier
    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-image');

    const closeBtn = document.querySelector('.close');

    if (modal && modalImg && closeBtn) {
        images.forEach(img => {
            img.addEventListener('click', () => {
                modal.style.display = 'block';
                modalImg.src = img.src;
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});
