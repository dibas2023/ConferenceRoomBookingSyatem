<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'conection.php';
session_start();

if (isset($_POST['signin'])) {
    $Fname = $_POST['fname'];
    $Lname = $_POST['lname'];
    $Phone = $_POST['phone'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $user_exist = "SELECT * FROM `user_table` WHERE `Email`= '$Email'";
    $result=mysqli_query($db , $user_exist);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $data_fetch = mysqli_fetch_assoc($result);
            if ($data_fetch['Email'] == $Email) {
                echo "<script> 
                        alert(' This $Email is already registered');
                        window.location.href = 'index.php';
                      </script>";
                exit();
            }
        } else {
            
            $password = password_hash($Password, PASSWORD_BCRYPT);

            $insert = "INSERT INTO `user_table` ( `Fname`, `Lname`,`Phone`,`Email`,`Password`) VALUES ('$Fname','$Lname','$Phone', '$Email','$password')";
            $signResult= mysqli_query($db,$insert);
            if ($signResult) {
                echo "<script>
                        alert('Registration Successful');
                        window.location.href = 'index.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Something Went Wrong!');
                        window.location.href = 'index.php';
                      </script>";
                exit();
            }
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