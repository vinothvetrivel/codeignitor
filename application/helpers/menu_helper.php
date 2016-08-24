<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('dynamicSortFunction'))
{
	function dynamicSortFunction(){

		$functionArgs = func_get_args();
		
		if(!isset($functionArgs[0]))
			return false;
			
		$functionArgs = $functionArgs[0];
		
		if(!isset($functionArgs['inputArray']) || !isset($functionArgs['fieldName']))
			return false;
			
		$arrayToSort=$functionArgs['inputArray'];
		
		if(!isset($functionArgs['fieldType']))
			$functionArgs['fieldType']="NUMBER";
		
		if(!isset($functionArgs['orderType']))
			$functionArgs['orderType']="ASC";
		
		usort($arrayToSort, function($firstArray, $secondArray) use($functionArgs)	{
			
			$retunValue=0;
			
			if($functionArgs['fieldType']=="STRING"){
				if($functionArgs['orderType']=="ASC"){
					$retunValue=strcmp($firstArray[$functionArgs['fieldName']] , $secondArray[$functionArgs['fieldName']]);
				}			
				if($functionArgs['orderType']=="DESC"){
					$retunValue=strcmp($secondArray[$functionArgs['fieldName']] , $firstArray[$functionArgs['fieldName']]);
				}
			}		
			if($functionArgs['fieldType']=="DATE"){
				if($functionArgs['orderType']=="ASC"){
					$retunValue=strtotime($firstArray[$functionArgs['fieldName']]) > strtotime($secondArray[$functionArgs['fieldName']]);
				}			
				if($functionArgs['orderType']=="DESC"){
					$retunValue=strtotime($firstArray[$functionArgs['fieldName']]) < strtotime($secondArray[$functionArgs['fieldName']]);
				}
			}		
			if($functionArgs['fieldType']=="NUMBER"){
				if($functionArgs['orderType']=="ASC"){
					$retunValue=$firstArray[$functionArgs['fieldName']] > $secondArray[$functionArgs['fieldName']];
				}			
				if($functionArgs['orderType']=="DESC"){
					$retunValue=$firstArray[$functionArgs['fieldName']] < $secondArray[$functionArgs['fieldName']];
				}			
			}		
			return $retunValue;
		});	
		return $arrayToSort;
	}
}

if ( ! function_exists('multipleSortFunction'))
{
	function multipleSortFunction(){

		$functionArgs = func_get_args();
		
		if(!isset($functionArgs[0]))
			return false;
			
		$functionArgs = $functionArgs[0];
		
		if(!isset($functionArgs['inputArray']) || !isset($functionArgs['firstFieldName']) || !isset($functionArgs['secondFieldName']))
			return false;
			
		$arrayToSort=$functionArgs['inputArray'];
		
		if(!isset($functionArgs['firstFieldOrder']))
			$functionArgs['firstFieldOrder']="ASC";
		
		if(!isset($functionArgs['secondFieldOrder']))
			$functionArgs['secondFieldOrder']="ASC";
		
		if($functionArgs['firstFieldOrder']=="ASC"){
			$firstFieldOrder=SORT_ASC;
		}	
		if($functionArgs['firstFieldOrder']=="DESC"){
			$firstFieldOrder=SORT_DESC;
		}	
		if($functionArgs['secondFieldOrder']=="ASC"){
			$secondFieldOrder=SORT_ASC;
		}	
		if($functionArgs['secondFieldOrder']=="DESC"){
			$secondFieldOrder=SORT_DESC;
		}	
		$sorterTempArray=array();
		foreach($arrayToSort as $key=>$value){
			$sorterTempArray[$functionArgs['firstFieldName']][$key] = $value[$functionArgs['firstFieldName']];
			$sorterTempArray[$functionArgs['secondFieldName']][$key] = $value[$functionArgs['secondFieldName']];
		}
		array_multisort($sorterTempArray[$functionArgs['firstFieldName']], $firstFieldOrder, $sorterTempArray[$functionArgs['secondFieldName']], $secondFieldOrder,$arrayToSort);
		return $arrayToSort;
	}
}