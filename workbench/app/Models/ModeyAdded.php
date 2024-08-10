<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class MoneyAdded extends Model
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
        'accound_id' => 'string',
        'amount' => 'float',
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