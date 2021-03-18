<?php
include_once 'connect.php';
   if(isset($_POST['sub'])){
     if (isset($_POST['q1'])) {
        $names = $_POST['q1'];
}

$w1 = "\n"; 
$w2 = ""; 
    
$names = str_replace($w1, $w2, $names); 
$names = strval($names) ;
$sql = "SELECT * FROM `grocery` WHERE LOCATE(name,'urban platter MEXICAN AGAVE SYRUP 500g / 1802') > 0";
$result3 = mysqli_query($conn,$sql);
echo "<table class= 'rwd-table'>
<tr>

<th>id</th>
<th>name</th>
<th>food_category</th>
</tr>";

 
  while($row2 = mysqli_fetch_assoc($result3))

  {

  echo "<tr>";
  echo "<td>" . $row2['ID'] . "</td>";
  echo "<td>" . $row2['name'] . "</td>";
  echo "<td>" . $row2['Food_Group'] . "</td>";
  
  echo "</tr>";

  }
echo "</table>";

mysqli_close($conn);
}
?>

//$sql = "SELECT * FROM `grocery` INNER JOIN `checking` on grocery.ID=checking.ID WHERE extraction LIKE '$names'";

echo "id:" . $row2["ID"]. "<br>". "Name: " . $row2["name"]. "<br>". "Food_Group: " . $row2["Food_Group"]. "<br>";