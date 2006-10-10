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

class tx_trees{
	
	var $treeView;
	
	function selectFunction($input){

		// Other classes are loaded by the configuration
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_configuration.php');

		// local configuration
		$localConfiguration = $input['config']['parameters'];
		
		// check presence of allowed tables
		if(!$localConfiguration['allowedTables'])	{
			tx_trees_div::end('selectFunction', 'Please set the parameter "allowedTables" for the function in tca.php.');
		}
		$allowedTables = t3lib_div::trimExplode(',', $localConfiguration['allowedTables']);
		
		// Configure main table
		$configuration  = t3lib_div::makeInstance('tx_trees_configuration');
		$configuration->setFocus('tx_trees__selectFunction', $localConfiguration);
		$table = $localConfiguration['nodeType'];
		$configuration->set('setValue', (in_array($table, $allowedTables) || $allowedTables[0] == '*'));
		
		$treeModel 	= t3lib_div::makeInstance($configuration->get('treeModelClass'));	
		$treeView 	= t3lib_div::makeInstance($configuration->get('treeViewClass'));
		$treeView->setTreeModel($treeModel);
		$treeView->configure($configuration);
		$treeModel->configure($configuration);
		
		$nodeModel 	= t3lib_div::makeInstance($configuration->get('nodeModelClass'));
		$nodeView 	= t3lib_div::makeInstance($configuration->get('nodeViewClass'));
		
		$nodeModel->configure($configuration);
		$treeModel->addNodeModel($nodeModel);
		
		$nodeView->configure($configuration);		
		$treeView->addNodeView($nodeView);
		$treeView->presetLabelArray($input['items']);

		
		// Configure additional tables by overwriting main table settings
		if(is_array($localConfiguration['additionalTablesOverwrite'])){
			foreach($localConfiguration['additionalTablesOverwrite'] as $tableConfiguration){
				
				$tableConfiguration = t3lib_div::array_merge($localConfiguration, $tableConfiguration);
				$configuration  = t3lib_div::makeInstance('tx_trees_configuration');
				$configuration->setFocus('tx_trees__selectFunction', $tableConfiguration);
				$table = $tableConfiguration['nodeType'];
				$configuration->set('setValue', (in_array($table, $allowedTables) || $allowedTables[0] == '*'));
				
				$nodeModel 	= t3lib_div::makeInstance($configuration->get('nodeModelClass'));
				$nodeView 	= t3lib_div::makeInstance($configuration->get('nodeViewClass'));				
				
				$nodeModel->configure($configuration);
				$treeModel->addNodeModel($nodeModel);
				$nodeView->configure($configuration);		
				$treeView->addNodeView($nodeView);
			}		
		}		
		
		// render
		$treeView->render();
		$input['items'] = $treeView->getLabelArray();		
	}
	
	
	function groupWizard(&$input){
		
		// Other classes are loaded by the configuration
		require_once(t3lib_extMgm::extPath('trees', 'library/') . 'class.tx_trees_configuration.php');

		//		tx_trees_div::view($input);
		
		// JavaScript Key
		$javaScriptKey = '_tx_trees_groupWizard';
		$targetSelectId = 'tx_trees_groupWizard' . rand();
		
		// local configuration
		$localConfiguration = $input['wConf']['parameters'];
		
		// construct
		$localConfiguration['onChange'] = 'setFormValueFromBrowseWin'. $javaScriptKey .'(
				\'' . $input['itemName'] . '\', 
				 this.options[this.selectedIndex].value,
				 this.options[this.selectedIndex].className,
				 escape(this.options[this.selectedIndex].title),
				 escape(this.options[this.selectedIndex].text)
			); ';
		
		// check presence of allowed tables
		if(!$localConfiguration['allowedTables'])	{
			tx_trees_div::end('groupWizard', 'Please set the parameter "allowedTables" for the wizard in tca.php. It has to be equal to the "allowed" parameter of the group element some lines above.');
		}
		$allowedTables = t3lib_div::trimExplode(',', $localConfiguration['allowedTables']);

		// Configure main table
		$configuration  = t3lib_div::makeInstance('tx_trees_configuration');
		$configuration->setFocus('tx_trees__groupWizard', $localConfiguration);
		$table = $localConfiguration['nodeType'];
		$configuration->set('setValue', (in_array($table, $allowedTables) || $allowedTables[0] == '*'));
		
		$treeModel 	= t3lib_div::makeInstance($configuration->get('treeModelClass'));	
		$treeView 	= t3lib_div::makeInstance($configuration->get('treeViewClass'));
		$treeView->setTreeModel($treeModel);
		$treeView->configure($configuration);
		$treeModel->configure($configuration);
//		tx_trees_div::view($configuration);
		
		$nodeModel 	= t3lib_div::makeInstance($configuration->get('nodeModelClass'));
		$nodeView 	= t3lib_div::makeInstance($configuration->get('nodeViewClass'));
		
		$nodeModel->configure($configuration);
		$treeModel->addNodeModel($nodeModel);
		
