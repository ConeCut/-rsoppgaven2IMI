//cookie clicker javascript
let cookie_score_num = 0;

function increment() {
    let cookie = document.getElementById("cookie")
    let cookie_score = document.getElementById("cookie_score")
    cookie_score_num += 1;
    cookie_score.innerText = "Score" + " " + cookie_score_num
}

function submitScore() {
    if (confirm('Your final score is ' + cookie_score_num + ' if you would like to submit it, press the OK button down below')) {
        document.body.innerHTML += `
        <form action="../php_db_update/dbu_cookie_clicker.php" method="post">
            <input id="cookie_score" type="number" name='cookie_score' placeholder='cookie_score' value="${cookie_score_num}">
            <button id="form-submit-button">Submit Score</button>
        </form>
        `
        // click submit button
        let submitButton = document.querySelector("#form-submit-button");
        submitButton.click();
    } else {
        window.location.reload()
    }
}
//snake code

function confirmationBox() {
    if (confirm('Your final score is ' + snakeScore + ' if you would like to submit it, press the OK button down below')) {

        // inject form and submit it lmao
        document.body.innerHTML += `
        <form action="../php_db_update/dbu_snake.php" method="post">
            <input id="snake_score" type="number" name='snake_score' placeholder='snake_score' value="${snakeScore}">
            <button id="form-submit-button">Submit Score</button>
        </form>
        `

        // click submit button
        let submitButton = document.querySelector("#form-submit-button");
        submitButton.click();


    } else {
        window.location.reload();
    }
}

let canvas = document.getElementById('game');
let context = canvas.getContext('2d');
let snakeScore = 0;
let snakeScoreTF = document.getElementById("snake_score")
let grid = 16;
let count = 0;

let snake = {
    x: 160,
    y: 160,
    dx: grid,
    dy: 0,
    cells: [],
    maxCells: 4
};
let apple = {
    x: 320,
    y: 320
};

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function loop() {
    requestAnimationFrame(loop);

    if (++count < 4) {
        return;
    }

    count = 0;
    context.clearRect(0, 0, canvas.width, canvas.height);

    snake.x += snake.dx;
    snake.y += snake.dy;

    if (snake.x < 0) {
        snake.x = canvas.width - grid;
    } else if (snake.x >= canvas.width) {
        snake.x = 0;
    }

    if (snake.y < 0) {
        snake.y = canvas.height - grid;
    } else if (snake.y >= canvas.height) {
        snake.y = 0;
    }

    snake.cells.unshift({x: snake.x, y: snake.y});

    if (snake.cells.length > snake.maxCells) {
        snake.cells.pop();
    }

    context.fillStyle = 'red';
    context.fillRect(apple.x, apple.y, grid - 1, grid - 1);

    context.fillStyle = 'blue';
    snake.cells.forEach(function (cell, index) {
        context.fillRect(cell.x, cell.y, grid - 1, grid - 1);

        if (cell.x === apple.x && cell.y === apple.y) {
            snake.maxCells++;
            snakeScore++;
            snakeScoreTF.innerText = "Score" + " " + snakeScore
            apple.x = getRandomInt(0, 25) * grid;
            apple.y = getRandomInt(0, 25) * grid;
        }
        for (let i = index + 1; i < snake.cells.length; i++) {

            if (cell.x === snake.cells[i].x && cell.y === snake.cells[i].y) {
                confirmationBox();

                let snake_score_input = document.getElementById('snake_score');
                snake_score_input.value = snakeScore;
                snake.x = 160;
                snake.y = 160;
                snake.cells = [];
                snake.maxCells = 4;
                snake.dx = grid;
                snake.dy = 0;
                // snakeScore = 0;
                snakeScoreTF.innerText = "Score" + " ";
                apple.x = getRandomInt(0, 25) * grid;
                apple.y = getRandomInt(0, 25) * grid;
            }
        }
    });
}

document.addEventListener('keydown', function (e) {

    // left arrow key
    if (e.which === 37 && snake.dx === 0) {
        snake.dx = -grid;
        snake.dy = 0;
    }
    // up arrow key
    else if (e.which === 38 && snake.dy === 0) {
        snake.dy = -grid;
        snake.dx = 0;
    }
    // right arrow key
    else if (e.which === 39 && snake.dx === 0) {
        snake.dx = grid;
        snake.dy = 0;
    }
    // down arrow key
    else if (e.which === 40 && snake.dy === 0) {
        snake.dy = grid;
        snake.dx = 0;
    } else if (e.which === 13) {
        requestAnimationFrame(loop);
    }
});

//car game code
