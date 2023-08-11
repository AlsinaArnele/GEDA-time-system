function updateDateTime() {
    const currentDate = new Date();

    const year = currentDate.getFullYear().toString().slice(-2);
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    const hours = String(currentDate.getHours()).padStart(2, '0');
    const minutes = String(currentDate.getMinutes()).padStart(2, '0');
    const seconds = String(currentDate.getSeconds()).padStart(2, '0');

    const formattedDate = `${day}-${month}-${year}`;
    const formattedTime = `${hours}:${minutes}:${seconds}`;

    var element = document.getElementById('currentdate');
    element.textContent = formattedDate;
    var element2 = document.getElementById('currenttime');
    element2.textContent = formattedTime;
}
setInterval(updateDateTime, 1000);

const canvas = document.getElementById('arcCanvas');
const ctx = canvas.getContext('2d');

const centerX = canvas.width / 2;
const centerY = canvas.height /canvas.height;
const radius = 180;
const startAngle = 0;
const endAngle = 0;
const totalTime = 8 * 60 * 60 * 1000;
const incrementAngle = (Math.PI * 2) / (totalTime/100);

let animationStartTime;

function drawArc(timestamp) {
    if (!animationStartTime) {
        animationStartTime = timestamp;
    }

    const elapsedTime = timestamp - animationStartTime;
    const angle = elapsedTime * incrementAngle;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, startAngle, angle);
    ctx.strokeStyle = 'green';
    ctx.lineWidth = 10;
    ctx.stroke();

    if (angle < Math.PI * 2) {
        requestAnimationFrame(drawArc);
    }
}

requestAnimationFrame(drawArc);

