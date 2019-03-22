<?php namespace Nocio\Outbox\Models;

use Model;

/**
 * Model
 */
class Outmail extends Model
{

    use \October\Rain\Database\Traits\Validation;

    protected $guarded = ['id'];

    public $rules = [
        'recipients' => 'required'
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'nocio_outbox_mails';

}