<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_trees_trunk1"] = Array (
	"ctrl" => $TCA["tx_trees_trunk1"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,title"
	),
	"feInterface" => $TCA["tx_trees_trunk1"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.xml:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"parentid" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_trunk1.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_trunk1.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"title" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_trunk1.title",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "required",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, parentid, parenttable, title;;;;2-2-2")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_trees_trunk2"] = Array (
	"ctrl" => $TCA["tx_trees_trunk2"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,title"
	),
	"feInterface" => $TCA["tx_trees_trunk2"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.xml:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"parentid" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_trunk2.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_trunk2.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"title" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_trunk2.title",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, parentid, parenttable, title;;;;2-2-2")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_trees_leaf1"] = Array (
	"ctrl" => $TCA["tx_trees_leaf1"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,header"
	),
	"feInterface" => $TCA["tx_trees_leaf1"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.xml:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"parentid" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_leaf1.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_leaf1.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"header" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_leaf1.header",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, parentid, parenttable, header")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_trees_leaf2"] = Array (
	"ctrl" => $TCA["tx_trees_leaf2"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,header"
	),
	"feInterface" => $TCA["tx_trees_leaf2"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.xml:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"parentid" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_leaf2.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_leaf2.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"header" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_leaf2.header",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, parentid, parenttable, header")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);


$TCA["tx_trees_mounts"] = Array (
    "ctrl" => $TCA["tx_trees_mounts"]["ctrl"],
    "interface" => Array (
        "showRecordFieldList" => "mountpoint"
    ),
    "feInterface" => $TCA["tx_trees_mounts"]["feInterface"],
    "columns" => Array (
        "mountpoint" => Array (        
            "exclude" => 0,        
            "label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_mounts.mountpoint",        
            "config" => Array (
                "type" => "group",    
                "internal_type" => "db",    
                "allowed" => "*", 
        		'prepend_tname' => 1,
                "size" => 1,    
                "minitems" => 0,
                "maxitems" => 1,
            )
        ),
    ),
    "types" => Array (
        "0" => Array("showitem" => "title;;;;2-2-2, type;;;;3-3-3, mountpoint")
    ),
    "palettes" => Array (
        "1" => Array("showitem" => "")
    )
);
?>