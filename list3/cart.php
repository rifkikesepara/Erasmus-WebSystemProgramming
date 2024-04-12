<?php session_start();

// Retrieve cart contents
$cart = $_SESSION['cart'] ?? [];

// echo var_dump($cart);
$index = 0;

if (isset($_POST['deleteButton'])) {
    $id = $_POST["id"];
    echo $id;
    echo $cart[$id];
    unset($_SESSION["cart"][$id]);
    unset($cart[$id]);
}

?>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
<table class='table table-striped table-dark table-bordered table-hover'>
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
                    <form method="post">
                        <img src=<?php echo $product['Img'] ?> width="70" />
                        <input style="display: none;" name="id" value=<?php echo $index ?> />
                        <input name="deleteButton" type="submit" class="btn btn-warning" value="Delete" />
                    </form>
                </td>
            </tr>
        </tbody>
        <?php $index++; ?>
    <?php endforeach; ?>

    <a href='task1.php' class='btn btn-success fixed-bottom w-25'>Go back to list
    </a>