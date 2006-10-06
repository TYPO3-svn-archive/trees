<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_trees_examples_regions"] = Array (
	"ctrl" => $TCA["tx_trees_examples_regions"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,title"
	),
	"feInterface" => $TCA["tx_trees_examples_regions"]["feInterface"],
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
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_regions.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_regions.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"title" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_regions.title",		
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



$TCA["tx_trees_examples_entities"] = Array (
	"ctrl" => $TCA["tx_trees_examples_entities"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,title"
	),
	"feInterface" => $TCA["tx_trees_examples_entities"]["feInterface"],
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
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_entities.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_entities.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"title" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_entities.title",		
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



$TCA["tx_trees_examples_produtcs"] = Array (
	"ctrl" => $TCA["tx_trees_examples_produtcs"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,header"
	),
	"feInterface" => $TCA["tx_trees_examples_produtcs"]["feInterface"],
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
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_produtcs.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_produtcs.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"header" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_produtcs.header",		
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



$TCA["tx_trees_examples_buildings"] = Array (
	"ctrl" => $TCA["tx_trees_examples_buildings"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,parentid,parenttable,header"
	),
	"feInterface" => $TCA["tx_trees_examples_buildings"]["feInterface"],
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
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_buildings.parentid",		
			"config" => Array (
				"type" => "none",
			)
		),
		"parenttable" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_buildings.parenttable",		
			"config" => Array (
				"type" => "none",
			)
		),
		"header" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:trees/locallang_db.xml:tx_trees_examples_buildings.header",		
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