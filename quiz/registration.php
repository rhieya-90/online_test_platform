<?php
include('../admin/config.php');
$errors = array();
$message = '';
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if ($password != $repassword) {
        array_push($errors, array('input' => 'password', 'msg' => 'password does not match'));
    }
    if ($name == '') {
        array_push($errors, array('input' => 'name', 'msg' => 'name empty'));
    }
    if ($password == '' || $repassword == '') {
        array_push($errors, array('input' => 'password_', 'msg' => 'password empty'));
    }
    if ($email == '') {
        array_push($errors, array('input' => 'email', 'msg' => 'email empty'));
    }
    $sql = "SELECT email FROM students WHERE 
         `email`='" . $email . "'";
    $fire = mysqli_query($conn, $sql) or die("can not fire the query" . mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire) > 0) {
        array_push($errors, array('query' => 'reg_email', 'msg' => "email exists"));
    }
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO students (`name`, `password`, `email`)VALUES
        ('" . $name . "', '" . $password . "', '" . $email . "')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
            header('Location:login.php');
                exit;
        } else {
            $errors[] = array('query' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>
<?php include('header.php'); ?>
    <div class="container">
        <h1 class="text-center text-success">Online Quiz</h1>
        <div class="card">
            <h2 class="text-center card-header">Registration form</h2>
            <form action="" method="post">
                <?php
                if (sizeof($errors) > 0) {
                    foreach ($errors as $key => $error) {
                        if (isset($error['input']) && $error['input'] == 'form') {
                            echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                        }
                    }
                }
                ?>
                <div class="form-group">
                    <label for="exampleInputName1">Your name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputPassword1">
                    <?php
                    if (sizeof($errors) > 0) {
                        foreach ($errors as $key => $error) {
                            if (isset($error['input']) && $error['input'] == 'name') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                            if (isset($error['query']) && $error['query'] == 'reg_name') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <?php
                    if (sizeof($errors) > 0) {
                        foreach ($errors as $key => $error) {
                            if (isset($error['input']) && $error['input'] == 'email') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                            if (isset($error['query']) && $error['query'] == 'reg_email') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password">
                    <?php
                    if (sizeof($errors) > 0) {
                        foreach ($errors as $key => $error) {
                            if (isset($error['input']) && $error['input'] == 'password') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                            if (isset($error['input']) && $error['input'] == 'password_') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Re-Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="repassword">
                    <?php
                    if (sizeof($errors) > 0) {
                        foreach ($errors as $key => $error) {
                            if (isset($error['input']) && $error['input'] == 'repassword') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                        }
                    }
                    ?>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <a href="login.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Login</a>
            </form>
        </div>
    </div>

    <?php include('footer.php'); ?>