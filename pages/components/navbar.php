<!-- <h1>This is navbar</h1> -->
<?php
error_reporting(0);
// session_start();
?>
<section class="navbar">


    <div class="navbar__wrapper">
        <div class="logo__div">
            <a href="?home"><img src="pages/img/logo4.png" alt="logo"></a>
        </div>

        <div class="nav__links">
            <a href="?home">Home</a>
            <a href="?assessment">Assessment</a>

            <!-- Finance dropdown -->
            <div id="finance-wrapper" class="relative dropdown__wrapper">
                <p id="finance-link" class="dropdown-link">Articles <i class='bx bx-chevron-down'></i></p>
                <div id="finance-dropdown" class="none dropdown">
                    <a href="?articles=all">General</a>
                    <a href="?chatgpt">Digital Nurse</a>
                    <a href="?articles=yoga">Yoga Articles</a>
                </div>
            </div>

            <!-- Trade dropdown -->
            <div id="trade-wrapper" class="relative dropdown__wrapper">
                <p id="trade-link" class="dropdown-link">Community <i class='bx bx-chevron-down'></i></p>
                <div id="trade-dropdown" class="none dropdown">
                    <a href="?counselling">Counselling</a>
                    <a href="?past">Past Experience</a>
                </div>
            </div>

            <!-- <a href="#" id="report-link">Report <i class='bx bx-chevron-down'></i></a> -->
            <?php
            if (isset($_SESSION['login']['status']) && $_SESSION["login"]["status"]) {
                echo '    <div class="profile__link">
                <div id="trade-wrapper" class="relative dropdown__wrapper">
                <p id="trade-link" class="dropdown-link">Profile <i class="bx bx-chevron-down"></i></p>
                <div id="trade-dropdown" class="none dropdown">
                    <a href="?manage=articles">Manage Events</a>
                    <a href="?profile">View Profile</a>
                    <a href="?logout">Logout</a>
                </div>
            </div>
                </div>';
            } else {
                echo '            <a href="?login">Login</a>
                <a href="?register">Register</a>';
            }
            ?>
        </div>

        <div class="hamburger none" id="hamburger">
            <i class='bx bx-menu-alt-left'></i>
        </div>

        <div class="mobile__nav none" id="mobile-nav">
            <a href="?home">Home</a>
            <a href="?assessment">Assessment</a>
            <a href="?articles=all">Articles</a>
            <a href="?articles=yoga">Yoga Articles</a>
            <a href="?counselling">Counselling</a>
            <a href="?past">Community Talks</a>
            <a href="?manage=articles">Manage</a>
            <a href="?chatgpt">Ask Khushi</a>
            <?php if (isset($_SESSION['login']['status']) && $_SESSION["login"]["status"]) {
                echo ' <a href="?profile">View Profile</a>
                <a href="?logout">Logout</a>';
            } else {
                echo ' <a href="?login">Login</a>
                <a href="?register">Register</a>';
            } ?>

        </div>

    </div>
</section>