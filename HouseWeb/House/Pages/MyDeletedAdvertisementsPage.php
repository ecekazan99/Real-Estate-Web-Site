<?php
// This file is created for displaying deleted advertisements of official user
$cookiename = 'currentPageForAdvertisements';
$value = 'MyDeletedAdvertisementsPage';
setcookie($cookiename, $value);
echo '<script>window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + "#loaded";
            window.location.reload();
        }
    }</script>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Deleted Advertisements</title>
    <link rel="icon" type="image/png" href="../Images/favIcon.png" />
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
        <div style="float:right;margin: 5px 50px;" class="dropdown">
            <button class="btn btn-danger">Hesabım</button>
            <div class="dropdown-content">
                <a href="OfficialUserProfilePage.php">Bilgilerim</a>
                <a href="MyActiveAdvertisementsPage.php">İlanlarım</a>
                <a href="DisplayMyFavoriteAdvertisements.php">Favorilerim</a>
                <a href="MyInterests.php">İlgilendiğim İlanlar</a>
                <a onclick=logOut() href="MainPage.php">Çıkış yap</a>
            </div>
        </div>
        <br><br>
        <div>
            <a href="MainPage.php"><img src="../Images/logo.png" alt="Logo" style="max-width:100%; height:auto;display: block;margin-left: auto;margin-right: auto;" /></a>
        </div>
    </header>
    <main style="display: flex;flex-direction: column;justify-content: center;align-items: center">
        <div style="width: 50%;">


            <div id="buttonGroup" style="display:flex;flex-direction:row;justify-content: center;align-items: center">

                <a class="btn btn-outline-secondary" style="display: flex;flex: 2" href="AddAdvertisement.php">İlan Ekle</a>
                <a type="button" href="MyActiveAdvertisementsPage.php" class="btn btn-outline-secondary" style="display: flex;flex: 2">Aktif İlanlarım</a>
                <button class="btn active btn-outline-secondary" style="display: flex;flex: 2">Geçmiş İlanlarım</button>

            </div>


            <div style="display:flex;flex-direction:row;justify-content: center;align-items: center">

                <div style="display:flex;justify-content: center;align-items:center;margin-top: 40px">
                    <div class="CardsContainerStyle">
                        <div class="DisplayAllilans" id="issuesList" style="border: 1px solid black"></div>
                        <div>
                            <div class="pagenumbers" id="pagination"></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once("DisplayAdvertisementsCard.php"); ?>
            <script>
                function setCookie(cname, cvalue) {
                    document.cookie = cname + "=" + cvalue;
                }

                function logOut() {
                    localStorage.clear();
                    setCookie('user_type', '0');
                }
            </script>
    </main>
</body>

</html>