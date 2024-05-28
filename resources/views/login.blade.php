<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <form class="flex-fill d-flex flex-column align-self-center" method="POST">
                    @csrf
                        <div class="d-flex flex-column flex-fill justify-content-center">
                            <input class="align-self-center pd-5" type="text" placeholder="學號" class="form-control" name="studentid" id="sid">
                            <input class="align-self-center pd-5" type="password" placeholder="密碼" class="form-control" name="password" id="ps">
                        </div>
                        <!-- 送出 -->
                        <div class="d-flex justify-content-center row pb-5">
                            <input class="login-btn col p-2" id="submit " button type="submit" value="登入">
                            <button class="register-btn col p-2" type="button" onclick="register()">註冊</button>
                        </div>
                   </form>
                </div>
                
            </div>
        </div>
        
        
    </div>

    <script>
    function register() {
        document.querySelector('form').submit();
    }
</script>
</body>
</html>