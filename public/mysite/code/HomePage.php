<?php

/**
 * Created by PhpStorm.
 * User: JJ
 * Date: 21/02/2015
 * Time: 11:43 PM
 */
class HomePage extends Page
{
    private static $db = array();

    private static $has_many = array(
        'HomePageSlides' => 'HomePageSlide'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', GridField::create('HomePageSlides', 'Home Page Slides', $this->HomePageSlides(), GridFieldConfig_RelationEditor::create()));
        return $fields;
    }
}

class HomePage_Controller extends Page_Controller
{

}