<?php
$conn = mysqli_connect("localhost", "root", "", "excelphp");


// connection

if (!$conn)
{
	echo "Connection failed";
}


// data insert

else
{
	$file = $_FILES['csvfile']['tmp_name'];
	$handle = fopen($file, "r");
	$i = 0;



while (($cont = fgetcsv($handle, 1000, ",")) !== false)

{

$table =  rtrim($_FILES['csvfile']['name'],".csv");

if($i == 0) 
{
		$id = $cont[0];
		$fname = $cont[1];
		$lname = $cont[2];
		$email = $cont[3];

		$query = "CREATE TABLE $table ($id INT(50), $fname VARCHAR(50), $lname VARCHAR(50), $email VARCHAR(50));";

		mysqli_query($conn, $query);

if (!$query)
{
			echo "Data not inserted";
}

else
{
			echo $query,"<br>";
}

}



else if ($i != 0)
{
	$query = "INSERT INTO $table ( $id, $fname, $lname, $email ) VALUES ( '$cont[0]', '$cont[1]', '$cont[2]', '$cont[3]' );";

	mysqli_query($conn, $query);

if (!$query)
{
			echo "Data not inserted";
}

else
{
			echo $query,"<br>";
}
}



$i++;

}
}

?>