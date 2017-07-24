<?php

namespace StySheC;

use UniCAT\CodeExport;
use UniCAT\Comments;
use UniCAT\MethodScope;

/**
 * @package VMaX-StySheC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * generation of style sheet code
 */
final class CodeGenerator implements I_StySheC_CodeGenerator
{
	use CodeExport,
	Comments;

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
	 * @param string $Selector single or multiple selector
	 *
	 * @throws StySheC_Exception
	 *
	 * @example new StySheC('p'); for binding styles to element <p>
	 * @example new StySheC('.success'); for binding styles to any element with class "success"
	 * @example new StySheC('#fail'); for binding styles to any element with id "fail"
	 */
	public function __construct($Selector = '')
	{
		try
		{
			if( empty($Selector) )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}

		/*
		 * selector must match one of set of patterns
		 */
		$Error = 0;

		for( $Index = 0; $Index < count(Core::ShowOptions_AssignSelector()); $Index++ )
		{
			if( !preg_match(Core::ShowOptions_AssignSelector()[$Index], $Selector) )
			{
				$Error = $Index;
				break;
			}
		}

		try
		{
			if( $Error == 0 )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGREGEX);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), $Selector, Core::ShowOptions_Selectors());
		}

		$this -> Selector = $Selector;
	}

	/**
	 * prevents calling of non-public functions from external scope
	 *
	 * @param string $Method function name
	 * @param array $Parameters function parameters
	 *
	 * @throws UniCAT_Exception
	 */
	public function __call($Method, $Parameters)
	{
		/*
		 * function must exist
		 */
		try
		{
			if( in_array($Method, ClassScope::Get_Methods(__CLASS__, ClassScope::UNICAT_OPTION_PUBLIC)) )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_SEC_FNC_MISSING);
			}
			else
			{
				call_user_func_array($Method, $Parameters);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, $Method);
		}
	}

	/**
	 * sets style
	 *
	 * @param string $Name style name
	 * @param string $Value style value
	 *
	 * @throws StySheC_Exception
	 *
	 * @example Set_Style('font-size', '5px'); for setting value 5px to style font-size
	 */
	public function Set_Style($Name, $Value = '')
	{
		try
		{
			if( empty($Name) )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}

		try
		{
			if( !is_string($Name) )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), gettype($Name), 'string');
		}

		try
		{
			if( !empty($Value) && !Core::Check_IsScalar($Value) )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_Parameters(__CLASS__, __FUNCTION__), gettype($Name), Core::ShowOptions_Scalars());
		}

		if( !empty($Value) )
		{
			$this -> Styles[$Name] = $Value;
		}
	}

	/**
	 * assembling of code
	 *
	 * @return string|void
	 *
	 * @throws StySheC_Exception
	 */
	public function Execute()
	{
		try
		{
			if( $this -> Selector == FALSE )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_VAR, Core::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Selector), 'FALSE');
		}

		try
		{
			if( empty($this -> Styles) )
			{
				throw new StySheC_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_VAR, Core::UNICAT_XCPT_SEC_VAR_PRHBSTMT);
			}
		}
		catch( StySheC_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Styles), 'empty');
		}

		/*
		 * prepares texts of styles
		 */
		foreach( $this -> Styles as $Name => $Value )
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
		Core::Set_ExportWay(static::$ExportWay);
		Core::Add_Comments($this -> LocalCode, static::$Comments);
		return Core::Convert_Code($this -> LocalCode, __CLASS__);
	}

}

?>