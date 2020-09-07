<?php
class Qcm {
   private $questions;
   private $appreciation;
    
   public function __construct() {
      $this->questions = array();
      $this->appreciation = array();
   }
    
   public function ajouterQuestion($question) {
      $this->questions[] = $question;
      return $this;
   }
    
   public function setAppreciation($appreciation) {
      foreach($appreciation as $key=>$appr) {
         if(is_numeric($key))
            $this->appreciation[(int)$appr] = $appr;
         else {
            list($min, $max) = explode('-', $key);
            if($min>$max)
               list($min, $max) = array($max, $min);
            for($i=(int)$min;$i<=$max;$i++)
               $this->appreciation[$i] = $appr;
         }
      }
      return $this;
   }
    
   public function generer() {
      $id = md5(serialize($this));
      if(isset($_POST['qcm_id']) AND $_POST['qcm_id']==$id) {
         $nbrBonneReponses = 0;
         foreach($this->questions as $i=>$question) {
            echo 'Question '.$i.' : '.htmlspecialchars($question->getQuestion()).'<br /><br />';
            if($_POST['qcm_q'.$i]==$question->getNumBonneReponse()) {
               echo 'Bonne réponse!<br /><br />';
               $nbrBonneReponses++;
            }
            else
               echo 'Mauvaise réponse : '.htmlspecialchars($question->getReponse($_POST['qcm_q'.$i])->getText()).'<br />';
            echo 'La bonne réponse était : '.htmlspecialchars($question->getBonneReponse()->getText()).'<br /><br />';
            echo 'Explication : '.htmlspecialchars($question->getExplication());
            echo '<hr />';
         }
         $note = round($nbrBonneReponses/count($this->questions)*20);
         echo 'Note : '.$note.'/20<br />';
         if(isset($this->appreciation[$note]))
            echo 'Appréciation : '.htmlspecialchars($this->appreciation[$note]);
      }
      else {
         echo '<form method="post" />';
         echo '<input type="hidden" value="'.$id.'" name="qcm_id" />';
         foreach($this->questions as $i=>$question) {
            echo '<fieldset>Question '.$i.' : '.htmlspecialchars($question->getQuestion()).'<br />';
            foreach($question->getReponses() as $j=>$reponse) {
               echo '<input type="radio" name="qcm_q'.$i.'" value="'.$j.'" />';
               echo htmlspecialchars($reponse->getText()).'<br />';
            }
            echo '</fieldset><br />';
         }
         echo '<input type="submit" value="envoyer" /></form>';
      }
   }
}