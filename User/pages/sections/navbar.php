<section class="flex">

    <img src="images/motojenlogofinal.png" class="logo" alt="" >

    <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="products.php">Product</a>
         <a href="services.php">Services</a>
         <a href="orders.php">Orders</a>
         <a href="Appointments.php">Appointments</a>
    </nav>

    <div class="icons">
        <?php
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            //sql query for cart
            $countcartsql = "SELECT * FROM tbl_cart WHERE user_id = $user_id";

            //check the query is executed or not
            $cartres = mysqli_query($conn, $countcartsql);

            $countcarts = mysqli_num_rows($cartres);

            echo '<a href="search.php"><i class="fas fa-search"></i></a>';
            echo '<a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(' . $countcarts . ')</span></a>';
            echo '<a href="notifications.php"><i class="fa fa-bell"></i></a>';
        } else {
            echo '<a href="search.php"><i class="fas fa-search"></i></a>';
            echo '<a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(0)</span></a>';
            echo '<a href="notifications.php"><i class="fa fa-bell"></i></a>';
        }
        ?>
        <div id="user-btn" class="fas fa-user"></div>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>

    <div class="profile">
    <?php
    $name = ''; // Initialize the variable to an empty string

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Assuming you have established the $conn variable for database connection

        // Your existing code to fetch user data
        $userquery = "SELECT * FROM tbl_user WHERE id = $user_id";
        $userresult = mysqli_query($conn, $userquery);
        $usercount = mysqli_num_rows($userresult);

        if ($usercount > 0) {
            while ($userow = mysqli_fetch_assoc($userresult)) {
                $name = $userow['name'];
                // You can process other data here if needed
            }
        } else {
            echo '<script>
                swal({
                    title: "Error",
                    text: "User not available",
                    icon: "error"
                }).then(function() {
                    window.location = "login.php";
                });
            </script>';
            exit;
        }
    } else {
        $name = ''; // Set name to empty if user is not logged in
    }
    ?>
    <?php if ($name !== '') { ?>
    <p class="name"><?php echo $name; ?></p>
    <div class="flex">
        <a href="profile.php" class="btn">profile</a>
        <a href="user-logout.php" class="delete-btn" onclick="confirmLogout(event)">logout</a>
        <script>
            function confirmLogout(event) {
                event.preventDefault();
                
                swal({
                    title: "Logout",
                    text: "Are you sure you want to logout from this app?",
                    icon: "warning",
                    buttons: ["Cancel", "Logout"],
                    dangerMode: true,
                }).then((willLogout) => {
                    if (willLogout) {
                        swal({
                            title: "Success",
                            text: "Logout Successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "user-logout.php";
                        });
                    }
                });
            }
        </script>
    </div>
    <?php } else { ?>
    <p class="account"><a href="login.php">login</a> or <a href="register.php">register</a></p>
    <?php } ?>
    </div>
</section>