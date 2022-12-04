function manageFollow(follow, idProfile, idButton) {
    location.replace(`querys/user/manage-follow.php?follow=${follow}&idProfile=${idProfile}&idButton=${idButton}&location=profile.php`);
}

function manageFollow(follow, idProfile) {
    location.replace(`manage-follow.php?follow=${follow}&idProfile=${idProfile}&location=profile.php`);
}

function updateUser() {
    let name = document.getElementById("updateName").value;
    let description = document.getElementById("updateDescription").value;
    let photo = document.getElementById("updatePhoto").value;
    location.replace(`querys/user/update-user.php?name=${name}&description=${description}&photo=${photo}`);
}

function deleteUser() {
    let password = document.getElementById("deletePassword").value;
    location.replace(`querys/user/delete-user.php?password=${password}`);
}

function addHistory() {
    let historyName = document.getElementById("historyName").value;
    let historyPhoto = document.getElementById("historyPhoto").value;
    let select = document.getElementById("privacity");
    let privacity = select.options[select.selectedIndex].value == "Private" ? 0 : 1;
    location.replace(`manage-history.php?historyName=${historyName}&historyPhoto=${historyPhoto}&privacity=${privacity}`);
}

function selectHistory(idProfile, idHistory) {
    location.replace(`profile.php?idProfile=${idProfile}&history=${idHistory}`);
}

const element = document.querySelector('.ProfileCenter');
var btn = document.getElementById("profileModal");
if (btn != null) {
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function () {
        modal.style.display = "block";
        element.style.overflow = "hidden";
    }
    span.onclick = function () {
        modal.style.display = "none";
        element.style.overflow = "scroll";
    }
}

var btn2 = document.getElementById("modalStories");
if (btn2 != null) {
    var modal2 = document.getElementById("storyModal");
    var span2 = document.getElementsByClassName("close")[1];

    btn2.onclick = function () {
        modal2.style.display = "block";
        element.style.overflow = "hidden";
    }
    span2.onclick = function () {
        modal2.style.display = "none";
        element.style.overflow = "scroll";
    }
}

var btn3 = document.getElementById("deleteButton");
if (btn3 != null) {
    var modal3 = document.getElementById("deleteModal");
    var span3 = document.getElementsByClassName("close")[2];

    btn3.onclick = function () {
        modal3.style.display = "block";
        element.style.overflow = "hidden";
    }
    span3.onclick = function () {
        modal3.style.display = "none";
        element.style.overflow = "scroll";
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (btn != null) {
        if (event.target == modal) {
            modal.style.display = "none";
            element.style.overflow = "scroll";
        }
    }
    if (btn2 != null) {
        if (event.target == modal2) {
            modal2.style.display = "none";
            element.style.overflow = "scroll";
        }
    }
}