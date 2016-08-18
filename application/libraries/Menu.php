<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Menu Class
 *
 * @package        CodeIgniter
 * @subpackage     Libraries
 * @category       Menu
 * @author         Vinoth
 */

class Menu {

	public $_SexceptionMenuId;
    public $_SexceptionSubMenuId;
    public $_SnavigationRequest;
    public $_IroleId;
    public $_IaccountId;
    public $_IuserId;
    public $_SinvoiceCreationType;
    public $_AexceptionMenuData;
    public $_AmenuData;

	public function __construct()
	{
		$CI =& get_instance();

		if(isset($CI->access->session->userdata['user_id']) && !empty($CI->access->session->userdata['user_id'])){
			$this->_AmenuData = $this->_getMenuMappingDetails();
		}
	}

	public function _getMenuMappingDetails()
    {
    	$CI =& get_instance();

    	$exceptionMenuDetailsArray  = array();
		$CI->load->model('Menu_mapping_details');

		$this->_IroleId 	= !empty($this->_IroleId)?$this->_IroleId:$CI->access->session->userdata['role_id'];
		$this->_IaccountId 	= !empty($this->_IaccountId)?$this->_IaccountId:$CI->access->session->userdata['account_id'];
		$this->_IuserId 	= !empty($this->_IuserId)?$this->_IuserId:$CI->access->session->userdata['user_id'];
		
    	$CI->Menu_mapping_details->role_id 		= $this->_IroleId;
    	$CI->Menu_mapping_details->account_id 	= $this->_IaccountId;
    	$CI->Menu_mapping_details->user_id 		= $this->_IuserId;
    	$menuDetailsArray 					= $CI->Menu_mapping_details->_getMenuMappingDetails();
		
		/* Exception Details Process Start */
		
		$exceptionMenuDetailsArray 			= $CI->Menu_mapping_details->_getExceptionMenuMappingDetails();
		//$this->_AexceptionMenuData = $exceptionMenuDetailsArray;		
		

		if(count($exceptionMenuDetailsArray) > 0){
		
			if(!isset($exceptionMenuDetailsArray[0])){
				$exceptionMenuDetailsArray = array(0=>$exceptionMenuDetailsArray);
			}
		
			$menuIdArray 	= array();
			$submenuIdArray = array();
			$exceptionGroup = array("roleChanges"=>array(),"accountChanges"=>array(),"accountRoleChanges"=>array(),"userChanges"=>array());
			foreach($menuDetailsArray as $key=>$value){
				$menuIdArray[] = $value['menu_id'];
				$submenuIdArray[] = $value['submenu_id'];
			}
			$menuIdArray 	= array_unique($menuIdArray);
			$submenuIdArray = array_unique($submenuIdArray);
			
			foreach($exceptionMenuDetailsArray as $key=>$value){
			
				if($value['target_menu_id']!=0){
					$CI->Menu_mapping_details->_ImenuId = $value['target_menu_id'];
					$value = array_merge($value,$CI->Menu_mapping_details->_getMenuDetails());
				}
				if($value['target_submenu_id']!=0){
					$CI->Menu_mapping_details->_IsubmenuId = $value['target_submenu_id'];
					$value = array_merge($value,$CI->Menu_mapping_details->_getSubmenuDetails());
				}
				
				if($value['role_id'] !=0 && $value['account_id'] == 0 && $value['user_id'] == 0 && $this->_IroleId == $value['role_id']){
					$exceptionGroup['roleChanges'][] = $value;
				}
				if($value['account_id'] !=0 && $value['role_id'] == 0 && $value['user_id'] == 0 && $this->_IaccountId == $value['account_id']){
					$exceptionGroup['accountChanges'][] = $value;
				}
				if($value['account_id'] !=0 && $value['role_id'] != 0 && $value['user_id'] == 0 && $this->_IroleId == $value['role_id'] && $this->_IaccountId == $value['account_id']){
					$exceptionGroup['accountRoleChanges'][] = $value;
				}
				if($value['user_id'] !=0 && $value['account_id'] == 0 && $value['role_id'] == 0 && $this->_IuserId == $value['user_id']){
					$exceptionGroup['userChanges'][] = $value;
				}
				if($value['user_id'] !=0 && $value['account_id'] != 0 && $value['role_id'] != 0 && $this->_IuserId == $value['user_id']){
					$exceptionGroup['userChanges'][] = $value;
				}
			}
			
			foreach($exceptionGroup as $key=>$value){
				foreach($value as $subKey=>$subValue){
					if($subValue['menu_id']!= 0 && !in_array($subValue['menu_id'],$menuIdArray)){
						$tempArray = array();
						$tempArray['menu_name'] = $subValue['target_menu_name'];
						$tempArray['link'] = $subValue['target_menu_link'];
						$tempArray['icon'] = $subValue['target_menu_icon'];						
						$tempArray['submneu_name'] = $subValue['target_submneu_name'];
						$tempArray['submenu_link'] = $subValue['target_submenu_link'];
						$tempArray['submenu_icon'] = $subValue['target_submenu_icon'];
						
						$menuDetailsArray[] = array_merge($tempArray,$subValue);
						$menuIdArray[] 		= $subValue['menu_id'];
					}
					else{
						if($subValue['menu_id'] != 0 && $subValue['submenu_id'] == 0){
							$this->_doMenuChanges($menuDetailsArray,$subValue);
						}
						if($subValue['submenu_id'] != 0 && $subValue['menu_id'] == 0){
							$this->_doSubmenuChanges($menuDetailsArray,$subValue);
						}
						if($subValue['menu_id'] != 0 && $subValue['submenu_id'] != 0){
							$this->_doMenuSubmenuChanges($menuDetailsArray,$subValue);
						}
					}
				}
			}
			
			/* Unset the values having status as N */
			
			foreach($menuDetailsArray as $key=>$value){
				if($value['menu_status'] == 'N' || $value['submenu_status'] == 'N'){
					unset($menuDetailsArray[$key]);
				}
			}
		}	
		
		/* Exception Details Process End */

		/* Menu and Submenu Array Format Start */
		$tempMenuDetails = array();
		if(!empty($menuDetailsArray)){
			foreach($menuDetailsArray as $key=>$value){
				if(!isset($tempMenuDetails[$value['menu_id']]) && !empty($value['menu_order'])){
					unset($value['submneu_name']);
					unset($value['submenu_link']);
					unset($value['submenu_icon']);
					$tempMenuDetails[$value['menu_id']] = $value;
				}
			}
			
			$finalInput=array("inputArray"=>$tempMenuDetails,"fieldName"=>"menu_order","fieldType"=>"NUMBER","orderType"=>"ASC");
			$tempMenuDetails=dynamicSortFunction($finalInput);
			
			$finalInput=array("inputArray"=>$menuDetailsArray,"firstFieldName"=>"submenu_pos","firstFieldOrder"=>"DESC","secondFieldName"=>"submenu_display_order","secondFieldOrder"=>"ASC");
			$menuDetailsArray=multipleSortFunction($finalInput);
			
			foreach($menuDetailsArray as $key=>&$value){
				if($value['submenu_parent_id']!=0){
					$this->_mapSubmenuInsideSubmenu($menuDetailsArray,$value['submenu_parent_id'],$value);
				}
			}
			
			$finalArray=array();
		
			foreach($tempMenuDetails as $menuKey=>$menuValue){
				$finalArray[$menuKey]=$menuValue;
				foreach($menuDetailsArray as $submenuKey=>$submenuValue){
					if($menuValue['menu_id']==$submenuValue['menu_id'] && $submenuValue['submenu_parent_id']==0 && $submenuValue['submenu_id']!=1000){
						$finalArray[$menuKey]['submenuArray'][]=$submenuValue;
					}
				}
			}
		}
		/* Menu and Submenu Array Format End */
		
		return $finalArray;
    }

