<?php
    //Form for updating of number

    echo "<a href='/'>Home</a><form action='/router.php' method='GET'><input type='hidden' name='method' value='update'>";
    echo "<h1>UPDATE NUMBER</h1>";
    echo "<h2><b>ID</b>: ".$_GET['id']."</h2><input type='hidden' name='id' value='".$_GET['id']."'>";
    echo "<h2><label>SLUG: <input name='slug' value='".$_GET['slug']."'></label></h2>";
    echo "<h2><label>TITLE: <input name='title' value='".$_GET['title']."'></label></h2>";
    echo "<h2><label>TEXT: <input name='text' value='".$_GET['text']."'></label></h2>";
    echo "<h2><label>NUMBER: <input name='number' value='".$_GET['number']."'></label></h2>";
    echo "<h2><label>TRANSCRIPTION: <input name='transcription' value='".$_GET['transcription']."'></label></h2><input type='submit' value='ok'></form>";
?>