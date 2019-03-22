<?php namespace eBussola\Feedbackslack;

use eBussola\Feedback\Models\Channel;
use System\Classes\PluginBase;

/**
 * feedbackslack Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * @var array Plugin dependencies
     */
    public $require = ['eBussola.Feedback', 'October.Drivers'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'FeedbackSlack',
            'description' => 'The Slack method for Feedback plugin',
            'author'      => 'eBussola',
            'icon'        => 'icon-slack'
        ];
    }

    /**
     * @inheritdoc
     */
    public function boot()
    {
        Channel::registerMethod('slack', '\eBussola\FeedbackSlack\Classes\SlackMethod', 'Slack');
    }

}
