<?php

$str= 'E-Shop B2B';

$arr = array('E-Shop B44','E-Shop B2C','E-Shop B2B');

$index = array_search(trim($str), $arr);

echo $index;