<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class AccountData extends Model
{
    use Sushi;

    public $timestamps = true;

    public $incrementing = false;

    protected $guarded = [];

    protected $schema = [
        'account_id' => 'string',
        'name' => 'string',
        'balance' => 'float',
    ];

    public function getKeyName()
    {
        return 'account_id';
    }

    protected $rows = [
        //
    ];
}
