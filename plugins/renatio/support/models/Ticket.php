<?php

namespace Renatio\Support\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Event;
use Model;
use October\Rain\Database\Traits\Purgeable;
use October\Rain\Database\Traits\Validation;

/**
 * Class Ticket
 * @package Renatio\Support\Models
 */
class Ticket extends Model
{

    use Validation;
    use SoftDeletes;
    use Purgeable;

    /**
     * @var string
     */
    public $table = 'renatio_support_tickets';

    /**
     * @var array
     */
    public $implement = [
        'Renatio.Support.Behaviors.TicketModel'
    ];

    /**
     * @var array
     */
    protected $fillable = ['subject', 'type', 'content'];

    /**
     * @var array
     */
    public $attributeNames = [
        'subject' => 'renatio.support::lang.field.subject',
        'type'    => 'renatio.support::lang.field.type',
        'content' => 'renatio.support::lang.field.content'
    ];

    /**
     * @var array
     */
    public $rules = [
        'subject' => 'required|max:255',
        'type'    => 'required',
        'content' => 'required'
    ];

    /**
     * @var array
     */
    protected $dates = ['status_updated_at'];

    /**
     * @var array
     */
    public $purgeable = ['ticket_toolbar', 'ticket_messages', 'reply'];

    /**
     * @var array
     */
    public $hasMany = [
        'messages' => ['Renatio\Support\Models\TicketMessage']
    ];

    /**
     * @var array
     */
    public $belongsTo = [
        'user'   => ['Backend\Models\User'],
        'status' => ['Renatio\Support\Models\TicketStatus'],
        'type'   => ['Renatio\Support\Models\TicketType', 'scope' => 'active']
    ];

    /**
     * @var array
     */
    public $attachMany = [
        'attachments' => ['System\Models\File', 'public' => false]
    ];

    /**
     * @param string $value
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags(trim($value));
    }

    /**
     * @return void
     */
    public function beforeCreate()
    {
        $this->setDefaults();
    }

    /**
     * @return void
     */
    public function afterCreate()
    {
        Event::fire('ticket.afterCreate', [$this]);
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        $this->deleteAttachments();
    }

    /**
     * @param $query
     */
    public function scopeClosed($query)
    {
        $query->where('is_closed', true);
    }

    /**
     * @param $query
     */
    public function scopeOpened($query)
    {
        $query->where('is_closed', false);
    }

    /**
     * @param $fields
     * @param null $context
     */
    public function filterFields($fields, $context = null)
    {
        if ($this->isAllowedToUpdate($context)) {
            foreach ($fields as $field) {
                $field->disabled = true;
            }
        }
    }

}
