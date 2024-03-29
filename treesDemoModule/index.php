<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 Elmar Hinz <elmar.hinz@team-red.net>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


// DEFAULT initialization of a module [BEGIN]
unset($MCONF);
require_once('conf.php');
require_once($BACK_PATH.'init.php');
require_once($BACK_PATH.'template.php');
require_once(PATH_t3lib.'class.t3lib_scbase.php');

$LANG->includeLLFile('EXT:trees/treesDemoModule/locallang.xml');
$BE_USER->modAccess($MCONF,1);	// This checks permissions and exits if the users has no permission for entry.
	// DEFAULT initialization of a module [END]

/**
 * Usage examples for the trees extension
 *
 * @author	Elmar Hinz <elmar.hinz@team-red.net>
 * @package	TYPO3
 * @subpackage	tx_trees
 */
class  tx_trees_treesDemoModule extends t3lib_SCbase {
	var $pageinfo;
	var $errors = array();

	//---------------------------------------------------------------------
	// Initialization
	//---------------------------------------------------------------------
	
	/**
	 * Initializes the Module
	 * @return	void
	 */
	function init()	{
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
		$this->doc = t3lib_div::makeInstance("mediumDoc");
		parent::init();
	}

	/**
	 * Adds items to the ->MOD_MENU array. Used for the function menu selector.
	 *
	 * @return	void
	 */
	function menuConfig(){
		global $LANG;
		  // tab controllers
		$this->MOD_MENU['controller'] = array(
			't3lib_treeview'  => $LANG->getLL('t3lib_treeviewController'),
			't3lib_browsetree'  => $LANG->getLL('t3lib_browsetreeController'),
			'plainPageModel'  => $LANG->getLL('plainPageModelController'),
			'modelAsTree'  => $LANG->getLL('modelAsTreeController'),
			'modelAsList'  => $LANG->getLL('modelAsListController'),
			'viewAsNestedList'  => $LANG->getLL('viewAsNestedListController'),
			'multiTypeView'  => $LANG->getLL('multiTypeViewController'),
			'select'  => $LANG->getLL('selectController'),
		);
		$this->MOD_MENU['webmounts']['none'] = '--- Select webmount! ---';
		foreach($GLOBALS['WEBMOUNTS'] as $value){
			$this->MOD_MENU['webmounts'][$value] = 'WEBMOUNT ' . $value;
		}
		$this->MOD_MENU['webmounts']['all'] = '--- All ---';
		parent::menuConfig();
	}
	
	//---------------------------------------------------------------------
	// Controllers
	//---------------------------------------------------------------------
	
	/**
	 * Main function of the module. Write the content to $this->content
	 * If you chose "web" as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
	 *
	 * @return	[type]		...
	 */
	function main()	{
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;
		$this->init();
		
		// Access check
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;
		if ((!$access) && (!$BE_USER->user['admin'])){
			$this->errors[] = 'Access denied.';
		} 
		
		tx_trees_div::tt('Controller start');
		// Controller
		if(!$this->errors) {
			$controller = $this->MOD_SETTINGS['controller'] . 'Controller';
			if(is_callable(array($this, $controller))){
				$content = $this->$controller();
			} else {
				$this->errors[] = 'Unknown controller.';
			}
		}
		$durationMessage = tx_trees_div::tt('Controller end');		
		
		// View
		$out .= $this->headerView();
		$out .= $this->mountselector();			
		$out .= $this->durationView($durationMessage);
		$out .= $this->controllersTabulatorsView();
		$out .= $this->errorsView($this->errors);
		$out .= $content;
		$out .= $this->footer();
		print $out; 
	}
	
