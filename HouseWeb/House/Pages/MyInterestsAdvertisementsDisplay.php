<?php
// This file is created for displaying interest advertisements
require_once("operation.php");
$cookiename = 'currentPageForAdvertisements';
$value = 'MyInterestsAdvertisementsDisplay';
setcookie($cookiename, $value);
echo '<script>window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + "#loaded";
            window.location.reload();
        }
    }</script>';
$userTypeforButton = $_COOKIE['user_type'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Interests Advertisements</title>
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../Stylings/MainPageWithoutLogin.css">
    <link rel="stylesheet" type="text/css" href="..\Stylings\myInterests.css">
</head>

<body>
    <header>
        <div style="float:left;margin: 5px 50px;">
            <a href="MainPage.php"><i class="fas fa-home" style="color:#bd2130; padding:10px; font-size: 30px;border:1px solid white;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
        </div>
        <div style="float:right;">
            <div id="buttonDisplay" class="dropdown" style="float:right;margin: 5px 50px; "></div>
        </div>
        <br><br>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
    </header>
    <br>
    <div id="buttonGroup" style="display:flex;flex-direction:row;justify-content: center;align-items: center;width:60%; margin: 5px 300px;">
        <a class="btn btn-outline-secondary" style="display: flex;flex: 2" href="MyInterests.php">İlgilendiğim İlan Özellikleri</a>
        <a class="btn btn-secondary" name="MyInterestsDisplay" value="deneme" style="display: flex;flex: 2" href="MyInterestsAdvertisementsDisplay.php">İlgilendiğim İlanlar</a>

    </div>
    <div style="display:flex;align-items:center;justify-content:center;flex-direction:row; width: 100%">
        <div id="activeAds"></div>
        <div class="CardsContainerStyle" style="margin-top: 50px">
            <div class="DisplayAllilans" id="issuesList" style="border: 1px solid black"></div>
            <div>
                <div class="pagenumbers" id="pagination"></div>
            </div>
        </div>

    </div>
    <?php require_once("SearchAndUpdate.php"); ?>
    <?php require_once("DisplayAdvertisementsCard.php"); ?>
    <?php
    echo '<script>
   
        $(document).ready(function() {
            
            buttonUserType("' . $userTypeforButton . '");
        });
        </script>;';
    ?>

</body>

</html>