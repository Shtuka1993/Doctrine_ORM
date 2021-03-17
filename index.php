<?php
    require_once("bootstrap.php");
    require_once("Crud.php");

    
    $crudInterface = new Crud($entityManager);

    $numbers = $crudInterface->readAllNumbers();
    //$headers = ["#", "ID", "TITLE", "TEXT", "NUMBER", "TRANSCRIPT", "DATE", "ACTIONS"];
    $headers = ["#", "ID", "TITLE", "TEXT", "NUMBER", "TRANSCRIPT", "ACTIONS"];
    $items = [
        ["1", "A0", "Zero", "Null", "0", "Нуль"], 
        ["2", "A1", "One", "Eins", "1", "Айнс"], 
        ["3", "A2", "Two", "Zwei", "2", "Цвай"], 
        ["4", "A3", "Three", "Drei", "3", "Драй"], 
        ["5", "A4", "Four", "Vier", "4", "Фір"], 
        ["6", "A5", "Five", "funf", "5", "Фюнф"], 
        ["7", "A6", "Six", "sechs", "6", "Зекс"],
        ["8", "A7", "Seven", "sieben", "7", "Зібен"],
        ["9", "A8", "Eight", "acht", "8", "Ахт"],
        ["10", "A9", "Nine", "neun", "9", "Нойн"],
        ["11", "A10", "Ten", "Zehn", "10", "Цейн"]
    ];
    echo "<h1>CRUD Example with Doctrine</h1>";
    echo "<table>";
    echo "<th>";
        foreach($headers as $header) {
            echo "<td>".$header."</td>";
        }
    echo "</th><tbody>";
    /*foreach($items as $item) {
        echo "<tr>";
        foreach($item as $data) {
            echo "<td>".$data."</td>";
        }
        echo "</tr>";
    }*/

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

    echo "
    <form action='/router.php' method='GET'>
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