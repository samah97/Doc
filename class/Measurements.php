<?php 

include_once '../functions.php';

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
    
    public static function insertMeasurement($patientId,$height,$weight,$headDiameter){
        
        $today=date('Y-m-d');
        $sql="insert into measurements(date_of_meas,patient_id,height,weight,head_diameter)
                values (?,?,?,?,?)";
        
        $con=mysqli_connect(host,user,pwd,dbname);
        $stmt=$con->prepare($sql);
        
        $stmt->bind_param("siddd",$today,$patientId,$height,$weight,$headDiameter);
        $stmt->execute();
        
        $stmt->close();
        $con->close();
        
        if($stmt)
            return 1;
        else 
            return 0;
        

        
       
        
    }
      
    
}



?>