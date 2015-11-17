<?php
if($_POST['submit'] == "Submit"){

	$name = cleanData($_POST['name']); 
	$image = cleanData($_POST['image']); 
	print "data cleaned".$name." + ".$image; 

	addData($name, $image); 
}

function cleanData($data){
	$data = trim($data); 
	$data = stripslashes($data); 
	$data = htmlspecialchars($data); 
	$data = strip_tags($data); 
	return $data; 

}

function addData($name, $image){
	// include("db.php"); 
	$image = checkUpload(); 
	print $image; 
	// $sql = "INSERT INTO images VALUES('$name', '$image')"; 
	// $result = mysql_query($sql) or die (mysql_error()); 

	print "Ready to add data"; 

	echo "<img src='http://images.jeffreyeverhart.com/images/". $image ."'/>"; 

}

function printForm(){

	print <<<HERE
	<h2>Image Form</h2>
	<form id="myForm" method="POST" enctype="multipart/form-data">
	<input type="text" name="name" id="name">
	<input type="file" id="image" name="image">
	<input type="submit" name="submit" value="Submit">
	</form>
HERE;

}

function checkUpload(){

	if (isset($_FILES['image'])) {
		$allowed = array ('image/pjpeg', 'image/png', 'image/JPG', 'image/X-PNG', 'image/PNG'); 
		if (in_array($_FILES['image']['type'], $allowed)){
			print "uploading files"; 
			if (move_uploaded_file($_FILES['image']['tmp_name'], "images/{$_FILES['image']['name']}")){
				echo "The file has been uploaded!"; 
				$image = "{$_FILES['image']['name']}"; 
				print "$image"; 
			} else {
				echo "<p class='error'>Invalid File Type</p>"; 
			}
		} //End of in_array check	
	}//End of isset check

	if($_FILES['image']['error'] >0){
				echo "<p class='error'>The file failed to upload because:</p>"; 

				switch($_FILES['image']['error']){
					case 1: 
							print "This file exceeds the max upload limit setting"; 
							break; 
					case 2: 
							print "This file exceeds the max upload limit setting in HTML"; 
							break; 
					case 3: 
							print "This file only partially uploaded"; 
							break; 
					case 4: 
							print "No file was uploaded"; 
							break; 
					case 6: 
							print "No temp folder"; 
							break; 
					case 7: 
							print "Unable to write to disk"; 
							break; 
					case 8: 
							print "File upload stopped"; 
							break; 	
					default: 
							print "A system error occured"; 
							break; 											

				}

	}

	if(file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])){
		print "file exists"; 
		unlink($_FILES['upload']['tmp_name']); 
	}

	return $image; 
}



?>