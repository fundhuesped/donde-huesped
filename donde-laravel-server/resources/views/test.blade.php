<?php


$conection = mysqli_connect("127.0.0.1", "root", "", "donde");

if (!$conection) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
// // ANDA OK
// $result = $conection->query("SHOW TABLES");
//     while ( $row = $result->fetch_row() ){
//     $table = $row[0];
//  echo '<h3>',$table,'</h3>';
// $result1 = $conection->query("SELECT * FROM $table");
// if($result1) {
//     echo '<table cellpadding="0" cellspacing="0" class="db-table">';
//     $column = $conection->query("SHOW COLUMNS FROM $table");
// echo '<tr>';
//     while($row3 = $column->fetch_row() ) {
//     echo '<th>'.$row3[0].'</th>';
// }
// echo '</tr>';
//     while($row2 = $result1->fetch_row() ) {
//       echo '<tr>';
//       foreach($row2 as $key=>$value) {
//         echo '<td>',$value,'</td>';
//       }
//       echo '</tr>';
//     }
//     echo '</table><br />';
//   }
//   }

$result = $conection->query("describe donde.places;");
while ( $row = $result->fetch_row() ){
	$col0 = $row[0];
	$col1 = $row[1];
	echo $col0." | ". $col1;
	echo "<br>";
	// echo '<h3>',$col0,'</h3>';
	$result1 = $conection->query("SELECT * FROM $col0");
	if($result1) {
		echo '<table cellpadding="0" cellspacing="0" class="db-table">';
		$column = $conection->query("SHOW COLUMNS FROM $col0");
		echo '<tr>';
		while($row3 = $column->fetch_row() ) {
			echo '<th>'.$row3[0].'</th>';
		}
		echo '</tr>';
		while($row2 = $result1->fetch_row() ) {
			echo '<tr>';
			foreach($row2 as $key=>$value) {
				echo '<td>',$value,'</td>';
			}
			echo '</tr>';
		}
		echo '</table><br />';
	}
}







mysqli_close($conection);
?>