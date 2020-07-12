<?php

// -----------------[ File header and system resources ]------------------------
// -----------------[ Hlavicka sousobru a systemove prostredky ] ---------------

// vypis
// name - jmeno souboru
// title - popiska odkazu (Atribut title)
// desc - popis souboru
// request - pozadovany soubor, jeho presny nazev vcetne pripony
// size - velikost souboru
// units - jednotky velikosti
// extension - pripona souboru
// count - ukazatel, pouziva se pro interni potrebu sablony (vypis pole)

require_once("../../mainfile.php");
global $xoopsTpl;
$xoopsOption['template_main'] = 'data_index.html';
include(XOOPS_ROOT_PATH."/header.php");

$myts =& MyTextSanitizer::getInstance();

$text = $myts->displayTarea($xoopsModuleConfig['pref_index_header'], 0,1,1,0,1);
$xoopsTpl->assign('data_header', $text);
$text = $myts->displayTarea($xoopsModuleConfig['pref_index_intro'], 1,1,1,0,1);
$xoopsTpl->assign('data_intro', $text);

if ($xoopsModuleConfig['pref_show_footer']==1 )
{
  $text = $myts->displayTarea($xoopsModuleConfig['pref_index_footer'], 1,1,1,0,1);
  $xoopsTpl->assign('data_footer', $text);
}

$sql = "SELECT * FROM ".$xoopsDB -> prefix('datasheet');
$result = $xoopsDB -> query($sql);

$size="0";
$units="kB";

while ($myrow=mysql_fetch_array($result))
  {
  
   $filename=  $xoopsModuleConfig['pref_path']."/". $myrow['d_file'];           // Kompletnni cesta k souboru / complet file path

   if (file_exists($filename)) {                                                // Existuje? Ano, tak zjistim velikost / Exist? If Yes, then check file size
    $size=round( (filesize($filename)/1024),0 );
    $path_parts = pathinfo($filename);                                          // zjistim jeho priponu / check extension of file
    $extension= strtoupper($path_parts['extension']);
    } 
   
   if ($size>1023) { $size=round($size/1024,2); $units="MB";}                   // kB MB ???
   
	 $xoopsTpl->append('vypis', array( 'name' => $myrow['d_name'], 'title' => $xoopsModuleConfig['pref_link_title'], 'desc' => $myrow['d_desc'], 'request' => $myrow['d_file'], 'size' => $size, 'units' => $units, 'extension' => $extension, 'count' => $count));
   $count++;
	}


if ( is_object($xoopsUser) && $xoopsUser->isAdmin())
	{
	$xoopsTpl->assign('data_a_footer', "<a href='./admin/index.php'>"._DATA_ADMINISTRATION."</a>");       // link if user is admin / Pokud jsem ADMIN, tak zobrazim odkaz
	}


include(XOOPS_ROOT_PATH."/footer.php");                                         // system footer / vlozeni paticky stranky
?>