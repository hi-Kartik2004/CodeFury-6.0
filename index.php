<?php
// starting session for handling errors;

session_start();
require_once("./php/config.php");


// Handling verfication of email
if (isset($_GET["verify"])) {
    $code = $_GET["verify"];
    header("location: php/actions.php/?verify=" . $code);
}

// Handling logout
if (isset($_GET["logout"])) {
    header("location: php/actions.php/?logout=1");
}

// This the head of the html
include("pages/components/head.php");

// All the components go below.
include("pages/components/navbar.php");


// Handling user login routers
if (isset($_SESSION["login"]["status"]) && $_SESSION["login"]["status"] == 1) {
    include("pages/components/page_loader.php");
    if(isset($_GET["login"])|| isset($_GET["register"])){
        header("location: ?past");
    }
    if (isset($_GET["profile"])) {
        include("pages/components/profile.php");
    } else if (isset($_GET["home"])) {
        include("pages/components/hero.php");
    } else if (isset($_GET["edit-profile"])) {
        include("pages/components/edit_profile.php");
    } else if (isset($_GET["edit-password"])) {
        include("pages/components/edit_password.php");
    } else if (isset($_GET["articles"]) && ($_GET["articles"] == "all")) {
        include("pages/components/general.php");
    } else if (isset($_GET["articles"])) {
        include("pages/components/yoga.php");
    } else if (isset($_GET["assessment"])) {
        include("pages/components/assessment.php");
    } else if (isset($_GET["counselling"])) {
        include("pages/components/counselling.php");
    } else if (isset($_GET["past"])) {
        include("pages/components/past.php");
    } else if (isset($_GET["chatgpt"])) {
        include("pages/components/chatgpt.php");
    }else if(isset($_GET["manage"]) && trim($_GET["manage"]) == "articles"){
        include("pages/components/manageArticles.php");
    }
    else if(isset($_GET["manage"]) && trim($_GET["manage"]) == "sessions"){
        include("pages/components/manageSessions.php");
    }
    else if(isset($_GET["admin"]) && $_GET["admin"] === "kartik"){
        include("pages/components/admin.php");
    }
    else {
        echo "<h1 style='text-align:center; margin: 8rem;'>404 Page not found</h1>";
    }
} else {
    include("pages/components/page_loader.php");
    if (isset($_GET["login"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["register"])) {
        include("pages/components/register.php");
    } else if (isset($_GET["forgot"])) {
        include("pages/components/forgot.php");
    } else if (isset($_GET["home"])) {
        include("pages/components/hero.php");
    } else if (isset($_GET["profile"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["edit-profile"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["edit-password"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["buy"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["cart"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["history"])) {
        include("pages/components/login.php");
    } else if (isset($_GET["sell"])) {
        include("pages/components/login.php");
    } else if (!isset($_GET)) {
        include("pages/components/hero.php");
    } else {
        echo "<h1 style='text-align:center; margin: 8rem;'>404 Page not found</h1>";
    }
}







// This is the foot of the html
include("pages/components/footer.php");
include("pages/components/foot.php");
