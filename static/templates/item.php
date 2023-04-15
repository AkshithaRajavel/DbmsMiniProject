<?php
echo "<div class='card col-lg-5 m-3 position-static'>
    <div class='card-img-top'>
    <img class='img-thumbnail' src=$image ></div>
    <div class='card-body'>";
if(!$admin||$_SERVER['REQUEST_URI']=='/'){
echo "
<h5 class='card-title'> $title </h5>
<p class='card-text'>$description</p>
<h5>FEE : $fee</h5>";}
else{
echo "
<form action='/api/update' method=post>
<input value='$type' name='type' hidden>
<input value='$title'name='old_title' hidden>
<h5 class='card-title'> TITLE</h5>
<input value='$title'name='title'>
<h5>IMAGE_LINK</h5>
<textarea class='form-control' rows='2' name='image'>$image</textarea>
<h5>DESCRIPTION</h5>
<textarea class='form-control' rows='5' name='description'>$description</textarea>
<h5>FEE : </h5><input type=number value=$fee name='fee'><br>
";
}
if($_SERVER['REQUEST_URI']=='/' && !$admin){
  if($LoggedIn){
    if($added) echo "<button>Added</button>";
    else echo "<button class='btn' onclick='add(\"$type\",\"$title\")'}>Add</button>";}
}
if($_SERVER['REQUEST_URI']=='/dashboard'){
  echo "<button class='btn' onclick='del(\"$type\",\"$title\")'}>Delete</button>";
}
if($_SERVER['REQUEST_URI']=='/dashboard' && $admin){
  echo "<button class='btn' type=submit >Update</button>";
}
echo "</form></div></div>";
?>