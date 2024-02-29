<?php
$a = 'hello';
function getDay($sd,$ed)
{
    $sdate = $sd;
    $edate = $ed;

    $sdate = explode('-',$sdate);
    $edate = explode('-',$edate);

    $syear = intval($sdate[0]);
    $smonth = intval($sdate[1]);
    $sday = intval($sdate[2]);

    $eyear = intval($edate[0]);
    $emonth = intval($edate[1]);
    $eday = intval($edate[2]);

    $stotalday = ($smonth-1)*30 + ($sday);
    $etotalday = ($emonth-1)*30 + ($eday+1);

    $difference = $etotalday - $stotalday;
    return $difference;

}

   

