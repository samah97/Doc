<?php
include '../functions.php';
include '../class/Measurements.php';

//session_start();


$supportedExtensions=array("jpg","jpeg","png");

$reponse="";

if(isset($_FILES['image-upload'])){
        
    $file=$_FILES['image-upload'];
    
    //print_r($file);
    
    $array=explode('.' ,$file['name'] );
    $fileExt= end($array);
    
    if($file['size'] < 10000*1024 ){
    
    
    if(in_array(  strtolower($fileExt),$supportedExtensions)){
       
      $path="images/uploads/measurements/Doctor_".$_SESSION['doc_id']."/";
      
      $tmp=$file['tmp_name'];
      $newName=time().".".$fileExt;
      
      
      
      if(move_uploaded_file($tmp, "../".$path.$newName)){
      $measurements=new Measurements();
      $inserted= $measurements-> insertImage($newName);       
          //header("location:measurements.php");
          $response=$path.$newName;

      }
       
      else 
          $response= 'error Upload';
      
        
    }
    else
        $reponse= "not supported image file";
    }
    else{
        $response= "Size:".$file['size']."   Image is to big";
    }
    
}
else {
    $response= "NOT SET";
}

echo $response;

?>