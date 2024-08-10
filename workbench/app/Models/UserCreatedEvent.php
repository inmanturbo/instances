<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class UserCreatedEvent extends Model
{
    use Sushi;

    public bool $shouldKeepInstance = true;

    public $timestamps = true;

    public $incrementing = false;

    protected $hidden = [
        'user_id',
        'guid',
    ];

    protected $guarded = [];

    protected $schema = [
        'name' => 'string',
        'user_id' => 'string',
        'guid' => 'string',
    ];

    public function getKeyName()
    {
        return 'user_id';
    }

    protected $rows = [
        //
    ];
}