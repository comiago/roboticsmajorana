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
        $chapter = getChapter($_GET['id']);
        $title = $chapter['name'] != "" ? $chapter['name'] : 'Title';
        $description = $chapter['description'] != "" ? $chapter['description'] : 'Description';
    }

?>

<h1>Chapter Editor</h1>

<?php
    if ($modify === true){
        echo "<form id='form' chapter='" . $_GET['id'] . "'>";
    } else {
        echo "<form id='form'>";
    }
?>
    <input type="text" name="title" placeholder="<?php echo $title; ?>" id="title">
    <textarea name="description" placeholder="<?php echo $description; ?>" id="description"></textarea>
    <div class="editors">
        <select name="project" id="project">
            <option value="">--Project</option>
            <?php
                $projects = getProjectReferences();
                $chapter = getChapter($_GET['id']);
                while($project = mysqli_fetch_array($projects)){
                    if ($project['idProject'] == $chapter['project']){
                        echo '<option value="' . $project["idProject"] . '" selected>' . $project["name"] . '</option>';
                    } else{
                        echo '<option value="' . $project["idProject"] . '">' . $project["name"] . '</option>';
                    }
                }
            ?>
        </select>
        <select name="status" id="status">
            <option value="">--Status</option>
            <?php
                $statuses = getStatuses();
                $project = getProject($_GET['id']);
                while($status = mysqli_fetch_array($statuses)){
                    if ($status['idStatus'] == $chapter['status']){
                        echo '<option value="' . $status["idStatus"] . '" selected>' . $status["name"] . '</option>';
                    } else{
                        echo '<option value="' . $status["idStatus"] . '">' . $status["name"] . '</option>';
                    }
                }
            ?>
        </select>
        <?php if ($modify === false): ?>
        <input type="submit" value="Salva" id="saveChapter">
        <?php else: ?>
        <input type="submit" value="Modifica" id="updateChapter">
        <?php endif; ?>    </div>
</form>

<?php

require('footer.php');

else:
    header("Location: /login.php");

endif;

?>