document.addEventListener('DOMContentLoaded', function() {
    const userPhoto = localStorage.getItem('user-img');
    const userName = localStorage.getItem('user-name');

    if (userPhoto && userName) {
        document.getElementById('user-photo').src = userPhoto;
        document.getElementById('user-name').textContent = userName;
    }
});