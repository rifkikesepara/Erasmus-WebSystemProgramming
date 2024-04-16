<?php session_start();

// Retrieve cart contents
$cart = $_SESSION['cart'] ?? [];

// echo "<pre>" . print_r($cart) . "</pre>";
$index = 0;

if (isset($_POST['deleteButton'])) {
    $id = $_POST["id"];
    // echo $id;
    // echo $cart[$id]["ID"];
    unset($_SESSION["cart"][$id]);
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['setButton'])) {
    $id = $_POST["id"];
    $_SESSION["cart"][$id]["Count"] = $_POST["count"];
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
    <?php foreach ($cart as $product) : ?>
        <tbody>
            <tr>
                <th scope='row'><?php echo $product['Manifacturer'] ?></th>
                <td><?php echo $product['Name'] ?></td>
                <td><?php echo $product['Desc'] ?></td>
                <td><?php echo $product['Price'] ?></td>
                <td>
                    <form method="post" style="display: flex;align-items: center;flex-direction: column;">
                        <img style="margin-bottom: 5;border-radius: 10px;" src=<?php echo $product['Img'] ?> width="80" />
                        <input style="display: none;" name="id" value=<?php echo $product["ID"] ?> />
                        <input class="form-control" style="width: 60px;margin-bottom: 3;" name="count" type="number" value=<?php echo $product["Count"] ?> />
                        <div>
                            <input style="width: 80px;height: 60px;" name="setButton" type="submit" class="btn btn-success" value="Set" />
                            <input style="width: 80px;height: 60px;" name="deleteButton" type="submit" class="btn btn-danger" value="Delete" />
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
        <?php $index++; ?>
    <?php endforeach; ?>

    <a href='task1.php' class='btn btn-success fixed-bottom w-25'>Go back to list
    </a>