<?php
session_start();
include('querys/home-information.php');
?>
<html>

<head>
  <meta charset="UTF-8">
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
          <div class="Search">
            <input type="text" placeholder="Cercar">
            <div class="s-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"></path>
              </svg>
            </div>
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
            <input type="text" placeholder="What's happening">
            <div class="postOptions">
              <div class="option" style="color: var(--photo);"><svg class="lnr lnr-picture">
                  <use xlink:href="#lnr-picture"></use>
                </svg><span>Afegir foto</span></div>
              <div class="option" style="color: var(--video);"><svg class="lnr lnr-film-play">
                  <use xlink:href="#lnr-film-play"></use>
                </svg><span>Afegir video</span></div>
              <div class="option" style="color: var(--history);"><svg class="lnr lnr-list">
                  <use xlink:href="#lnr-list"></use>
                </svg><span>Afegir a història</span></div>
              <div class="option" style="color: var(--discard);"><svg class="lnr lnr-trash">
                  <use xlink:href="#lnr-trash"></use>
                </svg><span>Descartar missatge</span></div>
              <button class="button ps-button">Share</button>
              <div style="display: none;"><input type="file" name="myImage"></div>
            </div>
          </div>
        </div>
        <div class="Posts">
          <div class="Post">
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Kung_Hei_Fat_Choi%21_%286834861529%29.jpg" alt="">
            <div class="detail">
              <div><span><b>Tzuyu</b></span><span> Happy New Year all friends! #2023</span></div>
            </div>
            <div class="postReact">
              <div class="reaction"><svg class="lnr lnr-heart">
                  <use xlink:href="#lnr-heart"></use>
                </svg><span>&nbsp; Like</span></div>
              <div class="reaction"><svg class="lnr lnr-bubble">
                  <use xlink:href="#lnr-bubble"></use>
                </svg><span>&nbsp; Comment</span></div>
              <div class="reaction"><svg class="lnr lnr-sync">
                  <use xlink:href="#lnr-sync"></use>
                </svg><span>&nbsp; Retweet</span></div>
            </div>
            <span style="color: var(--gray); font-size: 12px;">2301 likes</span>
          </div>
          <div class="Post">
            <img alt="">
            <div class="detail">
              <div><span><b>Tzuyu</b></span><span> Happy New Year all friends! #2023</span></div>
            </div>
            <div class="postReact">
              <div class="reaction"><svg class="lnr lnr-heart">
                  <use xlink:href="#lnr-heart"></use>
                </svg><span>&nbsp; Like</span></div>
              <div class="reaction"><svg class="lnr lnr-bubble">
                  <use xlink:href="#lnr-bubble"></use>
                </svg><span>&nbsp; Comment</span></div>
              <div class="reaction"><svg class="lnr lnr-sync">
                  <use xlink:href="#lnr-sync"></use>
                </svg><span>&nbsp; Retweet</span></div>
            </div>
            <span style="color: var(--gray); font-size: 12px;">2301 likes</span>
          </div>
          <div class="Post">
            <img alt="">
            <div class="detail">
              <div><span><b>Tzuyu</b></span><span> Happy New Year all friends! #2023</span></div>
            </div>
            <div class="postReact">
              <div class="reaction"><svg class="lnr lnr-heart">
                  <use xlink:href="#lnr-heart"></use>
                </svg><span>&nbsp; Like</span></div>
              <div class="reaction"><svg class="lnr lnr-bubble">
                  <use xlink:href="#lnr-bubble"></use>
                </svg><span>&nbsp; Comment</span></div>
              <div class="reaction"><svg class="lnr lnr-sync">
                  <use xlink:href="#lnr-sync"></use>
                </svg><span>&nbsp; Retweet</span></div>
            </div>
            <span style="color: var(--gray); font-size: 12px;">2301 likes</span>
          </div>
          <div class="Post">
            <img alt="">
            <div class="detail">
              <div><span><b>Tzuyu</b></span><span> Happy New Year all friends! #2023</span></div>
            </div>
            <div class="postReact">
              <div class="reaction"><svg class="lnr lnr-heart">
                  <use xlink:href="#lnr-heart"></use>
                </svg><span>&nbsp; Like</span></div>
              <div class="reaction"><svg class="lnr lnr-bubble">
                  <use xlink:href="#lnr-bubble"></use>
                </svg><span>&nbsp; Comment</span></div>
              <div class="reaction"><svg class="lnr lnr-sync">
                  <use xlink:href="#lnr-sync"></use>
                </svg><span>&nbsp; Retweet</span></div>
            </div>
            <span style="color: var(--gray); font-size: 12px;">2301 likes</span>
          </div>


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
</body>

</html>