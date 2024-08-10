<?php

namespace Inmanturbo\Instances\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;

/**
 * @property array $values
 * @property string $model
 * @property Carbon $created_at
 */
class Instance extends Model
{
    use MassPrunable;

    public $casts = [
        'values' => 'array',
    ];

    public $guarded = [];

    public $table = 'instances';

    /** @return class-string<Model> */
    protected function getInstanceClass(): string
    {
        return Relation::getMorphedModel($this->model) ?? $this->model;
    }

    public function makeInstance(): Model
    {
        $modelClass = $this->getInstanceClass();

        return (new $modelClass)->forceFill($this->values);
    }

    public function value(?string $key = null): mixed
    {
        return Arr::get($this->values, $key);
    }

    protected function prunable()
    {
        $days = config('instances.prune_after_days');

        return static::where('created_at', '<=', Carbon::now()->subDays($days)->format('Y-m-d H:i:s'));
    }

    public function snapshots()
    {
        return $this->hasOne(InstanceSnapshot::class);
    }
}
