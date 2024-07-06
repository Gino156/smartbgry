document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');

    menuToggle.addEventListener('click', function () {
        menuToggle.classList.toggle('active');
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
    });
});
