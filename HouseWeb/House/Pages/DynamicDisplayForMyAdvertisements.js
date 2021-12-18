// This file is created for displaying advertisements dynamically
let btnContainer = document.getElementById("buttonGroup");
let btns = btnContainer.getElementsByClassName("btn");

function displayButtonGroup() {

    // Loop through the buttons and add the active class to the current/clicked button
    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            let current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }

}