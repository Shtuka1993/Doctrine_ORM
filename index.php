<?php
    require_once("bootstrap.php");
    require_once("Crud.php");

    
    $crudInterface = new Crud($entityManager);

    $page = 1;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    //$pagination = $crudInterface->readNumbersPaginate($page);
    $filters = (isset($_GET['filters']))?array_filter($_GET['filters']):[];
    $sortings = (isset($_GET['sortings']))?array_filter($_GET['sortings']):[];;
    $pagination = $crudInterface->readNumbersWithFilterAndSortings($page, $filters, $sortings);
    $numbers = $pagination['data'];
    $currentPage = $pagination['page'];
    $pages = $pagination['pages'];
    echo "<h1>CRUD Example with Doctrine</h1>";
    echo "<table>";
    echo "<th>";
        echo "<td>#</td>";   
        echo "<td>ID</td>";
        echo "<td>TITLE</td>";
        echo "<td>TEXT</td>";
        echo "<td>NUMBER</td>";
        echo "<td>TRANSCRIPTION</td>";
        echo "<td>ACTIONS</td>";
    echo "</th><tbody>";
    echo "<tr><form method='GET' action='/'>";
        echo "<td>Find</td>";   
        echo "<td><input type='text' name='filters[slug]'></td>";
        echo "<td><input type='text' name='filters[title]'></td>";
        echo "<td><input type='text' name='filters[text]'></td>";
        echo "<td><input type='text' name='filters[number]'></td>";
        echo "<td><input type='text' name='filters[transcription]'></td>";
        echo "<td><input type='submit' value='search'></td>";
    echo "</form></tr>";
    foreach($numbers as $number) {
        $numberId = $number->getId();
        echo "<tr>";
            echo "<td>".$numberId."</td>";   
            echo "<td>".$number->getSlug()."</td>";
            echo "<td>".$number->getTitle()."</td>";
            echo "<td>".$number->getText()."</td>";
            echo "<td>".$number->getNumber()."</td>";
            echo "<td>".$number->getTranscription()."</td>";
            echo "<td><a href='/router.php?method=read&id=".$numberId."'>View</a> <a href='/router.php?method=edit&id=".$numberId."'>Edit</a> <a href='/router.php?method=delete&id=".$numberId."'>Delete</a></td>";
            //echo "<td>".$number->getDate()."</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    echo "<h2>PAgination</h2>";

    for($i=1; $i<=$pages; $i++)
    echo "<a href='/index.php?page=".$i."'>".(($i==$page)?('<b>'.$i.'</b>'):$i)."</a>";

    echo "
    <h1>CREATE NEW NUMBER</h1>
    <form action='/route.php' method='GET'>
        <label>Slug<input type='text' name='slug'></label>
        <label>Title<input type='text' name='title'></label>
        <label>Text<input type='text' name='text'></label>
        <label>Number<input type='text' name='number'></label>
        <label>Transcription<input type='text' name='transcription'></label>
        <input type='hidden' name='method' value='create'>
        <input type='submit' value='OK'>
    </form>";
    $crudInterface->readNumbersPaginate();
?>