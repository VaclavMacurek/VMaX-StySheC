<?php

namespace StySheC;

/**
 * @package VMaX-StySheC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * interface of constants with patterns for stylesheet names
 */
interface I_StySheC_Expressions_Selectors
{
	/**
	 * pattern for identifying of correct form of attribute selector (with value)
	 */
	const STYSHEC_PATTERN_ATTRSELECTOR1 = '/^[a-zA-Z]{1,}[\[]{1}[a-zA-Z]{1,}[\|\!\^\*\$\~]{0,1}\=\"{1}[a-zA-Z0-9\_]{1,}\"[\]]{1}$/i';
	/**
	 * pattern for identifying of correct form of attribute selector
	 */
	const STYSHEC_PATTERN_ATTRSELECTOR2 = '/^[a-zA-Z]{0,}[\[]{1}[a-zA-Z]{1,}[\]]{1}$/i';
	/**
	 * pattern for identifying of correct form of class selector
	 */
	const STYSHEC_PATTERN_CLSSELECTOR1 = '/^[a-zA-Z]{0,}[\.]{1}[a-zA-Z]{1,}$/i';
	/**
	 * pattern for identifying of correct form of pseudo-class selector
	 */
	const STYSHEC_PATTERN_CLSSELECTOR2 = '/^[a-zA-Z]{0,}[\:]{1}[a-zA-Z]{1,}[\-]{0,1}[a-zA-Z]{0,}$/i';
	/**
	 * pattern for identifying of correct form of id selector
	 */
	const STYSHEC_PATTERN_IDSELECTOR = '/^[a-zA-Z]{0,}[\#]{1}[a-zA-Z0-9\_]{1,}$/i';
	/**
	 * pattern for identifying of correct form of element selector
	 */
	const STYSHEC_PATTERN_ELMTSELECTOR = '/^[a-zA-Z]{1,}(\x20{0,1}[\>\,\*\+\x20]{1}\x20{0,1}[a-zA-Z]{1,}){0,}$/i';
}

/**
 * interface of constants with patterns for styles names
 */
interface I_StySheC_Expressions_StyleNames
{
	/**
	 * pattern for identifying of correct form of style name
	 */
	const STYSHEC_PATTERN_STYLENAME = '/^[a-z]{0,}([\-]{1}[a-z]{1,}){0,}$/i';
}

?>