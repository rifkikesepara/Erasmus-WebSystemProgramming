<?php
// Retrieve cart contents
$cart = array();
include("config.php");
$queryResult = $dbConnection->query("SELECT * FROM cart");
while ($row = $queryResult->fetch()) {
    array_push($cart, array($row["manifacturer"], $row["name"], $row["desc"], $row["price"], array($row["image"]), $row["count"], $row["id"]));
}

if (isset($_POST['deleteButton'])) {
    $dbConnection->query("DELETE FROM cart WHERE id='" . $_POST["id"] . "'");
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['setButton'])) {
    $id = $_POST["id"];
    $dbConnection->query("UPDATE cart SET count=" . $_POST["count"] . " WHERE id='" . $id . "'");
    echo "<meta http-equiv='refresh' content='0'>";
}

?>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
<table class='table table-striped table-dark table-bordered table-hover' style="margin-bottom: 0px;">
    <thead>
        <tr>
            <th scope='col'>Manufacturer</th>
            <th scope='col'>Name</th>
            <th scope='col'>Description</th>
            <th scope='col'>Price</th>
            <th scope='col'>Image</th>
        </tr>
    </thead>
    <?php for ($i = 0; $i < count($cart); $i++) : ?>
        <tbody>
            <tr>
                <th scope='row'><?php echo $cart[$i][0] ?></th>
                <td><?php echo $cart[$i][1] ?></td>
                <td><?php echo $cart[$i][2] ?></td>
                <td><?php echo $cart[$i][3] ?></td>
                <td>
                    <form method="post" style="display: flex;align-items: center;flex-direction: column;">
                        <img style="margin-bottom: 5;border-radius: 10px;" src=<?php echo $cart[$i][4][0] ?> width="80" />
                        <input style="display: none;" name="id" value=<?php echo $cart[$i][6] ?> />
                        <input class="form-control" style="width: 60px;margin-bottom: 3;" name="count" type="number" value=<?php echo $cart[$i][5] ?> />
                        <div>
                            <input style="width: 80px;height: 60px;" name="setButton" type="submit" class="btn btn-success" value="Set" />
                            <input style="width: 80px;height: 60px;" name="deleteButton" type="submit" class="btn btn-danger" value="Delete" />
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    <?php endfor; ?>
</table>
<a href='products.php' class='btn btn-success fixed-bottom w-25'>Go back to list
</a>