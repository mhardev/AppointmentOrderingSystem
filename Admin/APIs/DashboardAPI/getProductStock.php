<?php 
include('../../Config/dbcon.php');
$sql = "select 
`p`.`product_category` AS `product_category`,
sum(`p`.`product_stock`) AS `ProductStockCount`,
`pb`.`product_buy_count` AS `buyCount` 
from `tbl_product` `p` 
left join `tbl_product_buy_count` `pb` on `p`.`product_category` = `pb`.`product_category` 
group by `p`.`product_category`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>