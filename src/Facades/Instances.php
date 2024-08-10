<?php

namespace Inmanturbo\Instances\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string instanceModel()
 * @method static \Inmanturbo\Instances\Models\Instance newInstanceModel()
 * @method static bool isDisabled()
 * @method static void disable()
 * @method static void enable()
 * @method static void bootListeners()
 * @method static void listenForCreatingEvents()
 * @method static void listenForUpdatingEvents()
 * @method static void listenForDeletingEvents()
 * @method static void listen(string $event, array $pipes)
 *
 * @see \Inmanturbo\Instances\Instances
 */
class Instances extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Inmanturbo\Instances\Instances::class;
    }
}
