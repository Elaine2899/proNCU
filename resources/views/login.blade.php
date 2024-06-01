<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resources/img/squirrel_o.png">
    <title>登入</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login_new.css')}}">
    
</head>
<body>
    
    <div class="container-fluid" id="con-login">
        <div class="row align-items-center" style="height: 100vh">
            <!-- 左邊 -->
            <div class="col align-self-center">
                <div>
                    <h1 class="text-center ita" id="login-propro">propro<br>NCU</h1>
                </div>
            </div>
            <!-- 右邊 -->
            <!-- 遮罩 -->
            <div class="col d-flex justify-content-center" id="login-mask" style="height: 100%">
            <!-- 表單框框 -->
                <div class="d-flex flex-column align-self-center" id="login-form">
                    <!-- 登入 -->
                    <div>
                        <h1 class="text-center m-4" id="login">登入</h1>
                    </div>
                    <!-- 表單 -->
                    <form class="flex-fill d-flex flex-column align-self-center" method="POST" id="loginForm">
                    @csrf
                        <div class="d-flex flex-column flex-fill justify-content-center">
                            <input class="align-self-center pd-5" type="text" placeholder="學號" class="form-control" name="studentid" id="sid">
                            <input class="align-self-center pd-5" type="password" placeholder="密碼" class="form-control" name="password" id="ps">
                        </div>
                        <!-- 送出 -->
                        <div class="d-flex justify-content-center row pb-5">

                            <input class="login-btn col p-2" type="submit" name="action" value="登入">
                            <input class="register-btn col p-2" type="submit" name="action" value="註冊">
                            
                        </div>
                   </form>
                </div>
                
            </div>
        </div>        
    </div>

    <div class="modal fade" id="RegisterModal" tabindex="-1" aria-labelledby="RegisterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RegisterModalLabel">請輸入用戶名</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class="mb-3">
                    <label for="register-user-name" class="col-form-label">用戶名:</label>
                    <input type="text" class="form-control" id="register-user-name">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">送出</button>
            </div>
            </div>
        </div>
        </div>

    <script src="{{asset('js/login_new.js')}}"></script>
    @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
    @endif
</body>
</html>