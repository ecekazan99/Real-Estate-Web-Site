
<?php
// This file is created for displaying neighborhood
$con = mysqli_connect("localhost", "root", "", "dbhouse");
require_once("db.php");

?>

<?php
$advertisementIDForDisplaying =  $_COOKIE['advertisementIDForDisplaying'];
$town = $_POST["town"];
if ($advertisementIDForDisplaying > 0) {
    echo '<option class="dropdown-item" value="" style="display:none">Mahalle</option> ';
    $sql = "SELECT * FROM Neighborhood WHERE town_key='$town'";
    $query = mysqli_query($con, $sql);
    while ($list = mysqli_fetch_array($query)) {
        $sqlForCurrentAdsDisplay = "SELECT * FROM tbl_advertisements WHERE ads_ID= '$advertisementIDForDisplaying'";
        $resultQueryForCurrentAdvertisement = mysqli_query($GLOBALS['con'], $sqlForCurrentAdsDisplay);
        $getValueForDisplayingAdvertisement = mysqli_fetch_array($resultQueryForCurrentAdvertisement);
        $myarr =  $getValueForDisplayingAdvertisement;
        $ads_Town = $myarr['ads_Town'];
        $ads_Neighbourhood = $myarr['ads_neighbourhood'];
        if ($ads_Neighbourhood === $list['neighborhood_title']) {
            echo ' <option value="' . $list['neighborhood_key'] . '"selected>' . $list['neighborhood_title'] . '</option>';
        } else {
            echo ' <option value="' . $list['neighborhood_key'] . '">' . $list['neighborhood_title'] . '</option>';
        }
    }
} else {
    $sql = "SELECT * FROM Neighborhood WHERE town_key='$town'";
    $query = mysqli_query($con, $sql);
    echo '<option class="dropdown-item" value="" style="display:none">Mahalle</option> ';
    while ($list = mysqli_fetch_array($query)) {
        echo ' <option class="dropdown-item" value="' . $list['neighborhood_key'] . '">' . $list['neighborhood_title'] . '</option>';
    }
}


?>