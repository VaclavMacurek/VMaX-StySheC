<?php

/**
 * @package VMaX-StySheC
 *
 * @author V�clav Mac�rek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 V�clav Mac�rek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for CSS code generation
 */

define("STYSHEC_ADR", __DIR__.'/');

/*
 * VMaX-StySheC is dependent on VMaX-UniCAT
 */
if(!defined('UNICAT_ADR'))
{
	die('VMaX-UniCAT not available');
}

/*
 * Interfaces
*/
require_once (STYSHEC_ADR."Interfaces/Expressions.Interface.php");
require_once (STYSHEC_ADR."Interfaces/ConstructionTexts.Interface.php");

/*
 * Exceptions
 */
require_once (STYSHEC_ADR."Exceptions/StySheC_Exception.Exception.php");

/*
 * Classes
 */
require_once (STYSHEC_ADR."Classes/StySheC.class.php");
require_once (STYSHEC_ADR."Classes/CodeGenerator.Class.php");

?>