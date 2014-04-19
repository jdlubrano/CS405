<?php
    require_once "authenticateManager.php";
    require_once "../utilities/DB_Connector.php";
?>

<html>
    <head>
        <?php include_once '../layout/headerTags.php'; ?>
    </head>
    <body>
        <h2>Promotion History</h2>
        <?php
            include_once '../layout/navbar.php';
            include_once '../layout/sidebar.php';
            include_once '../layout/footer.php';
            const GET_PROMOTIONS = "SELECT P.promotion_id, P.discount,
                                    DATE_FORMAT(P.start_date, '%M %d %Y') as start_date,
                                    DATE_FORMAT(P.end_date, '%M %d %Y') as end_date, S.name
                                    FROM Promotions P, Staff S
                                    WHERE P.created_by = S.staff_id";
            $result = DB_Connector::getInstance()->executeSimpleQuery(GET_PROMOTIONS);
        ?>
        <table id="promoTable">
            <thead>
                <tr>
                    <th>Promotion ID</th>
                    <th>Discount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Created By</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    const GET_ITEMS_IN_PROMO = "SELECT * FROM Items I, Included Inc
                                                WHERE I.item_id = Inc.item_id
                                                AND Inc.promotion_id = ?";

                    while($row = $result->fetch())
                    {
                        $id = $row['promotion_id'];
                        $discount = $row['discount'] * 100 . "%";
                        $startDate = $row['start_date'];
                        $endDate = $row['end_date'];
                        $creator = $row['name'];
                        echo "<tr>
                                <td>$id</td>
                                <td>$discount</td>
                                <td>$startDate</td>
                                <td>$endDate</td>
                                <td>$creator</td>";
                        if($endDate == '')
                        {
                            echo "<td><button class=stopPromoBtn
                                        type=button promo=$id>Stop Promotion</button></td>";
                        }
                        echo "</tr>";
                        echo "<tr>
                                  <td class=bordered colspan=6>
                                  Items included:<br />
                                    <ul>";
                                        $itemsResult = DB_Connector::getInstance()->
                                        executePreparedQuery(GET_ITEMS_IN_PROMO,
                                                             array($id));
                                        while($item = $itemsResult->fetch())
                                        {
                                            $itemName = $item['name'];
                                            echo "<li style=list-style-type:none;>$itemName</li>";
                                        }

                        echo       "</ul>
                                  </td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>