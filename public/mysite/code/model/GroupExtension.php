<?php

/**
 * Created by PhpStorm.
 * User: haochen
 * Date: 8/6/2016
 * Time: 3:46 PM
 */
class GroupExtension extends DataExtension
{
    private static $db = array();

    private static $has_one = array(
        'Leader' => 'Member',
        'Event' => 'Event'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('EventID');
        $fields->addFieldsToTab('Root.Main', array(
            DropdownField::create('LeaderID', 'Leader')->setValue($this->owner->LeaderID)
        ));

        return $fields;
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if ($member = Member::currentUser()) {
            $Group = DataObject::get_one('Group', "Code = 'Admin'");
            if ($Group->exists() && Member::currentUser()->inGroup($Group->ID)) {
                $this->owner->LeaderID = $member->ID;
            }
        }
    }
}