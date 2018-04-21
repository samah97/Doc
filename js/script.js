function search(type,str,id) {

  if (str.length==0) { 
    document.getElementById(id).innerHTML="";
    document.getElementById(id).style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
		
      document.getElementById(id).innerHTML=this.responseText;
      document.getElementById(id).style.border="1px solid #A5ACB2";
    }
  }
  if(type=="name"){
  	$("#srchN").show();
  xmlhttp.open("GET","srch.php?t=name&q="+str,true);}
  else{
  $("#srchP").show();
  xmlhttp.open("GET","srch.php?t=phone&q="+str,true);}		
  xmlhttp.send();
}

function GetMed(str){
	
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
		
      document.getElementById("med_names").innerHTML=this.responseText;
      document.getElementById("med_names").style.border="1px solid #A5ACB2";
    }
  }
  
  xmlhttp.open("GET","get_med.php?q="+str,true);
  xmlhttp.send();
		
}

 function printf(){
	 //window.frames["printf"].focus();
	 //window.frames["printf"].print();
	window.print();
 }



