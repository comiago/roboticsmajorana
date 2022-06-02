<?php require('header.php'); ?>

<form action="">
    <input type="text" name="title" placeholder="Title" id="title">
    <div class="editors">
        <textarea name="style" placeholder="Style" id="style"></textarea>
        <textarea name="content" placeholder="Content" id="content"></textarea>
        <select name="status" id="status">
            <option value="">--Status</option>
            <option value="public">Public</option>
            <option value="public">Private</option>
        </select>
        <input type="submit" value="Salva">
    </div>
</form>

<?php require('footer.php'); ?>