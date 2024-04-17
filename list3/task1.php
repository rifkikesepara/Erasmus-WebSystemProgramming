<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$products = array(
  array("Nestle", "Nestle Crunch", "Nestle Crunch Pirinç Patlaklı Sütlü Çikolata 10x31,5 Gr", "₺99,50", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/DjcCIMFrS7_256x256.png")),
  array("ÜLKER", "Ülker Choclate", "Ülker Sütlü Çikolata 60 Gr", "₺22,50", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/-Sc9Xk4Otp_256x256.png")),
  array("VİNCE", "Vince Bütün Fındıklı Çikolata", "Vince Bütün Fındıklı Çikolata 100 Gr", "₺24,90", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/a0WPOKh9Nd_256x256.png")),
  array("ETİ", "Eti Biscuit", "Eti Burçak Yulaflı Mini Bisküvi 160 Gr", "₺14,95", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/qmDqAkMOvl_256x256.png")),
  array("ÇEREZYA", "Çerezya Kuruyemiş Badem", "Çerezya Kuruyemiş Badem İçi 250 Gr", "₺97,50", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/X7r2eF23hz_256x256.png")),
  array("VIVIDENT", "Vivident 45 Minutes", "Vivident 45 Dk Nane Aromalı Sakız 33 Gr", "₺25,00", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/cw9oQhkFqI_256x256.png")),
  array("DANONE", "Disney Puding", "Disney Hüpper Çikolatalı&Muzlu Puding Hazır Tatlı 70 Gr", "₺18,00", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/FFTJoicSqP_256x256.png")),
  array("TADAL", "Tadal Revani", "Tadal Revani 300 Gr", "₺39,00", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/WUm9g2Gaoz_256x256.png")),
  array("ŞANAL", "Şanal Kalburabastı", "Şanal Kalburabastı 200 Gr", "₺19,50", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/p2TMzDBhU1_256x256.png")),
  array("DR.OETKER", "Dr. Oetker Kakaolu Puding", "Dr. Oetker Kakaolu Puding 196 Gr", "₺30,00", array("https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/89DiD1zOtv_256x256.png")),
);

if (isset($_POST['add'])) {
  $id = $_POST['productIndex'];
  // echo "Index: " . $id;

  $_SESSION['cart'][$id]['Manifacturer'] = $products[$id][0];
  $_SESSION['cart'][$id]['Name'] = $products[$id][1];
  $_SESSION['cart'][$id]['Desc'] = $products[$id][2];
  $_SESSION['cart'][$id]['Price'] = $products[$id][3];
  $_SESSION['cart'][$id]['Img'] = $products[$id][4];
  $_SESSION['cart'][$id]['ID'] = $id;
  if (!isset($_SESSION['cart'][$id]['Count'])) $_SESSION['cart'][$id]['Count'] = 1;
  else $_SESSION['cart'][$id]['Count'] += 1;
}


if (isset($_POST["uploadPhoto"]))
  include("upload.php");

$folder = "photos/";
// $allowExt = array("jpg", "jpeg", "png", "gif");
// $files = scandir($folder);
// $photos = array();


// foreach ($files as $file) {
//   $fileData = pathinfo($folder . $file);
//   if (in_array(strtolower($fileData["extension"]), $allowExt)) {
//     $photos[] = $fileData["basename"];
//   }
// }


function getPhotos($path)
{
  $photoArray = array();
  $allowExt = array("jpg", "jpeg", "png", "gif");
  $folder = "photos/" . $path . "/";
  $files = scandir($folder);


  foreach ($files as $file) {
    $fileData = pathinfo($folder . $file);
    if (in_array(strtolower($fileData["extension"]), $allowExt)) {
      $photoArray[] = $fileData["basename"];
    }
  }

  return $photoArray;
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

      <!-- Modal Details -->
      <div class="modal fade" id=<?php echo "exampleModalCenter" . $i ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $products[$i % count($products)][1] ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div id=<?php echo "carouselExampleControls" . $i ?> class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="display: flex;justify-content: space-around;">
                  <?php for ($k = 0; $k < count(getPhotos(strtoupper($products[$i][0]))); $k++) : ?>
                    <?php if ($k == 0) : ?>
                      <div class="carousel-item active">
                        <img src=<?php echo $folder . strtoupper($products[$i][0]) . "/" . getPhotos(strtoupper($products[$i][0]))[$k] ?> class="d-block w-50" alt="...">
                      </div>
                    <?php endif; ?>
                    <?php if ($k != 0) : ?>
                      <div class="carousel-item">
                        <img src=<?php echo $folder . strtoupper($products[$i][0]) . "/" . getPhotos(strtoupper($products[$i][0]))[$k] ?> class="d-block w-50" alt="...">
                      </div>
                    <?php endif; ?>
                  <?php endfor; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target=<?php echo "#carouselExampleControls" . $i ?> data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target=<?php echo "#carouselExampleControls" . $i ?> data-bs-slide="next">
                  <span class="carousel-control-next-icon" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target=<?php echo "#editModal" . $i ?>>Edit Product</button>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!-- ----------------------------------------------------------------------------- -->

      <!-- Edit Modal -->
      <div class="modal fade" id=<?php echo "editModal" . $i ?> tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $products[$i][1] . " Edit" ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <input class="form-control" type="file" name="fileToUpload" />

                <!-- <?php for ($k = 0; $k < count($products[$k][4]); $k++) : ?>
              <img width='70' src=<?php echo $products[$k][4][$k] ?> />
            <?php endfor; ?> -->
                <?php foreach (getPhotos(strtoupper($products[$i][0])) as $image) : ?>
                  <img src=<?php echo $folder . strtoupper($products[$i][0]) . "/" . $image ?> width="100" />
                <?php endforeach; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input name="productName" value=<?php echo $products[$i][0] ?> style="display: none;" />
                <input type="submit" name="uploadPhoto" class="btn btn-primary" value="Save Changes" />
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
              <input name='productIndex' value=<?php echo $i ?> style='display:none;' />
              <input class='btn btn-primary' name='add' type='submit' value='ADD' />
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target=<?php echo "#exampleModalCenter" . $i ?>>
                Product Details
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    <?php endfor; ?>
  </table>
  <a href='cart.php' class='btn btn-success fixed-bottom w-25'>Go to the cart
    <span class='badge badge-light' style='font-size:18px;'><?php echo count($_SESSION['cart']) ?></span>
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>