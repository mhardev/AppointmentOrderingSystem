<?php
include('../../Config/dbcon.php');
$sql = "
WITH
    TotalSales AS(
    SELECT
        SUM(
            tbl_billing.`total_price`
        ) AS productSales
    FROM
        tbl_billing
    WHERE
        tbl_billing.`order_status` = 'Complete'
),
TotalAppointment AS(
    SELECT
        SUM(
            tbl_appointment.`total_cost`
        ) AS appointmentSales
    FROM
        tbl_appointment
    WHERE
        tbl_appointment.`status` = 'Complete'
),
TotalUsers AS(
    SELECT
        COUNT(0) AS Users
    FROM
        tbl_user
),
TotalOrders AS(
    SELECT
        COUNT(0) AS Orders
    FROM
        tbl_billing
)
SELECT
    sales.`productSales` + sales.`appointmentSales` AS TotalSales,
    sales.`Users` AS Users,
    sales.`Orders` AS Orders
FROM
    (
    SELECT
        ts.`productSales` AS productSales,
        ta.`appointmentSales` AS appointmentSales,
        tu.`Users` AS Users,
        tor.`Orders` AS Orders
    FROM
        (
            (
                (
                    totalsales
ts
                JOIN totalappointment
ta
                )
            JOIN totalusers
tu
            )
        JOIN totalorders
tor
        )
) sales";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['TotalSales'] = number_format($row['TotalSales'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>