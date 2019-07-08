<?php
	
	header('Content-type:application/json;charset=utf-8');

	$link = mysqli_connect("pinguspace.com", "pinguspa_phpAgenda", "PHPAgenda!!", "pinguspa_phpAgenda");
	 
	// Check connection
	if($link === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$data = new ArrayObject();
	
	
	$sql = "SELECT * FROM agenda_users";
	if($result = mysqli_query($link, $sql)){
	    if(mysqli_num_rows($result) > 0){
		    while($row = mysqli_fetch_array($result)){
			    $item=(object) array(
						      'id' => $row["id"],
						      'name' => $row["name"],
						      'email' => $row["email"],
						      'website' => $row["website"]
				);
				$data->append($item);
		    }
	    }else{
	        //echo "No records matching your query were found.";	        
	    }
	} else{
	    echo "ERROR: Could not able to execute " . mysqli_error($link);
	}    
	
	echo json_encode($data);

	
?>