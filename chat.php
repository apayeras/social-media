<?php
include('querys/chat-information.php');
if (isset($_GET['idchat'])) {
    $_SESSION['perfilSeleccionat'] = $_GET['idchat'];
}
?>
<html>

<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="Refresh" content="30"> -->
    <title>Chat1</title>
    <link rel="stylesheet" href="styles/chat.css">
    <script type="text/javascript">
        function logout() {
            location.replace("logout.php");
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
            location.replace(`read-messages.php?idchat=${id}&nom=${nom}&foto=${foto}&counter=${counter}`);
        }
    </script>
</head>

<body>
    <div class="App">
        <div class="blur" style="top: -18%; right: 0"></div>
        <div class="blur" style="top: 36%; left: -8rem"></div>
        <div class="Chat">
            <div class="Left-side-chat">
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
                <div class="Chat-container">
                    <h2>Chats</h2>
                    <?php
                    $counter = 1;
                    while (true) {
                        if (isset($_SESSION['idPerfil' . $counter])) {
                            echo "<div class='Chat-conversation'>
                                <div onclick='selectChat(" . $_SESSION['idPerfil' . $counter] . ", \"" . $_SESSION['nomPerfil' . $counter] . "\", \"" . $_SESSION['fotoPerfil' . $counter] . "\", " . $_SESSION['counter' . $counter] . ")' class='User'>
                                <img src='" . $_SESSION['fotoPerfil' . $counter] . "' alt='' class='Conversation-Image'>
                                <div class='name'>
                                    <div>
                                        <span>" . $_SESSION['nomPerfil' . $counter] . "</span>";
                            if ($_SESSION['counter' . $counter] > 0) {
                                echo "<span class='counter'>" . $_SESSION['counter' . $counter] . "</span>";
                            }

                            echo "</div>
                                    <span class='date'>" . $_SESSION['dataMax' . $counter] . "</span>
                                </div>
                              </div>
                              <hr style='width: 85%; border: 0.1px solid #b8c4db'/>
                            </div>";
                        } else {
                            break;
                        }
                        $counter += 1;
                    }
                    ?>
                </div>
            </div>

            <div class="Right-side-chat">
                <div class="NavContainer">
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
                        <svg onClick="openMessages()" class="messageIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z" />
                        </svg>
                        <svg onClick="logout()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M534.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L434.7 224 224 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM192 96c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-53 0-96 43-96 96l0 256c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ChatBox-container">
                    <?php
                    if (isset($_SESSION['perfilSeleccionat'])) {

                        echo "<div class=\"chat-header\">
                                <div class=\"Chat-conversation\">
                                    <div>
                                        <img class=\"Conversation-Image\" src=\"" . $_SESSION['fotoSeleccionat'] . "\"/>
                                        <div class=\"name\">
                                            <span class=\"profileName\">" . $_SESSION['nomSeleccionat'] . "</span>
                                        </div>
                                    </div>
                                </div>
                                <hr style=\"width: 95%; border: 0.1px solid #b8c4db; margin-top: 15px;\"/>
                            </div>
                            <div class=\"chat-body\">";
                        $id = 1;
                        while (true) {
                            if (isset($_SESSION['idMissatge' . $id])) {
                                echo "<div class=\"" . $_SESSION['emissor' . $id] . "\">
                                    <span>" . $_SESSION['text' . $id] . "</span>
                                    <span>" . $_SESSION['data' . $id] . "</span>
                                    </div>";
                                $id += 1;
                            } else {
                                break;
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "<div class=\"select-chat\">
                                <img class=\"img-chat\" src=\"imgs/chatting-icon.png\">
                                <h2>Selecciona un chat para continuar</h2>
                            </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>