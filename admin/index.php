<?php

// -----------------[ File header and system resources ]------------------------
// -----------------[ Hlavicka sousobru a systemove prostredky ] ---------------

include 'header.php';

// -[ Request without parameter or with bad parameter ]-------------------------
// -[ Prichod na stranku bez parametru nebo se spatnym parametrem ]-------------

if (!isset($_GET["op"]) || (isset($_GET["op"]) && $_GET["op"]!="new_file" && $_GET["op"]!="delete_file" && $_GET["op"]!="change_file" ))
{
 global $xoopsModule;

   if (isset($_POST['form_op']))    																						// Save to database / ulozeni dat do databaze
   {
			if ($_POST["form_op"]=="new_file")
			{

    	 	 $sql = "INSERT INTO " . $xoopsDB -> prefix('datasheet') . " SET  d_name=\"".$_POST['form_name']."\", d_file=\"".$_POST['form_file']."\", d_desc= \"".$_POST['form_desc']."\", d_date= \"".time()."\"  ";
				 $result = $xoopsDB -> query($sql);
     }

			if ($_POST["form_op"]=="delete_file")
			{

    	 	 $sql = "DELETE FROM " . $xoopsDB -> prefix('datasheet') . " WHERE id = \"".$_POST['form_id']."\" ";
				 $result = $xoopsDB -> query($sql);
     }

			if ($_POST["form_op"]=="change_file")
			{

    	 	 $sql = "UPDATE " . $xoopsDB -> prefix('datasheet') . " SET  d_name=\"".$_POST['form_name']."\", d_file=\"".$_POST['form_file']."\", d_desc= \"".$_POST['form_desc']."\", d_date= \"".time()."\" WHERE id=\" ".$_POST['form_id']."\" ";
				 $result = $xoopsDB -> query($sql);
     }


      if ( isset($result) && ($result==1))
      {
         redirect_header('index.php', 3, _DATA_ADMIN_AKTUAL_OK);                // Save to database OK / Aktualizace DB dopadla dobre
      } else
      {
         redirect_header('index.php', 3, _DATA_ADMIN_AKTUAL_KO);                // Sava to database KO / Aktualizace DB nedopadla dobre
      }
				 

	}
	
xoops_cp_header();                                                              // sytem header / systemova hlavicka
data_adminmenu(0);                                                              // nice style header / hlavicka s "peknymi" tlacitky

//	$krok = $xoopsModuleConfig['krok_admin'];
$krok = 10;

	if (isset($_GET["limit"])) { $limit = $_GET["limit"]; }
	else { $limit=0; }

	$sql = "SELECT * FROM ".$xoopsDB -> prefix('datasheet');                      // Zjisteni celkoveho poctu zaznamu
  $result = $xoopsDB -> query($sql);
	$celkem = mysql_num_rows($result);	                  												// Krok vypisu / step of list

	$sql = "SELECT * FROM ".$xoopsDB -> prefix('datasheet')." ORDER BY id DESC LIMIT ".$limit." ,".$krok." "; // Postupne vypisovani
  $result = $xoopsDB -> query($sql);

	echo "<table border='1' rules='all' width = '100%'>";

	echo "<tr><th>"._DATA_ADMIN_ID."</th><th>"._DATA_ADMIN_FILE_NAME."</ht><th>"._DATA_ADMIN_FILE_DESC."</th><th>"._DATA_ADMIN_DESCRIPTION."</th><th>"._DATA_ADMIN_DOWNLOADS."</th><th>"._DATA_ADMIN_ACTION."</th></tr>";

	if (mysql_num_rows($result)> 0)
	{

		while ($myrow=mysql_fetch_array($result))
		{
			echo "<tr valign='top' ><td align='center'><b>".$myrow['id']."</b></td><td><b>".$myrow['d_file']." </b></td><td><b>".$myrow['d_name']." </b></td><td>" . $myrow['d_desc']."</td><td align='right'>".$myrow['d_count']."</td> <td align='center'> <a href='".$_SERVER['PHP_SELF']."?op=change_file&id=".$myrow['id']."'><img src='../images/edit.png' title='"._DATA_ADMIN_CHANGE."'></a> <a href='".$_SERVER['PHP_SELF']."?op=delete_file&id=".$myrow['id']."'><img src='../images/delete.png' title='"._DATA_ADMIN_DELETE."'> </a></td></tr>";
		}

	}
	else                                                                          // Prazdna databaze / empty database
	{
	 	 echo "<tr valign='top' ><td align='center' colspan='4'><b>"._DATA_ADMIN_EMPTY_DB."</b></td></tr>";
	}

	 echo "</table>";

			if ((mysql_num_rows($result) == $krok)  &&  (($limit + $krok) != $celkem) ) // Dokud nejsem na konci, zobrazuji sipku DALSI
			{
				 	 	$prava = "<a href='index.php?co=uprav&limit=".($limit+$krok)."'  > >>>>> </a>";
			}

			if ( $limit > 0 )                     																		// Dokud nejsem na zacatku, zobrazuji sipku NOVEJSI
			{
				 	 	$leva = "<a href='index.php?co=uprav&limit=".($limit-$krok)."'  > <<<<<< </a>";
			}

		if ( ($limit+$krok) > $celkem )
		{
			$ciselnik = ($limit+1)." - ". $celkem. " / " .$celkem;
		}
		else
		{
			$ciselnik = ($limit+1)." - ". ($limit+$krok). " / " .$celkem;
		}

	echo "<br><table border=0><tr align='center'><td width=20%>". $leva."</td><td width=60%><b>".$ciselnik."</b></td><td width=20%>".$prava."</td></tr></table>";

data_adminfooter();
xoops_cp_footer();
}

