var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
var ballRadius = canvas.width / 80;
var x = canvas.width / 2;
var y = canvas.height - (canvas.height / 15);
var dx = canvas.width / 150;
var dy = -canvas.width / 150;
var paddleHeight = canvas.height / 20;
var paddleWidth = canvas.width / 8;
var paddleX = (canvas.width - paddleWidth) / 2;
var rightPressed = false;
var leftPressed = false;
var brickRowCount = 9;
var brickColumnCount = 3;
var brickWidth = canvas.width / (brickRowCount + 3);
var brickHeight = canvas.height / 16;
var brickPadding = canvas.width / (brickRowCount + 50);
var brickOffsetTop = canvas.height / 10;
var brickOffsetLeft = canvas.width / (brickRowCount + 10);
var ladrillo = new Image();
ladrillo.src = "../imagenes/canvas/ladrillo.png";
var bola = new Image();
bola.src = "../imagenes/canvas/bola.png";
var tabla = new Image();
tabla.src = "../imagenes/canvas/tabla.png";
var score = 0;
var lives = 3;

var bricks = [];
for (var c = 0; c < brickColumnCount; c++) {
    bricks[c] = [];
    for (var r = 0; r < brickRowCount; r++) {
        bricks[c][r] = { x: 0, y: 0, status: 1 };
    }
}

document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);

function keyDownHandler(e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = true;
    } else if (e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = true;
    }
}

function keyUpHandler(e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = false;
    } else if (e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = false;
    }
}

function drawBall() {
    ctx.drawImage(bola, x - ballRadius, y - ballRadius, ballRadius * 2, ballRadius * 2);
}

function drawPaddle() {
    ctx.drawImage(tabla, paddleX, canvas.height - paddleHeight - 5, paddleWidth, paddleHeight);
}

function drawBricks() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            if (bricks[c][r].status == 1) {
                var brickX = (r * (brickWidth + brickPadding)) + brickOffsetLeft;
                var brickY = (c * (brickHeight + brickPadding)) + brickOffsetTop;
                bricks[c][r].x = brickX;
                bricks[c][r].y = brickY;
                ctx.drawImage(ladrillo, brickX, brickY, brickWidth, brickHeight);
            }
        }
    }
}

function showCustomDialog(message, type) {
    const popup = document.createElement("div");
    popup.classList.add("custom-popup");
    popup.innerHTML = `
    <div class="message">${message}</div>
    <div class="score">Tu puntuación: ${score}</div>
    <div class="buttons">
      <button class="restart">Reiniciar partida</button>
      <button class="exit">Salir</button>
    </div>
  `;
    if (type === "success") {
        popup.classList.add("success");
    } else if (type === "error") {
        popup.classList.add("error");
    }
    const canvasContainer = document.querySelector("#myCanvas").parentNode;
    canvasContainer.appendChild(popup);
    dx = 0;
    dy = 0;
    rightPressed = false;
    leftPressed = false;
    document.removeEventListener("keydown", keyDownHandler);
    document.removeEventListener("keyup", keyUpHandler);
    const restartButton = popup.querySelector(".restart");
    restartButton.addEventListener("click", function () {
        popup.remove();
        document.addEventListener("keydown", keyDownHandler, false);
        document.addEventListener("keyup", keyUpHandler, false);
        score = 0;
        lives = 3;
        bricks.forEach(column => {
            column.forEach(brick => {
                brick.status = 1;
            });
        });
        x = canvas.width / 2;
        y = canvas.height - (canvas.height / 15);
        dx = canvas.width / 150;
        dy = -canvas.width / 150;
        paddleX = (canvas.width - paddleWidth) / 2;
    });

    const exitButton = popup.querySelector(".exit");
    exitButton.addEventListener("click", function () {
        popup.remove();
        document.removeEventListener("keydown", keyDownHandler);
        document.removeEventListener("keyup", keyUpHandler);
        location.href = "../index.php";
    });
}

let popUpActive = false;
document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        if (popUpActive === false) {
            showPausePopUp();
            popUpActive = true;
        }
    }
});

