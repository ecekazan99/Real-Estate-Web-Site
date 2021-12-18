<?php
// This file is created for create database and operations like Create Table..
function Createdb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbhouse";

    // create connection
    $con = mysqli_connect($servername, $username, $password);
    //Check connection
    if (!$con) {
        die("Connection Failed:" . mysqli_connect_error());
    }


    //create database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if (mysqli_query($con, $sql)) {
        $con = mysqli_connect($servername, $username, $password, $dbname);
        $create_tblIndividualUsers = "CREATE TABLE IF NOT EXISTS tbl_IndividualUsers(
                userID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                FirstName VARCHAR(25) NOT NULL,
                LastName VARCHAR(25) NOT NULL,
                MailAddress VARCHAR(50) NOT NULL,
                Phone VARCHAR(25) NOT NULL,
                Password VARCHAR(25) NOT NULL,
                UserType INT(1) NOT NULL,
                UserProfileImage VARCHAR(200) NOT NULL
            );
        ";

        $create_tblOfficalUsers = "CREATE TABLE IF NOT EXISTS tbl_OfficalUsers(
                userID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                FirmName VARCHAR(25) NOT NULL,
                Address VARCHAR(50) NOT NULL,
                MailAddress VARCHAR(50) NOT NULL,
                Phone VARCHAR(25) NOT NULL,
                Password VARCHAR(25) NOT NULL,
                UserType INT(1) NOT NULL,
                UserProfileImage VARCHAR(200) NOT NULL
        );
        ";

        $create_tblAdverstisements = "CREATE TABLE IF NOT EXISTS tbl_Advertisements(
                ads_ID INT(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                agency_ID INT(15) NOT NULL,
                ads_price INT(15) NOT NULL,
                ads_description VARCHAR(200) NOT NULL,
                ads_type VARCHAR(15) NOT NULL,
                ads_status BOOLEAN NOT NULL,
                ads_province VARCHAR(20) NOT NULL,
                ads_town VARCHAR(20) NOT NULL,
                ads_neighbourhood VARCHAR(20) NOT NULL,

                ads_address VARCHAR(50) NOT NULL,
                ads_housetype VARCHAR(25) NOT NULL,
                ads_area INT(5) NOT NULL,
                ads_roomnumber VARCHAR(10) NOT NULL,
                ads_floor INT(4) NOT NULL,
                ads_age INT(3) NOT NULL,

                ads_heatingsystem VARCHAR(20) NOT NULL,
                ads_facade VARCHAR(20) NOT NULL,
                ads_otopark BOOLEAN NOT NULL,
                ads_pool BOOLEAN NOT NULL,
                ads_security BOOLEAN NOT NULL,
                ads_kidsplaygarden BOOLEAN NOT NULL,

                ads_date TIMESTAMP(0) NOT NULL,
                ads_displayed_count INT(3) NOT NULL,
                ads_favoriting_count INT(3) NOT NULL,
                FOREIGN KEY (agency_ID) REFERENCES tbl_OfficalUsers(userID)
               
            );
        ";
        $create_tblAdvertisementImages = "CREATE TABLE IF NOT EXISTS tbl_AdvertisementImages(
            imageID INT(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            advertisementID INT(15) NOT NULL,
            file_name VARCHAR(200) NOT NULL,
            upload_time TIMESTAMP(0) NOT NULL,
            FOREIGN KEY (advertisementID) REFERENCES tbl_Advertisements(ads_ID)
        );
        ";

        $create_tblFavoruitedAdvertisements = "CREATE TABLE IF NOT EXISTS tbl_IndividualUsers_Favourited(
            individual_favouriteID INT(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            individual_UserID INT(15) NOT NULL,
            advertisementID INT(15) NOT NULL,
            FOREIGN KEY (individual_UserID) REFERENCES tbl_IndividualUsers(userID),
            FOREIGN KEY (advertisementID) REFERENCES tbl_Advertisements(ads_ID)
        );
        ";


        $create_tblOfficalFavoruitedAdvertisements = "CREATE TABLE IF NOT EXISTS tbl_OfficialUsers_Favourited(
        official_favouriteID INT(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        official_UserID INT(15) NOT NULL,
        advertisementID INT(15) NOT NULL,
        FOREIGN KEY (official_UserID) REFERENCES tbl_OfficalUsers(userID),
        FOREIGN KEY (advertisementID) REFERENCES tbl_Advertisements(ads_ID)
        );
        ";


        $create_tblMyIntersts = "CREATE TABLE IF NOT EXISTS tbl_MyInterest(
            UserId INT(11) NOT NULL ,
            UserType INT(11) NOT NULL,
            AdvType VARCHAR(25) NOT NULL,
            Province VARCHAR(25) NOT NULL,
            MinPrice INT(15) NOT NULL,
            MaxPrice INT(15) NOT NULL,
            Town VARCHAR(25) NOT NULL,
            Neighborhood VARCHAR(50) NOT NULL,
            HouseType VARCHAR(25) NOT NULL,
            MinArea INT(15) NOT NULL,
            MaxArea INT(15) NOT NULL,
            RoomNumber VARCHAR(25) NOT NULL,
            AdvFloor INT(15) NOT NULL,
            MinAge INT(15) NOT NULL,
            MaxAge INT(15) NOT NULL,
            HeatingSystem VARCHAR(25) NOT NULL,
            Facade VARCHAR(25) NOT NULL,
            AdditionalInfo VARCHAR(25) NOT NULL
        );
        ";

        $create_tblProvince = "CREATE TABLE IF NOT EXISTS Province(
            province_id INT(2),
            province_title VARCHAR(25),
            province_key INT(11)
        );
        ";

        $create_tblTown = "CREATE TABLE IF NOT EXISTS Town(
            town_id INT(11),
            town_title VARCHAR(25),
            town_key INT(11),
            province_key INT(11)
        );
        ";

        $create_tblNeighborhood = "CREATE TABLE IF NOT EXISTS Neighborhood(
            neighborhood_id INT(11),
            neighborhood_title VARCHAR(25),
            neighborhood_key INT(11),
            town_key INT(11)
        );
        ";
        //TRIGGERS

        $incrementFavouritedCountOfAds_Individual_Trigger = "CREATE TRIGGER `incrementer_favcount_individual_trigger` AFTER INSERT ON `tbl_individualusers_favourited`
        FOR EACH ROW UPDATE tbl_advertisements SET ads_favoriting_count = ads_favoriting_count + 1 WHERE tbl_advertisements.ads_ID = NEW.advertisementID";

        $decrementFavouritedCountOfAds_Individual_Trigger = "CREATE TRIGGER `decreaser_favcount_individual_trigger` AFTER DELETE ON `tbl_individualusers_favourited`
        FOR EACH ROW UPDATE tbl_advertisements SET ads_favoriting_count = ads_favoriting_count - 1 WHERE tbl_advertisements.ads_ID = OLD.advertisementID";

        $incrementFavouritedCountOfAds_Official_Trigger = "CREATE TRIGGER `incrementer_favcount_official_trigger` AFTER INSERT ON `tbl_officialusers_favourited`
        FOR EACH ROW UPDATE tbl_advertisements SET ads_favoriting_count = ads_favoriting_count + 1 WHERE tbl_advertisements.ads_ID = NEW.advertisementID";

        $decrementFavouritedCountOfAds_Official_Trigger = "CREATE TRIGGER `decreaser_favcount_official_trigger` AFTER DELETE ON `tbl_officialusers_favourited`
        FOR EACH ROW UPDATE tbl_advertisements SET ads_favoriting_count = ads_favoriting_count - 1 WHERE tbl_advertisements.ads_ID = OLD.advertisementID";


        $trigger_individual_increase_favs = mysqli_query($con, $incrementFavouritedCountOfAds_Individual_Trigger);
        $trigger_individual_decrease_favs =mysqli_query($con, $decrementFavouritedCountOfAds_Individual_Trigger);
        
        $trigger_official_increase_favs = mysqli_query($con, $incrementFavouritedCountOfAds_Official_Trigger);
        $trigger_official_increase_favs = mysqli_query($con, $decrementFavouritedCountOfAds_Official_Trigger);

        if (mysqli_query($con, $create_tblIndividualUsers) && mysqli_query($con, $create_tblOfficalUsers)
         && mysqli_query($con, $create_tblAdverstisements) && mysqli_query($con, $create_tblAdvertisementImages)
         && mysqli_query($con, $create_tblFavoruitedAdvertisements) && mysqli_query($con, $create_tblOfficalFavoruitedAdvertisements)
         && mysqli_query($con, $create_tblMyIntersts)&& mysqli_query($con, $create_tblProvince)&& mysqli_query($con, $create_tblTown)
         && mysqli_query($con, $create_tblNeighborhood)){
          
            return $con;
        } else {
            echo "Table cannot created...";
        }
    } else {
        echo "Error while creating database" . mysqli_error($con);
    }
}
