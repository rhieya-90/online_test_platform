<?php
session_start();
include('../admin/config.php');
$errors = array();
$message = '';
if (isset($_POST['login'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($email == '') {
        array_push($errors, array('input' => 'email', 'msg' => 'email empty'));
    }
    if ($name == '') {
        array_push($errors, array('input' => 'name', 'msg' => 'name empty'));
    }
    if ($password == '') {
        array_push($errors, array('input' => 'password', 'msg' => 'password empty'));
    }
    if (sizeof($errors) == 0) {
        $sql = "SELECT name,password,email FROM students WHERE 
        `name`='" . $name . "' AND `email`='" . $email . "'AND `password`='" . $password . "'";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $_SESSION['studentdata'] = array('name' => $row['name'], 'email' => $row['email']);
                echo $_SESSION['studentdata'];
                header('Location:test.php');
                exit;
            }
        } else {
            $errors[] = array('input' => 'form', 'msg' => 'Invalid login details');
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
        <h1 class="text-center text-success">Online Quiz</h1>
        <div class="card">
            <h2 class="text-center card-header">Login form</h2>
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
                    <button type="submit" name="login" class="btn btn-primary">login</button>
            </form>
        </div>
    </div>

    <?php include('footer.php'); ?>