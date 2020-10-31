<?php
session_start();
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
            echo "New record created successfully";
        } else {
            $errors[] = array('query' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}

$err=array();

if (isset($_POST['login'])) {
    $name1 = isset($_POST['name1']) ? $_POST['name1'] : '';
    $email_ = isset($_POST['email_']) ? $_POST['email_'] : '';
    $password1 = isset($_POST['password1']) ? $_POST['password1'] : '';

    if ($email_ == '') {
        array_push($err, array('input' => 'email_', 'msg' => 'email empty'));
    }
    if ($name1 == '') {
        array_push($err, array('input' => 'name1', 'msg' => 'name empty'));
    }
    if ($password1 == '') {
        array_push($err, array('input' => 'password1', 'msg' => 'password empty'));
    }
    if (sizeof($err) == 0) {
        $sql_ = "SELECT name,password,email FROM students WHERE 
        `name`='" . $name1 . "' AND `email`='" . $email_ . "'AND `password`='" . $password1 . "'";
        $result_ = $conn->query($sql_);


        if ($result_->num_rows > 0) {
            // output data of each row
            while ($row = $result_->fetch_assoc()) {
                $_SESSION['studentdata'] = array('name1' => $row['name'], 'email_' => $row['email']);
                echo $_SESSION['studentdata'];
                header('Location:test.php');
                exit;
            }
        } else {
            $err[] = array('input' => 'form', 'msg' => 'Invalid login details');
        }

        $conn->close();
    }
}

if (isset($_GET['logout'])) {
    session_unset();
}

?>
<?php include('header.php'); ?>
    <div class="container">
        <h1 class="text-center text-success">Online Quiz</h1><br><br>
        
            <div class="card form-signin span6">
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
                </form>
            </div>


<!--log in form-->
            <div class="card form-signin span8">
                <h2 class="text-center card-header">Login form</h2>
                <form action="" method="post">
                    <?php
                    if (sizeof($err) > 0) {
                        foreach ($err as $key => $error) {
                            if (isset($error['input']) && $error['input'] == 'form') {
                                echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                            }
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="exampleInputName1">Your name</label>
                        <input type="text" name="name1" class="form-control" id="exampleInputPassword1">
                        <?php
                        if (sizeof($err) > 0) {
                            foreach ($err as $key => $error) {
                                if (isset($error['input']) && $error['input'] == 'name1') {
                                    echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email_" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <?php
                        if (sizeof($err) > 0) {
                            foreach ($err as $key => $error) {
                                if (isset($error['input']) && $error['input'] == 'email_') {
                                    echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password1">
                        <?php
                        if (sizeof($err) > 0) {
                            foreach ($err as $key => $error) {
                                if (isset($error['input']) && $error['input'] == 'password1') {
                                    echo '<small id="emailHelp" class="alert alert-danger" role="alert">' . $error['msg'] . '</small>';
                                }
                            }
                        }
                        ?>
                        <button type="submit" name="login" class="btn btn-primary">login</button>
                </form>
            </div>
       
    </div>

    <?php include('footer.php'); ?>