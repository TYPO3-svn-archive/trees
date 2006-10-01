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

require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeViewAbstract.php');

class tx_trees_treeViewForSelects extends tx_trees_treeViewAbstract {
	
	// no direct use, use setters and getters	
	var $settings = array(
		'classLevel' =>  'normal',  // few, normal, many
		'listClass' => null,
		'indentMargin' => '.',
		'indentCharacter' => '&nbsp;.',
		'indentPadding' => '&nbsp;',
		'inputName' => null,
		'inputId' => null,
		'inputSize' => null,
		'onChange' => '',
		'onClick' => '',
		'selectedValues' => array(),
	);	
	
	//---------------------------------------------------------------------------
	// public functions
	//---------------------------------------------------------------------------

	 
	
	function set($key, $value){
		switch ($key){ 
			case 'inputSize':
				if(!is_integer($value)){
					tx_trees_div::end('set', 'The inputSize must be integer.');
				}
			break;	
		}			
		parent::set($key, $value);
	}
	
	function usageExample($script, $mounts){
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeModelForTables.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_treeModelAbstract.php');
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_nodeViewAbstract.php');
		foreach($mounts as $mount){
			$treeModel = t3lib_div::makeInstance('tx_trees_treeModelAbstract');
			$treeView = t3lib_div::makeInstance('tx_trees_treeViewForSelects');
			$nodeModel1 = t3lib_div::makeInstance('tx_trees_nodeModelForTables');
			$nodeView1 = t3lib_div::makeInstance('tx_trees_nodeViewAbstract');
			$treeView->setTreeModel($treeModel);
			$treeModel->addNodeModel($nodeModel1);
			$treeView->addNodeView($nodeView1);
			$treeView->set('classLevel', 'few');
			$treeView->set('listClass', 'pageTree');
			$treeView->set('inputId', 'usageExample');
			$treeView->set('inputName', 'tx_trees_treeViewForSelects[usageExample]');
			$nodeModel1->set('table', 'pages');
			$nodeModel1->set('parentTable', 'pages');
			$nodeModel1->set('idField', 'uid');
			$nodeModel1->set('parentIdField', 'pid');
			$nodeModel1->set('fields', 'title');		
			$nodeView1->set('type', 'pages');
			$nodeView1->set('titleField', 'title');
			$nodeView1->set('classAttribute', 'page');
			$treeModel->set( 'rootNodeType', 'pages');
			$treeModel->set('rootId', $mount);
			$out .= '<p>' . $treeView->render() . '</p>';
		}		
		return $out;
	}
	
	//---------------------------------------------------------------------------
	// protected functions to overwrite in inherited classes
	//---------------------------------------------------------------------------
	
	function _init(){
		if($this->isInitialized){
			return;
		}
		if($this->isEmpty('inputId')){
			$this->end('_init', 'Please set the inputId');		
		}		
		if($this->isEmpty('inputName')){
			$this->end('_init', 'Please set the inputName');		
		}		
		parent::_init();
	}
	
	function _renderLevelEnd($current){	}
	function _renderLevelBegin($current){}
	
	function _renderList($rows){
		$break = chr(10);
		$rows = join('', $rows);
		$id = ' id="' . $this->get('inputId') . '"';
		$name = ' name="' . $this->get('inputName') . '"';			
		if($this->get('inputSize') > 1){
			$size =' size="' . (int) $this->get('inputSize') . '" multiple="multiple"';			
		}else{
		}
		$onChange = $this->get('onChange') ? ' onChange="' . $this->get('onChange') .'"'  : '';
		$out = sprintf(
			'%s %s<select%s%s%s%s>%s %s</select> %s',
			$break, $break, $name, $id, $size, $onChange, $rows, $break, $break
		 );
		return $out;
	}	
	
	function _renderRow($current, $components){
//		tx_trees_div::view($this->selectedValues);
		$break = chr(10) . '    ';
		$id = $current['.nodeType'] . '_' . $current[$current['.idField']];
		$value = ' value="' . $id . '" ';
		$selected = in_array($id, (array) $this->get('selectedValues')) ? ' selected="1" ' : '';
		$prefix = $this->get('indentMargin');
		for($i=0; $i < $current['.level']; $i++){
			$prefix .= $this->get('indentCharacter');	
		}
		$prefix .= $this->get('indentPadding');
		$onClick .= $this->get('onClick') ? ' onClick="' . $this->get('onClick') . '"' : '';
		$text = $components['text'];
		$out = sprintf(
			'%s<option%s%s%s>%s%s</option>',
			 $break, $value, $selected, $onClick, $prefix, $text
		 );
		return $out;		
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewForSelects.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_treeViewForSelects.php']);
}

?>