<?php
session_start();
require_once ("database.class.php");
$db = new Db();

if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $user = $db->get_user($id);
} else {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['search'])) {
    header("Location: loggedin.php?msg=No%20search%20parameter");
    exit;
}

$search_results = $db->get_user_by_username($_GET['search'])
?>
<!DOCTYPE html>
<html>
<title>SQLi Unsave | logged in</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<body>

<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-center" style="display:none" id="mySidebar">
    <h1 class="w3-xxxlarge w3-text-theme">Side Navigation</h1>
    <button class="w3-bar-item w3-button" onclick="w3_close()">Close <i class="fa fa-remove"></i></button>
    <a href="index.php" class="w3-bar-item w3-button">Home</a>
    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    <a href="https://github.com/raav-learn/sqli-unsave" target="_blank" class="w3-bar-item w3-button">Github page</a>
</nav>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>SQLi Unsave</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">A sql injection demo site</h1>
        <div class="w3-padding-32">
            <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="document.getElementById('id01').style.display='block'" style="font-weight:900;">Instructions</button>
        </div>
    </div>
</header>

<!-- Modal -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-top">
        <header class="w3-container w3-theme-l1">
        <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topright">×</span>
            <h4>Oh snap! you openend the instuctions&nbsp;<i class="fa fa-smile-o"></i></h4>
            <h5>Let get started then</h5>
        </header>
        <div class="w3-padding">
            <p>Well, instuctions are no fun, sql injections are actually</p>
            <p>First of try to login by altering the login form. (Hint: backend is mysql)</p>
        </div>
        <footer class="w3-container w3-theme-l1">
            <p>You can do it.</p>
        </footer>
    </div>
</div>

<div class="w3-row-padding w3-center w3-margin-top w3-text-theme">
        <div class="w3-card w3-container" style="min-height:550px">
            <h3>Search results</h3><?php echo count($search_results); ?> of max 100<br>
            <ul class="w3-ul w3-card-4">
                <?php
                foreach ($search_results as $result) {
                    ?>
                    <li class="w3-bar" style="display: list-item;">
                        <i class="fa fa-user w3-bar-item w3-circle" style="font-size:25px" aria-hidden="true"></i>
                        <div class="w3-bar-item">
                            <span class="w3-large"><?php echo $result['username']; ?></span><br>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <p></p>
        </div>
</div>
<br />
<!-- Footer -->
<footer class="w3-container w3-theme-dark w3-padding-16">
    <h3>SQLi unsave</h3>
    <p>Powered by some guys</p>
    <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
        <span class="w3-text w3-theme-light w3-padding">Go To Top</span>
        <a class="w3-text-white" href="#myHeader"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
    </div>
</footer>

<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script>
    // Side navigation
    function w3_open() {
        var x = document.getElementById("mySidebar");
        x.style.width = "100%";
        x.style.fontSize = "40px";
        x.style.paddingTop = "10%";
        x.style.display = "block";
    }
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }

</script>

</body>
</html>
