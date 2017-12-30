"use strict";

document.addEventListener('DOMContentLoaded', function () {
    
    var modal = document.getElementById('login-modal');
    var register=document.getElementById('registration-modal');
    window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
    if (event.target == register) {
    register.style.display = "none";
    }
    }
    // document.body.style.backgroundImage = "url('img_tree.png')";
    document.getElementById("login-body").style.background = config.background_color;
    document.getElementById("logo-img").src = config.logo_path;
    document.getElementById("login-modal-img").src = config.logo_path;
    document.getElementById("registration-modal-img").src = config.logo_path;
    document.getElementById("index-organization").style.color = config.org_color;
    document.getElementById("index-organization").innerText = config.org_name; 
    document.getElementById("login-org").style.color = config.org_color;
    document.getElementById("login-org").innerText = config.org_name;
    document.getElementById("registration-org").style.color = config.org_color;
    document.getElementById("registration-org").innerText = config.org_name;

    // document.getElementById('registration-modal').addEventListener('click', );
    // document.getElementById('login-modal').addEventListener('click', );
}());