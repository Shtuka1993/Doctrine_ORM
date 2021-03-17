<?php
//"#", "ID", "TITLE", "TEXT", "DATE", "TRANSCRIPT"

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="numbers")
 */
class Number {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     *  @ORM\Column(type="string")
     */
    protected $slug;
    /**
     *  @ORM\Column(type="string")
     */
    protected $title;
    /**
     *  @ORM\Column(type="integer")
     */
    protected $number;
    /**
     *  @ORM\Column(type="string")
     */
    protected $text;
    /**
     *  @ORM\Column(type="datetime")
     */
    protected $date;
    /**
     *  @ORM\Column(type="string")
     */
    protected $transcription;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = id;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getTranscription() {
        return $this->transcription;
    }

    public function setTranscription($transcription) {
        $this->transcription = $transcription;
    }
}