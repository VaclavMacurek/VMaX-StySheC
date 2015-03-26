<?php

namespace StySheC;

/**
 * @package VMaX-StySheC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2015 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * interface with construction texts of class CodeGenerator
 */
interface I_StySheC_Texts_CodeGenerator
{
	/**
	 * order of %s: style name, style value
	 */
	const STYSHEC_CODE_STYLES = "\n\t%s: %s;";
	/**
	 * order of %s: selector, styles
	 */
	const STYSHEC_CODE_STYLESHEET = "\n%s\n{\n%s\n}\n";
}

/**
 * interface with construction text of comments
 */
interface I_StySheC_Texts_Comments
{
	/**
	 * order of %s: comment text
	 */
	const STYSHEC_CODE_COMMENT = "\n// %s \n";
}

?>