import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document.addEventListener('DOMContentLoaded', () => {
    toggleModal();
});

function toggleModal() {
    const openModalButton = document.getElementById('loginButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const modal = document.getElementById('loginModal');
    const modalContent = document.querySelector('.modal-content');

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });

    modalContent.addEventListener('click', (event) => {
        event.stopPropagation();
    });
}

