<?php
    // Checking if admin_id is not set in the session
    if (!isset($_SESSION['admin_id'])) {
        // Redirecting to admin-login.php if session is not set
        echo '<script>
                Swal.fire({
                    icon: "error",
                    text: "You must login first before you proceed!",
                    timer:1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location = "admin-login.php";
                })
            </script>';
    } else {
        // If session is set, proceed with fetching user details
        include('../Config/dbcon.php');
        $id = $_SESSION['admin_id'];
        $sql = "SELECT * FROM `tbl_admin` WHERE id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $image = $row['image']; // Assuming 'image' is the column name in the table storing the image path
        }
    }
?>
