<?php
session_start();
if (isset($_GET['idProfile'])) {
    $_SESSION['idProfile'] = $_GET['idProfile'];
}
if (isset($_GET['history'])) {
    $_SESSION['selectedHistory'] = $_GET['history'];
} else {
    unset($_SESSION['selectedHistory']);
}

?>

<?php
include('querys/profile-information.php');
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="Refresh" content="30"> -->
    <link rel="stylesheet" href="styles/profile.css">
    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function logout() {
            location.replace("logout.php");
        }

        function openHome() {
            location.replace("home.php");
        }

        function viewProfile(idProfile) {
            location.replace(`profile.php?idProfile=${idProfile}`);
        }

        function manageFollow(follow, idProfile, idButton) {
            location.replace(`manage-follow.php?follow=${follow}&idProfile=${idProfile}&idButton=${idButton}&location=profile.php`);
        }

        function manageFollow(follow, idProfile) {
            location.replace(`manage-follow.php?follow=${follow}&idProfile=${idProfile}&location=profile.php`);
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

        function openMessages() {
            <?php unset($_SESSION['perfilSeleccionat']); ?>
            location.replace("chat.php");
        }

        function filterNames() {
            var input, filter, filtered, div, spans, ul, li, a, i, j;
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

        function disableFilter() {
            div = document.getElementsByClassName("filteredUser");
            for (i = 0; i < div.length; i++) {
                div[i].style.display = "none";
            }
        }
    </script>
</head>

<body>
    <div class="App">
        <div class="blur" style="top: -18%; right: 0"></div>
        <div class="blur" style="top: 36%; left: -8rem"></div>
        <div class="Home">
            <div class="ProfileSide">
                <div class="LogoSearch">
                    <img src="https://www.freeiconspng.com/uploads/abstract-circle-wave-logo-png-image-11.png" alt="Wave-img">
                    <div class="Search" id="searchPanel">
                        <div style="display: flex">
                            <input type="text" class="nameInput" id="searchInput" placeholder="Cercar" onkeyup="filterNames()" onfocusin="filterNames()" onfocusout="disableFilter()">
                            <div class="s-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="filteredUser" style="display: none;" onClick="">
                            <img style="width: 2rem; height: 2rem; border-radius: 50%;" src="https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png">
                            <div class='name'><span style="font-size:13px">Name1</span><span style="font-size:13px">Name2</span>
                            </div>
                        </div>
                        <div class="filteredUser" style="display: none;" onClick="">
                            <img style="width: 2rem; height: 2rem; border-radius: 50%;" src="https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png">
                            <div class='name'><span style="font-size:13px">Base</span><span style="font-size:13px">Blog</span>
                            </div>
                        </div>
                        <div class="filteredUser" style="display: none;" onClick="">
                            <img style="width: 2rem; height: 2rem; border-radius: 50%;" src="https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png">
                            <div class='name'><span style="font-size:13px">Contact</span><span style="font-size:13px">Custom</span>
                            </div>
                        </div>
                        <div class="filteredUser" style="display: none;" onClick="">
                            <img style="width: 2rem; height: 2rem; border-radius: 50%;" src="https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png">
                            <div class='name'><span style="font-size:13px">Contact</span><span style="font-size:13px">Custom</span>
                            </div>
                        </div>
                        <div class="filteredUser" style="display: none;" onClick="">
                            <img style="width: 2rem; height: 2rem; border-radius: 50%;" src="https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png">
                            <div class='name'><span style="font-size:13px">Support</span><span style="font-size:13px">Support</span>
                            </div>
                        </div>
                        <div class="filteredUser" style="display: none;" onClick="">
                            <img style="width: 2rem; height: 2rem; border-radius: 50%;" src="https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png">
                            <div class='name'><span style="font-size:13px">Tools</span><span style="font-size:13px">Support</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="FollowersCard">
                    <h3>Gent suggerida</h3>
                    <?php
                    $counter = 1;
                    while (true) {
                        if (isset($_SESSION['button' . $counter])) {
                            echo "<div class='follower'>
                                        <div>
                                          <img src='" . $_SESSION['fotoPerfil' . $counter] . "' alt='' class='followerImage'>
                                          <div class='name'><span onClick='viewProfile(" . $_SESSION['button' . $counter] . ")'>" . $_SESSION['nomPerfil' . $counter] . "</span><span>" . $_SESSION['nomUsuari' . $counter] . "</span>
                                          </div>
                                        </div>
                                        <button class='button fc-button' onClick='manageFollow(\"" . $_SESSION['followButton' . $counter] . "\"," . $_SESSION['button' . $counter] . ", " . $counter . ")'>" . $_SESSION['followButton' . $counter] . "</button>
                                      </div>";
                        } else {
                            break;
                        }
                        $counter += 1;
                    }
                    ?>
                </div>
            </div>
            <div class="ProfileCenter">
                <div class="ProfileCard">
                    <div class="ProfileImages">
                        <img src="https://images.pexels.com/photos/1287142/pexels-photo-1287142.jpeg?cs=srgb&dl=pexels-eberhard-grossgasteiger-1287142.jpg&fm=jpg" alt="">
                        <img src="<?php echo $_SESSION['fotoPerfil']; ?>" alt="">
                    </div>
                    <?php
                    if ($_SESSION['idProfile'] == $_SESSION['user_id']) {
                        echo "<div id='profileModal' class='editButton'>
                        <span>EDITA</span>
                        <svg class='edit' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'>
                            <path d='M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z' />
                        </svg>
                        </div>
                        <div id='myModal' class='modal'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <span class='close'>&times;</span>
                                <h2>Dades personals</h2>
                            </div>
                            <div class='form'>
                                <div>
                                    <span>Nom: </span><input class='infoInput' type='text' value=\"" . $_SESSION['nomPerfil'] . "\" />
                                
                                    <span>Descripció: </span><input class='infoInput' type='text' placeholder='p.e. Enginyer Informàtic - UIB' value=\"" . $_SESSION['descripcio'] . "\" />
                                </div>
                                <div>
                                    <span>Foto: </span><input class='infoInput' type='text' placeholder='p.e. https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png' value=\"" . ($_SESSION['fotoPerfil'] != 'https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png' ? $_SESSION['fotoPerfil'] : '') . "\" />
                                </div>
                                <button class='button infoButton'>Actualitza</button>
                            </div>
                        </div>
                        </div>";
                    } else {
                        if ($_SESSION['mainFollowButton'] == 'Seguir') {
                            echo "<div onClick='manageFollow(\"" . $_SESSION['mainFollowButton'] . "\", " . $_SESSION['idProfile'] . ")' class='editButton followButton'>
                            <span style='text-transform: uppercase;'>" . $_SESSION['mainFollowButton'] . "</span>
                            <svg class='edit' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><path d='M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z'/></svg>
                            </div>";
                        } else {
                            echo "<div onClick='manageFollow(\"" . $_SESSION['mainFollowButton'] . "\", " . $_SESSION['idProfile'] . ")' class='editButton followButton'>
                            <span style='text-transform: uppercase; font-size: 12px;'>" . $_SESSION['mainFollowButton'] . "</span>
                            <svg class='edit'style='width: 30px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><path d='M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM472 200H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H472c-13.3 0-24-10.7-24-24s10.7-24 24-24z'/></svg>
                            </div>";
                        }
                    }

                    ?>
                    <div class="ProfileName">
                        <span><?php echo $_SESSION['nomPerfil']; ?></span><span><?php echo $_SESSION['descripcio']; ?></span>
                    </div>
                    <div class="followStatus">
                        <hr>
                        <div>
                            <div class="follow"><span><?php echo $_SESSION['numSeguits']; ?></span><span>Seguits</span></div>
                            <div class="vl"></div>
                            <div class="follow"><span><?php echo $_SESSION['numSeguidors']; ?></span><span>Seguidors</span></div>
                            <div class="vl"></div>
                            <div class="follow"><span><?php echo $_SESSION['numPosts']; ?></span><span>Publicacions</span></div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="StoriesSide">
                    <h3>Historias</h3>
                    <div class="Stories">
                        <div>
                            <?php
                            if (!isset($_SESSION['selectedHistory'])) {
                                $id = 1;
                                while (isset($_SESSION['history' . $id])) {
                                    echo "<div class='Story' onClick='selectHistory(" . $_SESSION['idProfile'] . "," . $_SESSION['history' . $id] . ")'>";
                                    if ($_SESSION['historyPhoto' . $id] == '') {
                                        echo "<div style='text-transform: uppercase;'>" . $_SESSION['nomPerfil'][0] . "</div>";
                                    } else {
                                        echo "<img style='object-fit: cover;' src=\"" . $_SESSION['historyPhoto' . $id] . "\" alt=\"Wave-img\">";
                                    }
                                    echo "<span>" . $_SESSION['historyName' . $id] . "</span>
                                    </div>";
                                    $id += 1;
                                }
                                if ($id == 1) {
                                    if ($_SESSION['idProfile'] != $_SESSION['user_id']) {
                                        echo "<span style='margin: auto;'>No hi ha cap història disponible</span>";
                                    } else {
                                        echo "<span style='margin: auto; text-align:center;'>No hi ha cap història disponible</span>";
                                    }
                                }

                                if ($_SESSION['idProfile'] == $_SESSION['user_id']) {
                                    if ($id == 1) {
                                        echo "<div id='modalStories' style='margin-left: 0px;' class='Story Add'>";
                                    } else {
                                        echo "<div id='modalStories' class='Story Add'>";
                                    }
                                    echo "<div>
                                        <svg style=\"width: 20px;\"xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path d='M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z'/></svg>
                                    </div>
                                    <span>Add story</span>
                                    </div>
                                    <div id='storyModal' class='modal'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <span class='close'>&times;</span>
                                            <h2>Nova història</h2>
                                        </div>
                                        <div class='form'>
                                            <div>
                                                <span>Títol: &nbsp</span><input id='historyName' class='infoInput' type='text' placeholder='p.e. Summertimes' />
                                            
                                                <span>Privacitat: </span>
                                                <select class='infoInput' id='privacity' name='privacity' style='padding: 9px;height: 40px;'>
                                                    <option value='Public'>Pública</option>
                                                    <option value='Private'>Privada</option>
                                                </select>
                                            </div>
                                            <div>
                                                <span>Icona: </span><input id='historyPhoto' class='infoInput' type='text' placeholder='p.e. https://iio.azcast.arizona.edu/sites/default/files/profile-blank-whitebg.png' value='' />
                                            </div>
                                            <button onClick='addHistory()' class='button infoButton'>Crear</button>
                                        </div>
                                    </div>
                                    </div>";
                                }
                            } else {
                                echo "<div class='editButton' onClick='viewProfile(" . $_SESSION['idProfile'] . ")' style='margin: auto 0 0 20px;width: 80px; height: 30px;'>
                                <svg style='width: 10px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512'><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z'/></svg>
                                <span style='font-size: 12px;'>Torna</span>
                                </div>";
                                if ($_SESSION['selectedHasContent'] == 1) {
                                    echo "<div class='Story' style='margin: auto;left: -50px;position: relative;'>";
                                    if ($_SESSION['selectedHistoryPhoto'] == '') {
                                        echo "<div style='text-transform: uppercase;'>" . $_SESSION['nomPerfil'][0] . "</div>";
                                    } else {
                                        echo "<img style='object-fit: cover;' src=\"" . $_SESSION['selectedHistoryPhoto'] . "\" >";
                                    }
                                    echo "<span>" . $_SESSION['selectedHistoryName'] . "</span>
                                    </div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="PublicationsSide">
                    <h3>Publicaciones</h3>
                    <div class="Posts">
                        <?php
                        $id = 1;
                        while (isset($_SESSION['publication' . $id])) {
                            echo "<div class=\"Post\">
                                    <img src=\"" . $_SESSION['publicationPhoto' . $id] . "\">
                                    <div class=\"detail\">
                                        <div><span><b>" . $_SESSION['publicationUser' . $id] . "</b></span><span> " . $_SESSION['publicationText' . $id] . "</span></div>
                                    </div>
                                    <div class=\"postReact\">
                                        <div class=\"reaction\"><svg class=\"lnr lnr-heart\">
                                                <use xlink:href=\"#lnr-heart\"></use>
                                            </svg><span>&nbsp; Like</span></div>
                                        <div class=\"reaction\"><svg class=\"lnr lnr-bubble\">
                                                <use xlink:href=\"#lnr-bubble\"></use>
                                            </svg><span>&nbsp; Comment</span></div>
                                        <div class=\"reaction\"><svg class=\"lnr lnr-sync\">
                                                <use xlink:href=\"#lnr-sync\"></use>
                                            </svg><span>&nbsp; Retweet</span></div>
                                    </div>
                                    <span style=\"color: var(--gray); font-size: 12px;\">2301 likes</span>
                                </div>";
                            $id += 1;
                        }
                        if ($id == 1) {
                            echo "<span style='margin: auto;'>" . (isset($_SESSION['selectedHistory']) ? 'No hi ha cap publicació disponible per aquesta història' : 'No hi ha cap publicació disponible') . "</span>";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div class="RightSide">
                <div class="navIcons">
                    <svg onClick="openHome()" class="homeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                    </svg>
                    <svg onClick="viewProfile(<?php echo $_SESSION['user_id'] ?>)" class="profileIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                    </svg>
                    <?php
                    if (isset($_SESSION['numMissatges'])) {
                        echo "<span class='messages'>" . $_SESSION['numMissatges'] . "</span>";
                    }
                    ?>
                    <svg onClick="openMessages()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z" />
                    </svg>
                    <svg onClick="logout()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path d="M534.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L434.7 224 224 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM192 96c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-53 0-96 43-96 96l0 256c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                    </svg>
                </div>
                <div class="TrendCard">
                    <h3>Trends for you</h3>
                    <div class="trend"><span>#Minions</span><span>97k shares</span></div>
                    <div class="trend"><span>#Avangers</span><span>80.5k shares</span></div>
                    <div class="trend"><span>#Zainkeepscode</span><span>75.5k shares</span></div>
                    <div class="trend"><span>#Reactjs</span><span>72k shares</span></div>
                    <div class="trend"><span>#Elon Musk</span><span>71.9k shares</span></div>
                    <div class="trend"><span>#Need for Speed</span><span>20k shares</span></div>
                </div>
                <button class="button r-button">Share</button>
            </div>
        </div>
    </div>
    <script>
        var btn = document.getElementById("profileModal");
        if (btn != null) {
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            btn.onclick = function() {
                modal.style.display = "block";
            }
            span.onclick = function() {
                modal.style.display = "none";
            }
        }

        var btn2 = document.getElementById("modalStories");
        if (btn2 != null) {
            var modal2 = document.getElementById("storyModal");
            var span2 = document.getElementsByClassName("close")[1];
            btn2.onclick = function() {
                modal2.style.display = "block";
            }
            span2.onclick = function() {
                modal2.style.display = "none";
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (btn != null) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            if (btn2 != null) {
                if (event.target == modal2) {
                    modal2.style.display = "none";
                }
            }
        }
    </script>
</body>

</html>