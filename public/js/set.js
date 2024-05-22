document.getElementById('user-settings-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const selectedImage = document.querySelector('input[name="user-img"]:checked').value;
    const userName = document.getElementById('user-name').value;

    localStorage.setItem('user-img', selectedImage);
    localStorage.setItem('user-name', userName);

    
    window.location.href = 'homepage.html';
});