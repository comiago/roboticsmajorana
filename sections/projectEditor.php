<?php

session_start();

if (isset($_SESSION['id'])):
    require('header.php');

?>

<h1>Edit Project</h1>

<form action="">
    <input type="text" name="title" placeholder="Title" id="title">
    <textarea name="style" placeholder="Description" id="description"></textarea>
    <div class="editors">
        <select name="status" id="status">
            <option value="">--Status</option>
            <option value="public">Public</option>
            <option value="public">Private</option>
        </select>
        <input type="submit" value="Salva" id="saveProject">
    </div>
</form>

<?php

require('footer.php');

else:
    header("Location: /login.php");

endif;

?>