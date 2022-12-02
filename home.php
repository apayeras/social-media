<?php
session_start();
include('querys/home-information.php');
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="Refresh" content="30"> -->
  <link rel="stylesheet" href="styles/home.css">
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
      location.replace(`manage-follow.php?follow=${follow}&idProfile=${idProfile}&idButton=${idButton}&location=home.php`);
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
      //filtered = div.getElementsByTagName("a");
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

    function loadHistory(id, historyName) {
      var text = document.getElementById('publicationText').value;
      location.replace(`home-history.php?text=${text}&historyId=${id}&historyName=${historyName}`);
    }

    function openHistorySelector() {
      div = document.getElementsByClassName("historySelector");
      for (i = 0; i < div.length; i++) {
        div[i].style.display = "";
      }
    }

    function sharePublication(id) {
      var text = document.getElementById('publicationText').value;
      location.replace(`share-publication.php?text=${text}&historyId=${id}`);
    }

    document.addEventListener('mouseup', function(e) {
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
            <div id="divUsers" style="display: flex">
              <input type="text" class="nameInput" id="searchInput" placeholder="Cercar" onkeyup="filterNames()" onfocusin="filterNames()">
              <div class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"></path>
                </svg>
              </div>
            </div>
            <?php
            $id = 1;
            while (isset($_SESSION['usuari' . $id])) {
              echo "<div class=\"filteredUser\" style=\"display: none;\" onClick=\"viewProfile(" . $_SESSION['usuari' . $id] . ")\">
                <img style=\"width: 2rem; height: 2rem; border-radius: 50%;\" src=\"" . $_SESSION['usuariFoto' . $id] . "\">
                <div class='name'><span style=\"font-size:13px\">" . $_SESSION['usuariPerfil' . $id] . "</span><span style=\"font-size:13px\">" . $_SESSION['usuariNom' . $id] . "</span>
                </div>
              </div>";
              $id += 1;
            }
            ?>

          </div>
        </div>

        <div class="ProfileCard">
          <div class="ProfileImages">
            <img src="https://images.pexels.com/photos/1287142/pexels-photo-1287142.jpeg?cs=srgb&dl=pexels-eberhard-grossgasteiger-1287142.jpg&fm=jpg" alt="">
            <img src="<?php echo $_SESSION['fotoPerfil']; ?>" alt="">
          </div>
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
      <div class="PostSide">
        <div class="PostShare">
          <img src="<?php echo $_SESSION['fotoPerfil']; ?>" alt="">
          <div>
            <?php
            if (isset($_SESSION['selectedHistoryId'])) {
              echo "<div class=\"selectedHistory\"><span style=\"margin-left:10px;\">història: </span><span id=\"historySelected\" style=\"margin-left: 5px; font-weight: bold;\">" . $_SESSION['selectedHistoryName'] . "</span>
                <svg class=\"deleteButton\" onClick=\"loadHistory(-1, '')\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\">
                  <path d=\"M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z\"></path>
                </svg>
              </div>";
            }
            if (isset($_SESSION['inputText'])) {
              echo "<input id='publicationText' type='text' placeholder='Que està passant...' value='" . $_SESSION['inputText'] . "'>";
            } else {
              echo "<input id='publicationText' type='text' placeholder='Que està passant...'>";
            }
            ?>
            <div class="postOptions">
              <div class="option" style="color: var(--photo);"><svg class="lnr lnr-picture">
                  <use xlink:href="#lnr-picture"></use>
                </svg><span>Afegir foto</span></div>
              <div class="option" style="color: var(--video);"><svg class="lnr lnr-film-play">
                  <use xlink:href="#lnr-film-play"></use>
                </svg><span>Afegir video</span></div>
              <div id="divHistory" style="position: relative;" onClick="openHistorySelector()">
                <div class="option" style="color: var(--history);"><svg class="lnr lnr-list">
                    <use xlink:href="#lnr-list"></use>
                  </svg><span>Afegir a història</span>
                </div>
                <div style="position:absolute; border-radius: 8px; background-color: rgba(255, 255, 255, 0.84)">
                  <?php
                  $id = 1;
                  while (isset($_SESSION['history' . $id])) {
                    echo "<div class='historySelector' style='display:none;' onClick='loadHistory(" . $_SESSION['history' . $id] . ",\"" . $_SESSION['historyName' . $id] . "\")'>";
                    if ($_SESSION['historyPhoto' . $id] == '') {
                      echo "<div style='text-transform: uppercase; font-size: 14px;'>" . $_SESSION['nomPerfil'][0] . "</div>";
                    } else {
                      echo "<img style='object-fit: cover;' src=\"" . $_SESSION['historyPhoto' . $id] . "\">";
                    }
                    echo "<span style=\"font-size:12px\">" . $_SESSION['historyName' . $id] . "</span>
                      </div>";
                    $id += 1;
                  }
                  ?>
                </div>

              </div>


              <div class="option" style="color: var(--discard);"><svg class="lnr lnr-trash">
                  <use xlink:href="#lnr-trash"></use>
                </svg><span>Descartar missatge</span></div>
              <button class="button ps-button" <?php
                                                if (isset($_SESSION['selectedHistoryId'])) {
                                                  echo "onClick=\"sharePublication(" . $_SESSION['selectedHistoryId'] . ")\"";
                                                } else {
                                                  echo "onClick=\"sharePublication(null)\"";
                                                }
                                                ?>>Compartir</button>

              <div style="display: none;"><input type="file" name="myImage"></div>
            </div>
          </div>
        </div>
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
                        </svg><span>&nbsp; M'agrada</span></div>
                    <div class=\"reaction\"><svg class=\"lnr lnr-bubble\">
                            <use xlink:href=\"#lnr-bubble\"></use>
                        </svg><span>&nbsp; Comenta</span></div>
                    <div class=\"reaction\"><svg class=\"lnr lnr-sync\">
                            <use xlink:href=\"#lnr-sync\"></use>
                        </svg><span>&nbsp; Reenvia</span></div>
                </div>
                <span>
                <span style=\"color: var(--gray); font-size: 12px;\"> 0 M'agrada</span>
                <span style=\"color: var(--gray); font-size: 12px; float:right;\">" . $_SESSION['publicationDate' . $id] . "</span>
                </span>
            </div>";
            $id += 1;
          }
          if ($id == 1) {
            echo "<span style='margin: 30px auto;border-radius: 5px;width: 95%;text-align: center;'>No hi ha cap publicació disponible. <br> Segueix a més usuaris per veure les seves publicacions.</span>";
          }

          ?>
        </div>
      </div>
      <div class="RightSide">
        <div class="navIcons">
          <svg onClick="openHome()" class="homeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
          </svg>
          <svg onClick="viewProfile(<?php echo $_SESSION['user_id'] ?>)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
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
          <h3>Tendències actuals</h3>
          <div class="trend"><span>#somUIB</span><span>7k shares</span></div>
          <div class="trend"><span>#Mundial</span><span>10.5k shares</span></div>
          <div class="trend"><span>#Clean code</span><span>1.5k shares</span></div>
          <div class="trend"><span>#Base de dades II</span><span>2k shares</span></div>
          <div class="trend"><span>#Cryptos</span><span>1.9k shares</span></div>
          <div class="trend"><span>#F1</span><span>839 shares</span></div>
        </div>
        <button class="button r-button">Compartir</button>
      </div>
    </div>
  </div>
</body>

</html>