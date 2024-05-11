<?php
include("config.php");

$queryResult = $dbConnection->query("SELECT * FROM products");
$products = array();
while ($row = $queryResult->fetch()) {
  array_push($products, array($row["manifacturer"], $row["name"], $row["desc"], $row["price"], array($row["image"]), $row["id"]));
}

if (isset($_POST["saveChanges"])) {
  $dbConnection->query("UPDATE products SET manifacturer='" . $_POST["Manifacturer"] . "',name='" . $_POST["Name"] . "',`desc`='" . $_POST["Desc"] . "',price=" . $_POST["Price"] . ",image='" . $_POST["Image"] . "' WHERE id=" . $_POST["id"]);
  echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST["delete"])) {
  $dbConnection->query("DELETE FROM products WHERE manifacturer='" . $_POST["delMan"] . "'");
  echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST["addProduct"])) {
  $exist = $dbConnection->query("SELECT EXISTS(SELECT * FROM products WHERE manifacturer='" . $_POST["manifacturer"] . "')")->fetch()[0];
  if (!$exist) {
    $sql = "INSERT INTO products(manifacturer,name,`desc`,price,image) VALUES (:p_manifacturer,:p_name,:p_desc,:p_price,:p_image)";
    $queryParam = $dbConnection->prepare($sql);
    $queryParam->bindValue(":p_manifacturer", $_POST["manifacturer"]);
    $queryParam->bindValue(":p_name", $_POST["name"]);
    $queryParam->bindValue(":p_desc", $_POST["desc"]);
    $queryParam->bindValue(":p_price", $_POST["price"]);
    $queryParam->bindValue(":p_image", $_POST["image"]);
    $queryParam->execute();
    echo "<meta http-equiv='refresh' content='0'>";
  } else {
    echo "Product Already Exists";
  }
}


function getString($var)
{
  $temp = explode(" ", $var);
  $newstr = "";
  for ($i = 0; $i < count($temp); $i++) {
    $newstr .= $temp[$i];
  }

  return $newstr;
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
      <!-- Edit Details -->
      <div class="modal fade" id=<?php echo "exampleModalCenter" . $i ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $products[$i % count($products)][1] ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 10px;">
                      <label for="deneme">Manifacturer</label>
                      <input value=<?php echo $products[$i % count($products)][0] ?> class="form-control" id="deneme" name="Manifacturer" placeholder="Manifacturer" autocomplete="off">
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                      <label for="exampleInputName">Name</label>
                      <input value=<?php echo getString($products[$i % count($products)][1]); ?> class="form-control" name="Name" id="exampleInputName" placeholder="Name" autocomplete="off">
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                      <label for="exampleInputDesc">Description</label>
                      <input value=<?php echo getString($products[$i % count($products)][2]) ?> class="form-control" name="Desc" id="exampleInputdesc" placeholder="Description" autocomplete="off">
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                      <label for="exampleInputPrice">Price</label>
                      <input value=<?php echo $products[$i % count($products)][3] ?> class="form-control" name="Price" id="exampleInputprice" placeholder="Price" autocomplete="off">
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                      <label for="exampleInputImage">Image</label>
                      <input value=<?php echo $products[$i][4][0] ?> class="form-control" name="Image" id="exampleInputimage" placeholder="url" autocomplete="off">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input name="id" value=<?php echo $products[$i][5] ?> style="display: none;" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="saveChanges" class="btn btn-warning" value="Save Changes" />
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <!-- ----------------------------------------------------------------------------- -->


      <!-- Add Modal -->
      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addProduct" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add A Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group" style="margin-bottom: 10px;">
                  <label for="exampleInputEmail1">Manifacturer</label>
                  <input class="form-control" name="manifacturer" id="exampleInputEmail1" placeholder="Manifacturer" autocomplete="off">
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                  <label for="exampleInputPassword1">Name</label>
                  <input class="form-control" name="name" id="exampleInputPassword1" placeholder="Name" autocomplete="off">
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                  <label for="exampleInputDesc">Description</label>
                  <input class="form-control" name="desc" id="exampleInputPassword1" placeholder="Description" autocomplete="off">
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                  <label for="exampleInputPrice">Price</label>
                  <input class="form-control" name="price" id="exampleInputPassword1" placeholder="Price" autocomplete="off">
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                  <label for="exampleInputImage">Image</label>
                  <input class="form-control" name="image" id="exampleInputPassword1" placeholder="url" autocomplete="off">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input name="productName" value=<?php echo $products[$i][0] ?> style="display: none;" />
                <input type="submit" name="addProduct" class="btn btn-primary" value="Add" />
            </form>
          </div>
        </div>
      </div>
      </div>
      <!-- ----------------------------------------------------------------------------- -->
      <tbody>
        <tr>
          <th scope='row'><?php echo $products[$i % count($products)][0] ?></th>
          <td><?php echo $products[$i % count($products)][1] ?></td>
          <td><?php echo $products[$i % count($products)][2] ?></td>
          <td><?php echo $products[$i % count($products)][3] ?></td>
          <td>
            <form method='post'>
              <img width='70' src=<?php echo $products[$i % count($products)][4][0] ?> />
              <input name='delMan' value=<?php echo $products[$i % count($products)][0] ?> style='display:none;' />
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target=<?php echo "#exampleModalCenter" . $i ?>>
                Edit
              </button>
              <button type="submit" class="btn btn-danger" name="delete">
                Delete
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    <?php endfor; ?>
  </table>
  <a href='products.php' class='btn btn-success w-10' style="position: fixed;bottom:0;right:0;">Logout</a>
  <button type="button" class="btn btn-success" style="position: fixed;bottom:0;left:0;" data-bs-toggle="modal" data-bs-target="#addModal">
    Add New Product
  </button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>