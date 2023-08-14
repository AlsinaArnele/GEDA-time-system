
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

var running = false;
var startTime = 0;

var storedStartTime = localStorage.getItem("startTime");
var storedRunning = localStorage.getItem("running");

if (storedStartTime && storedRunning === "true") {
    startTime = parseInt(storedStartTime);
    running = true;
    updateTimer();
}

function startTimer() {
    if(confirm("Start session?")){
    if (!running) {
        running = true;
        startTime = new Date().getTime();
        localStorage.setItem("startTime", startTime);
        localStorage.setItem("running", "true");
        updateTimer();
        document.getElementById("timer-button").style.backgroundColor = "green";
        document.getElementById("timer-button").style.color = "white";

        var xhr = new XMLHttpRequest();
        var data = "startTime=" + encodeURIComponent(startTime);

        xhr.open("POST", "actions/insert_time.php", true);
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

        xhr.onerror = function() {
            console.error("Request failed due to an error.");
        };

        xhr.send(data);
    }
}
}

function stopTimer() {
    if(confirm("End session?")){
    if (running) {
        running = false;
        localStorage.removeItem("startTime");
        localStorage.setItem("running", "false");
        document.getElementById("timer-button2").style.backgroundColor = "red";
        document.getElementById("timer-button2").style.color = "white";
        document.getElementById("timer-button").style.display = "none";
        document.getElementById("timer-button3").style.display = "block";

        var xhr = new XMLHttpRequest();
        var stopTime = new Date().getTime();
        var data = "stopTime=" + encodeURIComponent(stopTime);

        xhr.open("POST", "actions/insert_updated_time.php", true);
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

        xhr.onerror = function() {
            console.error("Request failed due to an error.");
        };

        xhr.send(data);
    }
}
}

function updateTimer() {
    if (running) {
        var currentTime = new Date().getTime();
        var elapsedTime = new Date(currentTime - startTime);
        var hours = Math.floor(elapsedTime / 3600000); // 1 hour = 3600000 milliseconds
        var minutes = elapsedTime.getUTCMinutes();
        var seconds = elapsedTime.getUTCSeconds();

        var formattedHours = hours < 10 ? "0" + hours : hours;
        var formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
        var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("timer-display").innerHTML = formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;

        if (hours >= 24) {
            running = false;
            localStorage.removeItem("startTime");
            localStorage.setItem("running", "false");
        }

        setTimeout(updateTimer, 1000);
    }
}

function pageReload(){
    location.reload();
}

function sendTask() {
    if (confirm("Are you sure you want to mark this task as finished?")) {
        var id = document.getElementById("idPlaceholder").innerHTML;
        var data = encodeURIComponent(id);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'actions/update_tasks.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send('data=' + data);
    }
}

