<?php
include 'conection.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['logemail'];
    $password = $_POST['logpassword'];

    $sql="SELECT * FROM `user_table` WHERE  `Email` = '$email' ";
    $result=mysqli_query($db , $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res_fetch = mysqli_fetch_assoc($result);
            if (password_verify($password, $res_fetch['Password'])) {
                $_SESSION['fname'] = $res_fetch['Fname'];
                $_SESSION['lname'] = $res_fetch['Lname'];
                $_SESSION['phone'] = $res_fetch['Phone'];
                $_SESSION['email'] = $res_fetch['Email'];
                header("Location: week.php");
                exit();
            } else {
                echo "<script>
                        alert('Wrong password');
                        window.location.href = 'index.php';
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('User does not exist');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('IDK!');
                window.location.href = 'index.php';
              </script>";
       
        exit();
    }
}
?>