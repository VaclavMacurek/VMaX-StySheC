<?php

namespace StySheC;

use UniCAT\InstanceOptions;
use UniCAT\CodeExport;
use UniCAT\CodeMemory;
use UniCAT\Comments;
use UniCAT\UniCAT;
use UniCAT\ClassScope;


/**
 * @package VMaX-StySheC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
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
		
		self::$Options['selectors'] = ClassScope::Get_ConstantsValues('StySheC\I_StySheC_Expressions_Selectors');
	}
}

?>