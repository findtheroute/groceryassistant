<?php
/* require the user as the parameter */
{

  /* soak in the passed variable or set our own */
  /* connect to the db */

  include "database.php";
  //echo "Database file imported /n";
	$store_id_value = $_GET['store_id'];
	$store_id = filter_var($store_id_value, FILTER_SANITIZE_NUMBER_INT);
	$product_id_value = $_GET['product_id'];
	$product_id = filter_var($product_id_value, FILTER_SANITIZE_NUMBER_INT);
	
  $link = mysql_connect($host,$username,$password) or die('Cannot connect to the DB');
	//echo "connection established/n";
  mysql_select_db($db_name,$link) or die('Cannot select the DB');
  /* grab all the users  from the db */
  $query = " Select product_name, line_no from product_location PL join product_detail PD on PD.product_id = PL.product_id
		where PL.product_id = '$product_id' and store_id ='$store_id' order by line_no asc";
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
	//echo mysql_num_rows($result);
	
	$location = array(); //declaring store array
  if(mysql_num_rows($result)) {
    while($location = mysql_fetch_assoc($result)) {
      //echo ($store["store_name"]);
	  $locations[] = array('location'=> $location);
    }
  }


  /* output in necessary format */

    //header('Content-type: application/json');
    echo json_encode(array('location'=> $locations));



  /* create one master array of the records */
  
  /* disconnect from the db */
  @mysql_close($link);
	//echo json_encode($result);
}
?>