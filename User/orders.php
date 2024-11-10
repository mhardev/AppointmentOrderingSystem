<?php include('config/dbcon.php');


session_start();


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-JEN | My Orders</title>
    <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    
    <!---Aos animation link-->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 14px; /* Default font size */
        }
    
        th, td {
            padding: 8px;
            text-align: left;
        }
    
        th {
            background-color: #f2f2f2;
        }
    
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    
        @media (max-width: 600px) {
            th, td {
                padding: 5px;
                font-size: 12px; /* Adjusted font size for smaller screens */
            }
        }
    
        @media (max-width: 865px) {
            th, td {
                padding: 5px;
                font-size: 12px; /* Adjusted font size for mid-sized screens */
            }
        }
    
        @media (max-width: 450px) {
            table {
                display: block;
            }
    
            thead {
                display: none;
            }
    
            tbody {
                display: block;
            }
    
            tr {
                display: block;
                margin-bottom: 20px;
            }
    
            td {
                display: block;
                text-align: left;
                border-bottom: 1px solid #ddd;
                font-size: 10px; /* Adjusted font size for smaller mobile screens */
                padding: 5px;
            }
    
            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
            }
        }
    </style>

</head>

<body>

    <header class="header">

        <?php
        include "./pages/sections/navbar.php"
        ?>

    </header>

    <div class="heading">
        <h3>your orders</h3>
        <p><a href="home.php">home </a> <span> / orders</span></p>
    </div>

    <section class="orders" style="padding-top: 0; min-height: 80vh;">

        <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">placed orders</h1>

        <div class="box-container">

            <div class="" id="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Order</th>
                            <th>Price</th>
                            <th>Purchase Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'OrdersAPI/getorders.php',
                    type: 'GET',
                    data: {
                        id: <?php echo $user_id; ?>
                    },
                    dataType: 'json',
                    success: function(data) {
                        var table = $('.table').find('tbody');
                        table.empty();
                        $.each(data, function(index, row) {
                            if (row.order_status !== "Complete") {
                                table.append($('<tr>')
                                    .append($('<td>').text(row.id))
                                    .append($('<td>').text(row.name))
                                    .append($('<td>').text(row.number))
                                    .append($('<td>').text(row.address))
                                    .append($('<td>').text(row.total_products))
                                    .append($('<td>').text(row.total_price))
                                    .append($('<td>').text(row.place_on))
                                    .append($('<td>').text(row.order_status))
                                    .append($('<td>').html(function() {
                                        if (row.order_status === "Cancelled" || row.order_status === "Complete") {
                                            return '<button id="Cancel" data-id="' + row.id + '" disabled>Cancel</button>'
                                        } else {
                                            return '<button id="Cancel" data-id="' + row.id + '">Cancel</button>'
                                        }
                                    }))
                                )            
                            }   
                        });
                    },
                    error: function(data) {
                        alert('Error loading supplier names.');
                    }
                });

                $(".tbl-user").on('click', '#Cancel', function() {
                    Swal.fire({
                        title: 'Do you want cancel your purchase?',
                        icon:'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'OrdersAPI/cancelorder.php',
                                type: 'POST',
                                data: {
                                    id:$(this).data('id'),
                                    userid: <?php echo $user_id; ?>
                                },
                                success: function(data) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Order Cancelled',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                },
                                error: function(error) {
                                    alert(error);
                                }
                            });
                        }
                    })
                });

            })
        </script>

    </section>

    <script src="js/script.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
<footer class="footer">
    <?php
    include "./pages/footer.php"
    ?>
</footer>