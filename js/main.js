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
