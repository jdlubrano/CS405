<?php
/**
 * salesStatistics.php
 * User: Joel
 * Date: 4/19/14
 * Time: 12:18 AM
 */
    require_once "../utilities/DB_Connector.php";
?>
<html>
    <head>
        <?php include_once '../layout/headerTags.php'; ?>
    </head>
    <body>
        <?php
            include_once '../layout/navbar.php';
            include_once '../layout/sidebar.php';
            include_once '../layout/footer.php';
            if(!isset($_GET['period']) || $_GET['period'] == WEEKLY)
                $period = WEEKLY;
            elseif($_GET['period'] == MONTHLY)
                $period = MONTHLY;
            elseif($_GET['period'] == YEARLY)
                $period = YEARLY;
            else
                $period = WEEKLY;
            $query = "SELECT IO.item_id, COUNT(IO.item_id) as cnt, I.name
                      FROM Items I, Item_Orders IO, Orders O
                      WHERE I.item_id = IO.item_id AND O.order_id = IO.order_id AND
                      O.order_date BETWEEN NOW() -  INTERVAL 1 ";
            echo "<h2>Sales Statistics";
            switch($period) {
                case WEEKLY:
                    echo " (Past week)";
                    $query .= "WEEK";
                    break;
                case MONTHLY:
                    echo " (Past month)";
                    $query .= "MONTH";
                    break;
                case YEARLY:
                    echo " (Past year)";
                    $query .= "YEAR";
                    break;
            }
            echo "</h2>";
            $query .= " AND NOW() GROUP BY IO.item_id";
            $result = DB_Connector::getInstance()->executeSimpleQuery($query);
        ?>
        <table>
            <tr>
                <td><a href="salesStatistics.php?period=<?php echo WEEKLY; ?>">Weekly</a></td>
                <td><a href="salesStatistics.php?period=<?php echo MONTHLY; ?>">Monthly</a></td>
                <td><a href="salesStatistics.php?period=<?php echo YEARLY; ?>">Yearly</a></td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Number Sold</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row = $result->fetch())
                {
                    $itemId = $row['item_id'];
                    $name = $row['name'];
                    $cnt = $row['cnt'];
                    echo "<tr>
                            <td>$itemId</td>
                            <td>$name</td>
                            <td>$cnt</td>
                          </tr>";
                }
            ?>
            </tbody>
        </table>
    </body>
</html>
