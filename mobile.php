<?php include_once("functions.php");?>
<html>
<head>
    <title>Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="js/jquery-3.3.1.min.js"></script>
			
	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<link rel="stylesheet" type="text/css" href="css/static.css">
		<link rel="stylesheet" type="text/css" href="css/measurements.css">
	<script type="text/javascript" href="js/main.js"></script>
	
	<!-- DataTable plugin -->
	<link rel="stylesheet" href="plugins/DataTables/dataTables.bootstrap.min.css" />
	<script src="plugins/DataTables/jquery.dataTables.min.js" ></script>
	<script src="plugins/DataTables/dataTables.bootstrap.min.js"> </script>
	<!-- End of DataTable -->

	
	
	
	<!--Slick-->
	<link rel="stylesheet" type="text/css" href="plugins/slick/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="plugins/slick/slick/slick-theme.css"/>

	<script type="text/javascript" src="plugins/slick/slick/slick.min.js"></script>
	<!--End -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Alertify Plugin -->
	<script src="plugins/alertify/alertify.js"></script>

	<link rel="stylesheet" href="plugins/alertify/css/alertify.min.css" />

	<link rel="stylesheet" href="plugins/alertify/css/themes/default.min.css" />
	<!-- End -->
	
	<!-- Zoom Plugin -->
<script src="plugins/jquery.elevatezoom.js" type="text/javascript"></script>
	<!-- End of Zoom -->
	
	<!--Custom Select box--> 
<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
<!-- End -->

<?php
include_once "header.php";
$result=exec_query("select * from health_tips where doctor_id=".$_SESSION['doc_id']);

?>
</head>

<body>
<div class="container-fluid">
<div class="row">

<div class="container">
<div class="row">
<div class="col-md-12"><h2 class="centered_title">Health Tips</h2></div>
<div class="col-md-12"><div class="centered_line"></div></div>
<div id="view_tips">
<div class="col-md-12"> <button type="button" class="btn btn-success pull-right" id="btn-addtip">Add Tip</button> </div>
<div class="col-md-12">
<table id="table-tips" class="table table-bordered">
<thead>
<tr>
<th>Title</th><th>Description</th><th>Image</th><th>Order</th><th>Active</th><th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_array($result)){
$active=$row['is_active']==1?"yes":"no";
?>
<tr id="row_<?php echo $row['tip_id'] ?>">
<?php echo "<td>".$row['tip_title']."<td>".$row['tip_description']."<td>".$row['tip_image']."<td>".$row['tip_order']."<td>".$active;
echo "<td style='text-align:center'><button type='button' class='btn btn-warning' style='margin-right:15px' onclick=Edit(".$row['tip_id'].")>Edit</button>";
echo "<button type='button' class='btn btn-danger' onclick=Delete(".$row['tip_id'].")>Delete</button>";

?>

</tr>
<?php }?>
</tbody>

</table>
</div>

</div>
</div>

<div id="add_tip" style='display:none'>
<div class="col-md-12"><button class="btn pull-left" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button></div>
<div class="col-md-12">
<form method="post" enctype="multipart/form-data" id="form-tip">
<input type="text" name="tip_id" style="display:none" id="tip_id"/>;
<label>Title</label><input type="text" name="title" id="title" class="form-control">
<label>Description</label><textarea name="description" id="description" class="form-control" ></textarea>
<label>Image</label>
<div class="image-holder">
<img id="tip-image" />
</div>
<input type="file" name="image" id="image-upload" class="image-upload"  style="display:block" />
<label for="image-upload" class="input-image"><i class="fa fa-upload"></i> Upload Images </label>
<br>
<label>Order</label><input type="number" name="order" id="order" class="form-control">
<button type="submit"  class="btn btn-success top_margin_20 pull-right" name="save" >SAVE</button>
</form>
</div>
</div>



<div class="row">
<div class="grey-line"></div>
<div class="col-md-12"><h2 class="centered_title">Send Notification</h2></div>
<div class="col-md-12"><div class="centered_line bottom_margin_20"></div></div>
<form method="post" id="notification-form" enctype="multipart/form-data" action="push_notification.php">
<div class="col-md-6 ">
<label for="notify-title">Title:</label>
<input type="text" id="notify-title" name="notify-title" class="form-control"/>
</div>

