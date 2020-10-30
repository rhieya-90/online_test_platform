<?php
include('config.php');
include('header.php'); ?>
<div class="container">
    <h1 class="text-center text-primary">Online Quiz Question</h1><br>
    <table class="table text-center table-bordered table-hover">

        <tr>
            <td colspan="7" class="bg-dark">
                <h3 class="text-primary">Manage quiz1</h3>
            </td>
        </tr>
        <tr>
            <td>question</td>
            <td>option1</td>
            <td>option2</td>
            <td>option3</td>
            <td>option4</td>
            <td>correct</td>
        </tr>

        <?php
        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['question'] ?></td>
            <td><?php echo $row['option1'] ?></td>
            <td><?php echo $row['option2'] ?></td>
            <td><?php echo $row['option3'] ?></td>
            <td><?php echo $row['option4'] ?></td>
            <td><?php echo $row['correct'] ?></td>
            <td>
                <a href="edit_quiz1_qst.php?q_id=<?php echo $row['q_id']; ?>&question=<?php echo $row['question']; ?>&option1=<?php echo $row['option1']; ?>&option2=<?php echo $row['option2']; ?>&option3=<?php echo $row['option3']; ?>&option4=<?php echo $row['option4']; ?>&correct=<?php echo $row['correct']; ?>">edit</a>
                <a href="delete_quiz1_qst.php?q_id=<?php echo $row['q_id']; ?>">delete</a>
            </td>
        </tr>
        <?php

            }
        } else {
            echo "0 results";
        }
        ?>
    </table>



    <table class="table text-center table-bordered table-hover">

        <tr>
            <td colspan="7" class="bg-dark">
                <h3 class="text-primary">Manage quiz2</h3>
            </td>
        </tr>
        <tr>
            <td>question</td>
            <td>option1</td>
            <td>option2</td>
            <td>option3</td>
            <td>option4</td>
            <td>correct</td>
        </tr>

        <?php
        $sql = "SELECT * FROM questions2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['question'] ?></td>
            <td><?php echo $row['option1'] ?></td>
            <td><?php echo $row['option2'] ?></td>
            <td><?php echo $row['option3'] ?></td>
            <td><?php echo $row['option4'] ?></td>
            <td><?php echo $row['correct'] ?></td>
            <td>
                <a href="edit_quiz2_qst.php?q_id=<?php echo $row['q_id']; ?>&question=<?php echo $row['question']; ?>&option1=<?php echo $row['option1']; ?>&option2=<?php echo $row['option2']; ?>&option3=<?php echo $row['option3']; ?>&option4=<?php echo $row['option4']; ?>&correct=<?php echo $row['correct']; ?>">edit</a>
                <a href="delete_quiz2_qst.php?q_id=<?php echo $row['q_id']; ?>">delete</a>
            </td>
        </tr>
        <?php

            }
        } else {
            echo "0 results";
        }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>