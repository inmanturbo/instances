<?php

// config for Inmanturbo/Instances
return [

    /*
     * Enable or disable the event listeners.
     */
    'enabled' => env('INSTANCES_ENABLED', true),

    /*
     * The model used to store instances.
     */
    'instance_model' => \Inmanturbo\Instances\Models\Instance::class,

    /*
     * The model used to store snapshots.
     */
    'snapshot_model' => \Inmanturbo\Instances\Models\InstanceSnapshot::class,

    /*
     * The number of days to keep instances.
     */
    'prune_after_days' => 365 * 1000000, // wouldn't delete this in a million years,

    /*
     * The table name used to store instances.
     *
     * Changing it is not supported at this time.
     *
     * It's here for reference and to be used by the `instances:migrate` command.
     */
    'instance_table' => 'instances',

    /*
     * The table name used to store snapshots.
     *
     * Changing it is not supported at this time.
     *
     * It's here for reference and to be used by the `instances:migrate` command.
     */

    'snapshot_table' => 'instance_snapshots',

    /*
     * These tables will be created when running the migration.
     *
     * They will be dropped when running `php artisan instances:migrate --fresh`.
     */
    'migration_tables' => [
        'instances',
        'instance_snapshots',
    ],
];
