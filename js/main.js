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

function addTask(){
    var background = document.getElementById('add-task');

    if(background.style.display == "none"){
        background.style.display = "flex";
    }else{
        background.style.display = "none"
    }
}

var startTime = 0;
var running = false;

function startTimer() {
    if (!running) {
        running = true;
        startTime = new Date().getTime();
        updateTimer();

        var xhr = new XMLHttpRequest();

        var data = "variable=" + encodeURIComponent(startTime);

        xhr.open("POST", "../actions/time.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error("Request failed with status: " + xhr.status);
                }
            }
        };

        xhr.send(data);
    }
}

function stopTimer() {
    running = false;
    document.getElementById("timer-button1").style.display = "none";
    document.getElementById("timer-button3").style.display = "block";

    var xhr = new XMLHttpRequest();

        stopTime = new Date().getTime();
        var data = "variable2=" + encodeURIComponent(stopTime);

        xhr.open("POST", "../actions/time.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error("Request failed with status: " + xhr.status);
                }
            }
        };

        xhr.send(data);
}

function updateTimer() {
    if (running) {
        var currentTime = new Date().getTime();
        var elapsedTime = new Date(currentTime - startTime);
        var minutes = elapsedTime.getMinutes();
        var seconds = elapsedTime.getSeconds();
        document.getElementById("timer-display").innerHTML = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        setTimeout(updateTimer, 1000);
    }
}