<!DOCTYPE HTML>  
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">		
	    <title>Agenda PHP</title>
		<style>
			.error {color: #FF0000;}
		</style>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">		
		<!-- Data tables Files -->
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>		
		
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">  		
		<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		
		
		<?php 
			require 'connection.php'; 
		?>		
	</head>
	<body>  

<?php
	
	$success = "";
	
	// define variables and set to empty values
	$nameErr = $emailErr = $websiteErr = "";
	$name = $email = $comment = $website = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		} else {
			$name = test_input($_POST["name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed"; 
			}
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else {
			$email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format"; 
			}
		}

		if (empty($_POST["website"])) {
			$website = "";
		} else {
			$website = test_input($_POST["website"]);
			// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
				$websiteErr = "Invalid URL"; 
			}
		}

		if (empty($_POST["comment"])) {
			$comment = "";
		} else {
			$comment = test_input($_POST["comment"]);
		}
		
		if( 
			($nameErr == "") && (isset($_POST["name"]) == true) && 
			($emailErr == "") && (isset($_POST["email"]) == true) &&  
			($websiteErr == "") && (isset($_POST["website"])== true)  
		){
			
			// DO POST
			$sql_insert = "INSERT INTO agenda_users (name, email, website, comment) VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["website"]."', '".$comment."')";
			
			//echo $sql_insert;
			
			if (mysqli_query($link, $sql_insert) === TRUE) {
			    //echo "New record created successfully";
			    $success = true; 
			} else {
			    echo "Error: " . "<br>" . $conn->error;
			}
			
			
			
			
			//$conn->close();
		}
		
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>


<?php 
	
	if($success == true){
?>
		<div class="alert alert-Success alert-dismissible fade show" role="alert">
		  <strong>Dato insertado correctamente</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
<?php
	}
	
?>

<div class="container">
	<br>
	<h2 class="text-center">Agenda</h2>
	<br>
	<div class="row">
		<div class="col-md-2">
			<button class="btn btn-success btn-sm">Add contact</button>
		</div>
	</div>	
	<br><br>
<?php
	
	$sql = "SELECT * FROM agenda_users";
	if($result = mysqli_query($link, $sql)){
	    if(mysqli_num_rows($result) > 0){
	        echo "<table id='agenda_table'>";
	        	echo "<thead>";
	            echo "<tr>";
	                echo "<th style='display:none'>id</th>";
	                echo "<th>Name</th>";
	                echo "<th>email</th>";
	                echo "<th>website</th>";
					echo "<th>comment</th>";			                
					echo "<th>actions</th>";
	            echo "</tr>";
	            echo "</thead>";
	        while($row = mysqli_fetch_array($result)){
	            echo "<tr>";
	                echo "<td style='display:none'>" . $row['id'] . "</td>";
	                echo "<td>" . $row['name'] . "</td>";
	                echo "<td>" . $row['email'] . "</td>";
	                echo "<td>" . $row['website'] . "</td>";
	                echo "<td>" . $row['comment'] . "</td>";
					echo '<th> <button class="btn btn-danger btn-sm">remove</button> </th>';	                			                
	            echo "</tr>";
	        }
	        echo "</table>";
	        // Free result set
	        mysqli_free_result($result);
	    } else{
	        echo "No records matching your query were found.";
	    }
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
	 
	// Close connection
	//mysqli_close($link);
?>				
</div>



<p>
	<span class="error">* required field</span>
</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	Name: <input type="text" name="name" value="<?php echo $name;?>">
	<span class="error">* <?php echo $nameErr;?></span>
	<br><br>
	E-mail: <input type="text" name="email" value="<?php echo $email;?>">
	<span class="error">* <?php echo $emailErr;?></span>
	<br>
	<br>
	Website: <input type="text" name="website" value="<?php echo $website;?>">
	<span class="error"><?php echo $websiteErr;?></span>
	<br>
	<br>
	Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
	<br>
	<br>

	<input type="submit" name="submit" value="Submit">  
</form>

<?php
/*
	echo "<h2>Posted Data:</h2>";
	echo $name;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $website;
	echo "<br>";
	echo $comment;
	echo "<br>"
*/

?>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		
		
		
	<script >
		$(document).ready( function () {
		    $('#agenda_table').DataTable();
		} );
	</script>				
		
		
	</body>
</html>