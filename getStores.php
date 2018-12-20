<?php
/* require the user as the parameter */
{

  /* soak in the passed variable or set our own */
  /* connect to the db */

  include "database.php";
  
  $zipValue = $_GET['zipValue'];
	$zipcode = filter_var($zipValue, FILTER_SANITIZE_NUMBER_INT);
  $link = mysql_connect($host,$username,$password) or die('Cannot connect to the DB');
  //echo "connection established";
  mysql_select_db($db_name,$link) or die('Cannot select the DB');
  /* grab all the stores  from the db */
  $query = "SELECT store_id, store_name,  address, city, state, zipcode, store_logo FROM store where zipcode ='$zipcode'";
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
 	
  $store = array(); //declaring store array
  if(mysql_num_rows($result)) {
    while($store = mysql_fetch_assoc($result)) {
      //echo ($store["store_name"]);
	  $stores[] = array('store'=> $store);
    }
  }

  /* output in necessary format */
    //header('Content-type: application/json');
    echo json_encode(array('store'=> $stores));

  /* create one master array of the records */
  
  /* disconnect from the db */
  @mysql_close($link);
  
}
?>