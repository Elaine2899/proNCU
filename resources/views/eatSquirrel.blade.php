<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{asset('img/squirrel_o.png')}}">
    <title>貪食松鼠</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/eatSquirrel.css')}}" />
  </head>
  <body style="height: 100vh; background-image: url('./side-squirrel.png')">
    <div class="d-flex justify-content-center" style="height: 100vh;">
      
      <div class="p-2 d-flex align-items-center">
        <canvas
          id="eatSquirrel"
          width="510"
          height="450"
          style="background-color: #EDE0D4"
        ></canvas>
      </div>
      <div class="p-2 text-center" style="margin-left: 100px; margin-top: 150px;">
        <p id="myScore"></p>
        <p id="myScore2"></p>
        <button type="button" id="Start" onclick="location.reload()">
          開始新遊戲
        </button>
      </div>
    </div>
    <script src="{asset('js/eatSquirrel.js')}}"></script>
    <!-- <script src="{{asset('js/eatSquirrel_wall.js')}}"></script> -->
  </body>
</html>