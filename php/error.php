<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #383838;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 1;
        }

        h1 {
            font-size: 72px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <canvas id="canvas"></canvas>
    <div class="content">
        <h1>El producto no existe</h1>
        <p>Lo siento, ha ocurrido un error.</p>
    </div>

    <script>
        // Obtener el canvas y el contexto
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        // Establecer el tamaño del canvas
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Carreta
        const carreta = {
            x: -300,
            y: canvas.height - 200,
            width: 300,
            height: 200,
            speed: 5,
            img: new Image()
        };

        // Cargar imagen de la carreta
        carreta.img.onload = function () {
            ctx.drawImage(carreta.img, carreta.x, carreta.y, carreta.width, carreta.height);
        }
        carreta.img.src = '../imagenes/Productos/45.png';

        // Dibujar la carreta en movimiento
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(carreta.img, carreta.x, carreta.y, carreta.width, carreta.height);
            carreta.x += carreta.speed;
            if (carreta.x > canvas.width) {
                carreta.x = -300;
            }
            requestAnimationFrame(draw);
        }
        draw();
    </script>
</body>

</html>