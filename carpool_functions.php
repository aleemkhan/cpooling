<?

/*
 function connect_db();	
 This fucntion establishes connection with the database
 Returns "true" or "false"
 */

// connect_db() STARTS 
function connect_db(){
	
	//database host name
	$host = "localhost";
	
	//database user name 
	$user = "root";
	
	//database password
	$password = "";
	
	//database name
	$db_name = "carpoolingsystem";
	
	
	//connecting to host
	$con_host = mysql_connect($host, $user, $password) OR DIE ("HOST NOT AVAILABLE");
            
	if($con_host){
		//connecting to database
		$con_db = mysql_select_db($db_name);
	}
	
	//returns true if connection successfull else false
	return $con_db;
}
// connect_db() ENDS

/************************************************************************************************************************************/

/*
	function disconnect_db()
	this function disconnects a user form database
	RETURNS: VOID
*/

//disconnect_db() starts
function disconnect_db(){

	//closing connection with database
	mysql_close();

}
//disconnect_db() ENDS


/************************************************************************************************************************************/

/*
	fucntion signup_query(INT USER_ID, STRING USER_NAME, STRING PASSWORD)
	this function registers a user into database
	RETURNS "true" for successfull registeration and false otherwise 
*/


// signup_query() STARTS
function signup_query($uid, $name, $password){
	$hash = wp_hash_password($password);
	$query = "SELECT * FROM user WHERE uid = ".$uid;
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	if($num_rows > 0){
		return false;
	}else{
		$query = "INSERT INTO user VALUES ('', ".$uid.", '".$name."', '".$hash."', 0, NOW())";
		$result = mysql_query($query);
		$query1 = "INSERT INTO credentials VALUES('', ".$uid.",'','','')";
		$result1 = mysql_query($query1);
		if($result && $result1){
			return true;
		}else{
			return false;
		}
		return false;
	}
	return false;
}

//signup_query() ENDS



/************************************************************************************************************************************/

/*
	fucntion login_query(INT USER_ID, STRING PASSWORD)
	this function validates login of a user from database
	RETURNS "true" for successfull login and false otherwise 
*/


// login_query() STARTS
function login_query($uid, $password){
	include_once (TEMPLATEPATH . '/class-phpass.php');
	$query = "SELECT password FROM user WHERE uid = '".$uid."'";
	$result = mysql_query($query);
	if($result){
		$row = mysql_fetch_array($result);
		$passHash = $row['password'];
		$check = new PasswordHash(8, TRUE);
		if($check->CheckPassword($password, $passHash)){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}


/************************************************************************************************************************************/

/*
	fucntion credentials_query(INT USER_ID, STRING phone, STRING emergency, STRING gender)
	this function adds extra information about user into database
	RETURNS "true" for successfull registeration and false otherwise 
*/

function credentials_query($uid, $phone, $emergency, $gender){
	$query = "UPDATE credentials SET phone_number='".$phone."', emergency_number='".$emergency."',gender=".$gender." WHERE uid=".$uid;
	$result = mysql_query($query);
	if($result){
		return true;
	}else{
		return false;
	}
}

//credentials_query() ENDS


/************************************************************************************************************************************/

/*
	fucntion ticket_query(INT USER_ID, STRING vehicle, INT in_out, INT seats, STRING destination, STRING TIME)
	this function enters a ticket into database
	RETURNS "true" for successfull ticket entry and "false" otherwise 
*/

function ticket_query($uid, $vehicle, $in_out, $seats, $destination, $time){
	$query = "INSERT into ticket VALUES ('', ".$uid.", '".$vehicle."', ".$in_out.", ".$seats.", '".$destination."', '".$time."')";
	$result = mysql_query($query);
	if($result){
		return true;
	}else{
		return false;
	}
}

//ticket_query() ENDS


/************************************************************************************************************************************/

/*
	fucntion request_query(INT USER_ID, STRING destination,  STRING TIME)
	this function enters a request into database
	RETURNS "true" for successfull request entry and "false" otherwise 
*/

function request_query($uid, $destination, $time){
	$query = "INSERT into request VALUES ('', ".$uid.", '".$destination."', '".$time."')";
	$result = mysql_query($query);
	if($result){
		return true;
	}else{
		return false;
	}
}

//request_query() ENDS


/************************************************************************************************************************************/

/*
	fucntion message_query(INT USER_ID, STRING title,  STRING body)
	this function enters a masage into database
	RETURNS "true" for successfull request entry and "false" otherwise 
*/

function message_query($uid, $ticket_id, $title, $body){
	//$ticket_id = $uid."".strtotime(date("Y-m-d H:i:s"));
	$query = "INSERT into message VALUES ('', ".$uid.",".$ticket_id.", '".$title."', '".$body."')";
	$result = mysql_query($query);
	
	
	$query1 = "SELECT uid FROM join_ticket WHERE ticket_id = ".$ticket_id;
	$result1 = mysql_query($query1);
	
	$query2 = "SELECT id FROM message WHERE uid=".$uid." AND ticket_id = ".$ticket_id."";
	$result2 = mysql_query($query2);
	$message_id = mysql_fetch_array($result2);
	while($uid = mysql_fetch_array($result1)){
		reciever_query($uid['uid'], $message_id['id'], $ticket_id);
	}
	
	if($result){
		return true;
	}else{
		return false;
	}
}

//message_query() ENDS

/************************************************************************************************************************************/

/*
	fucntion reciever_query(INT USER_ID, INT message_id, INT ticket_id)
	this function enters a reciever into database
	RETURNS "true" for successfull transaction and "false" otherwise 
*/

function reciever_query($uid, $messageid, $ticket_id){
	$query = "INSERT into reciever VALUES ('', ".$messageid.", ".$uid.",".$ticket_id." ,0)";
	$result = mysql_query($query);
	if($result){
		return true;
	}else{
		return false;
	}
}

//reciever_query() ENDS


/************************************************************************************************************************************/

/*
	fucntion notification_query(INT USER_ID, INT message_id, INT reciever_id)
	this function enters a reciever into database
	RETURNS "true" for successfull transaction and "false" otherwise 
*/

function notification_query($uid, $text){
	$query = "INSERT into notification VALUES ('', ".$uid.", '".$text."', 0)";
	$result = mysql_query($query);
	if($result){
		return true;
	}else{
		return false;
	}
}

//notification_query() ENDS

/************************************************************************************************************************************/

/*
	fucntion join_query(INT USER_ID, INT ticket_id, INT seat_number)
	this function enters a reciever into database
	RETURNS "true" for successfull transaction and "false" otherwise 
*/

function join_query($uid, $ticket_id, $seat){
	$query = "INSERT into join_ticket VALUES ('', ".$ticket_id.", ".$uid.", ".$seat.")";
	$result = mysql_query($query);
	if($result){
		$query1 = "SELECT uid FROM ticket WHERE id =".$ticket_id;
		$result1 = mysql_query($query1);
		$reciever_id = mysql_fetch_array($result1);
		notification_query($reciever_id['uid'], $uid."@campusmail.lums.edu.pk has joined your ticket");
		return true;
	}else{
		return false;
	}
}

//join_query() ENDS

	
	
?>

