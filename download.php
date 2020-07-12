<?php

require_once("../../mainfile.php");
//include(XOOPS_ROOT_PATH."/header.php");

if (isset($_GET["req"])){

   $file=  $_GET["req"];

   $dfile=  $xoopsModuleConfig['pref_path']."/". $_GET["req"];

   header('Content-type: application/pdf');

   header('Content-Disposition: attachment; filename="'.$file.'"');

   readfile($dfile);

 	 $sql = "UPDATE " . $xoopsDB -> prefix('datasheet') . " SET  d_count = d_count+1 WHERE d_file='".$file."' ";
   $result = $xoopsDB -> queryF($sql);


echo $sql;

   
} else {
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
}

?>