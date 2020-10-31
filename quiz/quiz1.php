<?php
session_start();
include('../admin/config.php');
if (!isset($_SESSION['studentdata']['name1'])) {
    header('Location:login.php');
}

$name = $_SESSION['studentdata']['name'];
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$num_per_page = 1;
$start_from = ($page - 1) * 1;
$sql = "SELECT * FROM questions limit $start_from,$num_per_page";
$result = $conn->query($sql);
?>


<?php include('header.php'); ?>
<div class="container">
    <br>
    <h1 class="text-center text-primary">Online Quiz</h1><br>
    <div class="col-lg-8 m-auto d-block">
        <div class="card">
            <h2 class="text-center text-success card-header">Welcome <?php echo $name; ?>,Best Of Luck</h2><br>
        </div><br>
        <form action="check.php" method="post">
            <?php
            $i = 1;
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) { ?>
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
        $total_record = $result->num_rows;
        $num_per_page = 1;
        $total_pages = ceil($total_record / $num_per_page); ?>

        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
<!-- continue from here page edit -->

                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    # code...
                    echo '<a  href="quiz1.php?page=' . $i . '">' . $i . '</a>';
                }
                ?>

                <input class="btn btn-success m-auto" type="submit" value="submit" name="submit1">
    </div>
</div><br><br>

<div class="m-auto d-block">
    <a href="registration.php?name=logout" class="btn btn-primary">logout</a>
</div>
</div>





<?php include('footer.php'); ?>