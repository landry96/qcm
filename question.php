<?php
class Question {
   private $question;
   private $reponses;
   private $explication;
 
   public function __construct($question) {
      $this->question = $question;
      $this->reponse = array();
   }
 
   public function ajouterReponse($reponse) {
      $this->reponses[] = $reponse;
      return $this;
   }
 
   public function setExplications($explication) {
      $this->explication = $explication;
      return $this;
   }
 
   public function getNumBonneReponse() {
      foreach($this->reponses as $i=>$reponse)
         if($reponse->getStatus())
            return $i;
   }
 
   public function getBonneReponse() {
      foreach($this->reponses as $reponse)
         if($reponse->getStatus())
            return $reponse;
   }
 
   public function getReponses() {
      return $this->reponses;
   }
 
   public function getReponse($num) {
      return $this->reponses[$num];
   }
 
   public function getQuestion() {
      return $this->question;
   }
 
   public function getExplication() {
      return $this->explication;
   }
}