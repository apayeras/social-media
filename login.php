<?php
    session_start();
    include('querys/db.php');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        getDB();
        $str_query = "SELECT * FROM usuari WHERE nomUsuari=\"$username\"";
        $query = mysqli_query($con, $str_query);

        if(mysqli_num_rows($query) == 0)
        {
            echo '<p class="error">Username password combination is wrong!</p>';
        }

        while($row = mysqli_fetch_array($query))
        {
            // echo $row['contrasenya'];
            // echo $password;
            if (password_verify($password, $row['contrasenya'])) {
                $_SESSION['user_id'] = $row['id'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
                // index.php
                header("Location: http://localhost/BD2/home.php");
                exit();
            } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }
    }
