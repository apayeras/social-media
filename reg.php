<?php
    session_start();
    include('querys/db.php');
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        getDB();

        $str_query = "SELECT * FROM usuari WHERE nomUsuari='".$username."'";

        $query = mysqli_query($con, $str_query);

        if ($query->num_rows > 0) {
            session_destroy();
            header("Location: http://localhost/BD2/register.html");
            echo "<script type='text/javascript'>alert('Aquest nom d'usuari ja existeix');</script>";
        }
        if ($query->num_rows == 0) {
            $str_query = "INSERT INTO usuari(nomUsuari,contrasenya,email) VALUES (\"$username\",\"$password_hash\",\"$email\")";
            $query = mysqli_query($con, $str_query);

            if(!$query){
                echo '<p class="error">Something went wrong!</p>';
            }
            if($query){
                echo '<p class="success">Your registration was successful!</p>';
            }

             closeDB();
        
        }
    }