		$nodeView->configure($configuration);		
		$treeView->addNodeView($nodeView);
		
		// Configure additional tables by overwriting main table settings
		if(is_array($localConfiguration['additionalTablesOverwrite'])){
			foreach($localConfiguration['additionalTablesOverwrite'] as $tableConfiguration){
				
				$tableConfiguration = t3lib_div::array_merge($localConfiguration, $tableConfiguration);
				$configuration  = t3lib_div::makeInstance('tx_trees_configuration');
				$configuration->setFocus('tx_trees__groupWizard', $tableConfiguration);
				$table = $tableConfiguration['nodeType'];
				$configuration->set('setValue', (in_array($table, $allowedTables) || $allowedTables[0] == '*'));
				
				$nodeModel 	= t3lib_div::makeInstance($configuration->get('nodeModelClass'));
				$nodeView 	= t3lib_div::makeInstance($configuration->get('nodeViewClass'));				
				
				$nodeModel->configure($configuration);
				$treeModel->addNodeModel($nodeModel);
				$nodeView->configure($configuration);		
				$treeView->addNodeView($nodeView);
			}		
		}		
		
		// render
		$out .= $treeView->render();
		
		// add id to the given select
		$pattern = '|<select|';
		$replacement = '<select id="' . $targetSelectId . '" ';
		$input['item'] = preg_replace($pattern, $replacement, $input['item']);
		
		// add attributes to the given options
		$pattern = '|<option([^>]+value\s*=\s*"([^"]*)"[^>]*)>([^<]*</option>)|';
		$GLOBALS['tx_trees']['selectWizard']['treeView'] = $treeView;
		$input['item'] = preg_replace_callback(
			$pattern, array('tx_trees', '_selectWizardOption'), $input['item'] 
		);	

		// and remove the original browser wizard button
		$pattern = '|<td.*setFormValueOpenBrowser.*</td>|U';
		$input['item'] = preg_replace($pattern, '', $input['item']);

		// adapt the Javascript names
		$pattern = '|setFormValueManipulate|';
		$input['item'] = preg_replace($pattern, 'setFormValueManipulate' . $javaScriptKey, $input['item']);
				
		// set the javascript only once
		if(!$GLOBALS['tx_trees']['groupWizard']['javaScriptIsSet']){
			$out = tx_trees::_createJavaScript($javaScriptKey) . $out;
			$GLOBALS['tx_trees']['groupWizard']['javaScriptIsSet'] = true;
		}
		
		// add css styles
		$out = chr(10) . $treeView->getStyles($targetSelectId) . $out;
		$out = chr(10) . $treeView->getStyles() . $out;
		
