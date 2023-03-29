<meta name="viewport" content="width=device-width, initial-scale=1.0"><?php

if($_POST['posted'] == "yes") {

$date  = $_POST['date'];
$gas   = $_POST['gas'];
$elec  = $_POST['elec'];

$number = trim(file_get_contents('number.txt'));
$number = ($number +1);


if (!file_exists("content/" . $number)) {
    mkdir("content/" . $number, 0777, true);
}

$fo = fopen("content/" . $number . "/date.txt" , "w");
fwrite($fo,$date);
fclose($fo);
$fp = fopen("content/" . $number . "/gas.txt" , "w");
fwrite($fp,$gas);
fclose($fp);
$fq = fopen("content/" . $number . "/elec.txt" , "w");
fwrite($fq,$elec);
fclose($fq);
$ft = fopen("number.txt" , "w");
fwrite($ft,$number);
fclose($ft);

?>OK, your data is saved!<br>
<a href="newdata.php">Enter more data</a><br>
<a href="./">To overview</a><?php
die();
}


?><form action="newdata.php" method="post"><p align="center">
<table width="70%">
<tr><td>Day:</td><td><input type="text" name="date" autocomplete="off" value="<?php print(date('l j F Y',strtotime("yesterday"))); ?>"></td></tr>
<tr><td>Gas:</td><td><input type="number" name="gas" autocomplete="off" size="8" step="0.01">m<sup>3</sup></td></tr>
<tr><td>Electricity:</td><td><input type="number" name="elec" autocomplete="off" size="8" step="0.01">kWh</td></tr>
<input type="hidden" name="posted" value="yes"><input name="submit" type="submit" value="Post"></form></table></p>
<?php

?>
