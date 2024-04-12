<?php

$table;
for ($i = 0; $i < 8; $i++) {
    for ($k = 0; $k < 8; $k++) {
        $table[$i][$k] = 0;
    }
}

$blackPositions = array(
    array(0, 1),
    array(0, 3),
    array(0, 5),
    array(0, 7),
    array(1, 0),
    array(1, 2),
    array(1, 4),
    array(1, 6),
    array(2, 1),
    array(2, 3),
    array(2, 5),
    array(2, 7),
);

$whitePositions = array(
    array(5, 0),
    array(5, 2),
    array(5, 4),
    array(5, 6),
    array(6, 1),
    array(6, 3),
    array(6, 5),
    array(6, 7),
    array(7, 0),
    array(7, 2),
    array(7, 4),
    array(7, 6),
);



function newPosition()
{
    $evens = array(0, 2, 4, 6);
    $odds = array(1, 3, 5, 7);
    $positionY = rand(0, 7);
    if ($positionY % 2 == 0) $positionX = $odds[rand(0, 3)];
    else $positionX = $evens[rand(0, 3)];

    $array[0] = $positionY;
    $array[1] = $positionX;
    return $array;
}

if (isset($_POST['button1'])) {
    for ($i = 0; $i < 8; $i++) {
        for ($k = 0; $k < 8; $k++) {
            $table[$i][$k] = 0;
        }
    }
    for ($i = 0; $i < count($blackPositions); $i++) {
        while (true) {
            $position = newPosition();
            if ($table[$position[0]][$position[1]] == 0) {
                $table[$position[0]][$position[1]] = 1;
                for ($k = 0; $k < 2; $k++) {
                    $blackPositions[$i][$k] = $position[$k];
                }
                break;
            }
        }
    }

    for ($i = 0; $i < count($whitePositions); $i++) {
        while (true) {
            $position = newPosition();
            if ($table[$position[0]][$position[1]] == 0) {
                $table[$position[0]][$position[1]] = 1;
                for ($k = 0; $k < 2; $k++) {
                    $whitePositions[$i][$k] = $position[$k];
                }
                break;
            }
        }
    }
}

echo "<div style='position:relative;'><img src=\"https://images.chesscomfiles.com/uploads/v1/images_users/tiny_mce/ColinStapczynski/phprnyp9x.png\" width='700' />";

for ($i = 0; $i < count($blackPositions); $i++) {
    // echo ($blackPositions[$i]);
    echo "<img width='87' src='https://symbols-electrical.getvecta.com/stencil_231/24_pm-black-fbr-3d.be2d0d8d17.svg' 
             style='position:absolute;left:" . 87 * ($blackPositions[$i][1]) . ";top:" . 87 * $blackPositions[$i][0] . "'/>";
}
for ($i = 0; $i < count($whitePositions); $i++) {
    // echo ($whitePositions[$i]);

    echo "<img width='87' src='https://symbols-electrical.getvecta.com/stencil_231/29_pm-white-fbr-3d.06457957f8.svg' 
             style='position:absolute;left:" . 87 * ($whitePositions[$i][1]) . ";top:" . 87 * $whitePositions[$i][0] . "'/>";
}

echo "</div>";
echo " <form method='post'>  <input type='submit' name='button1' value='Refresh'/> </form>";
