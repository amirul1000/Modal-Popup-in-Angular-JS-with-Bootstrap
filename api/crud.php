<?php
    include("connection.php");
	
  	//$cmd = $_REQUEST['cmd'];
	
	$postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request     = json_decode($postdata);					
	}   
    
	$cmd = $request->cmd;
	$id = $request->id;
	
	$first_name = $request->first_name;
	$last_name = $request->last_name;
	$address = $request->address;
	
	switch($cmd){
		case "add":
			  if(empty($_REQUEST['id']))
				{
				///Insertion
				$sql = "INSERT INTO `users` (`first_name`, `last_name`, `address`)
					 VALUES ('".$first_name."', '".$last_name."', '".$address."');";
					 $result = $conn->query($sql);
					 echo "Sucessfully Save";
				}
				else
				{
					$sql = "update `users` set `first_name`='".$first_name."', 
							`last_name`='".$last_name."', 
							`address`='".$address."' WHERE id='".$id."'";
				    $result = $conn->query($sql);			
				    echo "Sucessfully updated";			
				}
				break;		
	     case "edit":
			   //retrive data
				$sql = "SELECT * FROM users where id='".$id."'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					$i=-1;
					while($row = $result->fetch_assoc()) {
						$i++;
						$arr[$i]['id'] = $row["id"];
						$arr[$i]['first_name'] = $row["first_name"];
						$arr[$i]['last_name'] = $row["last_name"];
						$arr[$i]['address'] = $row["address"];
					}
				} else {
					echo "0 results";
				}
				$conn->close();
				echo json_encode($arr);
				/////////////////////////////// 
			break;
			 
		case "delete": 
			   //retrive data
				$sql = "Delete FROM users where id='".$id."'";
				$result = $conn->query($sql);
				if($result==TRUE)
				{
					echo "Deletion has been completed succesfully";
				}
				else
				{
					echo "Deletion Fail";
				}
				$conn->close();
				///////////////////////////////
		    break;  
		case "load_data": 
		    //load all data
			$sql = "SELECT * FROM users ORDER BY id DESC";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				$i=-1;
				while($row = $result->fetch_assoc()) {
					$i++;
					$arr[$i]['id'] = $row["id"];
					$arr[$i]['first_name'] = $row["first_name"];
					$arr[$i]['last_name'] = $row["last_name"];
					$arr[$i]['address'] = $row["address"];
				}
			  }
			echo json_encode($arr);
			break;			  	
		default:
		    //load all data
			$all_data = load_data($conn);
			echo json_encode($all_data);
			break;			  	  		
	}
?>