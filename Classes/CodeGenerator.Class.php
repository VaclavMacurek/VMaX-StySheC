<?php

namespace StySheC;

use UniCAT\CodeExport;
use UniCAT\Comments;
use UniCAT\UniCAT;
use UniCAT\MethodScope;

/**
 * @package VMaX-StySheC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * generation of style sheet code
 */
final class CodeGenerator implements I_StySheC_Texts_CodeGenerator
{
	use CodeExport, Comments;
	
	/**
	 * selector
	 *
	 * @var string
	 */
	private $Selector = FALSE;
	/**
	 * styles of style sheet
	 *
	 * @var array
	 */
	private $Styles = array();
	
	/**
	 * sets selector;
	 *
	 * @param string $Selector
	 *
	 * @throws StySheC_Exception if selector was not set as string
	 * @throws StySheC_Exception if selector does not match to any of patterns for selectors
	 *
	 * @example new StySheC('p'); for binding styles to element <p>
	 * @example new StySheC('.success'); for binding styles to aany element with class "success"
	 * @example new StySheC('#fail'); for binding styles to aany element with id "fail"
	 */
	public function __construct($Selector)
	{
		/*
		 * initial setting of instance of class StySheC
		 */
		StySheC::Set_Instance();
		
		try
		{
			if(empty($Selector))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}
		
		/*
		 * selector must match one of set of patterns
		 */
		$Error = 0;
			
		for($Index = 0; $Index < count(StySheC::Show_Options_Selectors()); $Index++)
		{
			if(!preg_match(StySheC::Show_Options_Selectors()[$Index], $Selector))
			{
				$Error = $Index;
			}
		}
		
		try
		{
			if($Error == 0)
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_WRONGREGEX);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), $Selector, StySheC::Show_Options_Selectors());
		}
		
		$this -> Selector = $Selector;
	}
	
	/**
	 * sets style
	 *
	 * @param string $Name
	 * @param string $Value
	 *
	 * @throws StySheC_Exception if style name was not set
	 * @throws StySheC_Exception if style name was not set as string
	 * @throws StySheC_Exception if style value was not set as scalar
	 *
	 * @example Set_Style('font-size', '5px'); for setting value 5px to style font-size
	 */
	public function Set_Style($Name, $Value="")
	{
		try
		{
			if(empty($Name))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}
	
		try
		{
			if(!is_string($Name))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), gettype($Name), 'string');
		}
		
		try
		{
			if(!empty($Value) && !in_array(gettype($Value), StySheC::Show_Options_Scalars()))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), gettype($Name), StySheC::Show_Options_Scalars());
		}
		
		if(!empty($Value))
		{
			$this -> Styles[$Name] = $Value;
		}
	}
		
	/**
	 * assembling of code
	 *
	 * @return string|void
	 *
	 * @throws StySheC_Exception if selector was not set
	 * @throws StySheC_Exception if styles were not set
	 */
	public function Execute()
	{
		try
		{
			if($this -> Selector == FALSE)
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_VAR, UniCAT::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Selector), 'FALSE');
		}
		
		try
		{
			if(empty($this -> Styles))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_VAR, UniCAT::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Styles), 'empty');
		}
		
		/*
		 * prepares texts of styles
		 */
		foreach($this -> Styles as $Name => $Value)
		{
			$this -> LocalCode[] = sprintf(self::STYSHEC_CODE_STYLES, $Name, $Value);
		}
		
		/*
		 * if comment was not set;
		 * inserts styles into form of stylesheet
		 */
		$this -> LocalCode = sprintf(self::STYSHEC_CODE_STYLESHEET, $this -> Selector, implode('', $this -> LocalCode));
		
		/*
		 * sets way how code will be exported;
		 * exports code
		 */
		StySheC::Set_ExportWay(static::$ExportWay);
		StySheC::Add_Comments($this -> LocalCode, static::$Comments);
		return StySheC::Convert_Code($this -> LocalCode, __CLASS__);
	}
}

?>