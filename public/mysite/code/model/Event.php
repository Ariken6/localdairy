<?php

/**
 * Created by PhpStorm.
 * User: haochen
 * Date: 8/6/2016
 * Time: 4:45 PM
 */
//TODO think about if this class is needed or everything should go on group
class Event extends DataObject
{
    private static $db = array(
        'Title' => 'Varchar(200)',
        'Reoccurring' => 'Boolean',
        'Date' => 'SS_DateTime',
        'DayOfTheWeek' => 'enum("Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday", "Wednesday")'
    );

    private static $has_many = array(
        'Groups' => 'Group'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('Title', 'Event Name'),
            CheckboxField::create('Reoccurring', 'Reoccurring'),
            $dateTimeField = DatetimeField::create('Date', 'Date'),
            DropdownField::create('DayOfTheWeek', 'Day of the week')->setDescription('Only applies if Reoccurring is true'),
            GridField::create('Groups', 'Groups', Group::get(), GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldSortableRows('Sort')))
        ));

        $dateTimeField->getDateField()->setConfig('showcalendar', true);

        return $fields;
    }
}

class EventModelAdmin extends ModelAdmin
{
    private static $managed_models = array('Event');
    private static $url_segment = 'event-admin';
    private static $menu_title = 'Events';
}