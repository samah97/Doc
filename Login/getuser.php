<?php
require_once ('../functions.php');
 
 if (isset($_REQUEST['id'])) {
   
 $id = intval($_REQUEST['id']);
 $query = "SELECT * FROM accounts WHERE id=".$id;
 $r=exec_query("uni",$query);
 $row=mysqli_fetch_array($r);
 
 
 ?>
   
 <div class="table-responsive">
  
 <table class="table table-striped table-bordered">
  <tr>
 <th>Username</th>
 <td><?php echo $row[1]; ?></td>
 </tr>
 <tr>
 <th>First Name</th>
 <td><?php echo $row[4]; ?></td>
 </tr>
 <tr>
 <th>Last Name</th>
 <td><?php echo $row[5]; ?></td>
 </tr>
 <tr>
 <th>Email ID</th>
 <td><?php echo $row[6]; ?></td>
 </tr>

 </table>
   
 </div>
   
 <?php    
}
else die("SOmething is w");