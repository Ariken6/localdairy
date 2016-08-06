<?php
/**
 * Created by PhpStorm.
 * User: haochen
 * Date: 8/6/2016
 * Time: 3:46 PM
 */
class MemberExtension extends DataExtension
{
    private static $db = array(
        'ItemLevel' => 'Int',
        'BattleTag' => 'Varchar(100)',
        'CharacterClass' => 'enum("Paladin,Warlock,Rogue,Death Knight,Demon Hunter,Priest,Shaman,Druid,Warrior,Monk,Hunter,Mage", "Paladin")',
        'CharacterSpec' => 'Varchar(100)',
        'PlayStyle' => 'Text'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('ItemLevel', 'Item Level'),
            TextField::create('BattleTag', 'Battle Tag'),
            DropdownField::create('CharacterClass', 'Character Class'),
            TextField::create('CharacterSpec', 'Character Spec'),
            TextareaField::create('PlayStyle', 'Play Style')
        ));

        return $fields;
    }
}