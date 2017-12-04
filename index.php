<?php
session_start();
require_once ("database.class.php");
$db = new Db();

if (isset($_SESSION['user'])) {
    header("Location: loggedin.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<title>SQLi Unsave | home</title>
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
    <a href="#" class="w3-bar-item w3-button">Home</a>
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

<?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
<div class="w3-container">
    <div class="w3-center w3-margin-top w3-pale-green w3-leftbar w3-border-green w3-xlarge">
            <?php echo $_GET['msg']; ?>
    </div>
</div>
<?php } ?>

<div class="w3-row-padding w3-center w3-margin-top w3-text-theme">
    <div class="w3-third">
        <div class="w3-card w3-container" style="min-height:550px">
            <h3>Login</h3><br>
            <i class="fa fa-sign-in w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
            <form action="login.php" method="post" enctype="application/x-www-form-urlencoded">
                <div class="w3-section">
                    <label for="username">Username</label>
                    <input class="w3-input"  type="text" name="username" />
                </div>
                <div class="w3-section">
                    <label for="password">Password</label>
                    <input class="w3-input" type="password" name="password" />
                </div>

                <div>
                    <input type="submit" value="login" class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" />
                </div>
            </form>
        </div>
    </div>

    <div class="w3-third">
        <div class="w3-card w3-container" style="min-height:550px">
            <h3>Welcome</h3><br>
            <i class="fa fa-puzzle-piece w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
            <p>Please do not implement the examples on this website in your own, the examples are deliberately bad implementations of sql connections.</p>
            <p>Try your best to get all the hidden information on this site.</p>
            <p>If you break it please inform the developers using using the issue tracker on github.</p>
            <p>Enjoy</p>
        </div>
    </div>

    <div class="w3-third">
        <div class="w3-card w3-container" style="min-height:550px">
            <h3>Register</h3><br>
            <i class="fa fa-desktop w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
            <form action="register.php" method="post" enctype="application/x-www-form-urlencoded">
                <div class="w3-section">
                    <label for="username">Username</label>
                    <input class="w3-input"  type="text" name="username" />
                </div>
                <div class="w3-section">
                    <label for="email">Email</label>
                    <input class="w3-input"  type="text" name="email" />
                </div>
                <div class="w3-section">
                    <label for="password">Password</label>
                    <input class="w3-input" type="password" name="password" />
                </div>

                <div>
                    <input type="submit" value="register" class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" />
                </div>
            </form>
        </div>
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
