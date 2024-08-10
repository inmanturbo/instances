<?php

namespace Workbench\App\Models;

use Inmanturbo\Instances\Facades\Instances;

class UserNameChangedEvent extends UserCreatedEvent
{
    public static function find($userId)
    {
        $values = Instances::instanceModel()::where('key', $userId)
            ->latest('tally')
            ->first()
            ->values;

        $model = new static;

        $model->setRawAttributes($values);

        $model->save();

        return $model;
    }
}
