<?php
/* require the user as the parameter */
{

  /* soak in the passed variable or set our own */
  /* connect to the db */

  include "database.php";
  //echo "Database file imported /n";
	
	$store_id_value = $_GET["store_id"];
	//echo $store_id_value;
	$store_id = filter_var($store_id_value, FILTER_SANITIZE_NUMBER_INT);
	//echo $store_id;
	//$store_id =(int)1;
	
  $link = mysql_connect($host,$username,$password) or die('Cannot connect to the DB');
	//echo "connection established/n";

  mysql_select_db($db_name,$link) or die('Cannot select the DB');

  /* grab all the users  from the db */
  $query = "select PD.product_id, product_name from
	    product_location PL join product_detail PD on PL.product_id = PD.product_id where store_id = '$store_id'";
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
	$Product = array(); //declaring store array
  if(mysql_num_rows($result)) {
    while($Product = mysql_fetch_assoc($result)) {
	  $Products[] = array('Product'=> $Product);
    }
  }


  /* output in necessary format */

    //header('Content-type: application/json');
    echo json_encode(array('Product'=> $Products));



  /* create one master array of the records */
  
  /* disconnect from the db */
  @mysql_close($link);
	//echo json_encode($result);
}
?>