<?php

$colors = array("#0072bb", "#905438", "#a8e2f8", "#d93a96", "#f7941d", "#ed1b24", "#fef200", "#1fb25a");
$railRoads = array("Reading Railroad", "Pennsylvania Railroad", "B. & O. Railroad", "Short Line Railroad");
$cities = array(
    "Mediterranean Avenue", "Baltic Avenue", "Oriental Avenue", "Vermont Avenue", "Connecticut Avenue", "St. Charles Place", "States Avenue",
    "Virginia Avenue", "Tennessee Avenue", "New York Avenue", "Kentucky Avenue", "Indiana Avenue", "Illinois Avenue", "Atlantic Avenue", "Ventnor Avenue",
    "Marvin Gardens", "Pacific Avenue", "North Carolina Avenue", "Pennsylvania Avenue"
);
$industries = array(
    "Finance and Insurance", "Manifacturing", "Transportation", "Education", "Hotels and Restaurants", "Agriculture", "Construction",
    "Mining", "Technology",
);

class Place
{
    public $name;
    public $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}

class Railway extends Place
{
    public function __construct($name, $price)
    {
        parent::__construct($name, $price);
    }
}
class City extends Place
{
    public $houseCount;
    public $hotelCount;

    public $color;
    public function __construct($name, $color, $price, $property)
    {
        $this->color = $color;
        parent::__construct($name, $price);
        switch ($property) {
            case 0:
                $this->houseCount = 0;
                $this->hotelCount = 0;
                break;
            case 1:
                $this->houseCount = 1;
                $this->hotelCount = 0;
                break;
            case 2:
                $this->houseCount = 2;
                $this->hotelCount = 0;
                break;
            case 3:
                $this->houseCount = 3;
                $this->hotelCount = 0;
                break;
            case 4:
                $this->houseCount = 4;
                $this->hotelCount = 0;
                break;
            case 5:
                $this->houseCount = 0;
                $this->hotelCount = 1;
                break;
        }
    }
}
class Industry extends Place
{
    public function __construct($name, $price)
    {
        parent::__construct($name, $price);
    }
}



if (isset($_POST["send"])) {
    switch ($_POST["option-base"]) {
        case "railway":
            $Place = new Railway($railRoads[rand(0, count($railRoads) - 1)], rand(60, 400));
            break;
        case "city":
            $Place = new City($cities[rand(0, count($cities) - 1)], $colors[rand(0, count($colors) - 1)], rand(60, 400), rand(0, 5));
            break;
        case "industry":
            $Place = new Industry($industries[rand(0, count($industries) - 1)], rand(60, 400));
            break;
    }
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div style="width: 100%;height: 100vh;display: flex;justify-content: center;align-items: center;flex-direction: column;">
    <form method="post">
        <input class="btn-check " name="option-base" type="radio" id="railway" value="railway" checked />
        <label class="btn" style="font-size: 40px;" for="railway">Railway</label>

        <input class="btn-check" name="option-base" type="radio" id="city" value="city" />
        <label class="btn" style="font-size: 40px;" for="city">City</label>

        <input class="btn-check" name="option-base" type="radio" id="industry" value="industry" />
        <label class="btn" style="font-size: 40px;" for="industry">Industry</label>

        <input type="submit" class="btn btn-primary btn-lg" value="Send" name="send" />
    </form>

    <div style="height: 500px;width: 380px;border:2px solid black;border-radius: 10px;overflow: hidden;position: relative; background-color: #cde6d0;">
        <?php if (isset($_POST["send"])) : ?>
            <?php if ($_POST["option-base"] == "city") : ?>
                <?php echo "<div style='display:flex;justify-content:center;border-bottom:2px solid black;width:100%;background-color: " . $Place->color . ";height: 80px;'>";
                if ($Place->houseCount > 0)
                    for ($i = 0; $i < $Place->houseCount; $i++) :
                ?>
                    <img src="./house.png" />
                <?php
                    endfor;
                if ($Place->hotelCount > 0) : ?>
                    <img src="./hotel.png" />
                <?php endif;
                echo "</div>" ?>
            <?php endif; ?>
            <h2 class="text-center" style="font-size: 50px;height:150px;"><?php echo $Place->name ?></h2>
            <div class="position-absolute bottom-0" style="width: 100%;font-weight: bold;font-size: 30px;">
                <p class="text-center">$<?php echo $Place->price ?></p>
            </div>
            <?php if ($_POST["option-base"] == "railway") : ?>
                <div style="display: flex;width: 100%;justify-content: center;">
                    <img src="./train.png" width="50%" />
                </div>
            <?php endif; ?>
            <?php if ($_POST["option-base"] == "industry") : ?>
                <!-- <div style="display: flex;width: 100%;justify-content: center;">
                    <img src="./train.png" width="50%" />
                </div> -->
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>