<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class AccountCreated extends Model
{
    use Sushi;

    public bool $shouldKeepInstance = true;

    public $timestamps = true;

    public $incrementing = false;

    protected $hidden = [
        'account_id',
        'guid',
    ];

    protected $guarded = [];

    protected $schema = [
        'name' => 'string',
        'accound_id' => 'string',
        'balance' => 'float',
        'guid' => 'string',
    ];

    public function getKeyName()
    {
        return 'account_id';
    }

    protected $rows = [
        //
    ];
}