// --[ New item ]---------------------------------------------------------------
// --[ Novy zaznam do databaze ]------------------------------------------------

if (isset($_GET["op"]) && ($_GET["op"]=="new_file" ))
{
   global $xoopsModule;
   xoops_cp_header();
   data_adminmenu(1);

   $formular = new XoopsThemeForm(_DATA_ADMIN_NEW_FILE_H, 'formular', 'index.php');
   $formular->setExtra('enctype="multipart/form-data"');

   $formular->addElement(new XoopsFormText(_DATA_ADMIN_FILE, 'form_file', 50, 255, ""), true);
   $formular->addElement(new XoopsFormText(_DATA_ADMIN_NAME, 'form_name', 50, 255, "" ), true);
   $formular->addElement(new XoopsFormText(_DATA_ADMIN_DESC, 'form_desc', 50, 255, ""), true);

   $formular->addElement(new XoopsFormHidden('form_op', 'new_file'), false);
   $formular->addElement(new XoopsFormButton('', 'save', _DATA_ADMIN_SAVE, 'submit'));

   $formular->display();

   data_adminfooter();
   xoops_cp_footer();
}
// -----------------------------------------------------------------------------


// --[ Change item ]------------------------------------------------------------
// --[ Zmena zaznamu ]----------------------------------------------------------

if (isset($_GET["op"]) && ($_GET["op"]=="change_file" ))
{
   global $xoopsModule;
   xoops_cp_header();
   data_adminmenu(99);

   $sql = "SELECT * FROM " . $xoopsDB -> prefix('datasheet') . " WHERE id=".$_GET["id"]." ";
   $result = $xoopsDB -> query($sql);
   $myrow = $xoopsDB->fetchArray($result);


   $formular = new XoopsThemeForm(_DATA_ADMIN_CHANGE_FILE_H, 'formular', 'index.php');
   $formular->setExtra('enctype="multipart/form-data"');

   $formular->addElement(new XoopsFormText(_DATA_ADMIN_FILE, 'form_file', 50, 255, $myrow['d_file']), true);
   $formular->addElement(new XoopsFormText(_DATA_ADMIN_NAME, 'form_name', 50, 255, $myrow['d_name'] ), true);
   $formular->addElement(new XoopsFormText(_DATA_ADMIN_DESC, 'form_desc', 50, 255, $myrow['d_desc']), true);

   $formular->addElement(new XoopsFormHidden('form_op', 'change_file'), false);
   $formular->addElement(new XoopsFormHidden('form_id', $_GET["id"]), false);
   $formular->addElement(new XoopsFormButton('', 'save', _DATA_ADMIN_SAVE, 'submit'));

   $formular->display();

   data_adminfooter();
   xoops_cp_footer();
}
// -----------------------------------------------------------------------------

// --[ Delete item ]------------------------------------------------------------
// --[ Smazani zaznamu ]--------------------------------------------------------

if (isset($_GET["op"]) && ($_GET["op"]=="delete_file" ))
{
   global $xoopsModule;
   xoops_cp_header();
   data_adminmenu(99);

   $sql = "SELECT * FROM " . $xoopsDB -> prefix('datasheet') . " WHERE id=".$_GET["id"]." ";
   $result = $xoopsDB -> query($sql);
   $myrow = $xoopsDB->fetchArray($result);

   echo "<fieldset>";
   echo "<legend style=\"color: #990000; font-weight: bold;\">"._DATA_ADMIN_CONFIRM."</legend>";
   echo "<p align='center'<b>"._DATA_ADMIN_SURE."</b> </p>";
   echo "<center>";
   echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
   echo "<input type='hidden' name='form_op' value='delete_file'>";
   echo "<input type='hidden' name='form_id' value='".$_GET["id"]."'>";
   echo "<input type='submit' value='"._DATA_ADMIN_YES."'>";
   echo "</form>";
   echo "</center>";
   echo "</fieldset>";

   data_adminfooter();
   xoops_cp_footer();
}
// -----------------------------------------------------------------------------

?>