<?php

$initialTable = array(
    array(0, 1, 0, 1, 0, 1, 0, 1),
    array(1, 0, 1, 0, 1, 0, 1, 0),
    array(0, 1, 0, 1, 0, 1, 0, 1),
    array(0, 0, 0, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 0),
    array(2, 0, 2, 0, 2, 0, 2, 0),
    array(0, 2, 0, 2, 0, 2, 0, 2),
    array(2, 0, 2, 0, 2, 0, 2, 0)
);

// file_put_contents('table.txt',  '<?php return ' . var_export($initialTable, true) . ';');

$turnFile = fopen("turn.txt", "r");
$turn = fread($turnFile, 10);
$table = include "table.txt";

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

// print_r($table);
function setPosition($nLetter, $nNumber)
{
    global $table, $turn;

    $turnFile = fopen("turn.txt", "w");
    if ($turn == "black") {
        $table[$nNumber][$nLetter] = 1;
        $turn = "white";
        fwrite($turnFile, "white");
    } elseif ($turn == "white") {
        $table[$nNumber][$nLetter] = 2;
        $turn = "black";
        fwrite($turnFile, "black");
    }
    fclose($turnFile);
}


if (isset($_POST['button1'])) {
    $pNumber = 8 - $_POST['pPositionNumber'];
    $pLetter = $_POST['pPositionLetter'];
    $nLetter = $_POST['nPositionLetter'];
    $nNumber = 8 - $_POST['nPositionNumber'];
    if (
        abs($pNumber - $nNumber) != 1 ||
        (abs(LetterToIndex($pLetter) - LetterToIndex($nLetter)) == 1 && abs($pNumber - $nNumber)) != 1 ||
        (abs(LetterToIndex($pLetter) - LetterToIndex($nLetter)) != 1 && abs($pNumber - $nNumber)) == 1
    ) echo "Please select a proper position";
    elseif (
        $table[$nNumber][LetterToIndex($nLetter)] == 0 &&
        abs($pNumber - $nNumber) == 1
    ) {
        $table[$pNumber][LetterToIndex($pLetter)] = 0;

        setPosition(LetterToIndex($_POST['nPositionLetter']), 8 - $_POST['nPositionNumber']);
        file_put_contents('table.txt',  '<?php return ' . var_export($table, true) . ';');
    } elseif (
        $table[$nNumber][LetterToIndex($nLetter)] == 1 ||
        $table[$nNumber][LetterToIndex($nLetter)] == 2
    ) {
        if ($table[$pNumber][LetterToIndex($pLetter)] != $table[$nNumber][LetterToIndex($nLetter)]) {
            $newLetter = LetterToIndex($_POST['nPositionLetter']) + abs(LetterToIndex($_POST['nPositionLetter']) - LetterToIndex($_POST['pPositionLetter']));
            $newNumber = (8 - $_POST['nPositionNumber']) * 2 - (8 - $_POST['pPositionNumber']);
            setPosition($newLetter, $newNumber);
            $table[$pNumber][LetterToIndex($pLetter)] = 0;
            $table[$nNumber][LetterToIndex($nLetter)] = 0;

            file_put_contents('table.txt',  '<?php return ' . var_export($table, true) . ';');
        } else {
            echo "Please select an empty position";
        }
    } else echo "Please select an empty position";
}

if (isset($_POST['reset'])) {
    file_put_contents('table.txt',  '<?php return ' . var_export($initialTable, true) . ';');
    $turnFile = fopen("turn.txt", "w");
    fwrite($turnFile, "white");
    fclose($turnFile);
}



echo "<div style='display:flex;align-items:center;'>
<div style='position:relative;'><img src=\"https://images.chesscomfiles.com/uploads/v1/images_users/tiny_mce/ColinStapczynski/phprnyp9x.png\" width='700' />";

for ($i = 0; $i < count($table); $i++) {
    for ($k = 0; $k < 8; $k++) {
        if ($table[$i][$k] == 1) {
            echo "<img width='87' src='https://symbols-electrical.getvecta.com/stencil_231/24_pm-black-fbr-3d.be2d0d8d17.svg' 
           style='position:absolute;left:" . 87 * $k . ";top:" . 87 * $i . "'/>";
        } elseif ($table[$i][$k] == 2) {
            echo "<img width='87' src='https://symbols-electrical.getvecta.com/stencil_231/29_pm-white-fbr-3d.06457957f8.svg' 
        style='position:absolute;left:" . 87 * $k . ";top:" . 87 * $i . "'/>";
        }
    }
}

echo "</div>";
echo " <form method='post' style='width: 100%;display:flex;flex-direction:column;align-items:center;'>
<h1>Turn: " . $turn . "</h1>
<div style='padding-bottom:10px;'>  
<h3>Previous Position</h3>
<input name='pPositionLetter' onkeydown='return /[a-z]/i.test(event.key)' placeholder='A'style='height:50px;' autocomplete='off' maxlength='1'/>
<input name='pPositionNumber' placeholder='1' style='height:50px;' autocomplete='off' maxlength='1'/>
</div>
<div style='padding-top:10px;border-top:1px solid black;'>  
<h3>New Position</h3>
<input name='nPositionLetter' placeholder='B' onkeydown='return /[a-z]/i.test(event.key)' style='height:50px;' autocomplete='off' maxlength='1'/>
<input name='nPositionNumber' placeholder='2' style='height:50px;' autocomplete='off' maxlength='1'/>
</div>
<input type='submit' name='button1' value='Submit' style='margin-top:10px;width:200px;height: 100px;'/> 
<input type='submit' name='reset' value='RESET' style='margin-top:10px;width:200px;height: 100px;'/> 
</form>
</div>";
