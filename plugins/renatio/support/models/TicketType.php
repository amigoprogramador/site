<?php

namespace Renatio\Support\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Class TicketType
 * @package Renatio\Support\Models
 */
class TicketType extends Model
{

    use Validation;
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = 'renatio_support_ticket_types';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'is_active'];

    /**
     * @var array
     */
    public $attributeNames = [
        'name'        => 'renatio.support::lang.field.name',
        'description' => 'renatio.support::lang.field.description',
        'is_active'   => 'renatio.support::lang.field.is_active'
    ];

    /**
     * @var array
     */
    public $rules = [
        'name'        => 'required|max:100',
        'description' => 'max:255',
        'is_active'   => 'boolean'
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

}
