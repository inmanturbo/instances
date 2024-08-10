<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class AccountCreated extends Model
{
    use Sushi;

    public bool $shouldKeepInstance = true;

    public $tallyLimit = 1;

    public $timestamps = true;

    public $incrementing = false;

    protected $hidden = [
        //
    ];

    protected $guarded = [];

    protected $schema = [
        'name' => 'string',
        'account_id' => 'string',
        'balance' => 'float',
    ];

    public function getKeyName()
    {
        return 'account_id';
    }

    protected $rows = [
        //
    ];

    public function sushishouldCache()
    {
        return false;
    }
}
