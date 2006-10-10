<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

//------------------------------------------------------------------------------------- 
// Tree Mounts for BE users and BE groups
//------------------------------------------------------------------------------------- 

$TCA['tx_trees_mounts'] = Array (
    'ctrl' => $TCA['tx_trees_mounts']['ctrl'],
    'interface' => Array (
        'showRecordFieldList' => 'mountpoint'
    ),
    'feInterface' => $TCA['tx_trees_mounts']['feInterface'],
    'columns' => Array (
        'mountpoint' => Array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_mounts.mountpoint',        
            'config' => Array (
                'type' => 'group',    
                'internal_type' => 'db',    
                'allowed' => '*', 
        		'prepend_tname' => 1,
                'size' => 1,    
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
    ),
    'types' => Array (
        '0' => Array('showitem' => 'title;;;;2-2-2, type;;;;3-3-3, mountpoint')
    ),
    'palettes' => Array (
        '1' => Array('showitem' => '')
    )
);


//------------------------------------------------------------------------------------- 
// Tables for the examples
//------------------------------------------------------------------------------------- 

$TCA['tx_trees_examples'] = Array (
    'ctrl' => $TCA['tx_trees_examples']['ctrl'],
    'interface' => Array (
        'showRecordFieldList' => 'singleselect, pagesingleselect, multiselect, pagemultiselect'
    ),
    'feInterface' => $TCA['tx_trees_examples']['feInterface'],
    'columns' => Array (
		'title' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
        'singleselect' => Array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples.singleselect',        
            'config' => Array (
                'type' => 'select',
                'items' => Array (
                    Array('LLL:EXT:trees/locallang_db.xml:noSelection', ''),
                ),
                'itemsProcFunc' => 'tx_trees->selectFunction',
                'parameters' => array(
			                'allowedTables' => '*',    
							'rootId' => 0,
							'rootNodeType' => '',                	
							'nodeType' => 'tx_trees_examples_regions',
							'idField' => 'uid',
							'parentTable' => '',
							'parentIdField' => 'parentid',
							'parentTableField' => 'parenttable',
							'fields' => 'title',
							'orderBy' => 'title',
							'titleField' => 'title',
							'additionalTablesOverwrite' => array(
								0 => array(
									'nodeType' => 'tx_trees_examples_entities',
									'fields' => 'title',														
									'titleField' => 'title',
									'style' => 'color:darkblue;',
									'orderBy' => 'title',
									'rowClassAttribute' => 'entity',
								),
							),
                ),
                'size' => 1,    
                'maxitems' => 1,
            )
        ),
        'pagesingleselect' => Array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples.pagesingleselect',        
            'config' => Array (
                'type' => 'select',
                'items' => Array (
                    Array('LLL:EXT:trees/locallang_db.xml:noSelection', ''),
                ),
                'itemsProcFunc' => 'tx_trees->selectFunction',
                'parameters' => array(
			                'allowedTables' => '*',    
							'nodeType' => 'pages',	
                ),
                'size' => 1,    
                'maxitems' => 1,
            )
        ),
		'pagemultiselect' => Array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples.pagemultiselect',        
            'config' => Array (
                'type' => 'group',    
                'internal_type' => 'db',    
                'allowed' => 'pages',    
                'size' => 20,    
                'minitems' => 0,
                'maxitems' => 99,    
                'MM' => 'tx_trees_examples_pagemultiselect_mm',
				'prepend_tname' => 1,
				'wizards' => array(
					'_POSITION' => 'left',
					'_VALIGN' => top,
					'select' => array(
						'type' => 'userFunc',
						'userFunc' => 'tx_trees->groupWizard',
						'parameters' => array(
			                'allowedTables' => 'pages',    
							'nodeType' => 'pages',
			                'inputSize' => 20,
						),						
					),
				),
			),
		),
		'multiselect' => Array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples.multiselect',        
            'config' => Array (
                'type' => 'group',    
                'internal_type' => 'db',    
                'allowed' => '*',    
                'size' => 20,    
                'minitems' => 0,
                'maxitems' => 99,    
                'MM' => 'tx_trees_examples_multiselect_mm',
				'prepend_tname' => 1,
//				'MM_foreign_select' =>1,
				'wizards' => array(
					'_POSITION' => 'left',
					'_VALIGN' => top,
					'select' => array(
						'type' => 'userFunc',
						'userFunc' => 'tx_trees->groupWizard',
						'parameters' => array(
			                'allowedTables' => '*',    
			                'inputSize' => 20,
							'rootId' => 0,
							'rootNodeType' => '',
							'nodeType' => 'tx_trees_examples_regions',
							'idField' => 'uid',
							'parentTable' => '',
							'parentIdField' => 'parentid',
							'parentTableField' => 'parenttable',
							'fields' => 'title',
							'titleField' => 'title',
							'orderBy' => 'title',
							'rowClassAttribute' => 'region',
							'additionalTablesOverwrite' => array(
								0 => array(
									'nodeType' => 'tx_trees_examples_entities',
									'fields' => 'title',														
									'titleField' => 'title',
									'style' => 'color:darkblue;',
									'orderBy' => 'title',
									'rowClassAttribute' => 'entity',
								),
								1 => array(
									'nodeType' => 'tx_trees_examples_buildings',
									'fields' => 'header',														
									'titleField' => 'header',
									'style' => 'font-weight:bold; font-style:italic; color:darkred;',
									'orderBy' => 'header',
									'rowClassAttribute' => 'building',
								),
								2 => array(
									'nodeType' => 'tx_trees_examples_products',
									'fields' => 'header',														
									'titleField' => 'header',
									'style' => 'font-weight:bold; font-style:italic; color:darkgreen;',
									'orderBy' => 'header',
									'rowClassAttribute' => 'product',
								),
							),
						),
					),
				),
			),
        ),
    ),
    'types' => Array (
//        '0' => Array('showitem' => 'title;;;;1-1-1, multiselect')
        '0' => Array('showitem' => 'title;;;;1-1-1, singleselect, multiselect, pagesingleselect, pagemultiselect')
    ),
);

