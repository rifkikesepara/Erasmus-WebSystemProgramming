<?php
include("config.php");
$queryResult = $dbConnection->query("SELECT * FROM products");
$products = array();
while ($row = $queryResult->fetch()) {
  array_push($products, array($row["manifacturer"], $row["name"], $row["desc"], $row["price"], array($row["image"]), $row["id"]));
}

if (isset($_POST['add'])) {
  $id = $_POST['productIndex'];
  $selectedProduct = $dbConnection->query("SELECT *  FROM products WHERE id=" . $id)->fetch();
  $exist = $dbConnection->query("SELECT EXISTS(SELECT * FROM cart WHERE manifacturer='" . $selectedProduct["manifacturer"] . "')")->fetch()[0];
  if (!$exist) {
    $sql = "INSERT INTO cart(id,manifacturer,name,`desc`,price,image,count) VALUES (:p_id,:p_manifacturer,:p_name,:p_desc,:p_price,:p_image,1)";
    $queryParam = $dbConnection->prepare($sql);
    $queryParam->bindValue(":p_id", $selectedProduct["id"]);
    $queryParam->bindValue(":p_manifacturer", $selectedProduct["manifacturer"]);
    $queryParam->bindValue(":p_name", $selectedProduct["name"]);
    $queryParam->bindValue(":p_desc", $selectedProduct["desc"]);
    $queryParam->bindValue(":p_price", $selectedProduct["price"]);
    $queryParam->bindValue(":p_image", $selectedProduct["image"]);
    $queryParam->execute();
  } else {
    $count = $dbConnection->query("SELECT count FROM cart WHERE manifacturer='" . $selectedProduct["manifacturer"] . "'")->fetch()[0];
    $dbConnection->query("UPDATE cart SET count=" . ($count + 1) . " WHERE id='" . $selectedProduct["id"] . "'");
  }
  // echo "Index: " . $id;
}
?>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<body>
  <table class='table table-striped table-dark table-bordered table-hover' style='margin-bottom:0px;'>
    <thead>
      <tr>
        <th scope='col'>Manufacturer</th>
        <th scope='col'>Name</th>
        <th scope='col'>Description</th>
        <th scope='col'>Price</th>
        <th scope='col'>Image</th>
      </tr>
    </thead>


    <?php for ($i = 0; $i < count($products); $i++) : ?>

      <tbody>
        <tr>
          <th scope='row'><?php echo $products[$i % count($products)][0] ?></th>
          <td><?php echo $products[$i % count($products)][1] ?></td>
          <td><?php echo $products[$i % count($products)][2] ?></td>
          <td><?php echo $products[$i % count($products)][3] ?></td>
          <td>
            <form method='post'>
              <img width='70' src=<?php echo $products[$i % count($products)][4][0] ?> />
              <input name='productIndex' value=<?php echo $products[$i % count($products)][5] ?> style='display:none;' />
              <input class='btn btn-primary' name='add' type='submit' value='ADD' />
            </form>
          </td>
        </tr>
      </tbody>
    <?php endfor; ?>
  </table>
  <a href='cart.php' class='btn btn-success fixed-bottom w-25'>Go to the cart
    <span class='badge badge-light' style='font-size:18px;'><?php echo $dbConnection->query("SELECT COUNT(*) FROM cart")->fetch()[0] ?></span>
  </a>
  <a href='adminLogin.php' class='btn btn-success w-10' style="position: fixed;bottom:0;right:0;">Admin Login </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>