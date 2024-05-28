$(document).ready(function() {
    // 取得畫布元素和其2D繪圖上下文
    const canvas = $('#tetris')[0];  // 從HTML文檔中獲取id為'tetris'的元素作為畫布
    const context = canvas.getContext('2d');  // 獲取2D繪圖
    context.scale(30, 30);  // 縮放畫布，使得每個單位代表的像素變成原來的30倍

    // 創建遊戲場地矩陣
    const arena = createMatrix(10, 16); //改canvas大小的話，這裡也要改

    // 設定圖片
    const images = [];
    for (let i = 1; i <= 8; i++) {
        const img = new Image();
        img.src = '../img/game2/toy' + i + '.png';
        images.push(img);
    }

    // 初始化玩家狀態
    const player = {
        pos: {x: 0, y: 0},
        matrix: null,
        score: 0,
        level: 0,
        linesCleared: 0
    };

    // 創建矩陣
    function createMatrix(w, h) {
        const matrix = [];
        for (let y = 0; y < h - 1; y++) { // -1是預留最後一行 放狗狗
            matrix.push(new Array(w).fill(0));  // 創建一個寬度為w的行，每個單元格的初始值都是0
        }
        // 最後一行填滿狗狗
        matrix.push(new Array(w).fill(8));
        return matrix;
    }

    // 建方塊
    function createPiece(type) {
        if (type === 'T') {
            return [
                [0, 0, 0],
                [1, 1, 1],
                [0, 1, 0]
            ];
        } else if (type === 'O') {
            return [
                [2, 2],
                [2, 2]
            ];
        } else if (type === 'L') {
            return [
                [0, 3, 0],
                [0, 3, 0],
                [0, 3, 3]
            ];
        } else if (type === 'J') {
            return [
                [0, 4, 0],
                [0, 4, 0],
                [4, 4, 0]
            ];
        } else if (type === 'I') {
            return [
                [0, 5, 0, 0],
                [0, 5, 0, 0],
                [0, 5, 0, 0],
                [0, 5, 0, 0]
            ];
        } else if (type === 'S') {
            return [
                [0, 6, 6],
                [6, 6, 0],
                [0, 0, 0]
            ];
        } else if (type === 'Z') {
            return [
                [7, 7, 0],
                [0, 7, 7],
                [0, 0, 0]
            ];
        }
    }

    // 用圖片繪製方塊
    function drawMatrix(matrix, offset) {
        matrix.forEach((row, y) => {
            row.forEach((value, x) => {
                if (value !== 0) {
                    context.drawImage(images[value - 1], x + offset.x, y + offset.y, 1, 1);
                }
            });
        });
    }

    // 清空畫布 然後繪製整個遊戲框和玩家方塊
    function draw() {
        context.fillStyle = '#ede0d4';
        context.fillRect(0, 0, canvas.width, canvas.height); //畫一個填充整個畫布的矩形

        drawMatrix(arena, {x: 0, y: 0});  //從左上開始畫遊戲框
        drawMatrix(player.matrix, player.pos);  //畫掉落中方塊
    }

    // 經過每一行列看有沒有方塊 有就合併玩家方塊到場地矩陣中 
    function merge(arena, player) {
        player.matrix.forEach((row, y) => {
            row.forEach((value, x) => {
                if (value !== 0) {  //合併
                    arena[y + player.pos.y][x + player.pos.x] = value;
                }
            });
        });
    }

    // 檢查玩家方塊和場地矩陣是否碰撞 [碰撞了合併/沒碰繼續落]
    function collide(arena, player) {
        const [m, o] = [player.matrix, player.pos];
        for (let y = 0; y < m.length; ++y) {
            for (let x = 0; x < m[y].length; ++x) {
                if (m[y][x] !== 0 &&
                   (arena[y + o.y] &&
                    arena[y + o.y][x + o.x]) !== 0) {
                    return true;
                }
            }
        }
        return false;
    }

    // 旋轉方塊  翻轉矩陣
    function rotate(matrix, dir) {
        for (let y = 0; y < matrix.length; ++y) {
            for (let x = 0; x < y; ++x) {
                [
                    matrix[x][y],
                    matrix[y][x],
                ] = [
                    matrix[y][x],
                    matrix[x][y],
                ];
            }
        }

        if (dir > 0) { //順時針
            matrix.forEach(row => row.reverse());
        } else { //逆時針
            matrix.reverse();
        }
    }

    // 玩家方塊下落 
    function playerDrop() {
        player.pos.y++;  //下移一格
        if (collide(arena, player)) { //檢查碰撞
            player.pos.y--;
            merge(arena, player);
            playerReset();
            arenaSweep();
            updateScore();
        }
        dropCounter = 0;
    }
    // 玩家方塊左右移動
    function playerMove(dir) {
        player.pos.x += dir;
        if (collide(arena, player)) {
            player.pos.x -= dir;
        }
    }
    // 新的玩家方塊
    function playerReset() {
        const pieces = 'ILJOTSZ';
        player.matrix = createPiece(pieces[pieces.length * Math.random() | 0]);
        player.pos.y = 0;
        player.pos.x = (arena[0].length / 2 | 0) - (player.matrix[0].length / 2 | 0);
        if (collide(arena, player)) { //檢查是否跟遊戲框碰撞
            gameOver();
        }
    }

    // 清除已滿的行
    function arenaSweep() {
        let rowCount = 0;
        outer: for (let y = arena.length - 2; y > 0; --y) {  // 從倒數第二行開始遍歷場地
            for (let x = 0; x < arena[y].length; ++x) {
                if (arena[y][x] === 0) {
                    continue outer;  // 如果該行有任何一個單元格為0，則跳過該行
                }
            }

            // 已滿的行
            const row = arena.splice(y, 1)[0].fill(0);  // 刪除並返回一個全為0的數組
            arena.unshift(row);  // 在頂部添加新的空行
            ++y;
            rowCount++;   // 增加已清除行的計數
            player.linesCleared++;  // 增加玩家已清除行的計數
            
            // 每清除10行，提高玩家等級，並加快方塊下落速度
            if (player.linesCleared % 10 === 0) {
                player.level++;
                updateLevel();
                dropInterval *= 0.5; // 加快下落速度
            }

             // 根據已清除行數更新玩家分數
            player.score += calculateScore(rowCount);
        }
    }

    // 計算分數
    function calculateScore(rowCount) {
        if (rowCount === 1) {
            return 10;
        } else if (rowCount === 2) {
            return 25;
        } else {
            return calculateScore(rowCount - 1) * rowCount;
        }
    }
    // 更新分數顯示
    function updateScore() {
        $('#game2_score').text('Score: ' + player.score);
    }
    // 更新等級顯示
    function updateLevel() {
        $('#game2_level').text('Level: ' + player.level);
    }

    // 結束遊戲
    function gameOver() {
        alert('Game Over!');
        resetGame();
    }

    // 開始新遊戲
    function resetGame() {

        for (let y = 0; y < arena.length - 1; ++y) { // 從第一行開始清除，到倒數第二行
            arena[y].fill(0); // 清除每一行
        }
    
        
        // 重置分數、等級、已消除行數、方塊掉落速度
        player.score = 0;
        player.level = 0;
        player.linesCleared = 0;
        dropInterval = 1000;
        // 更新顯示的分數等級
        updateScore();
        updateLevel();
        playerReset();
    }

    // 點擊開始新遊戲
    $('#game2_restart').click(function() {
        resetGame();
    });

    let dropCounter = 0;
    let dropInterval = 1000;

    let lastTime = 0;
    // 更新遊戲狀態
    function update(time = 0) {
        const deltaTime = time - lastTime;
        lastTime = time;

        dropCounter += deltaTime;
        if (dropCounter > dropInterval) {
            playerDrop();
        }

        draw();
        requestAnimationFrame(update);
    }

    // 監聽旋轉、移動
    $(document).keydown(event => {
        if (event.keyCode === 37) {
            playerMove(-1); // 左移
        } else if (event.keyCode === 39) {
            playerMove(1); // 右移
        } else if (event.keyCode === 40) {
            playerDrop(); // 下移
        } else if (event.keyCode === 52) {
            playerRotate(-1); // 逆時針旋轉 4(A 鍵)65
        } else if (event.keyCode === 54) {
            playerRotate(1); // 順時針旋轉 6(D 鍵)68
        }
    });

    // 旋轉玩家方塊 玩家控制方塊的旋轉功能，在
    function playerRotate(dir) {
        const pos = player.pos.x;
        let offset = 1;
        rotate(player.matrix, dir);
        // 旋轉後檢查碰撞並根據情況調整方塊位置
        while (collide(arena, player)) {
            player.pos.x += offset;
            offset = -(offset + (offset > 0 ? 1 : -1));
            if (offset > player.matrix[0].length) {
                rotate(player.matrix, -dir);
                player.pos.x = pos;
                return;
            }
        }
    }

    playerReset();
    updateScore();
    updateLevel();
    update();
});