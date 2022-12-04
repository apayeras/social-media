<!DOCTYPE html>
<html>

<head>
  <title>Registre</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/authStyle.css">
  <script>
    function validate() {
      if (document.getElementById("password")?.value != document.getElementById("confirmpass")?.value) alert("Passwords do no match");
      return document.getElementById("password")?.value == document.getElementById("confirmpass").value;
      return false;
    }
  </script>
  <?php
  session_start();
  if (isset($_SESSION['register'])) {
    if ($_SESSION['register'] == 0) {
      echo "<script type='text/javascript'>alert('Aquest nom d\'usuari ja existeix, introdueix un altre nom d\'usuari');</script>";
    } else {
      echo "<script type='text/javascript'>alert('El registre ha fallat, intenteu uns minuts més tard');</script>";
    }
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
        <form class="infoForm authForm" onSubmit="return validate()" action="querys/user/insert-user.php" method="post">
          <h3>Registre</h3>

          <div>
            <input type="text" placeholder="Nom d'usuari" class="infoInput" name="username" required />
          </div>

          <div>
            <input type="text" class="infoInput" name="email" placeholder="Correu electrònic" required />
          </div>

          <div>
            <input id="password" type="password" class="infoInput" name="password" placeholder="Contrasenya" required />
            <input id="confirmpass" type="password" class="infoInput" name="confirmpass" placeholder="Confirmació de contrasenya" required />
          </div>

          <div>
            <span style="font-size: 12px">
              <a href="login.php">Ja tens un compte? Inicia sessió</a>
            </span>
            <button class="button infoButton" name="register" value="register" type="submit">Registre</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>