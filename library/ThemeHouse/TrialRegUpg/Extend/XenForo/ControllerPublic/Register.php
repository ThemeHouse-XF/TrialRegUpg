<?php

/**
 *
 * @see XenForo_ControllerPublic_Register
 */
class ThemeHouse_TrialRegUpg_Extend_XenForo_ControllerPublic_Register extends XFCP_ThemeHouse_TrialRegUpg_Extend_XenForo_ControllerPublic_Register
{

    /**
     *
     * @see XenForo_ControllerPublic_Register::actionRegister()
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionRegister()
    {
        $response = parent::actionRegister();
        
        if ($response instanceof XenForo_ControllerResponse_View &&
             $response->viewName == 'XenForo_ViewPublic_Register_Process') {
            $user = $response->params['user'];
            $this->_upgradeRegisteringMember($user);
        }
        
        return $response;
    } /* END actionRegister */

    /**
     * Manually assigns a member a chosen upgrade for a specified trial period.
     */
    protected function _upgradeRegisteringMember(array $user)
    {
        $options = XenForo_Application::get('options');
        $userUpgradeId = $options->th_trialRegUpgrades_upgradeId;
        $trialLength = $options->th_trialRegUpgrades_trialLength;
        
        if ($userUpgradeId && $trialLength) {
            $endDate = XenForo_Application::$time + ($trialLength * 60 * 60 * 24);
            $upgrade = $this->_getUserUpgradeModel()->getUserUpgradeById($userUpgradeId);
            if (is_array($upgrade)) {
                $this->_getUserUpgradeModel()->upgradeUser($user['user_id'], $upgrade, true, $endDate);
            }
        }
    } /* END _upgradeRegisteringMember */

    /**
     *
     * @return XenForo_Model_UserUpgrade
     */
    protected function _getUserUpgradeModel()
    {
        return $this->getModelFromCache('XenForo_Model_UserUpgrade');
    } /* END _getUserUpgradeModel */
}