<?php
    //Router for handling different URIs and CRUDs methods for Number

    require_once('bootstrap.php');
    require_once("Crud.php");
    if(isset($_GET)) {
        $crudInterface = new Crud($entityManager);
        $method = $_GET['method'];
        switch($method) {
            case 'create':
                $slug = $_GET['slug']; 
                $title = $_GET['title'];
                $number = $_GET['number'];
                $text = $_GET['text'];
                $transcription = $_GET['transcription'];
                $crudInterface->createNumber($slug, $title, $number, $text, $transcription);
                header('Location: /');
                break;
            case 'read':
                $id = $_GET['id'];
                $numberEntety = $crudInterface->readNumber($id);
                $slug = $numberEntety->getSlug(); 
                $title = $numberEntety->getTitle();
                $number = $numberEntety->getNumber();
                $text = $numberEntety->getText();
                $transcription = $numberEntety->getTranscription();
                header('Location: /view.php?id='.$id.'&slug='.$slug.'&title='.$title.'&number='.$number.'&text='.$text.'&transcription='.$transcription);
                break;
            case 'edit':
                $id = $_GET['id'];
                $numberEntety = $crudInterface->readNumber($id);
                $slug = $numberEntety->getSlug(); 
                $title = $numberEntety->getTitle();
                $number = $numberEntety->getNumber();
                $text = $numberEntety->getText();
                $transcription = $numberEntety->getTranscription();
                header('Location: /edit.php?id='.$id.'&slug='.$slug.'&title='.$title.'&number='.$number.'&text='.$text.'&transcription='.$transcription);
                break;
            case 'update':
                $id = $_GET['id'];
                $numberEntety = $crudInterface->readNumber($id);
                $slug = $numberEntety->getSlug; 
                $title = $numberEntety->getTitle;
                $number = $numberEntety->getNumber;
                $text = $numberEntety->getText;
                $transcription = $numberEntety->getTranscription;
                header('Location: /');
                break;
            case 'delete':
                $id = $_GET['id'];
                $crudInterface->deleteNumber($id);
                header('Location: /');
                break;
            default:
                header('Location: /');
                break;
        }
    }