function startGame(){
    window.location.href = 'game.html'
}
document.body.onkeyup = function (e) {
    if (e.keyCode === 32) {
        startGame()
    }
}
function submitScore() {
    if (confirm('Your final score is ' + score + ' if you would like to submit it, press the OK button down below')) {
        document.body.innerHTML += `
        <form action="../php_db_update/dbu_shooter_game.php" method="post">
            <input id="shooter_score" type="number" name='shooter_score' placeholder='shooter_score' value="${score}">
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
let target = document.getElementById("target")
let shootingRange = document.getElementById("shootingRange")
let score = 0;
let clickedAmount = 0;
let points = document.getElementById("points")

target.style.display = "none"

target.addEventListener("click",function clicked(){
    let randomTop = getRandomNumber(0, 750);
    let randomLeft = getRandomNumber(0, 1080);
    clickedAmount++;
    score += 2;
    points.innerText = "Score: " + score;
    if (clickedAmount++){
        target.style.marginTop = randomTop + "px";
        target.style.marginLeft = randomLeft + "px";
    }
    console.log(randomLeft)
})

shootingRange.addEventListener("click", function (){
    if(score > 1){
        score -= 1;
        points.innerText = "Score: " + score;
    }
})


let countdown = document.getElementById("countdown")
let time = document.getElementById("time")

let x = 4;
let y = 35;

function setTimer(){
    setInterval(countDown, 1000)
}
function setTimerTwo(){
    setInterval(countDownTwo, 1000)
}
function countDown(){
    if (x >= 0){
        x--;
    }
    if (x > 0){
        countdown.innerText = x;
    }
    else if (x === 0){
        countdown.innerText = "GO!"
    }
    else{
        countdown.innerText = "";
        target.style.display = "inherit"
    }
}

function countDownTwo(){
    if (y >= 0){
        y--;
    }
    if (y > 0){
        time.innerText = "Time left: " + y;
    }
    else if (y === 2){
        time.innerText = "TIME IS UP!"
    }
    else if (y === 1){
        time.innerText = "TIME IS UP!"
    }
    else if (y <= 0){
        document.body.innerHTML ="";
        submitScore();
    }
    document.body.onkeyup = function (e){
        if (e.keyCode === 32){
            window.location.href = "Shooting_Range.html"
        }
    }
}


setTimeout(setTimer, 0)
setTimeout(setTimerTwo, 0)



function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}



