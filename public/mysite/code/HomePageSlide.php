<?php

/**
 * Created by PhpStorm.
 * User: JJ
 * Date: 21/02/2015
 * Time: 11:47 PM
 */
class HomePageSlide extends DataObject
{
    private static $db = array(
        'Title' => 'Varchar',
        'Content' => 'Text'
    );

    private static $has_one = array(
        'HomePage' => 'HomePage',
        'Slide' => 'Image'
    );

    private static $summary_fields = array(
        'Thumbnail' => 'Slide Image',
        'Title' => 'Title'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('HomePageID');
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('Title', 'Title'),
            TextareaField::create('Content', 'Content'),
            UploadField::create('Slide', 'Slide')
        ));
        return $fields;
    }

    public function Thumbnail()
    {
        return $this->Slide()->CMSThumbnail();
    }
}