<?php
    require_once("bootstrap.php");
    $newNumbersData = [
        ["A0", "Zero", 0, "Null", "Нуль"], 
        ["A1", "One", 1, "Eins", "Айнс"], 
        ["A2", "Two", 2, "Zwei", "Цвай"], 
        ["A3", "Three", 3, "Drei", "Драй"], 
        ["A4", "Four", 4, "Vier", "Фір"], 
        ["A5", "Five", 5, "funf", "Фюнф"], 
        ["A6", "Six", 6, "sechs", "Зекс"],
        ["A7", "Seven", 7, "sieben", "Зібен"],
        ["A8", "Eight", 8, "acht", "Ахт"],
        ["A9", "Nine", 9, "neun", "Нойн"],
        ["A10", "Ten", 10, "Zehn", "Цейн"]
    ];

    foreach($newNumbersData as $data) {
        $date = date('Y-m-d H:i:s');
        $number = new Number();
        $number->setSlug($data[0]);
        $number->setTitle($data[1]);
        $number->setNumber($data[2]);
        $number->setText($data[3]);
        $number->setTranscription($data[4]);
        $number->setDate(new DateTime());
        
        $entityManager->persist($number);
        $entityManager->flush();

        echo "Created Number with ID " . $number->getId() . "\n";
    }