<?php
session_start();
include('../admin/config.php');
if (!isset($_SESSION['studentdata']['name1'])) {
    header('Location:registration.php');
}

$name = $_SESSION['studentdata']['name1'];
?>
<?php include('header.php'); ?>
    <div class="container">
        <br>
        <h1 class="text-center text-primary">Online Quiz</h1><br>
        <div class="col-lg-8 m-auto d-block">
            <div class="card">
                <h2 class="text-center text-success card-header">Welcome <?php echo $name; ?>,Best Of Luck</h2><br>
            </div><br>
            <h2 class="text-center text-primary">select any quiz</h2><br>
    <div class="col-lg-8 m-auto d-block">
        <a href="quiz1.php" class="btn btn-success">Quiz1</a>
        <a href="quiz2.php" class="btn btn-success">Quiz2</a>
    </div><br><br>
    <div class="m-auto d-block">
        <a href="registration.php?name=logout" class="btn btn-primary">logout</a>
    </div>
    </div>





    <?php include('footer.php'); ?>