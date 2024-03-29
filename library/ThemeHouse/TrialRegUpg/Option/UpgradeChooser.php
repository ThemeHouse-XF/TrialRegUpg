<?php

/**
 * Helper for choosing a user upgrades.
 *
 * @package ThemeHouse_TrialRegUpg
 */
abstract class ThemeHouse_TrialRegUpg_Option_UpgradeChooser
{

    /**
     * Renders the node chooser option as a <select>.
     *
     * @param XenForo_View $view View object
     * @param string $fieldPrefix Prefix for the HTML form field name
     * @param array $preparedOption Prepared option info
     * @param boolean $canEdit True if an "edit" link should appear
     *
     * @return XenForo_Template_Abstract Template object
     */
    public static function renderSelect(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {
        return self::_render('option_list_option_select', $view, $fieldPrefix, $preparedOption, $canEdit);
    } /* END renderSelect */
    
	/**
	 * Renders the node chooser option.
	 *
	 * @param string Name of template to render
	 * @param XenForo_View $view View object
	 * @param string $fieldPrefix Prefix for the HTML form field name
	 * @param array $preparedOption Prepared option info
	 * @param boolean $canEdit True if an "edit" link should appear
	 *
	 * @return XenForo_Template_Abstract Template object
	 */
	protected static function _render($templateName, XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
	{
        $preparedOption['formatParams'] = XenForo_Model::create('XenForo_Model_UserUpgrade')->getUserUpgradeOptions(
			$preparedOption['option_value']
		);

		return XenForo_ViewAdmin_Helper_Option::renderOptionTemplateInternal(
			$templateName, $view, $fieldPrefix, $preparedOption, $canEdit
		);
	} /* END _render */
}