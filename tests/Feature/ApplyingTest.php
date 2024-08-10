<?php

use Inmanturbo\Instances\Models\Instance;
use Workbench\App\Models\AccountCreated;

it('will record the account creation event', function () {
    AccountCreated::create([
        'account_id' => 'fake-account-id',
        'name' => 'cash',
    ]);

    expect(Instance::where('key', 'fake-account-id')->exists())->toBeTrue();
});