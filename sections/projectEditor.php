<?php

session_start();

if (isset($_SESSION['id'])):
    require('header.php');
    require('../dbh/administration.php');

    $modify = false;
    $title = 'Title';
    $description = 'Description';

    if (isset($_GET['id'])){
        $modify = true;
        $project = getProject($_GET['id']);
        $title = $project['name'] != "" ? $project['name'] : 'Title';
        $description = $project['description'] != "" ? $project['description'] : 'Description';
    }

?>

<h1>Project Editor</h1>

<?php
    if ($modify === true){
        echo "<form id='form' project='" . $_GET['id'] . "'>";
    } else {
        echo "<form id='form'>";
    }
?>
    <input type="text" name="title" placeholder="<?php echo $title; ?>" id="title">
    <textarea name="description" placeholder="<?php echo $description; ?>" id="description"></textarea>
    <div class="editors">
        <select name="status" id="status">
            <option value="">--Status</option>
            <?php
                $statuses = getStatuses();
                $project = getProject($_GET['id']);
                while($status = mysqli_fetch_array($statuses)){
                    if ($status['idStatus'] == $project['status']){
                        echo '<option value="' . $status["idStatus"] . '" selected>' . $status["name"] . '</option>';
                    } else{
                        echo '<option value="' . $status["idStatus"] . '">' . $status["name"] . '</option>';
                    }
                }
            ?>
        </select>
        <?php if ($modify === false): ?>
        <input type="submit" value="Salva" id="saveProject">
        <?php else: ?>
        <input type="submit" value="Modifica" id="updateProject">
        <?php endif; ?>    </div>
</form>

<?php

require('footer.php');

else:
    header("Location: /login.php");

endif;

?>