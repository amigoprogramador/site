<?php
/**
 * Created by PhpStorm.
 * User: shina
 * Date: 9/5/15
 * Time: 11:48 AM
 */

namespace eBussola\FeedbackSlack\Classes;


use Backend\Widgets\Form;
use eBussola\Feedback\Classes\Method;
use eBussola\Feedback\Controllers\Channels;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class SlackMethod implements Method
{

    /**
     * Used to register new form fields to Channel.
     * Modify and prepare Channel model.
     *
     * @return void
     */
    public function boot()
    {
        Channels::extendFormFields(function (Form $form, $model) {
            $form->addFields([
                    'method_data[slack_webhook_url]' => [
                        'label' => 'Slack Webhook URL',
                        'commentAbove' => '',
                        'required' => true,
                        'trigger' => [
                            'action' => 'show',
                            'field' => 'method',
                            'condition' => 'value[slack]'
                        ]
                    ]
                ]
            );
        });
    }

    /**
     * @param array $methodData
     * @param array $data
     * @return mixed
     */
    public function send($methodData, $data)
    {
        $client = new Client();
        try {
            $client->post($methodData['slack_webhook_url'], [
                'json' => [
                    'text' => substr(substr(print_r($data, true), 7), 0, -2)
                ]
            ]);
        } catch (ServerException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }

}