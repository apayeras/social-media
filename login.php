<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inici de sessió</title>
    <link rel="stylesheet" href="styles/authStyle.css">
    <?php
    session_start();
    if (isset($_SESSION['login'])) {
        echo "<script type='text/javascript'>alert('L\'usuari o la contrasenya són incorrectes!');</script>";
    }
    session_destroy();
    ?>
</head>

<body>
    <div class="App">
        <div class="blur" style="top: -18%; right: 0"></div>
        <div class="blur" style="top: 36%; left: -8rem"></div>
        <div class="Auth">
            <div class="a-left">
                <img src="imgs/logo.png" alt="Wave-img">
                <div class="Webname">
                    <h1>Extreamwave</h1>
                    <h2 style="font-size: 16.2px;">El que està passant ara</h2>
                </div>
            </div>
            <div class="a-right">
                <form class="infoForm authForm" action="querys/user/login-user.php" method="post">
                    <h3>Inicia sessió</h3>
                    <div>
                        <input type="text" placeholder="Nom d'usuari" class="infoInput" name="username" required />
                    </div>
                    <div>
                        <input type="password" class="infoInput" placeholder="Contrasenya" name="password" required />
                    </div>
                    <div>
                        <span style="font-size: 12px">
                            <a href="register.php">No tens un compte? Registra't</a>
                        </span>
                        <button class="button infoButton" name="login" value="login" type="submit">Entra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>