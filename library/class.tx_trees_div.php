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

class tx_trees_div{	

	function end($function, $message){
			die(get_class($this) . ' [or an ancester of it ... ]->' . $function . '(): ' . $message );		
	}

	function dump($par){
		ob_start();	
		print_r($par); 
		$out = htmlspecialchars(ob_get_clean());
		return '<pre>' . $out .  '</pre>';
	}
	
	function list2array($listString){
		$array = array();
		foreach(t3lib_div::trimExplode(chr(10), $listString) as $row){
			if(!empty($row)){
				list($key, $value) = t3lib_div::trimExplode('=', $row);
				if(empty($key)) {
					tx_trees_div::end('list2array', 'Empty key in given list.');
				}
				if($value === null) {
					$value = '';
				}
				$array[$key] = $value;
			}
		}
		if(empty($array)){
			tx_trees_div::end('list2array', 'Empty list was given.');			
		}
		return $array;
	}

	function tt($marker = 'Timestamp', $display=false){
		$time = tx_trees_div::_microtime();
		$GLOBALS['tx_trees_div'][][(string) $time] = $marker;
		$array = $GLOBALS['tx_trees_div'];
		$start = key($array[0]);
		$end = key($array[count($array)-1]);
		$total = $end - $start;	
		
		foreach($GLOBALS['tx_trees_div'] as $values){
			$ts = key($values);
			$marker = current($values);
			$duration = $ts - $start;
			if($total){
				$percent = (integer) (($duration/$total) * 100);
			} else {
				$percent = '--';
			}
			$last = sprintf('<p><span style="display:block; width:25em; float:left;">%s :</span> %03d msec (%s %%)</p>', 
							$marker, $duration, $percent);		
			$out .= $last;
		}
		if($display){
			print $last;
		}
		return $out;
	}
	
	function view($par){
		print tx_trees_div::dump($par);
	}
	
	function _microtime(){
		list($msec, $sec) = explode(' ', microtime());
		return 1000 * ((float)substr($sec,-4) + (float)$msec);
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_div.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_div.php']);
}

?>