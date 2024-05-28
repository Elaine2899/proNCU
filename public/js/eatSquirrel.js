// 獲取畫布元素和其2D渲染上下文
const canvas = document.getElementById("eatSquirrel");
const ctx = canvas.getContext("2d");
// 設定單位格大小、行列數、顏色 
const unit = 30; 
const row = canvas.height / unit;
const column = canvas.width / unit;
const backgroundColor = "#EDE0D4";

// 初始化松鼠陣列和位置變更變數
let squirrel = [];
let positionChange = null;

// 創建初始的松鼠
function createSquirrel() {
  for(let i = 0; i < 4; i++){
    squirrel[i] = {
        x: (4 - i) * unit,  // 設置松鼠每個部分的位置
        y: 0,
        dir: "Right"// 設置初始方向為右
    }
}
}

// 處理松果的位置和繪製
class Fruit {
  constructor() {
    //隨機生成松果的位置
    this.x = Math.floor(Math.random() * column) * unit;
    this.y = Math.floor(Math.random() * row) * unit;
  }

  // 在畫布上繪製松果
  drawFruit() {
    const pineconeImg = new Image();
    pineconeImg.src = '../img/eatSquirrel/pinecone.png';
    pineconeImg.onload = () => {
      ctx.drawImage(pineconeImg, this.x, this.y, unit, unit);
    };
  }

  // 選擇松果的新位置
  pickALocation() {
    let overlapping = false;
    let new_x;
    let new_y;

    // 檢查新位置是否與松鼠的位置重疊
    function checkOverlap(new_x, new_y) {
      for (let i = 0; i < squirrel.length; i++) {
        if (new_x == squirrel[i].x && new_y == squirrel[i].y) {
          overlapping = true;
          return;
        } else {
          overlapping = false;
        }
      }
    }
    // 持續選擇新位置直到沒有重疊
    do {
      new_x = Math.floor(Math.random() * column) * unit;
      new_y = Math.floor(Math.random() * row) * unit;
      checkOverlap(new_x, new_y);
    } while (overlapping);

    // 設置水果的新位置
    this.x = new_x;
    this.y = new_y;
  }
}

// 創建初始的松鼠、新松果
createSquirrel();
let myFruit = new Fruit();

// 添加鍵盤輸入事件監聽器來改變松鼠的方向
window.addEventListener("keydown", changeDirection);
let d = "Right";
function changeDirection(e) {
  let newDirection;
  if (e.key == "ArrowRight" && d != "Left") {
    newDirection = "Right";
  } else if (e.key == "ArrowDown" && d != "Up") {
    newDirection = "Down";
  } else if (e.key == "ArrowLeft" && d != "Right") {
    newDirection = "Left";
  } else if (e.key == "ArrowUp" && d != "Down") {
    newDirection = "Up";
  }

  // 如果方向有變化，更新方向和位置變更
  if (newDirection) {
    d = newDirection;
    positionChange = { x: squirrel[0].x, y: squirrel[0].y, dir: newDirection };
    window.removeEventListener("keydown", changeDirection);
  }
}

// 最高分數相關變數
let highestScore;
loadHighestScore();
let score = 0;
// 更新分數顯示
document.getElementById("myScore").innerHTML = "遊戲分數:" + score;
document.getElementById("myScore2").innerHTML = "最高分數:" + highestScore;

// 定義松鼠圖片
const squirrelImages = {
  Up: {
    head: new Image(),
    mid: new Image(),
    tail: new Image(),
  },
  Right: {
    head: new Image(),
    mid: new Image(),
    tail: new Image(),
  },
  Down: {
    head: new Image(),
    mid: new Image(),
    tail: new Image(),
  },
  Left: {
    head: new Image(),
    mid: new Image(),
    tail: new Image(),
  }
};

// 設置松鼠圖片的來源
squirrelImages.Up.head.src = '../img/eatSquirrel/squirrel_head_up.png';
squirrelImages.Up.mid.src = '../img/eatSquirrel/squirrel_mid_up.png';
squirrelImages.Up.tail.src = '../img/eatSquirrel/squirrel_tail_up.png';

squirrelImages.Right.head.src = '../img/eatSquirrel/squirrel_head_right.png';
squirrelImages.Right.mid.src = '../img/eatSquirrel/squirrel_mid.png';
squirrelImages.Right.tail.src = '../img/eatSquirrel/squirrel_tail_right.png';

