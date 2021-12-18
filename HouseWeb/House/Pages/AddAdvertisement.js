// This js file is created for functionallity of AddAdvertisement.php file 

// province, town, neighborhood filters in dropdowns
function filterChosenProvince() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("provinceSearch");
    filter = input.value.toLocaleUpperCase('tr-TR');
    div = document.getElementById("provinceDropdown");
    a = div.getElementsByTagName("button");
    for (let i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) === 0) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

function filterChosenTown() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("townSearch");
    filter = input.value.toLocaleUpperCase('tr-TR');
    div = document.getElementById("townDropdown");
    a = div.getElementsByTagName("button");
    for (let i = 0; i < a.length; i++) {
        let txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) === 0) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

function filterChosenNeighborhood() {
    let input, filter, ul, li, a, i;
    input = document.getElementById("neighborhoodSearch");
    filter = input.value.toLocaleUpperCase('tr-TR');
    div = document.getElementById("neighborhoodDropdown");
    a = div.getElementsByTagName("button");
    for (let i = 0; i < a.length; i++) {
        let txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) === 0) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

// here we chancing dropdown's texts
$(document).ready(function() {
    $(".advTypeDropdown .dropdown-item").click(function() {
        $("#advType").text($(this).text());
    });
    $(".provinceDropdown .dropdown-item").click(function() {
        $("#province").text($(this).text());
    });
    $(".townDropdown .dropdown-item").click(function() {
        $("#town").text($(this).text());
    });
    $(".neighborhoodDropdown .dropdown-item").click(function() {
        $("#neighborhood").text($(this).text());
    });
    $(".structureTypeDropdown .dropdown-item").click(function() {
        $("#structureType").text($(this).text());
    });
    $(".numOfRoomsDropdown .dropdown-item").click(function() {
        $("#numOfRooms").text($(this).text());
    });
    $(".heatingDropdown .dropdown-item").click(function() {
        $("#heating").text($(this).text());
    });
    $(".facadeDropdown .dropdown-item").click(function() {
        $("#facade").text($(this).text());
    });
});