document.addEventListener("DOMContentLoaded", function() {
    // 確保DOM完全載入後才執行
    
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // 防止表單默認提交行為

        // 查找所有具有 name="action" 屬性的按鈕
        var buttons = document.querySelectorAll('input[name="action"]');

        // 變量來保存哪個按鈕被按下
        var submitValue = '';

        // 為每個按鈕添加click事件監聽器
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                submitValue = button.value; // 保存按下按鈕的值
                //根據按鈕的值來決定提交到哪個路徑
                let prefix = window.location.pathname.indexOf('/proncu/public') !== -1 ? '/proncu/public' : '';
                if (submitValue === '登入') {
                    loginForm.action = prefix + '/welcome/login'; // 登入路徑
                    loginForm.submit();
                } else if (submitValue === '註冊') {
                    loginForm.action = prefix + '/welcome/register'; // 註冊路徑
                    loginForm.submit();
                }
                
            });
        });

    });
});
