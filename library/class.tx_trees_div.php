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
			die(get_class($this) . '->' . $function . '(): ' . $message );		
	}

	function dump($par){
		ob_start();	
		print_r($par); 
		$out = htmlspecialchars(ob_get_clean());
		return '<pre>' . $out .  '</pre>';
	}
	
	function tt($marker = 'Timestamp', $display=false){
		$time = microtime(1);
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
			$last = sprintf('<p><span style="display:block; width:15em; float:left;">%s :</span> %01.2f (%s %%)</p>', 
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
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_div.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/trees/library/class.tx_trees_div.php']);
}

?>