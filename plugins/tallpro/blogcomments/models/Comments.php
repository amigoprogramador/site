<?php namespace Tallpro\BlogComments\Models;

use Model;

/**
 * Model
 */
class Comments extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    const STATUS = ['1' => 'Approved', '2' => 'Pending', '3' => 'Spam'];
    /**
     *
     */
    const STATUS_APPROVED = 1;
    const STATUS_PENDING = 2;
    const STATUS_SPAM = 3;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'tallpro_blogcomments_comments';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
       'user' => ['RainLab\User\Models\User']
   ];

}
