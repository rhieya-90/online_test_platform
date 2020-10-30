<?php
include('config.php');
$q_id= $_GET['q_id'];
$query = "DELETE FROM questions2 WHERE q_id='$q_id'";
$data = mysqli_query($conn, $query);
if ($data) {
?>
    <meta http-equiv="Refresh" content="0; URL=http://http://localhost/online_test_platform/index.php">
<?php
} else {
    echo "can't delete the data";
} ?>