	public function _mapSubmenuInsideSubmenu(&$givenArray,$parentSubmenuId,$subArray)
	{
		foreach($givenArray as $key=>$value){
			if($value['submenu_id']==$parentSubmenuId){
				$givenArray[$key]['submenuArray'][]=$subArray;
				$givenArray[$key]['parentSubmenu']='Y';
			}
		}
	}
	
	public function _doMenuChanges(&$menuDetailsArray,$subValue)
	{	
		foreach($menuDetailsArray as $key=>$value){
			if($value['menu_id'] == $subValue['menu_id']){
				if(isset($subValue['target_menu_id']) && $subValue['target_menu_id']!=0){
					$menuDetailsArray[$key]['menu_name'] = $subValue['target_menu_name'];
					$menuDetailsArray[$key]['link'] = $subValue['target_menu_link'];
					$menuDetailsArray[$key]['icon'] = $subValue['target_menu_icon'];
				}
				if(!is_null($subValue['menu_status']) && !empty($subValue['menu_status'])){
					$menuDetailsArray[$key]['menu_status'] = $subValue['menu_status'];
				}
				if(!is_null($subValue['menu_order']) && !empty($subValue['menu_order'])){
					$menuDetailsArray[$key]['menu_order'] = $subValue['menu_order'];
				}
			}
		}
	}
	