squirrelImages.Down.head.src = '../img/eatSquirrel/squirrel_head_down.png';
squirrelImages.Down.mid.src = '../img/eatSquirrel/squirrel_mid_down.png';
squirrelImages.Down.tail.src = '../img/eatSquirrel/squirrel_tail_down.png';

squirrelImages.Left.head.src = '../img/eatSquirrel/squirrel_head_left.png';
squirrelImages.Left.mid.src = '../img/eatSquirrel/squirrel_mid.png';
squirrelImages.Left.tail.src = '../img/eatSquirrel/squirrel_tail_left.png';

// 繪製畫面更新函數
function draw() {
  // 檢查松鼠是否撞到自己
  for (let i = 1; i < squirrel.length; i++) {
    if (squirrel[i].x == squirrel[0].x && squirrel[i].y == squirrel[0].y) {
      clearInterval(myGame);
      alert("你死了!!!!!!");
      return;
    }
  }

  // 填充背景
  ctx.fillStyle = backgroundColor;
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  
  // 繪製松果
  myFruit.drawFruit();

  // 繪製松鼠的每個部分
  for (let i = 0; i < squirrel.length; i++) {
    let currentDirection = squirrel[i].dir;

    // 如果位置變更，更新當前方向
    if (positionChange && squirrel[i].x === positionChange.x && squirrel[i].y === positionChange.y) {
      currentDirection = positionChange.dir;
    }

    // 繪製松鼠的頭、身體和尾巴
    if (i == 0) {
      ctx.drawImage(squirrelImages[d].head, squirrel[i].x, squirrel[i].y, unit, unit);
    } else if (i == squirrel.length - 1) {
      ctx.drawImage(squirrelImages[currentDirection].tail, squirrel[i].x, squirrel[i].y, unit, unit);
    } else {
      ctx.drawImage(squirrelImages[currentDirection].mid, squirrel[i].x, squirrel[i].y, unit, unit);
    }

    // 處理邊界情況，讓松鼠能夠從一邊穿過到另一邊
    if (squirrel[i].x >= canvas.width) {
      squirrel[i].x = 0;
    }
    if (squirrel[i].x < 0) {
      squirrel[i].x = canvas.width - unit;
    }
    if (squirrel[i].y >= canvas.height) {
      squirrel[i].y = 0;
    }
    if (squirrel[i].y < 0) {
      squirrel[i].y = canvas.height - unit;
    }

    // 更新松鼠的方向
    squirrel[i].dir = currentDirection;
  }

  // 根據方向移動松鼠的頭部位置
  let squirrelX = squirrel[0].x;
  let squirrelY = squirrel[0].y;
  if (d == "Left") {
    squirrelX -= unit;
  } else if (d == "Up") {
    squirrelY -= unit;
  } else if (d == "Right") {
    squirrelX += unit;
  } else if (d == "Down") {
    squirrelY += unit;
  }

  // 創建新頭部
  let newHead = { x: squirrelX, y: squirrelY, dir: d };

  // 如果松鼠吃到松果，重新選擇松果位置並增加分數
  if (squirrel[0].x == myFruit.x && squirrel[0].y == myFruit.y) {
    myFruit.pickALocation();
    score++;
    setHighestScore(score);
    document.getElementById("myScore").innerHTML = "遊戲分數:" + score;
    document.getElementById("myScore2").innerHTML = "最高分數:" + highestScore;
  } else {
    // 否則移除尾部
    squirrel.pop();
  }

  // 在陣列開頭插入新頭部
  squirrel.unshift(newHead);
  // 重新添加鍵盤事件監聽器
  window.addEventListener("keydown", changeDirection);
}

// 設置遊戲循環，間隔時間為100毫秒
let myGame = setInterval(draw, 100);

// 加載最高分數的函數
function loadHighestScore() {
  // 檢查localStorage中是否存在最高分數
  if (localStorage.getItem("highestScore") == null) {
    highestScore = 0;  // 如果不存在，設置最高分數為0
  } else {
    // 如果存在，將其轉換為數字並設置為最高分數
    highestScore = Number(localStorage.getItem("highestScore"));
  }
}

// 設置最高分數的函數
function setHighestScore(score) {
  // 如果當前分數大於最高分數，更新最高分數
  if (score > highestScore) {
    localStorage.setItem("highestScore", score);
    highestScore = score;
  }
}