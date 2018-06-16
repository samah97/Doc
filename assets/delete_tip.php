<?php
include '../functions.php';

if(isset($_POST)){
    $result=exec_query("delete from health_tips where tip_id=".$_POST['id']);
    
    if($result){
        echo "Tip Deleted";
    }
    else {
        echo "Error Deleting Tip: ".$result;
    }
}

?>