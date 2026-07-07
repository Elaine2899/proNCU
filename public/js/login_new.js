document.addEventListener("DOMContentLoaded", function() {
    var loginForm = document.getElementById('loginForm');
    var prefix = window.location.pathname.indexOf('/proncu/public') !== -1 ? '/proncu/public' : '';
    
    // 儲存被點擊的按鈕值 (登入 或 註冊)
    var submitValue = '';
    
    var buttons = document.querySelectorAll('input[name="action"]');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            submitValue = button.value;
        });
    });

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // 防止預設提交

        if (submitValue === '登入') {
            loginForm.action = prefix + '/welcome/login';
            loginForm.submit();
        } else if (submitValue === '註冊') {
            var studentId = document.getElementById('sid').value.trim();
            var password = document.getElementById('ps').value.trim();
            
            if (studentId === '' || password === '') {
                alert('請先輸入學號與密碼再進行註冊！');
                return;
            }
            
            // 彈出註冊用戶名 Modal
            var myModal = new bootstrap.Modal(document.getElementById('RegisterModal'));
            myModal.show();
        }
    });

    // 點擊 Modal 內的送出按鈕
    document.getElementById('confirm-register-btn').addEventListener('click', function() {
        var username = document.getElementById('register-user-name').value.trim();
        if (username === '') {
            alert('請輸入用戶名！');
            return;
        }
        
        document.getElementById('register-hidden-username').value = username;
        loginForm.action = prefix + '/welcome/register';
        loginForm.submit();
    });
});
