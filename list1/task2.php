<?php

$products = array(
    array("Nestle", "Nestle Crunch", "Nestle Crunch Pirinç Patlaklı Sütlü Çikolata 10x31,5 Gr", "₺99,50", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/DjcCIMFrS7_256x256.png"),
    array("ÜLKER", "Ülker Choclate", "Ülker Sütlü Çikolata 60 Gr", "₺22,50", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/-Sc9Xk4Otp_256x256.png"),
    array("VİNCE", "Vince Bütün Fındıklı Çikolata", "Vince Bütün Fındıklı Çikolata 100 Gr", "₺24,90", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/a0WPOKh9Nd_256x256.png"),
    array("ETİ", "Eti Biscuit", "Eti Burçak Yulaflı Mini Bisküvi 160 Gr", "₺14,95", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/qmDqAkMOvl_256x256.png"),
    array("ÇEREZYA", "Çerezya Kuruyemiş Badem", "Çerezya Kuruyemiş Badem İçi 250 Gr", "₺97,50", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/X7r2eF23hz_256x256.png"),
    array("VIVIDENT", "Vivident 45 Minutes", "Vivident 45 Dk Nane Aromalı Sakız 33 Gr", "₺25,00", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/cw9oQhkFqI_256x256.png"),
    array("DANONE", "Disney Puding", "Disney Hüpper Çikolatalı&Muzlu Puding Hazır Tatlı 70 Gr", "₺18,00", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/FFTJoicSqP_256x256.png"),
    array("TADAL", "Tadal Revani", "Tadal Revani 300 Gr", "₺39,00", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/WUm9g2Gaoz_256x256.png"),
    array("ŞANAL", "Şanal Kalburabastı", "Şanal Kalburabastı 200 Gr", "₺19,50", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/p2TMzDBhU1_256x256.png"),
    array("DR.OETKER", "Dr. Oetker Kakaolu Puding", "Dr. Oetker Kakaolu Puding 196 Gr", "₺30,00", "https://api.a101kapida.com/dbmk89vnr/CALL/Image/get/89DiD1zOtv_256x256.png"),
);
echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>";

echo "<table class='table table-striped table-dark table-bordered table-hover'>
    <thead>
    <tr>
      <th scope='col'>Manufacturer</th>
      <th scope='col'>Name</th>
      <th scope='col'>Description</th>
      <th scope='col'>Price</th>
      <th scope='col'>Image</th>
    </tr>
  </thead>";


for ($i = 0; $i < count($products) * 10; $i++) {
    echo "<tbody>
        <tr>
          <th scope='row'>" . $products[$i % count($products)][0] . "</th>
          <td>" . $products[$i % count($products)][1] . "</td>
          <td>" . $products[$i % count($products)][2] . "</td>
          <td>" . $products[$i % count($products)][3] . "</td>
          <td><img width='70' src='" . $products[$i % count($products)][4] . "'/></td>
        </tr>
      </tbody>";
}

echo "</table>";
