<?php
class Reponse {
   private $reponse;
   private $status;
   const MAUVAIS_REPONSE = false;
   const BONNE_REPONSE = true;
 
   public function __construct($reponse, $status = self::MAUVAIS_REPONSE) {
      $this->reponse = $reponse;
      $this->status = $status;
   }
 
   public function getStatus() {
      return $this->status;
   }
 
   public function getText() {
      return $this->reponse;
   }
}