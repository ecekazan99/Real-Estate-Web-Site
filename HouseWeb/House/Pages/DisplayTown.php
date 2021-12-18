<?php
// This file is created for displaying town
$con = mysqli_connect("localhost", "root", "", "dbhouse");
require_once("db.php");

?>

<?php
$advertisementIDForDisplaying =  $_COOKIE['advertisementIDForDisplaying'];
$province = $_POST["province"];
if ($advertisementIDForDisplaying > 0) {
    echo '<option class="dropdown-item" value="" style="display:none">İlçe</option> ';
    $sql = "SELECT * FROM Town WHERE province_key='$province'";
    $query = mysqli_query($con, $sql);
    while ($list = mysqli_fetch_array($query)) {
        $sqlForCurrentAdsDisplay = "SELECT * FROM tbl_advertisements WHERE ads_ID= '$advertisementIDForDisplaying'";
        $resultQueryForCurrentAdvertisement = mysqli_query($GLOBALS['con'], $sqlForCurrentAdsDisplay);
        $getValueForDisplayingAdvertisement = mysqli_fetch_array($resultQueryForCurrentAdvertisement);
        $myarr =  $getValueForDisplayingAdvertisement;
        $ads_Province = $myarr['ads_province'];
        $ads_Town = $myarr['ads_town'];
        if ($ads_Town === $list['town_title']) {
            echo ' <option value="' . $list['town_key'] . '"selected>' . $list['town_title'] . '</option>';
        } else {
            echo ' <option value="' . $list['town_key'] . '">' . $list['town_title'] . '</option>';
        }
    }
} else {
    $sql = "SELECT * FROM Town WHERE province_key='$province'";
    $query = mysqli_query($con, $sql);
    echo '<option class="dropdown-item" value="" style="display:none">İlçe</option> ';
    while ($list = mysqli_fetch_array($query)) {
        echo ' <option class="dropdown-item" value="' . $list['town_key'] . '">' . $list['town_title'] . '</option>';
    }
}


?>