$TCA['tx_trees_examples_regions'] = Array (
	'ctrl' => $TCA['tx_trees_examples_regions']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'parentid,parenttable,title'
	),
	'feInterface' => $TCA['tx_trees_examples_regions']['feInterface'],
	'columns' => Array (
		'parentid' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_regions.parentid',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'parenttable' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_regions.parenttable',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'title' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_regions.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'parentid, parenttable, title;;;;2-2-2')
	),
);



$TCA['tx_trees_examples_entities'] = Array (
	'ctrl' => $TCA['tx_trees_examples_entities']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'parentid,parenttable,title'
	),
	'feInterface' => $TCA['tx_trees_examples_entities']['feInterface'],
	'columns' => Array (
		'parentid' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_entities.parentid',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'parenttable' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_entities.parenttable',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'title' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_entities.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => ' parentid, parenttable, title;;;;2-2-2')
	),
);



$TCA['tx_trees_examples_products'] = Array (
	'ctrl' => $TCA['tx_trees_examples_products']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'parentid,parenttable,header'
	),
	'feInterface' => $TCA['tx_trees_examples_products']['feInterface'],
	'columns' => Array (
		'parentid' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_products.parentid',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'parenttable' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_products.parenttable',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'header' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_products.header',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => Array (
		'0' => Array('parentid, parenttable, header')
	),
);



$TCA['tx_trees_examples_buildings'] = Array (
	'ctrl' => $TCA['tx_trees_examples_buildings']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'parentid,parenttable,header'
	),
	'feInterface' => $TCA['tx_trees_examples_buildings']['feInterface'],
	'columns' => Array (
		'parentid' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_buildings.parentid',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'parenttable' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_buildings.parenttable',		
			'config' => Array (
				'type' => 'none',
			)
		),
		'header' => Array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:trees/locallang_db.xml:tx_trees_examples_buildings.header',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => Array (
		'0' => Array('parentid, parenttable, header')
	),
);


?>