let previusdx;
let previusdy;
function showPausePopUp() {
    const popUp = document.createElement("div");
    popUp.setAttribute("id", "pausePopUp");
    popUp.classList.add("popup");
    previusdx = dx;
    previusdy = dy;
    dx = 0;
    dy = 0;
    rightPressed = false;
    leftPressed = false;
    document.removeEventListener("keydown", keyDownHandler);
    document.removeEventListener("keyup", keyUpHandler);
    const popUpText = document.createElement("p");
    popUpText.textContent = "JUEGO EN PAUSA";
    popUp.appendChild(popUpText);

    const resumeButton = document.createElement("button");
    resumeButton.textContent = "Reanudar";
    resumeButton.addEventListener("click", () => {
        popUp.remove();
        popUpActive = false;
        dx = previusdx;
        dy = previusdy;
        document.addEventListener("keydown", keyDownHandler, false);
        document.addEventListener("keyup", keyUpHandler, false);
    });
    popUp.appendChild(resumeButton);

    const exitButton = document.createElement("button");
    exitButton.textContent = "Salir";
    exitButton.addEventListener("click", () => {
        popUp.remove();
        location.href = "../index.php";
    });
    popUp.appendChild(exitButton);

    document.body.appendChild(popUp);
}


function showPausePopUp() {
    const popUp = document.createElement("div");
    popUp.setAttribute("id", "pausePopUp");
    popUp.classList.add("popup");
    previusdx = dx;
    previusdy = dy;
    dx = 0;
    dy = 0;
    rightPressed = false;
    leftPressed = false;
    document.removeEventListener("keydown", keyDownHandler);
    document.removeEventListener("keyup", keyUpHandler);
    const popUpText = document.createElement("p");
    popUpText.textContent = "JUEGO EN PAUSA";
    popUp.appendChild(popUpText);

    const resumeButton = document.createElement("button");
    resumeButton.textContent = "Reanudar";
    resumeButton.addEventListener("click", () => {
        popUp.remove();
        popUpActive = false;
        dx = previusdx;
        dy = previusdy;
        document.addEventListener("keydown", keyDownHandler, false);
        document.addEventListener("keyup", keyUpHandler, false);
    });
    popUp.appendChild(resumeButton);

    const exitButton = document.createElement("button");
    exitButton.textContent = "Salir";
    exitButton.addEventListener("click", () => {
        popUp.remove();
        location.href = "../index.php";
    });
    popUp.appendChild(exitButton);

    document.body.appendChild(popUp);
}

function collisionDetection() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            var b = bricks[c][r];
            if (b.status == 1) {
                if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {
                    dy = -dy;
                    b.status = 0;
                    score++;
                    if (score == brickRowCount * brickColumnCount) {
                        showCustomDialog("BRICTORIA!", "success");
                    }
                }
            }
        }
    }
}

function drawScore() {
    ctx.font = "5vh Arial";
    ctx.fillStyle = "black";
    ctx.fillText("Puntuación: " + score, 20, 50);
}

function drawLives() {
    ctx.font = "5vh Arial";
    ctx.fillStyle = "black";
    ctx.fillText("Vidas: " + lives, canvas.width - 200, 50);
}

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawBricks();
    drawBall();
    drawPaddle();
    drawScore();
    drawLives();
    collisionDetection();

    if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {
        dx = -dx;
    }

    if (y + dy < ballRadius) {
        dy = -dy;
    } else if (y + dy > canvas.height - ballRadius) {
        if (x > paddleX && x < paddleX + paddleWidth) {
            dy = -dy;
        } else {
            lives--;
            if (!lives) {
                showCustomDialog("INTEISTALO DE NUEVO", "error");
            } else {
                x = canvas.width / 2;
                y = canvas.height - (canvas.height / 15);
                dx = canvas.width / 150;
                dy = -canvas.width / 150;
                paddleX = (canvas.width - paddleWidth) / 2;
            }
        }
    }

    if (rightPressed && paddleX < canvas.width - paddleWidth) {
        paddleX += canvas.width / 50;
    } else if (leftPressed && paddleX > 0) {
        paddleX -= canvas.width / 50;
    }

    x += dx;
    y += dy;

    requestAnimationFrame(draw);
}

draw();