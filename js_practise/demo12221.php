<!DOCTYPE html>
<html lang="en">
<head>
    <title>Example of Testing Whether a Key Exists in PHP Array</title>
</head>
<body>

<?php
$cities = array("France"=> "", "India"=>"Mumbai", "UK"=>"London", "USA"=>"New York");
 
// Testing the key exists in the array or not
if(array_key_exists("France", $cities)){
    echo "The key 'France' is exists in the cities array";
}
?>

</body>
</html>