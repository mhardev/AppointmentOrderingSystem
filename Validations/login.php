<?php
    include('Config/dbcon.php');
    //check if the submit button is clicked or not
    if(isset($_POST['login-submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //sql to check the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //execute the sql queery
        $result = mysqli_query($conn,$sql);

        //count the rows 
        $count = mysqli_num_rows($result);

        if($count==1){
            session_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $row['id'];
            
            //user is exist
            echo '
            <script>
                Swal.fire({
                    icon: "success",
                    text: "Login Successful!",
                    timer:1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "Admin/Dashboard.php";
                })
            </script>';
        exit;
        } else{
            //user not available
            echo '
            <script>
                Swal.fire({
                    icon: "error",
                    text: "Username or Password is incorrect.",
                    timer:1000,
                    showConfirmButton: false
                })
            </script>';
        exit;
        }
    }
?>