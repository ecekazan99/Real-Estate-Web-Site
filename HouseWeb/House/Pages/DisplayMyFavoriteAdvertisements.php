<?php
// This file is created for displaying favorite advertisements of users 
require_once("operation.php");
$userTypeforButton = $_COOKIE['user_type'];
$cookiename = 'currentPageForAdvertisements';
$value = 'DisplayMyFavoriteAdvertisements';
setcookie($cookiename, $value);
echo '<script>window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + "#loaded";
        window.location.reload();
    }
}</script>';
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Favorite Advertisements Page</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
    <link rel="stylesheet" href="../Stylings/HouseCardStyling.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="../Stylings/myInterests.css">

</head>

<body>
    <header>
        <div style="float:left;margin: 5px 50px;">
            <a href="MainPage.php"><i class="fas fa-home" style="color:#bd2130; padding:10px; font-size: 30px;border:1px solid white;border-radius: 100%;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);"></i></a>
        </div>
        <div style="float:right;margin: 5px 50px;" class="dropdown">
            <div id="buttonDisplay" class="dropdown" style="float:right;margin: 5px 50px; "></div>
        </div>
        <br><br>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
    </header>
    <main style="display: flex;justify-content: center;align-items:center;flex-direction: column">
        <div style="width:800px;background-color: rgb(184, 183, 183);  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

            <div style="display: flex;flex-direction: column">
                <div style="display: flex;flex-direction: row;width: 800px;border-bottom: 2px solid black;height: 50px;align-items:center;justify-content:center;text-align:center">

                    <div style="align-items:center;justify-content:center;text-align:center">
                        <h3 class="mt-1">FAVORİ İLANLARIM</h3>
                    </div>
                </div>

                <div style="display:flex;flex-direction:row; width: 800px;align-items:center;justify-content:center;text-align:center"">
                    <div style=" display:flex;width: 90%;justify-content: center;align-items:center;margin-top:20px">
                    <div class="CardsContainerStyle">
                        <div class="DisplayAllilans" id="issuesList" style="border: 1px solid black"></div>
                        <div>
                            <div class="pagenumbers" id="pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php require_once("DisplayAdvertisementsCard.php") ?>

        <script>
            function setCookie(cname, cvalue) {
                document.cookie = cname + "=" + cvalue;
            }

            function logOut() {
                localStorage.clear();
                setCookie('user_type', '0');
            }

            function buttonUserType(userType) {
                if (userType == 1) {
                    document.getElementById('buttonDisplay').innerHTML = '<button class="btn btn-primary">Hesabım</button><div class="dropdown-content"><a href="IndividualUserProfilePage.php">Bilgilerim</a><a href="DisplayMyFavoriteAdvertisements.php">Favorilerim</a><a href="MyInterests.php" >İlgilendiğim İlanlar</a><a onclick="logOut()" href="MainPage.php">Çıkış yap</a> </div> ';

                } else if (userType == 2) {
                    document.getElementById('buttonDisplay').innerHTML = '<button class="btn btn-danger">Hesabım</button><div class="dropdown-content"><a href="OfficialUserProfilePage.php">Bilgilerim</a><a href="MyActiveAdvertisementsPage.php">İlanlarım</a><a href="DisplayMyFavoriteAdvertisements.php">Favorilerim</a><a href="MyInterests.php" >İlgilendiğim İlanlar</a><a onclick="logOut()" href="MainPage.php">Çıkış yap</a></div>';
                }
            }
        </script>
    </main>
    <?php
    echo '<script>
   
        $(document).ready(function() {
            
            buttonUserType("' . $userTypeforButton . '");
        });
        </script>;'
    ?>
</body>

</html>