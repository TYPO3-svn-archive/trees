<?php
if (!defined ('TYPO3_MODE'))     die ('Access denied.');

//------------------------------------------------------------------------------------- 
// Regularly used classes
//------------------------------------------------------------------------------------- 

require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_div.php');

//------------------------------------------------------------------------------------- 
// Tutor Module
//------------------------------------------------------------------------------------- 

if (TYPO3_MODE=="BE")	{	
	t3lib_extMgm::addModule('help','txtreesTreesDemo','',t3lib_extMgm::extPath($_EXTKEY) . 'treesDemoModule');
}

//------------------------------------------------------------------------------------- 
// Tree Mounts for BE users and BE groups
//------------------------------------------------------------------------------------- 

$TCA["tx_trees_mounts"] = Array (
    "ctrl" => Array (
        'title' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_mounts',        
        'label' => 'mountpoint',
		'label_alt'  =>  'uid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'rootLevel' => '1',
        "default_sortby" => "ORDER BY mountpoint",    
        "delete" => "deleted",    
        "dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
        "iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_trees_mounts.gif",
    ),
    "feInterface" => Array (
        "fe_admin_fieldList" => "mountpoint",
    )
);

$tempColumns = Array (
    "tx_trees_mounts" => Array (        
        "exclude" => 0,        
        "label" => "LLL:EXT:trees/locallang_db.xml:be_groups.tx_trees_mounts",        
        "config" => Array (
            "type" => "select",    
            "foreign_table" => "tx_trees_mounts",    
            "foreign_table_where" => "ORDER BY tx_trees_mounts.mountpoint",    
            "size" => 8,    
            "minitems" => 0,
            "maxitems" => 99,    
            "MM" => "be_groups_tx_trees_mounts_mm",    
            "wizards" => Array(
                "_PADDING" => 2,
                "_VERTICAL" => 1,
                "add" => Array(
                    "type" => "script",
                    "title" => "Create new record",
                    "icon" => "add.gif",
                    "params" => Array(
                        "table"=>"tx_trees_mounts",
                        "pid" => "0",
                        "setValue" => "prepend"
                    ),
                    "script" => "wizard_add.php",
                ),
                "list" => Array(
                    "type" => "script",
                    "title" => "List",
                    "icon" => "list.gif",
                    "params" => Array(
                        "table"=>"tx_trees_mounts",
                        "pid" => "0",
                    ),
                    "script" => "wizard_list.php",
                ),
                "edit" => Array(
                    "type" => "popup",
                    "title" => "Edit",
                    "script" => "wizard_edit.php",
                    "popup_onlyOpenIfSelected" => 1,
                    "icon" => "edit2.gif",
                    "JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
                ),
            ),
        )
    ),
);


t3lib_div::loadTCA("be_groups");
t3lib_extMgm::addTCAcolumns("be_groups",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("be_groups","tx_trees_mounts;;;;1-1-1");

$tempColumns = Array (
    "tx_trees_mounts" => Array (        
        "exclude" => 0,        
        "label" => "LLL:EXT:trees/locallang_db.xml:be_users.tx_trees_mounts",        
        "config" => Array (
            "type" => "select",    
            "foreign_table" => "tx_trees_mounts",    
            "foreign_table_where" => "ORDER BY tx_trees_mounts.mountpoint",    
            "size" => 8,    
            "minitems" => 0,
            "maxitems" => 99,    
            "MM" => "be_users_tx_trees_mounts_mm",    
            "wizards" => Array(
                "_PADDING" => 2,
                "_VERTICAL" => 1,
                "add" => Array(
                    "type" => "script",
                    "title" => "Create new record",
                    "icon" => "add.gif",
                    "params" => Array(
                        "table"=>"tx_trees_mounts",
                        "pid" => "0",
                        "setValue" => "prepend"
                    ),
                    "script" => "wizard_add.php",
                ),
                "list" => Array(
                    "type" => "script",
                    "title" => "List",
                    "icon" => "list.gif",
                    "params" => Array(
                        "table"=>"tx_trees_mounts",
                        "pid" => "0",
                    ),
                    "script" => "wizard_list.php",
                ),
                "edit" => Array(
                    "type" => "popup",
                    "title" => "Edit",
                    "script" => "wizard_edit.php",
                    "popup_onlyOpenIfSelected" => 1,
                    "icon" => "edit2.gif",
                    "JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
                ),
            ),
        )
    ),
);


t3lib_div::loadTCA("be_users");
t3lib_extMgm::addTCAcolumns("be_users",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("be_users","tx_trees_mounts;;;;1-1-1");


//------------------------------------------------------------------------------------- 
// Tables for the examples
//------------------------------------------------------------------------------------- 

$TCA["tx_trees_trunk1"] = Array (
    "ctrl" => Array (
        'title' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_trunk1',        
        'label' => 'title',    
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        "default_sortby" => "ORDER BY crdate",    
        "delete" => "deleted",    
        "enablecolumns" => Array (        
            "disabled" => "hidden",
        ),
        "dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
        "iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_trees_trunk1.gif",
    ),
    "feInterface" => Array (
        "fe_admin_fieldList" => "hidden, parentid, parenttable, title",
    )
);

$TCA["tx_trees_trunk2"] = Array (
    "ctrl" => Array (
        'title' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_trunk2',        
        'label' => 'title',    
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        "default_sortby" => "ORDER BY crdate",    
        "delete" => "deleted",    
        "enablecolumns" => Array (        
            "disabled" => "hidden",
        ),
        "dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
        "iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_trees_trunk2.gif",
    ),
    "feInterface" => Array (
        "fe_admin_fieldList" => "hidden, parentid, parenttable, title",
    )
);

$TCA["tx_trees_leaf1"] = Array (
    "ctrl" => Array (
        'title' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_leaf1',        
        'label' => 'uid',    
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'type' => 'header',    
        "default_sortby" => "ORDER BY crdate",    
        "delete" => "deleted",    
        "enablecolumns" => Array (        
            "disabled" => "hidden",
        ),
        "dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
        "iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_trees_leaf1.gif",
    ),
    "feInterface" => Array (
        "fe_admin_fieldList" => "hidden, parentid, parenttable, header",
    )
);

$TCA["tx_trees_leaf2"] = Array (
    "ctrl" => Array (
        'title' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_leaf2',        
        'label' => 'header',    
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        "default_sortby" => "ORDER BY crdate",    
        "delete" => "deleted",    
        "enablecolumns" => Array (        
            "disabled" => "hidden",
        ),
        "dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
        "iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_trees_leaf2.gif",
    ),
    "feInterface" => Array (
        "fe_admin_fieldList" => "hidden, parentid, parenttable, header",
    )
);


?>