	function t3lib_treeviewController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_t3libTreeViewDemo.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_t3libTreeViewDemo::example($mounts, 'index.php');
		}
		return $out;
	}
	
	function t3lib_browsetreeController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_t3libBrowseTreeDemo.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_t3libBrowseTreeDemo::example($mounts, 'index.php');
		}
		return $out;
	}
	
	function plainPageModelController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForPageTree.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_treeModelForPageTree::usageExampleDumpPageTree($mounts);
		}
		return $out;
	}
	
	function modelAsTreeController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForPageTree.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_treeModelForPageTree::usageExampleDumpTree($mounts);
		}
		return $out;
	}
	
	function modelAsListController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelForPageTree.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_treeModelForPageTree::usageExampleDumpList($mounts);
		}
		return $out;
	}
	
	function viewAsNestedListController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSimpleLists.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_treeViewForSimpleLists::usageExampleNestedList($mounts);
		}
		return $out;
	}
	
	function multiTypeViewController()	{
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSimpleLists.php');
		if($this->MOD_SETTINGS['webmounts'] != 'none') {
			$mounts = ($this->MOD_SETTINGS['webmounts'] == 'all') 
				? $GLOBALS['WEBMOUNTS'] : array($this->MOD_SETTINGS['webmounts']) ;
			$out .= tx_trees_treeViewForSimpleLists::usageExampleMultiTypes($mounts);
		}
		return $out;
	}
	
	function selectController(){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewForSelects.php');
		require_once(t3lib_extMgm::extPath('trees') . 'class.tx_trees.php');
		
		$params= '&edit[tx_trees_examples][0]=new';
		$onClick = htmlspecialchars(t3lib_BEfunc::editOnClick($params, $GLOBALS['BACK_PATH']));
		$new = '<p><a href="#" onClick="'. $onClick . '">New Example</a></p>';
		
		$fields = '*';
		$table = 'tx_trees_examples';
		$query = $GLOBALS['TYPO3_DB']->SELECTquery($fields, $table, $where, $groupBy, $orderBy, $limit);
		$result = $GLOBALS['TYPO3_DB']->sql(TYPO3_db, $query);
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){	
			$params= '&edit[tx_trees_examples][' . $row['uid'] . ']=edit';
			$onClick = htmlspecialchars(t3lib_BEfunc::editOnClick($params, $GLOBALS['BACK_PATH']));
//			print $onClick;
			$list .= '<li><a href="#" onClick="'. $onClick . '">' . $row['title'] . '</a></li>';
		}		
		$list = '<ul>' . $list . '</ul>';
		$out .= $this->doc->spacer(10);
		$out .= $this->doc->section('Show off', $new . $list);
		$out .= $this->doc->sectionEnd();
		$out .= $this->doc->spacer(10);
		return $out;
	}
	
	
	//---------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------

	function mountselector(){
		return $this->doc->section('', $this->doc->funcMenu($headerSection, 
				t3lib_BEfunc :: getFuncMenu(
				$this->id, 'SET[webmounts]', 
				$this->MOD_SETTINGS['webmounts'], 
				$this->MOD_MENU['webmounts']
			)));				
	}
	
	function controllersTabulatorsView(){
		$out .= $this->doc->spacer(5);
		$par = array('id' => $this->id);
		$tab = $this->MOD_SETTINGS['controller'];
		$lables = $this->MOD_MENU['controller'];

		$tbm  = $this->doc->getTabMenu($par,'SET[controller]', $tab, $lables);
		// workaround for ampersand bug of doc->getTabMenu
		return $out . preg_replace('/&amp;amp;/', '&amp;', $tbm);
	}

	function durationView($message){
		$out .= $this->doc->spacer(10);
		$out .= $this->doc->section('Duration', $message );		
		$out .= $this->doc->sectionEnd();
		return $out;
	}
	
	function errorsView($errors){
		$errorMessages = '';
		foreach($errors as $error){
			$errorMessages .= '<li>' . $error . '</li>';
		}
		if($errorMessages){
			$out .= $this->doc->spacer(10);
			$out .= '<ul>' . $this->doc->section('Errors', $errorMessages, false, false, 3) . '</ul>';
			$out .= $this->doc->sectionEnd();
		}
		return $out;
	}
	
	function footer(){
		global $BE_USER;
    // ShortCut
		if ($BE_USER->mayMakeShortcut())	{
			$out .= $this->doc->spacer(20);
			$out .= $this->doc->divider(1);
			$out .=	$this->doc->section("",$this->doc->makeShortcutIcon("id",implode(",",array_keys($this->MOD_MENU)),$this->MCONF["name"]));
			$out .= $this->doc->sectionEnd();
		}
		$out .= $this->doc->spacer(10);
		$out .= $this->doc->endPage();
		return $out;
	}
	
	function headerView(){
		global $LANG,$BACK_PATH;
		$this->doc->backPath = $BACK_PATH;
		
    // Draw the header.
		$this->doc->form='<form action="" method="POST">';
		
    // JavaScript
		$this->doc->JScode = '
				<script language="javascript" type="text/javascript">
					script_ended = 0;
					function jumpToUrl(URL)	{
						document.location = URL;
					}
				</script>
			';
		$this->doc->postCode='
				<script language="javascript" type="text/javascript">
					script_ended = 1;
					if (top.fsMod) top.fsMod.recentIds["web"] = '.intval($this->id).';
				</script>
			';
		$out .= $this->doc->startPage($LANG->getLL("title"));
		$out .= $this->doc->header($LANG->getLL("title"));			
		return $out;
	}
	
}

// Require class extensions
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/treesDemoModule/index.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/treesDemoModule/index.php']);
}
// Run
$obj = t3lib_div::makeInstance('tx_trees_treesDemoModule');
$obj->main();
?>