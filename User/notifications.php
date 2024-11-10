<?php include('config/dbcon.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-JEN | Notification/s</title>
    <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="notif.css">

    <!---Aos animation link-->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <header class="header">

        <?php
        include "./pages/sections/navbar.php"
        ?>

    </header>

    <div class="heading">
        <h3>MOTO-JEN Notifications</h3>
        <p><a href="home.php">Home </a> <span> / Notifications</span></p>
    </div>

    <section class="service-class" style="padding-top: 2vmin; min-height: 80vh;">

        <div class="row">

            <div class="container">
                <header>
                    <div class="notif_box" style="text-align: center; margin-top: 2.25rem;">
                        <h2 class="title">Recent Notifications</h2>
                    </div>
                </header>
                <main style="margin-top: 5%;">
                    <div class="notification-container">
                    <?php
                        if (isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                            $sql = "(
                                SELECT 'order' as type, id, place_on as timestamp, order_status, NULL as appointment_type, 'Order' as activity
                                FROM tbl_billing
                                WHERE user_id = $user_id
                            )
                            UNION
                            (
                                SELECT 'appointment' as type, id, created_at as timestamp, status as order_status, appointment_type, 'Appointment' as activity
                                FROM tbl_appointment
                                WHERE user_id = $user_id
                            )
                            ORDER BY timestamp DESC";

                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                $count = mysqli_num_rows($res);
                            } else {
                                // Print the SQL error if there is one
                                echo "Error: " . mysqli_error($conn);
                                $count = 0;
                            }

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $order_status = $row['order_status'];
                                    $appointment_type = isset($row['appointment_type']) ? $row['appointment_type'] : ''; // Check if appointment_type is set
                                    $timestamp = strtotime($row['timestamp']);
                                    $activity = $row['activity'];

                                    // Determine notification type based on order/appointment status
                                    $notification_type = '';
                                    if ($activity == 'Order') {
                                        $notification_type = ucfirst($order_status);
                                    } elseif ($activity == 'Appointment') {
                                        $notification_type = ucfirst($order_status);
                                    }
                                    ?>
                                    <div class="notif_card unread" style="margin: 3%;">
                                        <div class="description">
                                            <p class="user_activity">
                                                <strong><?php echo $activity; ?> id: <?php echo $id; ?></strong> <?php echo $activity; ?> placed on at <?php echo date('Y-m-d H:i:s', $timestamp); ?>. <?php echo $activity; ?> status is: <?php echo $order_status; ?>
                                                <?php
                                                // Display appointment_type if available
                                                if ($activity == 'Appointment' && $appointment_type) {
                                                    echo ' for ' . $appointment_type;
                                                }
                                                ?>
                                                <b class="time" data-timestamp="<?php echo date('Y-m-d H:i:s', $timestamp); ?>">0m ago</b>
                                            </p>
                                        </div>
                                        <!-- Add a notification type to the notification container -->
                                        <span class="notification-type"><?php echo $notification_type; ?></span>
                                    </div>
                                <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </main>
    
            </div>

        </div>

    </section>


    <script>
        function updateTime() {
            var timeElements = document.getElementsByClassName("time");
            var now = new Date();

            for (var i = 0; i < timeElements.length; i++) {
                var timeElement = timeElements[i];
                var timestamp = new Date(timeElement.getAttribute("data-timestamp"));
                var timeDifference = now - timestamp;

                var hoursAgo = Math.floor(timeDifference / 3600000); // Convert milliseconds to hours
                var minutesAgo = Math.floor((timeDifference % 3600000) / 60000); // Convert remaining milliseconds to minutes

                var timeText = "";

                if (hoursAgo > 0) {
                    timeText = hoursAgo + "h ago";
                } else {
                    timeText = minutesAgo + "m ago";
                }

                // Update the time text
                timeElement.textContent = timeText;
            }

            // Update the time every 60 seconds
            setTimeout(updateTime, 60000);
        }

        // Call the updateTime function to start updating the time
        updateTime();
        
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


    <script src="js/script.js"></script>
    <script src="notif.js"></script>

</body>

</html>

<footer class="footer">
    <?php
    include "./pages/footer.php"
    ?>
</footer>