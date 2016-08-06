<?php

/**
 * Created by PhpStorm.
 * User: haochen
 * Date: 8/6/2016
 * Time: 4:04 PM
 */
class SignUpPage extends Page
{
    private static $db = array();
}

class SignUpPage_Controller extends Page_Controller
{
    private static $allow_actions = array(
        'GuildLoginForm',
        'GuildSignUpForm'
    );

    public function GuildLoginForm()
    {
        return MemberLoginForm::create($this, 'GuildLoginForm');
    }

    public function GuildSignUpForm()
    {
        //todo add signup form
    }
}