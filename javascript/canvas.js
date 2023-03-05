const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

// Crear las excavadoras
const excavadoras = [];
for (let i = 0; i < 19; i++) {
    let excavadora = {
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        speed: Math.random() * 0.1,
        angle: Math.random() * Math.PI * 2,
        img: new Image()
    };
    excavadora.img.src = '../imagenes/error404.png';
    excavadoras.push(excavadora);
}

// Dibujar las excavadoras en movimiento
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    excavadoras.forEach(excavadora => {
        ctx.save();
        ctx.translate(excavadora.x + excavadora.img.width / 2, excavadora.y + excavadora.img.height / 2);
        ctx.rotate(excavadora.angle);
        ctx.drawImage(excavadora.img, -excavadora.img.width / 2, -excavadora.img.height / 2);
        ctx.restore();
        excavadora.x += Math.cos(excavadora.angle) * excavadora.speed;
        excavadora.y += Math.sin(excavadora.angle) * excavadora.speed;
        if (excavadora.x > canvas.width) {
            excavadora.x = -excavadora.img.width;
        } else if (excavadora.x < -excavadora.img.width) {
            excavadora.x = canvas.width;
        }
        if (excavadora.y > canvas.height) {
            excavadora.y = -excavadora.img.height;
        } else if (excavadora.y < -excavadora.img.height) {
            excavadora.y = canvas.height;
        }
        excavadora.angle += Math.random() * 0.1 - 0.05;
    });
    requestAnimationFrame(draw);
}
draw();
