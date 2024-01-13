<?php
$finalPrice1 = '6.8999999';
$finalPrice = round($finalPrice1, 2);
echo $finalPrice; 
$finalPrice2 = new Price(round($finalPrice1, 2), 'EUR');
echo $finalPrice2 ; 

exit;