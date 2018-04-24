
<?php 
include_once '/functions.php';

class Doctor{
    
    public function selectAll(){
        
        $sql="select * from doctors";
        
        $result=exec_query($sql);
        
        return $result;
    }
    
    public function selectWithId($id){
        
        $sql="SELECT * FROM doctors WHERE doc_id = $id";
        
        $result=exec_query($sql);
        
        return $result;
        
    }
    
    
    
    
}

?>