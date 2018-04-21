<?php
session_start();
//insert.php  
echo "Hello world";
$connect = mysqli_connect("localhost", "root", "", "testing");
if(!empty($_POST))
{
 $output = '';
 // $name = mysqli_real_escape_string($connect, $_POST["name"]);  
    // $address = mysqli_real_escape_string($connect, $_POST["address"]);  
    // $gender = mysqli_real_escape_string($connect, $_POST["gender"]);  
    // $designation = mysqli_real_escape_string($connect, $_POST["designation"]);  
    // $age = mysqli_real_escape_string($connect, $_POST["age"]);
	$date=mysqli_real_escape_string($connect,$_POST['lec_date']);
    $query = "
    INSERT INTO employee(course,teacher,date)  
     VALUES(11,".$_SESSION['id'].",".$date.")";
    if(mysqli_query($connect, $query))
    // {
     // $output .= '<label class="text-success">Data Inserted</label>';
     // $select_query = "SELECT * FROM employee ORDER BY id DESC";
     // $result = mysqli_query($connect, $select_query);
     // $output .= '
      // <table class="table table-bordered">  
                    // <tr>  
                         // <th width="70%">Employee Name</th>  
                         // <th width="30%">View</th>  
                    // </tr>

     // ';
     // while($row = mysqli_fetch_array($result))
     // {
      // $output .= '
       // <tr>  
                         // <td>' . $row["name"] . '</td>  
                         // <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                    // </tr>
      // ';
     // }
     // $output .= '</table>';
    // }
    // echo $output;
	//header("location:teacher.php?action=course&cid=11");
}
?>