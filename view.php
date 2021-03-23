<?php
    //Template for displaying number instance

    echo "<a href='/'>Home</a>";
    echo "<h1>VIEW NUMBER</h1>";
    echo "<h2><b>ID</b>: ".$_GET['id']."</h2>";
    echo "<h2><b>SLUG</b>: ".$_GET['slug']."</h2>";
    echo "<h2><b>TITLE</b>: ".$_GET['title']."</h2>";
    echo "<h2><b>TEXT</b>: ".$_GET['text']."</h2>";
    echo "<h2><b>NUMBER</b>: ".$_GET['number']."</h2>";
    echo "<h2><b>TRANSCRIPTION</b>: ".$_GET['transcription']."</h2>";
?>