function manageFollow(follow, idProfile, idButton) {
    location.replace(`querys/user/manage-follow.php?follow=${follow}&idProfile=${idProfile}&idButton=${idButton}&location=home.php`);
}

function loadHistory(id, historyName) {
    var text = document.getElementById('publicationText').value;
    location.replace(`querys/auxiliar/home-history.php?text=${text}&historyId=${id}&historyName=${historyName}`);
}

function openHistorySelector() {
    div = document.getElementsByClassName("historySelector");
    for (i = 0; i < div.length; i++) {
        div[i].style.display = "";
    }
}

function sharePublication(id) {
    var text = document.getElementById('publicationText').value;
    location.replace(`querys/publication/insert-publication.php?text=${text}&historyId=${id}`);
}
function discardMessage(){
    location.replace(`querys/auxiliar/home-history.php?text=&historyId=-1`);
}
document.addEventListener('mouseup', function (e) {
    var container = document.getElementById('divUsers');
    if (!container.contains(e.target)) {
        div = document.getElementsByClassName("filteredUser");
        for (i = 0; i < div.length; i++) {
            div[i].style.display = "none";
        }
    }
    var container2 = document.getElementById('divHistory');
    if (!container2.contains(e.target)) {
        div2 = document.getElementsByClassName("historySelector");
        for (i = 0; i < div2.length; i++) {
            div2[i].style.display = "none";
        }
    }
});