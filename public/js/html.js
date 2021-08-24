const renderLoader = () => {
    return `
        <div class="calendar-table-list-loader">
           <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M75.4 126.63a11.43 11.43 0 0 1-2.1-22.65 40.9 40.9 0 0 0 30.5-30.6 11.4 11.4 0 1 1 22.27 4.87h.02a63.77 63.77 0 0 1-47.8 48.05v-.02a11.38 11.38 0 0 1-2.93.37z" fill="#636e72"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1200ms" repeatCount="indefinite"></animateTransform></g></svg>
        </div>
    `
};

const renderText = text => `<div class="calendar-table-list-text">${text}</div>`;

const createToastItem = (title, options = {}, status = 'success') => {
    const toastsWrap = document.querySelector('.toast-container');

    const toastWrap = document.createElement('div');
    toastWrap.classList.add('toast', 'show', 'align-items-center', 'text-white', 'border-0', `bg-${status}`);
    toastWrap.setAttribute('role', 'alert');
    toastWrap.setAttribute('aria-live', 'assertive');
    toastWrap.setAttribute('aria-atomic', 'true');
    toastWrap.innerHTML = `
        <div class="d-flex">
            <div class="toast-body text-white">${title}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
        </div>
    `;
    toastsWrap.appendChild(toastWrap);
    return new bootstrap.Toast(toastWrap, options);
}