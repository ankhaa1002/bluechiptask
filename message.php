<?php

	include 'DB.php';

	function getMessages(){
		$sql = "SELECT * FROM message";
		$messages = OpenCon()->query($sql);
		CloseCon(OpenCon());
		return $messages;
	}

	function getPaginatedMessages($pagenum){
		$limit = 10;
		$offset = 0;

		if($pagenum != 1){
			$offset = ($pagenum-1)*$limit;
		}

		$sql = "SELECT * FROM message ORDER BY posteddate DESC LIMIT ".$limit." OFFSET ".$offset."";
		$con = OpenCon();
		$messages = $con->query($sql);
		if (!$messages) {
		    trigger_error('Invalid query: ' . $con->error);
		}
		CloseCon(OpenCon());
		return $messages;
	}

	function getPaginations(){
		$total = mysqli_num_rows(getMessages());
		$count = $total/10;
		if($total%10)
			$count++;

		return $count;
	}

	try{
		if(isset($_POST['submit'])){
			$conn = OpenCon();

			$body = $_POST['message'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$posteddate = date('Y-m-d H:i:s');

			$sql = "INSERT INTO message (body, name, email, posteddate)
				VALUES ('".$body."', '".$name."','".$email."', '".$posteddate."')";

			if ($conn->query($sql) === TRUE) {
			    header("Location: index.php?success=1");
				exit();
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	} catch(\Exception $e){
		header("Location: index.php?danger=1");
		exit();
	}
	
	try{
		if(isset($_GET['message'])){
			$conn = OpenCon();

			$sql = "DELETE FROM message WHERE id = ".$_GET["message"]."";

			if ($conn->query($sql) === TRUE) {
			    header("Location: index.php?deleteSuccess=1");
				exit();
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	} catch(\Exception $e){
		header("Location: index.php?deleteDanger=1");
		exit();
	}
?>