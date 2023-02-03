<?php
// The codes below are optional, in case you want to disable strangers from accessing ////////
//////////////////////////////////////////////////////////////////////////////////////////////
if($_COOKIE['allowed'] == 'CREATE_A_TOKEN_HERE') {                                          //
?><head><?php                                                                               //
setcookie('allowed', "ENTER_SAME_TOKEN" ,time() + (170*60*24*30), '/', '.yourdomain.com');  //
} else {                                                                                    //
?>This app is for private use only<?php                                                     //
exit;                                                                                       //
}                                                                                           //
//////////////////////////////////////////////////////////////////////////////////////////////
?>
<head>
<title>Real Power Usage</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="./manifest.json">
</title>
<style>
table {
    width: 100%;
}
.ellipsis {
    position: relative;
}
.ellipsis:before {
    content: '&nbsp;';
    visibility: hidden;
}
.ellipsis span {
    position: absolute;
    left: 0;
    right: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<body><font face="Helvetica" size="2">
<table border="0">
<?php
$number = trim(file_get_contents('number.txt'));

if(isset($_GET['continue'])) {
$number = $_GET['continue'];
} 
if($_GET['show'] == "99") {
$i = 99;
} else {
$i = 32;
}

do { 
    if (file_exists("content/" . $number . "/")) {
    $day = trim(file_get_contents("content/" . $number . "/date.txt"));
    $gas  = file_get_contents("content/" . $number . "/gas.txt");
    $elec = file_get_contents("content/" . $number . "/elec.txt");
    $gasprice = round($gas * 1.45,2);
    $elecprice = round($elec * 0.40,2);
    $totalprice = $gasprice+$elecprice;
    print("<tr><td width=\"100\" class=\"ellipsis\" align=\"right\"><span><font size=2>");
    if(strpos($day,"total") !== false) {
        print("<font color=\"gray\">");
    }
    print($day.":</span></td><td><font size=2>");
    if(strpos($day,"total") !== false) {
        print("<font color=\"gray\">");
    }
    print($gas."&#13221; (&euro;".$gasprice.")/".$elec." kWh (&euro;".$elecprice.")</td><td width=\"80\">");
    if(strpos($day,"total") !== false) {
        print("<font size=\"2\" color=\"blue\">".$day);
    } else {
    print("<font size=2>Total:");
    }
    print(" &euro;".$totalprice."</td></tr>");
    print("\n");
    --$i; 
    } 
    --$number;
    if($number < 1) {
      $i = 0;
    } 
} while($i >= 1);


?></table>
<a href="newdata.php">Add new data</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="./?show=99">>> All data</a>
