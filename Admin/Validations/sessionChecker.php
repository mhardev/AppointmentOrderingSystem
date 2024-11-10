<?php   
    if (!isset($_SESSION['admin_id'])) {
    echo    '<script>
                Swal.fire({
                    icon: "error",
                    text: "You must login first before you proceed!",
                    timer:1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "../adminlogin.php";
                })
            </script>';
        exit;
    }
?>