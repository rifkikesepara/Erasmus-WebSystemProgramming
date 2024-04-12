<?php

$table;
for ($i = 0; $i < 8; $i++) {
    for ($k = 0; $k < 8; $k++) {
        $table[$i][$k] = 0;
    }
}

static $blackPositions = array(
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

static $whitePositions = array(
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

function LetterToIndex($letter)
{
    switch ($letter) {
        case 'a':
            return 0;
            break;
        case 'b':
            return 1;
            break;
        case 'c':
            return 2;
            break;
        case 'd':
            return 3;
            break;
        case 'e':
            return 4;
            break;
        case 'f':
            return 5;
            break;
        case 'g':
            return 6;
            break;
        case 'h':
            return 7;
            break;
    }
}

function findThePosition($letter, $number)
{
    for ($i = 0; $i < 12; $i++) {
        if ($GLOBALS['blackPositions'][$i][0] == $number && $GLOBALS['blackPositions'][$i][1] == LetterToIndex($letter)) {
            return $i;
        }
    }
}

function setPosition($index, $nLetter, $nNumber, &$positions)
{
    // echo count($blackPositions);
    // $positions[$index][0] = $nNumber;
    // $positions[$index][1] = LetterToIndex($nLetter);
    // echo '<pre>';
    // print_r($positions);
    // echo '</pre>';
}


if (isset($_POST['button1'])) {
    $index = findThePosition($_POST['pPositionLetter'], 8 - $_POST['pPositionNumber']);
    $nNumber = 8 - $_POST['pPositionNumber'];
    $nLetter = $_POST['pPositionLetter'];
    for ($i = 0; $i < 8; $i++) {
        for ($k = 0; $k < 8; $k++) {
            $table[$i][$k] = 0;
        }
    }
    echo "Index: " . $index . "<br/>";
    // setPosition($index, $_POST['nPositionLetter'], 8 - $_POST['nPositionNumber'], $blackPositions);
    $blackPositions[$index][0] = 0;
    $blackPositions[$index][1] = 0;

    echo $blackPositions[$index][0] . " : " . $blackPositions[$index][1];
    // for ($i = 0; $i < count($blackPositions); $i++) {
    // }
}

echo "<div style='display:flex;align-items:center;'>
<div style='position:relative;'><img src=\"https://images.chesscomfiles.com/uploads/v1/images_users/tiny_mce/ColinStapczynski/phprnyp9x.png\" width='700' />";

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
echo " <form method='post' style='width: 100%;display:flex;flex-direction:column;align-items:center;'>
<h1>Black's turn</h1>
<div style='padding-bottom:10px;'>  
<input name='pPositionLetter' onkeydown='return /[a-z]/i.test(event.key)' placeholder='A'style='height:50px;' autocomplete='off' maxlength='1'/>
<input name='pPositionNumber' placeholder='1' style='height:50px;' autocomplete='off' maxlength='1'/>
</div>
<div style='padding-top:10px;border-top:1px solid black;'>  
<input name='nPositionLetter' placeholder='B' onkeydown='return /[a-z]/i.test(event.key)' style='height:50px;' autocomplete='off' maxlength='1'/>
<input name='nPositionNumber' placeholder='2' style='height:50px;' autocomplete='off' maxlength='1'/>
</div>
<input type='submit' name='button1' value='Submit' style='margin-top:10px;width:200px;height: 100px;'/> </form></div>";