		// return
		return $out;
	}

	
	function _selectWizardOption($matches){
		if($title = $GLOBALS['tx_trees']['selectWizard']['treeView']->getBreadcrumbById($matches[2])){
			$title = ' title="' . htmlspecialchars($title) .'"'; 
		} else {
			$title = ' title="[no title]"'; 
		}
		if($class = $GLOBALS['tx_trees']['selectWizard']['treeView']->getRowClassAttributeById($matches[2])){
			$class = ' class="' . $class .'"'; 
		} 
		return '<option ' . $matches[1] . $title . $class . '>' . $matches[3];
	}	
	
	function _createJavaScript($key){		
		return '
		<script type="text/javascript">
			/*<![CDATA[*/
	
			function setFormValueFromBrowseWin'. $key .'(fName,value,className,title,label)	{	//
				if(value == ""){
					return false;
				}
				var formObj = setFormValue_getFObj(fName)
				if (formObj && value!="--div--")	{
					fObj = formObj[fName+"_list"];
					var len = fObj.length;
						// Inserting element
					var setOK = 1;
					if (!formObj[fName+"_mul"] || formObj[fName+"_mul"].value==0)	{
						for (a=0;a<len;a++)	{
							if (fObj.options[a].value==value)	{
								setOK = 0;
							}
						}
					}
					if (setOK)	{

						fObj.length++;
						fObj.options[len].value = value;
						fObj.options[len].className = className;
						fObj.options[len].title = unescape(title);
						fObj.options[len].text = unescape(label);

							// Traversing list and set the hidden-field
						setHiddenFromList(fObj,formObj[fName]);
						TBE_EDITOR_fieldChanged_fName(fName,formObj[fName+"_list"]);
					}
				}
			}	

			function setFormValueManipulate'. $key .'(fName,type)	{	//
				var formObj = setFormValue_getFObj(fName)
				if (formObj)	{
					var localArray_V = new Array();
					var localArray_C = new Array();
					var localArray_L = new Array();
					var localArray_T = new Array();
					var localArray_S = new Array();
					var fObjSel = formObj[fName+"_list"];
					var l=fObjSel.length;
					var c=0;
					if (type=="Remove" || type=="Top" || type=="Bottom")	{
						if (type=="Top")	{
							for (a=0;a<l;a++)	{
								if (fObjSel.options[a].selected==1)	{
									localArray_V[c]=fObjSel.options[a].value;
									localArray_C[c]=fObjSel.options[a].className;
									localArray_L[c]=fObjSel.options[a].text;
									localArray_T[c]=fObjSel.options[a].title;
									localArray_S[c]=1;
									c++;
								}
							}
						}
						for (a=0;a<l;a++)	{
							if (fObjSel.options[a].selected!=1)	{
								localArray_V[c]=fObjSel.options[a].value;
								localArray_C[c]=fObjSel.options[a].className;
								localArray_L[c]=fObjSel.options[a].text;
								localArray_T[c]=fObjSel.options[a].title;
								localArray_S[c]=0;
								c++;
							}
						}
						if (type=="Bottom")	{
							for (a=0;a<l;a++)	{
								if (fObjSel.options[a].selected==1)	{
									localArray_V[c]=fObjSel.options[a].value;
									localArray_C[c]=fObjSel.options[a].className;
									localArray_L[c]=fObjSel.options[a].text;
									localArray_T[c]=fObjSel.options[a].title;
									localArray_S[c]=1;
									c++;
								}
							}
						}
					}
					if (type=="Down")	{
						var tC = 0;
						var tA = new Array();

						for (a=0;a<l;a++)	{
							if (fObjSel.options[a].selected!=1)	{
									// Add non-selected element:
								localArray_V[c]=fObjSel.options[a].value;
								localArray_C[c]=fObjSel.options[a].className;
								localArray_L[c]=fObjSel.options[a].text;
								localArray_T[c]=fObjSel.options[a].title;
								localArray_S[c]=0;
								c++;

									// Transfer any accumulated and reset:
								if (tA.length > 0)	{
									for (aa=0;aa<tA.length;aa++)	{
										localArray_V[c]=fObjSel.options[tA[aa]].value;
										localArray_C[c]=fObjSel.options[tA[aa]].className;
										localArray_L[c]=fObjSel.options[tA[aa]].text;
										localArray_T[c]=fObjSel.options[tA[aa]].title;
										localArray_S[c]=1;
										c++;
									}

									var tC = 0;
									var tA = new Array();
								}
							} else {
								tA[tC] = a;
								tC++;
							}
						}
							// Transfer any remaining:
						if (tA.length > 0)	{
							for (aa=0;aa<tA.length;aa++)	{
								localArray_V[c]=fObjSel.options[tA[aa]].value;
								localArray_C[c]=fObjSel.options[tA[aa]].className;
								localArray_L[c]=fObjSel.options[tA[aa]].text;
								localArray_T[c]=fObjSel.options[tA[aa]].title;
								localArray_S[c]=1;
								c++;
							}
						}
					}
					if (type=="Up")	{
						var tC = 0;
						var tA = new Array();
						var c = l-1;

						for (a=l-1;a>=0;a--)	{
							if (fObjSel.options[a].selected!=1)	{

									// Add non-selected element:
								localArray_V[c]=fObjSel.options[a].value;
								localArray_C[c]=fObjSel.options[a].className;
								localArray_L[c]=fObjSel.options[a].text;
								localArray_T[c]=fObjSel.options[a].title;
								localArray_S[c]=0;
								c--;

									// Transfer any accumulated and reset:
								if (tA.length > 0)	{
									for (aa=0;aa<tA.length;aa++)	{
										localArray_V[c]=fObjSel.options[tA[aa]].value;
										localArray_C[c]=fObjSel.options[tA[aa]].className;
										localArray_L[c]=fObjSel.options[tA[aa]].text;
										localArray_T[c]=fObjSel.options[tA[aa]].title;
										localArray_S[c]=1;
										c--;
									}

									var tC = 0;
									var tA = new Array();
								}
							} else {
								tA[tC] = a;
								tC++;
							}
						}
							// Transfer any remaining:
						if (tA.length > 0)	{
							for (aa=0;aa<tA.length;aa++)	{
								localArray_V[c]=fObjSel.options[tA[aa]].value;
								localArray_C[c]=fObjSel.options[tA[aa]].className;
								localArray_L[c]=fObjSel.options[tA[aa]].text;
								localArray_T[c]=fObjSel.options[tA[aa]].title;
								localArray_S[c]=1;
								c--;
							}
						}
						c=l;	// Restore length value in "c"
					}

						// Transfer items in temporary storage to list object:
					fObjSel.length = c;
					for (a=0;a<c;a++)	{
						fObjSel.options[a].value = localArray_V[a];
						fObjSel.options[a].className = localArray_C[a];
						fObjSel.options[a].text = localArray_L[a];
						fObjSel.options[a].title = localArray_T[a];
						fObjSel.options[a].selected = localArray_S[a];
					}
					setHiddenFromList(fObjSel,formObj[fName]);

					TBE_EDITOR_fieldChanged_fName(fName,formObj[fName+"_list"]);
				}
			}
			/*]]>*/
		</script>
		';
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/class.tx_trees.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/class.tx_trees.php']);
}

?>