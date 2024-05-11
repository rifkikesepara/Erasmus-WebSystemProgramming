<?php
include("config.php");

$queryResult = $dbConnection->query("SELECT * FROM persons");
$logged = false;
$message = "Admin Login Panel";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    while ($row = $queryResult->fetch()) {
        if ($username == $row["name"] && $password == $row["last_name"]) {
            // echo "giris yapildi";
            header("Location: http://localhost/Erasmus-WebSystemProgramming/list5/productsAdmin.php");
            $logged = true;
            // include("task1.php");
            break;
        }
        // echo "id: " . $row["id"] . ", name: " . $row["name"] . ", last_name: " . $row["last_name"] . ", email: " . $row["email"];
    }
    if (!$logged) $message = "Try Again!";
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!$logged) {
    echo "<div style='display: flex;width: 100%;height: 100vh;justify-content: center;align-items: center;background-color: #323539;'>";
} else echo "<div style='display: none;'>";
?>
<form method="post" class="shadow p-3 mb-5 bg-white rounded" style="padding: 10px;width: 30%;display:flex;flex-direction: column; justify-content: center;">
    <?php echo "<h1 style='text-align:center;'>$message</h1>" ?>
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="exampleInputEmail1">Username</label>
        <input class="form-control" name="username" id="exampleInputEmail1" placeholder="Username" autocomplete="off">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button name="login" type="submit" class="btn btn-primary">Login</button>
    <a href="products.php" class="btn btn-danger" style="margin-top: 4px;">Back</a>
</form>
</div>