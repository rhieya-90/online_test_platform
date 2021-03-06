<?php
include('config.php');
$errors = array();
$message = '';
$q_id=isset($_GET['q_id']) ? $_GET['q_id'] : '';
if (isset($_POST['update'])) {
    $question = isset($_POST['question']) ? $_POST['question'] : '';
    $option1 = isset($_POST['option1']) ? $_POST['option1'] : '';
    $option2 = isset($_POST['option2']) ? $_POST['option2'] : '';
    $option3 = isset($_POST['option3']) ? $_POST['option3'] : '';
    $option4 = isset($_POST['option4']) ? $_POST['option4'] : '';
    $correct = isset($_POST['correct']) ? $_POST['correct'] : '';

    if ($question == '') {
        array_push($errors, array('input' => 'question', 'msg' => 'question empty'));
    }
    if ($option1 == '') {
        array_push($errors, array('input' => 'option1', 'msg' => 'option1 empty'));
    }
    if ($option2 == '') {
        array_push($errors, array('input' => 'option2', 'msg' => 'option2 empty'));
    }
    if ($option3 == '') {
        array_push($errors, array('input' => 'option3', 'msg' => 'option3 empty'));
    }
    if ($option4 == '') {
        array_push($errors, array('input' => 'option4', 'msg' => 'option4 empty'));
    }
    if ($correct == '') {
        array_push($errors, array('input' => 'correct', 'msg' => 'correct empty'));
    }
    if (sizeof($errors) == 0) {
        $sql = "UPDATE questions2 SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', correct='$correct'WHERE q_id='$q_id'";

        if ($conn->query($sql) === true) {
            header('Location:quiz1_qst.php');
            //echo "New record created successfully";
        } else {
            $errors[] = array('input' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

<?php include('header.php');?>
    <div class="container">
        <h1 class="text-center text-primary">Online Quiz1 Question</h1><br>
        <ul class="content-box-tabs">
            <li><a href="manage.php?name=quiz1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="quiz1_qst.php">Add</a></li>
        </ul>


        <form action="" method="post">
            <?php
            if (sizeof($errors) > 0) {
                foreach ($errors as $key => $error) {
                    if (isset($error['question_']) && $error['question_']  == 'add') {
                        echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                    }
                    if (isset($error['input']) && $error['input']  == 'form') {
                        echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                    }
                }
            }
            ?>

            <div class="form-group">
                <label for="exampleInputPassword1">Question</label>
                <input type="text" name="question" class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['question'] ?>">

                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input']  == 'question') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Q_id</label>
                <input type="text" name="q_id" class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['q_id'] ?>">

                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input']  == 'q_id') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Option 1</label>
                <input type="text" name="option1" value="<?php echo $_GET['option1'] ?>" class="form-control" id="exampleInputPassword1">

                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input'] == 'option1') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Option 2</label>
                <input type="text" name="option2" value="<?php echo $_GET['option2'] ?>" class="form-control" id="exampleInputPassword1">

                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input']  == 'option2') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Option 3</label>
                <input type="text" name="option3" value="<?php echo $_GET['option3'] ?>" class="form-control" id="exampleInputPassword1">

                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input']  == 'option3') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword4">Option 4</label>
                <input type="text" name="option4" value="<?php echo $_GET['option4'] ?>" class="form-control" id="exampleInputPassword1">
                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input']  == 'option4') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Correct Option</label>
                <input type="text" name="correct" value="<?php echo $_GET['correct'] ?>" class="form-control" id="exampleInputPassword1">
                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input']  == 'correct') {
                            echo '<small id="emailHelp" class="form-text text-muted">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

   <?php include('footer.php'); ?>