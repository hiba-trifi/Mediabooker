
AOS.init();
const notificationSidebar = document.querySelector('.notification-sidebar');
const notificationIcon = document.querySelector('.notification-icon');
const closeBtn = document.querySelector('.close-btn');

notificationIcon.addEventListener('click', () => {
    notificationSidebar.style.right = '0';
});

closeBtn.addEventListener('click', () => {
    notificationSidebar.style.right = '-300px';
});