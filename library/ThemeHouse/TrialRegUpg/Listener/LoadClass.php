<?php

class ThemeHouse_TrialRegUpg_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_TrialRegUpg' => array(
                'controller' => array(
                    'XenForo_ControllerPublic_Register'
                ), /* END 'controller' */
            ), /* END 'ThemeHouse_TrialRegUpg' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_TrialRegUpg_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */
}