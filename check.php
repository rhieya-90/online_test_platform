<?php
session_start();
include('config.php');
if (!isset($_SESSION['studentdata']['name'])) {
    header('Location:login.php');
}
$errors = array();
$name = $_SESSION['studentdata']['name'];
echo "<br><br>";
if (isset($_POST['submit1'])) {
    if (!empty($_POST['quizcheck'])) {
        $count = count($_POST['quizcheck']);
        echo "attempted question" . "" . $count;


        $selected = $_POST['quizcheck'];
        echo '<pre>';
        print_r($selected);
        echo '</pre>';

        $i = 1;
        $score = 0;
        $status='';

        $sql = "SELECT correct FROM questions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $checked = $row['correct'] == $selected[$i];
                if ($checked) {
                    $score++;
                }
                $i++;
            }
        } else {
            echo "0 results";
        }
        $score=$score*10;
        if($score>=50){
            $status='Pass';
        }else{
            $status='Fail';
        }
        echo "your score is" . "" . $score;
        $sql = "INSERT INTO quiz1 (`name`, `attempted`, `score`)VALUES
        ('" . $name . "', '" . $count . "', '" . $score . "')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('query' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
if (isset($_POST['submit2'])) {
    if (!empty($_POST['quizcheck'])) {
        $count_ = count($_POST['quizcheck']);
        echo "attempted question" . "" . $count_;


        $selected = $_POST['quizcheck'];
        echo '<pre>';
        print_r($selected);
        echo '</pre>';

        $i = 1;
        $score_ = 0;
        $status_='';

        $sql = "SELECT correct FROM questions2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $checked = $row['correct'] == $selected[$i];
                if ($checked) {
                    $score_++;
                }
                $i++;
            }
        } else {
            echo "0 results";
        }
        $score_=$score_*10;
        if($score_>=50){
            $status_='Pass';
        }else{
            $status_='Fail';
        }
        echo "your score is" . "" . $score_.$status_;
        $sql = "INSERT INTO quiz2 (`name`, `attempted`, `score`)VALUES
        ('" . $name . "', '" . $count_ . "', '" . $score_ . "')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('query' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Result</title>
</head>

<body>

    <div class="container text-center">
        <br><br>
        <h1 class="text-center text-success text-uppercase">Online Quiz</h1>
        <br>
        <table class="table text-center table-bordered table-hover">
            <tr>
                <th colspan="4" class="bg-dark">
                    <h1 class="text-white">Result</h1>
                </th>
            </tr>
            <tr>
                <td></td>
                <td>Question Attempted</td>
                <td>Your Score</td>
            </tr>
            <?php
            if (isset($_POST['submit1'])) {
                ?>
                    <tr>
                        <td>quiz1</td>
                <?php
                $sql = "SELECT * FROM quiz1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if($row['name']==$name) {
            ?>
                    
                        <td><?php echo $row['attempted']?></td>
                        <td><?php echo $row['score']?></td>
            <?php
                        }
                   }
                } else {
                echo "0 results";
                }
                ?>
                        <td><?php echo $status; ?></td>
                    </tr>
                <?php
            }
            ?>



            <?php
            if (isset($_POST['submit2'])) {
                ?>
                    <tr>
                        <td>quiz2</td>
                <?php
                // $sql = "SELECT * FROM quiz2";
                // $result = $conn->query($sql);

                // if ($result->num_rows > 0) {
                //     // output data of each row
                //     while ($row = $result->fetch_assoc()) {
                //         if($row['name']==$name){
            ?>
                        <td><?php echo $count_?></td>
                        <td><?php echo $score_?></td>
                        <td><?php echo $status_?></td>
                    </tr>
            <?php
            //             }
            //         }
            //     } else {
            //     echo "0 results";
            //     }
            // }
            }
            ?>
        </table>
        <br><br>
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