<?php
$modversion['name']                          = _DATA_MODULE_NAME;
$modversion['version']                       = "1";
$modversion['description']                   = _DATA_MODULE_DESC;
$modversion['author']                        = "Sasa Svobodova (Zirafka)";
$modversion['credits']                       = "www.zirafoviny.cz";
$modversion['help']                          = "no";
$modversion['license']                       = "GNU GPL";
$modversion['official']                      = "no";
$modversion['image']                         = "images/logo.gif";
$modversion['dirname']                       = "datasheet";

// Main menu / Hlavni menu
$modversion['hasMain']                       = 1;

// Administration / Administrace
$modversion['hasAdmin']                      = 1;
$modversion['adminindex']                    = "admin/index.php";
$modversion['adminmenu']                     = "admin/menu.php";

// Database
$modversion['sqlfile']['mysql']              = "sql/mysql.sql";
$modversion['tables'][0]                     = "datasheet";

// Xoops Templates / Sablony
$modversion['templates'][1]['file']          = 'data_index.html';
$modversion['templates'][1]['description']   = '';

// XOOPS Search / Hledani
$modversion['hasSearch']                     = 0;

// Xoops Notifications / Upozorneni
$modversion['hasNotification']               = 0;

// Preferences / Predvolby

$i=1;
$modversion['config'][$i]['name']            = 'pref_index_header';
$modversion['config'][$i]['title']           = '_DATA_PREF_HEADER';
$modversion['config'][$i]['description']     = '_DATA_PREF_HEADER_DESC';
$modversion['config'][$i]['formtype']        = 'textbox';
$modversion['config'][$i]['valuetype']       = 'text';
$modversion['config'][$i]['default']         = _DATA_PREF_HEADER_DEF;
$i++;
$modversion['config'][$i]['name']            = 'pref_index_intro';
$modversion['config'][$i]['title']           = '_DATA_PREF_INTRO';
$modversion['config'][$i]['description']     = '_DATA_PREF_INTRO_DESC';
$modversion['config'][$i]['formtype']        = 'textarea';
$modversion['config'][$i]['valuetype']       = 'text';
$modversion['config'][$i]['default']         = _DATA_PREF_INTRO_DEF;
$i++;
$modversion['config'][$i]['name']            = 'pref_index_footer';
$modversion['config'][$i]['title']           = '_DATA_PREF_FOOTER';
$modversion['config'][$i]['description']     = '_DATA_PREF_FOOTER_DESC';
$modversion['config'][$i]['formtype']        = 'textarea';
$modversion['config'][$i]['valuetype']       = 'text';
$modversion['config'][$i]['default']         = _DATA_PREF_FOOTER_DEF;
$i++;
$modversion['config'][$i]['name']            = 'pref_show_footer';
$modversion['config'][$i]['title']           = '_DATA_PREF_SFOOTER';
$modversion['config'][$i]['description']     = '_DATA_PREF_SFOOTER_DESC';
$modversion['config'][$i]['formtype']        = 'yesno';
$modversion['config'][$i]['valuetype']       = 'int';
$modversion['config'][$i]['default']         = 1;
$i++;
$modversion['config'][$i]['name']            = 'pref_path';
$modversion['config'][$i]['title']           = '_DATA_PREF_PATH';
$modversion['config'][$i]['description']     = '_DATA_PREF_PATH_DESC';
$modversion['config'][$i]['formtype']        = 'textbox';
$modversion['config'][$i]['valuetype']       = 'text';
$modversion['config'][$i]['default']         = '';
$i++;
$modversion['config'][$i]['name']            = 'pref_link_title';
$modversion['config'][$i]['title']           = '_DATA_PREF_TITLE';
$modversion['config'][$i]['description']     = '_DATA_PREF_TITLE_DESC';
$modversion['config'][$i]['formtype']        = 'textbox';
$modversion['config'][$i]['valuetype']       = 'text';
$modversion['config'][$i]['default']         = _DATA_PREF_TITLE_DEF;

?>