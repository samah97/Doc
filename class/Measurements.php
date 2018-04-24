<?php 

include_once 'functions.php';

class Measurements{
    
    
    public static function insertImage($name){
        
        $docId=$_SESSION['doc_id'];
        $patientId=$_SESSION['patient_id'];
        $today=date('Y-m-d');
        
        $sql="INSERT INTO measurement_images(doc_id,patient_id,date,image,is_active) VALUES ($docId,$patientId,'".$today."','".$name."',1)";
        
        $r=exec_query($sql);
        
        if($r)
            return 1;
        else
            return 0;
    }
    
    
    
}



?>