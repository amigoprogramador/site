<?php

namespace Renatio\Support\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Class TicketStatus
 * @package Renatio\Support\Models
 */
class TicketStatus extends Model
{

    use Validation;
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = 'renatio_support_ticket_statuses';

    /**
     * @var array
     */
    protected $fillable = ['name', 'is_active'];

    /**
     * @var array
     */
    public $attributeNames = [
        'name'      => 'renatio.support::lang.field.name',
        'is_active' => 'renatio.support::lang.field.is_active'
    ];

    /**
     * @var array
     */
    public $rules = [
        'name'      => 'required|max:50',
        'is_active' => 'boolean'
    ];

    /**
     * @var array
     */
    public $belongsToMany = [
        'tickets' => ['Renatio\Support\Models\Ticket']
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * @return mixed
     */
    public static function getActiveList()
    {
        return self::active()->get()->lists('name', 'id');
    }

}
