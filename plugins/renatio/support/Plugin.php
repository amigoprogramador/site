<?php

namespace Renatio\Support;

use Renatio\Support\Models\Ticket;
use System\Classes\PluginBase;
use Backend;
use Event;

/**
 * Support Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'renatio.support::lang.plugin.name',
            'description' => 'renatio.support::lang.plugin.description',
            'author'      => 'Renatio',
            'icon'        => 'icon-life-ring',
        ];
    }

    /**
     * Boot plugin
     */
    public function boot()
    {
        $this->extendNavigation();
    }

    /**
     * Register backend navigation.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'support' => [
                'label'       => 'renatio.support::lang.navigation.support',
                'icon'        => 'icon-life-ring',
                'url'         => Backend::url('renatio/support/tickets'),
                'permissions' => ['renatio.support.*'],
                'order'       => 600,
                'sideMenu'    => [
                    'tickets'        => [
                        'label'       => 'renatio.support::lang.navigation.tickets',
                        'icon'        => 'icon-ticket',
                        'url'         => Backend::url('renatio/support/tickets'),
                        'permissions' => ['renatio.support.access_tickets']
                    ],
                    'tickettypes'    => [
                        'label'       => 'renatio.support::lang.navigation.ticket_types',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('renatio/support/tickettypes'),
                        'permissions' => ['renatio.support.access_ticket_types']
                    ],
                    'ticketstatuses' => [
                        'label'       => 'renatio.support::lang.navigation.ticket_statuses',
                        'icon'        => 'icon-check-square',
                        'url'         => Backend::url('renatio/support/ticketstatuses'),
                        'permissions' => ['renatio.support.access_ticket_statuses']
                    ]
                ]
            ],
        ];
    }

    /**
     * Register permissions.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'renatio.support.access_settings'        => [
                'label' => 'renatio.support::lang.permissions.settings',
                'tab'   => 'renatio.support::lang.permissions.tab'
            ],
            'renatio.support.access_tickets'         => [
                'label' => 'renatio.support::lang.permissions.tickets',
                'tab'   => 'renatio.support::lang.permissions.tab'
            ],
            'renatio.support.access_other_tickets'   => [
                'label' => 'renatio.support::lang.permissions.other_tickets',
                'tab'   => 'renatio.support::lang.permissions.tab'
            ],
            'renatio.support.access_ticket_types'    => [
                'label' => 'renatio.support::lang.permissions.ticket_types',
                'tab'   => 'renatio.support::lang.permissions.tab'
            ],
            'renatio.support.access_ticket_statuses' => [
                'label' => 'renatio.support::lang.permissions.ticket_statuses',
                'tab'   => 'renatio.support::lang.permissions.tab'
            ],
        ];
    }

    /**
     * Register form widgets
     *
     * @return array
     */
    public function registerFormWidgets()
    {
        return [
            'Renatio\Support\FormWidgets\TicketToolbar'  => [
                'label' => 'renatio.support::lang.ticket.toolbar',
                'code'  => 'ticket_toolbar'
            ],
            'Renatio\Support\FormWidgets\TicketMessages' => [
                'label' => 'renatio.support::lang.ticket.messages',
                'code'  => 'ticket_messages'
            ]
        ];
    }

    /**
     * Register mail templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'renatio.support::mail.new_ticket'    => 'New ticket mail to support team.',
            'renatio.support::mail.new_reply'     => 'New reply message for ticket.',
            'renatio.support::mail.ticket_closed' => 'Close ticket mail.'
        ];
    }

    /**
     * Register settings.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'renatio.support::lang.settings.label',
                'description' => 'renatio.support::lang.settings.description',
                'category'    => 'renatio.support::lang.settings.category',
                'icon'        => 'icon-life-ring',
                'class'       => 'Renatio\Support\Models\Settings',
                'order'       => 500,
                'keywords'    => 'support help',
                'permissions' => ['renatio.support.access_settings']
            ]
        ];
    }

    /**
     * Extend inbox navigation
     */
    protected function extendNavigation()
    {
        Event::listen('backend.menu.extendItems', function ($manager) {
            $openCount = Ticket::getOpenedCount();

            if ($openCount) {
                $manager->addSideMenuItems('Renatio.Support', 'support', [
                    'tickets' => [
                        'counter' => $openCount,
                    ]
                ]);
            }
        });
    }

}
