<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax Add/Delete a Record with jQuery Fade In/Fade Out</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type="text/javascript" src="custom.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="content_wrapper">
	 <div class="form_style">
		<textarea name="content_txt" id="contentText" cols="45" rows="5" placeholder="Enter some text"></textarea>
		<button id="FormSubmit">Add record</button>
		<img src="images/loading.gif" id="LoadingImage" style="display:none" />
    </div>
	
	<div class="clearfix"></div>
	

<ul id="responds">
<?php
//include db configuration file
include_once("config.php");

//MySQL query
$results = $mysqli->query("SELECT id,content FROM add_delete_record");
//get all records from add_delete_record table
while($row = $results->fetch_assoc())
{
	
  $rand	= rand(1,8);
  echo '<li id="item_'.$row["id"].'" class="item_'.$rand.'">';
  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$row["id"].'">';
  echo '<img src="images/icon_del.gif" border="0" />';
  echo '</a></div>';
  echo '<textarea class="text_area" id="text_'.$row["id"].'">'.$row["content"].'</textarea>';
  echo '<div class="update_submit" id="update-'.$row["id"].'">Submit</div>';
  echo '</li>';
}

//close db connection
$mysqli->close();
?>
</ul>
   
</div>

</body>
</html>
