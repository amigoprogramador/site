<?php namespace AlekseyP\GoogleTagManager\Components;

use AlekseyP\GoogleTagManager\Models\Settings;
use Cms\Classes\ComponentBase;
use Lang;

/**
 * Class TagManager
 * @package AlekseyP\GoogleTagManager\Components
 */
class TagManager extends ComponentBase
{

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'alekseyp.googletagmanager::lang.components.tagmanager.name',
            'description' => 'alekseyp.googletagmanager::lang.components.tagmanager.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'container_id' => [
                'title' => Lang::get('alekseyp.googletagmanager::lang.components.tagmanager.container_id'),
                'description' => Lang::get('alekseyp.googletagmanager::lang.components.tagmanager.container_id_desc'),
                'default' => '',
                'type' => 'string',
                'validationPattern' => '^GTM-.*',
                'validationMessage' => Lang::get('alekseyp.googletagmanager::lang.components.tagmanager.container_id_val_message'),
                'placeholder' => 'GTM-XXXXXX'
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function containerId()
    {
        return $this->property('container_id') ?: Settings::get('container_id');
    }

}