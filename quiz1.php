<?php
session_start();
include('config.php');
if (!isset($_SESSION['studentdata']['name'])) {
    header('Location:login.php');
}

$name = $_SESSION['studentdata']['name'];
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}

$num_per_page=1;
$start_from=($page-1)*1;
$sql = "SELECT * FROM questions limit $start_from,$num_per_page";
$result = $conn->query($sql);



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>welcome</title>
</head>

<body>
    <div class="container">
        <br>
        <h1 class="text-center text-primary">Online Quiz</h1><br>
        <div class="col-lg-8 m-auto d-block">
            <div class="card">
                <h2 class="text-center text-success card-header">Welcome <?php echo $name; ?>,Best Of Luck</h2><br>
            </div><br>
            <form action="check.php" method="post">
                <?php
                $i=1;
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {?>
                        <div class="card">
                            <h4 class="card-header"><?php echo $row['question']; ?></h4>
                            <div class="card-body">
                                <input type="radio" name="quizcheck[<?php echo $i; ?>]" value="<?php echo $row['option1']; ?>"><?php echo $row['option1']; ?><br><br>
                                <input type="radio" name="quizcheck[<?php echo $i; ?>]" value="<?php echo $row['option2']; ?>"><?php echo $row['option2']; ?><br><br>
                                <input type="radio" name="quizcheck[<?php echo $i; ?>]" value="<?php echo $row['option3']; ?>"><?php echo $row['option3']; ?><br><br>
                                <input type="radio" name="quizcheck[<?php echo $i; ?>]" value="<?php echo $row['option4']; ?>"><?php echo $row['option4']; ?><br>
                            </div>
                    <?php
                    $i++;
                    }
                } else {
                    echo "0 results";
                }

                    ?>
            </form>
            <?php
            $sql = "SELECT * FROM questions";
            $result = $conn->query($sql);
            $total_record=$result->num_rows;
            $num_per_page=1;
            $total_pages=ceil($total_record/$num_per_page);
            for ($i=1; $i <= $total_pages; $i++) { 
                # code...
                echo '<a  href="quiz1.php?page='.$i.'">'.$i.'</a>';
            }
            ?>
            
            <input class="btn btn-success m-auto" type="submit" value="submit" name="submit1">
        </div>
    </div><br><br>

    <div class="m-auto d-block">
        <a href="login.php?name=logout" class="btn btn-primary">logout</a>
    </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>