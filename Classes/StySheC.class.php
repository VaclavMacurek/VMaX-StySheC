<?php

namespace StySheC;

use UniCAT\InstanceOptions;
use UniCAT\CodeExport;
use UniCAT\CodeMemory;
use UniCAT\UniCAT;
use UniCAT\Comments;

/**
 * @package VMaX-StySheC
 *
 * @author Václav Macùrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macùrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for easier access to class constants of interfaces
 */
final class StySheC extends UniCAT
{
	use CodeExport, CodeMemory, Comments,
	InstanceOptions
	{
		Set_Instance as public;
	}
	
	/**
	 * prepares lists of options
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		self::$Options['selectors'] = $this -> Get_Options_Selectors();
	}
	
	/**
	 * gets options of selectors
	 *
	 * @return array
	 */
	protected function Get_Options_Selectors()
	{
		return $this -> Get_Options("StySheC\I_StySheC_Expressions_Selectors");
	}
	
	/**
	 * shows available expressions for class CodeGenerator
	 *
	 * @return array
	 *
	 * @throws StySheC_Exception if if self::$Options was not set (throws fatal error if instance was not set)
	 */
	public static function Show_Options_Selectors()
	{
		/*
		 * class instance cannot be set wherever
		 */
		try
		{
			if(!empty(self::$Options['selectors']))
			{
				return self::$Options['selectors'];
			}
			else
			{
				throw new StySheC_Exception(UniCAT::UNICAT_EXCEPTIONS_MAIN_CLS, UniCAT::UNICAT_EXCEPTIONS_MAIN_FNC, UniCAT::UNICAT_EXCEPTIONS_MAIN_VAR, UniCAT::UNICAT_EXCEPTIONS_SEC_VAR_PRHBSTMT);
			}
		}
		catch(StySheC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, $Exception -> Get_VariableNameAsText(self::$Options), 'empty');
		}
	}
}

?>