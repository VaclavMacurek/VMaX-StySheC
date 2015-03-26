<?php

namespace StySheC;

use UniCAT\CodeExport;
use UniCAT\UniCAT;
use UniCAT\Comments;

/**
 * @package VMaX-StySheC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macůrek
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
	 * @return void
	 *
	 * @throws StySheC_Exception if selector was not set as string
	 * @throws StySheC_Exception if selector does not match to any of patterns for selectors
	 */
	public function __construct($Selector="")
	{
		/*
		 * initial setting of instance of class StySheC;
		 * using of function __construct is also available
		 */
		StySheC::Set_Instance();
		
		try
		{
			if(empty($Selector))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__));
		}
		
		/*
		 * selector must match one of set of patterns
		 */
		$Error = 0;
		$Patterns = StySheC::Show_Options_Selectors();
			
		for($Order = 0; $Order < count($Patterns); $Order++)
		{
			if(!preg_match($Patterns[$Order], $Selector))
			{
				$Error = $Order;
			}
		}
		
		try
		{
			if($Error == 0)
			{
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_WRONGREGEX);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__), $Selector, StySheC::Show_Options_Selectors());
		}
		
		$this -> Selector = $Selector;
	}
	
	/**
	 * sets style
	 *
	 * @param string $Name
	 * @param string $Value
	 *
	 * @return void
	 *
	 * @throws StySheC_Exception if style name was not set
	 */
	public function Set_Style($Name="", $Value="")
	{
		try
		{
			if(empty($Name))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__)[0]);
		}
	
		try
		{
			if(!is_string($Name))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__)[0], gettype($Name), 'string');
		}
		
		try
		{
			if(!empty($Value) && !in_array(gettype($Value), StySheC::Show_Options_Scalars()))
			{
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_PRM, UniCAT::UNICAT_EXCEPTIONS_SEC_PRM_MISSING);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_Parameters(__CLASS__, __FUNCTION__)[0], gettype($Name), StySheC::Show_Options_Scalars());
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
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_VAR, UniCAT::UNICAT_EXCEPTIONS_SEC_VAR_PRHBSTMT);
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
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_VAR, UniCAT::UNICAT_EXCEPTIONS_SEC_VAR_PRHBSTMT);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Styles), 'empty');
		}
		
		if($this -> Comment != FALSE)
		{
			$this -> LocalCode[] = sprintf(self::STYSHEC_CODE_COMMENT, $this -> Comment);
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
		if($this -> Comment == FALSE)
		{
			$this -> LocalCode = sprintf(self::STYSHEC_CODE_STYLESHEET, $this -> Selector, implode('', $this -> LocalCode));
		}
		/*
		 * if comment was set;
		 * inserts comment;
		 * inserts styles into form of stylesheet;
		 * eliminates unwanted items from array;
		 * converts array into text
		 */
		else
		{
			$this -> LocalCode[1] = sprintf(self::STYSHEC_CODE_STYLESHEET, $this -> Selector, implode('', array_slice($this -> LocalCode, 1)));
			$this -> LocalCode = array_slice($this -> LocalCode, 0, 2);
			$this -> LocalCode = implode('', $this -> LocalCode);
		}
		
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