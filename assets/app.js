import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/appBase.css';

document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.img_body img');

    images.forEach(image => {
        image.addEventListener('click', function() {
            this.classList.toggle('enlarged');
        });
    });
});

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
