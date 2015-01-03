<!DOCTYPE html>
<html>
<head>
    <!-- remove the css to fit with your theme-->
<style>
  body {background-color:lightgray}
  h1   {color:blue}
  p    {color:green}
  #imageArea  {width:100%; margin:auto; display:block;}    
  img {display:block;margin:auto;}    
  #imgs {margin: auto;width: 400px;height: 40px;font-size: 25px;text-align: center;display: block;text-indent: 15px;color:goldenrod;}
</style>

<?php
    /*
        Display all files that are in a directory 
        put them in a dropdown list when they are selected
        display the image.
        
        Addning array to convert file names to display name 
        should be easy enough

    */

    //Define the path to the images you want to display.


    $file_path = "img";
    
    //Ignore list. 
    $ignore_list = array (".","..");
?>
<script>
    
function displayIMG() {
    var path = <?php echo json_encode($file_path);?>;
    var x = document.getElementById("imgs").value;
    if (x != ""){
        document.getElementById("imageArea").innerHTML = "<img src='"+path+"/"+x+"' />";
    }
}
</script>
</head>
<body>
<?
    /*
        Function:   getFiles
        Args:       string $dir directory to search for files
                    array $ignore array of files to ignore
        Return:     array $files an array of the files returned
                    null on empty directory / invalid path / or all files ignored
    */

    function getFiles($dir,$ignore){
        $files = NULL;
        if($dh  = opendir($dir)){
            while (false !== ($filename = readdir($dh))) {
                if(!in_array($filename,$ignore)){
                    $files[] = $filename;
                }
            }
            return $files;
        }else return NULL;
    }
    
    if($file_list = getFiles($file_path,$ignore_list)){
?>
    
    
<select id="imgs" onchange="displayIMG()">
    <option value="">-----------------</option>

    <?php
        foreach($file_list as $value){
            $fsplit = explode(".",$value);
            $display_name = $fsplit[0];
            echo '<option value="'.$value.'">'.$display_name.'</option>'; //close your tags!!
        }
    ?>
</select>
<?    
    }else Echo "Sorry the directory was empty";
?>

<div id="imageArea"> </div>
</body>
</html>
