<?php

include_once("config.php");

function exec_query($sql){
    
    $con=mysqli_connect(host,user,pwd,dbname);
    
    if(!$con)
        die ("Error while connecting".mysqli_error($con));
        
        $r=mysqli_query($con,$sql);
        
        if(!$r)
            die("Error in query: ".$sql." Error: ".mysqli_error($con));
            
            mysqli_close($con);
        return $r;
}


function select($table,$where){
    $sql="SELECT * FROM $table WHERE 1";
    
    $result=exec_query($sql);
    return $result;
}

function selectUser($userName,$pass){
    
    $sql= mysqli_prepare("SELECT * FROM users WHERE username= ?");
       
}






?>