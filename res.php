<?php
			// echo "string";
 		// include_once("connect/connection.php");
   //       $city=$_GET['name_booking'];
   //       $query=mysqli_query($connect, "SELECT name_city FROM city where name_city LIKE '%".$city."%'");
   //       while ($result=mysqli_fetch_assoc($query)) {

   //       	echo $result[name_city];
   //       }


//fetch.php
include_once("connect/connection.php");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "SELECT  DISTINCT location_hotel FROM hotel WHERE location_hotel LIKE '%".$search."%'";
}
else
{
 $query = "SELECT location_hotel FROM hotel ORDER BY hotelID LIMIT 0 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 
 while($row = mysqli_fetch_array($result))
 {

  $output .= '
   <tr>
    <td>'.$row["location_hotel"].'</td>
    
   </tr>
  ';
 }
 
 echo $output;
}


?>
