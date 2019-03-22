<?php namespace StudioBosco\LoginAsUser\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Input;
use Auth;
use RainLab\User\Models\User as FrontendUser;

/**
 * Login As User Back-end Controller
 */
class Index extends Controller
{

    public $requiredPermissions = ['studiobosco.loginasuser.*'];

    public function index()
    {
        $user = null;
        $id = Input::get('id');
        $this->vars['user'] = null;
        $this->pageTitle = 'Login as User';

        if ($id) {
            try {
                $this->vars['user'] = $user = FrontendUser::find($id);
            } catch (\Exception $error) {

            }

            if ($user && $user->is_activated) {
                Auth::login($user, true);
            }
        }
    }
}