<div class="col-md-6">
<label for="notify-summary">Summary:</label>
<input type="text" id="notify-summary" name="notify-summary" class="form-control"/>
</div>
<div class="col-md-6">
<label for="notify-image">Image:</label>
<input type="file" id="notify-image" name="notify-image" class="form-control"/>
</div>
<div class="col-md-12">
<label for="notify-description">Description:</label>
<textarea type="text" id="notify-description" name="notify-description" class="form-control"></textarea>
</div>
<div class="col-md-12">
<button class="btn btn-warning pull-right top_margin_20" name="btnnotification">Send</button>
</div>
</form>
</div>

</div>


</div>
</div>

<script>
$('#table-tips').DataTable();

$('#btn-addtip').on('click',function(){
	<?php $action="add";?>
$('#view_tips').css('display','none');
$('#add_tip').css('display','block');	
});

$('#btn-back').on('click',function(){
	$('#add_tip').css('display','none');
	$('#view_tips').css('display','block');
	
	});


function Edit(id){
	action="edit";
	var array=[];
	document.cookie = "myJavascriptVar = " + id;
	  var $item =$("#row_"+id).find('td').each(function(){
			var textval=$(this).text();
			array.push(textval);
		  })
	$('#tip_id').val(id);
	$('#title').val(array[0]);
	$('#description').val(array[1]);
	$('#tip-image').attr('src',"images/uploads/tips/"+array[2]);
	$('#order').val(array[3]);
	//$('#order').val(array[4]);
	
	$('#view_tips').css('display','none');
	$('#add_tip').css('display','block');		

}

function Delete(id){


$.ajax({
	type:'POST',
	url:'assets/delete_tip.php',
	data:{id:id},
	success:function(response){
		alertify.alert(response);
		$('#row_'+id).remove();
		//location.reload();
		}
});
	
}





$('.image-upload').change(function(){
	var reader=new FileReader();
	reader.onload=function(e){
		$('#tip-image').attr('src',e.target.result);
		}
	reader.readAsDataURL($('.image-upload')[0].files[0]);
	});
</script>

<?php 
if(isset($_POST['save'])){
    
    extract($_POST);
    
    
    $response="";
    $imageName="";
    
    if(isset($_FILES['image'])){
        $uploaded=false;
        $supportedExtensions=array("jpg","jpeg","png");
        
        $file=$_FILES['image'];
        
        $array=explode('.' ,$file['name'] );
        $fileExt= end($array);
        
        if($file['size'] < 10000*1024 ){ //Checks the size of image if it is less than 10 MB
            
            
            if(in_array(  strtolower($fileExt),$supportedExtensions)){  //Checks if the file uploaded is a image
                
                $path="images/uploads/tips/";
                if(!is_dir($path)){   //Checks if directory exists
                    mkdir($path); //Make a new Directory
                }
                
                
                $tmp=$file['tmp_name'];  //When file is uploaded it is stored in a temporary directory for a temporary time
                $newName=time().".".$fileExt;
                
                
                
                if(move_uploaded_file($tmp, $path.$newName)){
                    $uploaded=true;
                    $imageName=$newName;
                }
                
                else{
                    $response= 'error Upload';
                    $uploaded=false;
                }
                
                
            }
            else{
                $reponse= "not supported image file";
                $uploaded=false;
            }
        }
        else{
            $uploaded=false;
            $response= "Size:".$file['size']."   Image is to big";
        }
    }
    
    //echo $uploaded;die();
    if($uploaded!=null && $uploaded==false){
        die("Error Uploading image, Error: ".$uploaded );
    }

    if($tip_id!=null){

        $query="update health_tips set tip_title='".$title."',tip_description='".$description."',tip_image='".$imageName."',tip_order=".$order;
        $query.=" WHERE tip_id=".$tip_id;
        echo "<script>alertify.alert('Tip has been edited');</script>";

    }
    else {
        $query="insert into health_tips(tip_title,tip_description,tip_image,tip_order,doctor_id) values ";
        $query.="('".$title."','".$description."','".$imageName."',".$order.",".$_SESSION['doc_id'].")";
        echo "<script>alertify.alert('Tip Added');</script>";
        
    }
    $insert=exec_query($query);
    if(!$insert){
        die("Error: ".$insert);
    }    
    

}

//print_r($_SESSION);

?>
<script>


</script>
</body>
</html>

