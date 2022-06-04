<?php

session_start();

if (isset($_SESSION['id'])):
    require('header.php');
    require('../dbh/administration.php');
    
    $id = isset($_GET['id']);
    $modify = false;
    $title = 'Title';
    $style = 'Style';
    $content = 'Content';

    if ($id){
        $modify = true;
        $page = getPage($_GET['id']);
        $title = $page['name'] != "" ? $page['name'] : 'Title';
        $style = $page['style'] != "" ? $page['style'] : 'Style';
        $content = $page['content'] != "" ? $page['content'] : 'Content';
    }
?>

<h1>Edit Page</h1>

<?php
    if ($modify === true){
        echo "<form id='form' page='" . $id . "'>";
    } else {
        echo "<form id='form'>";
    }
?>
    <input type="text" name="title" placeholder="<?php echo $title; ?>" id="title">
    <div class="editors">
        <textarea name="style" placeholder="<?php echo $style; ?>" id="style"></textarea>
        <textarea name="content" placeholder="<?php echo $content; ?>" id="content"></textarea>
        <select name="status" id="status">
            <option value="">--Status</option>
            <?php
                $statuses = getStatuses();
                $page = getPage($_GET['id']);
                while($status = mysqli_fetch_array($statuses)){
                    if ($status['idStatus'] == $page['status']){
                        echo '<option value="' . $status["idStatus"] . '" selected>' . $status["name"] . '</option>';
                    } else{
                        echo '<option value="' . $status["idStatus"] . '">' . $status["name"] . '</option>';
                    }
                }
            ?>
        </select>
        <?php if ($modify === false): ?>
        <input type="submit" value="Salva" id="savePage">
        <?php else: ?>
        <input type="submit" value="Modifica" id="updatePage">
        <?php endif; ?>
    </div>
</form>

<?php

require('footer.php');

else:
    header("Location: /login.php");

endif;

?>