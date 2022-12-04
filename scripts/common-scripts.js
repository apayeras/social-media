function logout() {
    location.replace("querys/utilities/logout.php");
}

function viewProfile(idProfile) {
    location.replace(`profile.php?idProfile=${idProfile}`);
}

function openMessages() {
    location.replace("chat.php");
}

function openHome() {
    location.replace("home.php");
}

function selectChat(id, nom, foto, counter) {
    location.replace(`querys/chat/read-messages.php?idchat=${id}&nom=${nom}&foto=${foto}&counter=${counter}`);
}

function filterNames() {
    var input, filter, div, spans, i, j;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    div = document.getElementsByClassName("filteredUser");
    if (filter.length == 0) {
        for (i = 0; i < div.length; i++) {
            div[i].style.display = "none";
        }
    } else {
        j = 0;
        for (i = 0; i < div.length && j < 8; i++) {
            spans = div[i].getElementsByTagName("span");
            txtValue1 = spans[0].textContent || spans[0].innerText;
            txtValue2 = spans[1].textContent || spans[1].innerText;
            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                div[i].style.display = "";
                j++;
            } else {
                div[i].style.display = "none";
            }
        }
    }
}