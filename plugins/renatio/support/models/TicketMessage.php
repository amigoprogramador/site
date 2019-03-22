<?php

namespace Renatio\Support\Models;

use Backend\Facades\BackendAuth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Class TicketMessage
 * @package Renatio\Support\Models
 */
class TicketMessage extends Model
{

    use Validation;
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = 'renatio_support_ticket_messages';

    /**
     * @var array
     */
    protected $fillable = ['user', 'ticket', 'reply'];

    /**
     * @var array
     */
    public $attributeNames = [
        'user'   => 'renatio.support::lang.field.user',
        'ticket' => 'renatio.support::lang.field.ticket',
        'reply'  => 'renatio.support::lang.field.reply'
    ];

    /**
     * @var array
     */
    public $rules = [
        'user'   => 'required',
        'ticket' => 'required',
        'reply'  => 'required'
    ];

    /**
     * @var array
     */
    public $belongsTo = [
        'user'   => ['Backend\Models\User'],
        'ticket' => ['Renatio\Support\Models\Ticket']
    ];

    /**
     * @param string $value
     */
    public function setReplyAttribute($value)
    {
        $this->attributes['reply'] = strip_tags(trim($value));
    }

    /**
     * @return bool
     */
    public function isOwner()
    {
        return $this->user->id == BackendAuth::getUser()->id;
    }

}
