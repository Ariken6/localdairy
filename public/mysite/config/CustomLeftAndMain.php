<?php

/**
 * Created by PhpStorm.
 * User: JJ
 * Date: 21/02/2015
 * Time: 4:25 PM
 */
class CustomLeftAndMain extends DataExtension
{
    function init()
    {
        CMSMenu::remove_menu_item('Help');
        CMSMenu::remove_menu_item('ReportAdmin');
    }
}