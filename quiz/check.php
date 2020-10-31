<?php
session_start();
include('../admin/config.php');
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
<?php include('header.php'); ?>

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
        <a href="registration.php?name=logout" class="btn btn-primary">logout</a>
    </div>
    </div>










    <?php include('footer.php'); ?>