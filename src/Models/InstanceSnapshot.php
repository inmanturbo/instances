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
class InstanceSnapshot extends Model
{
    use MassPrunable;

    public $casts = [
        'values' => 'array',
        'attributes' => 'array',
    ];

    public $guarded = [];

    public $table = 'instance_snapshots';

    /** @return class-string<Model> */
    protected function getInstanceClass(): string
    {
        return Relation::getMorphedModel($this->model) ?? $this->model;
    }

    public function makeRestoredInstance(): Model
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
        $days = config('instances.snapshots.prune_after_days');

        return static::where('created_at', '<=', Carbon::now()->subDays($days)->format('Y-m-d H:i:s'));
    }

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }
}