	public function _doSubmenuChanges(&$menuDetailsArray,$subValue)
	{	
		foreach($menuDetailsArray as $key=>$value){
			if($value['submenu_id'] == $subValue['submenu_id']){
				if(isset($subValue['target_submenu_id']) && $subValue['target_submenu_id']!=0){
					$menuDetailsArray[$key]['submneu_name'] = $subValue['target_submneu_name'];
					$menuDetailsArray[$key]['submenu_link'] = $subValue['target_submenu_link'];
					$menuDetailsArray[$key]['submenu_icon'] = $subValue['target_submenu_icon'];
				}
				if(!is_null($subValue['submenu_pos']) && !empty($subValue['submenu_pos'])){
					$menuDetailsArray[$key]['submenu_pos'] = $subValue['submenu_pos'];
				}
				if(!is_null($subValue['submenu_display_order']) && !empty($subValue['submenu_display_order'])){
					$menuDetailsArray[$key]['submenu_display_order'] = $subValue['submenu_display_order'];
				}
				if(!is_null($subValue['submenu_status']) && !empty($subValue['submenu_status'])){
					$menuDetailsArray[$key]['submenu_status'] = $subValue['submenu_status'];
				}
				if(!is_null($subValue['submenu_parent_id']) && !empty($subValue['submenu_parent_id'])){
					$menuDetailsArray[$key]['submenu_parent_id'] = $subValue['submenu_parent_id'];
				}
			}
		}
	}
	
	public function _doMenuSubmenuChanges(&$menuDetailsArray,$subValue)
	{	
		$menuSubmenuFound = 0;
		
		foreach($menuDetailsArray as $key=>$value){
			if(($value['menu_id'] == $subValue['menu_id']) && ($value['submenu_id'] == $subValue['submenu_id'])){
			
				$menuSubmenuFound = 1;
				// Menu Changes
				if(isset($subValue['target_menu_id']) && $subValue['target_menu_id']!=0){
					$menuDetailsArray[$key]['menu_name'] = $subValue['target_menu_name'];
					$menuDetailsArray[$key]['link'] = $subValue['target_menu_link'];
					$menuDetailsArray[$key]['icon'] = $subValue['target_menu_icon'];
				}
				if(!is_null($subValue['menu_status']) && !empty($subValue['menu_status'])){
					$menuDetailsArray[$key]['menu_status'] = $subValue['menu_status'];
				}
				if(!is_null($subValue['menu_order']) && !empty($subValue['menu_order'])){
					$menuDetailsArray[$key]['menu_order'] = $subValue['menu_order'];
				}
				
				// Submenu Changes
				if(isset($subValue['target_submenu_id']) && $subValue['target_submenu_id']!=0){
					$menuDetailsArray[$key]['submneu_name'] = $subValue['target_submneu_name'];
					$menuDetailsArray[$key]['submenu_link'] = $subValue['target_submenu_link'];
					$menuDetailsArray[$key]['submenu_icon'] = $subValue['target_submenu_icon'];
				}
				if(!is_null($subValue['submenu_pos']) && !empty($subValue['submenu_pos'])){
					$menuDetailsArray[$key]['submenu_pos'] = $subValue['submenu_pos'];
				}
				if(!is_null($subValue['submenu_display_order']) && !empty($subValue['submenu_display_order'])){
					$menuDetailsArray[$key]['submenu_display_order'] = $subValue['submenu_display_order'];
				}
				if(!is_null($subValue['submenu_status']) && !empty($subValue['submenu_status'])){
					$menuDetailsArray[$key]['submenu_status'] = $subValue['submenu_status'];
				}
				if(!is_null($subValue['submenu_parent_id']) && !empty($subValue['submenu_parent_id'])){
					$menuDetailsArray[$key]['submenu_parent_id'] = $subValue['submenu_parent_id'];
				}				
			}
		}
		
		if($menuSubmenuFound==0){
			if(!isset($subValue['target_menu_name'])){
				$exactMenuArray = $this->_getExactMenuDetails($menuDetailsArray,$subValue['menu_id']);
			}
			else{
				$exactMenuArray = array();
				$exactMenuArray['menu_name'] = $subValue['target_menu_name'];
				$exactMenuArray['link'] = $subValue['target_menu_link'];
				$exactMenuArray['icon'] = $subValue['target_menu_icon'];
			}
			if(count($exactMenuArray)>0){
				$tempArray = array();
				$tempArray['menu_name'] = $exactMenuArray['menu_name'];
				$tempArray['link'] = $exactMenuArray['link'];
				$tempArray['icon'] = $exactMenuArray['icon'];
				$tempArray['submneu_name'] = $subValue['target_submneu_name'];
				$tempArray['submenu_link'] = $subValue['target_submenu_link'];
				$tempArray['submenu_icon'] = $subValue['target_submenu_icon'];
				$menuDetailsArray[] = array_merge($tempArray,$subValue);
			}
		}
	}
	
	public function _getExactMenuDetails($givenMenuArray,$menuId)
	{
		$exactMenuArray = array();
		foreach($givenMenuArray as $key=>$value){
			if($value['menu_id'] == $menuId && isset($value['menu_name']) && !empty($value['menu_name'])){
				$exactMenuArray = $value;
				break;
			}
		}
		return $exactMenuArray;
	}
}