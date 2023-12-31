<?php
 include 'actions/session-check.php';
 include 'actions/connect.php';
 $currentDate = date("Y-m-d");

 $checkSql = "SELECT time_in FROM `time` WHERE user_email = ? AND date = ?";
 $checkStmt = $conn->prepare($checkSql);
 
 if ($checkStmt) {
     $checkStmt->bind_param("ss", $id, $currentDate);
     $checkStmt->execute();
     
     $checkResult = $checkStmt->get_result();

     if ($checkResult->num_rows > 0) {
         $hide_button = " ";
     }else{
        $hide_button = "startTimer()";
     }
     $checkStmt->close();
 } else {
     $response = "Error: Statement preparation error.";
 }

 $checkSql2 = "SELECT time_out FROM `time` WHERE user_email = ? AND date = ?";
 $checkStmt2 = $conn->prepare($checkSql2);
 
 if ($checkStmt2) {
     $checkStmt2->bind_param("ss", $id, $currentDate);
     $checkStmt2->execute();
     
     $checkResult2 = $checkStmt2->get_result();

     if ($checkResult2->num_rows > 0) {
         $hide_stop_button = " ";
     }else{
        $hide_stop_button = "stopTimer()";
     }
     $checkStmt2->close();
 } else {
     $response = "Error: Statement preparation error.";
 }
 
    $currentHour = date("H");

if ($currentHour >= 12) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good morning";
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time System</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
</head>
<body id="bodyID">
    <section id="content-container">
        <div class="aside" id="myAside">
            <img src="Images/image 1.png" alt="">
            <div id="burger" onclick="toggleBurger()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <ul class="navigation">
                <li><a href=""><span class="material-symbols-outlined">home</span>Home</a></li>
                <li><a href="https://gedagroup.com/about-us/">About</a></li>
                <li><a href="https://gedagroup.com/prospects/">Prospect</a></li>
                <li><a href="https://gedagroup.com/strategy/">Strategy</a></li>
                <li><a href="https://gedagroup.com/market/">Market</a></li>
                <li><a href="https://gedagroup.com/contact-us/">Contact</a></li>
                <li><a href="https://gedagroup.com/news/">News</a></li>
            </ul>
        </div>
        <div id="add-task" class="background">
            <form action="actions/addtask.php" method="post" class="add-task">
                <div class="input">
                    <h1>Task title</h1>
                    <input type="text" name="task-title" placeholder="enter task title">
                </div>
                <div class="input">
                    <h1>Task description</h1>
                    <input type="text" name="task-desc" placeholder="Enter task description">
                </div>
                <div class="buttonss">
                    <button type="submit">+ Create Task</button>
                    <button type="reset" onclick="addTask()"> Cancel </button>
                </div>
            </form>
        </div>

        <div class="main">
           
            <div class="top">
                <div class="header">
                    <div class="nav-container">
                        <div id="burger" onclick="toggleBurger()">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div>
                            <h1><?php echo $greeting .' '. $user_username;?>,</h1>
                            <h2>Dashboard</h2>
                        </div>
                    </div>
                    <div class="nav-container">
                        <h1 id="currenttime"></h1>
                        <h1 id="currentdate"></h1>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <h1>Hours this week</h1>
                        <div class="inner-card">
                            <h1><?php
                                    include 'actions/analytics.php';
                                    echo "$hours:$minutes:$seconds";
                                ?> </h1>
                            <span class="material-symbols-outlined">alarm</span>
                        </div>
                    </div>
                    <div class="card">
                        <h1>Completed tasks</h1>
                        <div class="inner-card">
                            <h1><?php echo $completeTasks;?> Completed</h1>
                            <span class="material-symbols-outlined">event_note</span>
                        </div>
                    </div>
                    <div class="card">
                        <h1>Pending tasks</h1>
                        <div class="inner-card">
                            <h1><?php echo $pendingTasks;?> pending</h1>
                            <span class="material-symbols-outlined">event_note</span>
                        </div>
                    </div>
                    <div class="card">
                        <h1>Daily average</h1>
                        <div class="inner-card">
                            <h1> 8Hrs </h1>
                            <span class="material-symbols-outlined">alarm</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="sector">
                    <div id="timer-display" class="card">
                        00:00:00
                    </div>
                    <script src="js/main.js"></script>
                    <div class="timer-buttonss">
                        <button id="timer-button" onclick="<?php echo $hide_button;?>">Start</button>
                        <button id="timer-button2" onclick="<?php echo $hide_stop_button;?>">Stop</button>
                        <button id="timer-button3" onclick="pageReload()">Reset</button>
                    </div>
                </div>
                <div class="sector">
                    <H1>Pending tasks</H1>
                    <!-- <div class="tasks">
                        <h1>DCA Portal</h1>
                        <ul>
                            <li>Create UI design</li>
                            <li>Implement system</li>
                        </ul>
                    </div> -->
                    <?php
                    include 'actions/fetch-tasks.php';
                    echo $html; ?>
                    <div class="tasks-button">
                        <Button onclick="addTask()">Add new</Button>
                    </div>
                </div>

                <div class="sector">
                    <h1>Completed tasks</h1>
                    <?php
                    include 'actions/fetch-tasks.php';
                    echo $html2; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="footer">
        <div class="panel">
            <img src="Images/image 1.png" alt="">
            <p>Global Economic Development Alliance (GEDA Group) Ltd deals in economic development and investments in emerging economies, but with a particular focus on Africa.
                <br>
                <br>
                <br>
                © 2022 GEDA Group Designed by YakoCloud Webservices</p>
        </div>
        <div class="panel">
            <h1>NEWS</h1>
            <p>DCA Group & Affiliates partner with DHL and Bolt

                DotConnectAfrica Restructures Under GEDA
                
                Chairwoman of GEDA provides Thought Leadership on a Keynote Panel</p>
        </div>
        <div class="panel">
            <h1>OUR OFFICES</h1>
            <p>Kenya
                CIC Plaza, Ground floor, Mara Road Upper Hill, <br>
                Box 39466-00623 Nairobi, Kenya. <br>
                <br>
                Mauritius <br>
                1st Floor, River Court, 6 St. Denis Street,<br>
                Port Louis, 11328, Mauritius<br>
                <br>
                Ethiopia<br>
                P.O. Box 5992 Old Airport,Bekele Eshete Towers,<br>
                 Addis Abba, Ethiopia,<br>
                <br>
                California<br>
                P.O. Box 303 California,USA,<br>
                94596Alpine Park, 1700 Botehlo Drive</p><br>
        </div>
    </section>
</body>
</html>
<script src="js/main.js"></script>
<script>
    function toggleBurger(){
        const aside = document.getElementById('myAside');
        if(aside.style.display == 'none'){
            aside.style.display = 'flex';
            aside.style.left = '0';
        }else{
            aside.style.display = 'none';
        }
    }
    
</script>

