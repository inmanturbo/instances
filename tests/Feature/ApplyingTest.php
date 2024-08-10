<?php

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Schema;
use Inmanturbo\Instances\Facades\Instances;
use Inmanturbo\Instances\Models\Instance;
use Inmanturbo\Modelware\Facades\Modelware;
use Workbench\App\Models\AccountCreated;
use Workbench\App\Models\AccountData;
use Workbench\App\Models\MoneyAdded;

beforeEach(function () {

    Schema::create('accounts', function ($table) {
        $table->uuid('id')->primary();
        $table->string('name');
        $table->integer('balance')->default(0);
        $table->timestamps();
    });

    $this->accountModel = new class extends Illuminate\Database\Eloquent\Model
    {
        use HasUuids;

        protected $table = 'accounts';

        protected $guarded = [];
    };

    Modelware::add('eloquent.created: '.AccountData::class, [
        function ($data, Closure $next) {
            $data->model->balance = 0;

            foreach (Instances::instanceModel()::where('key', $data->model->getKey())->get() as $event) {
                match ($event->model) {
                    MoneyAdded::class => $data->model->balance += $event->values['amount'],
                    default => null,
                };
            }

            return $next($data);
        },
    ]);

    Modelware::add('eloquent.created: '.AccountCreated::class, [
        function ($data, Closure $next) {
            $this->accountModel::create([
                'id' => $data->model->account_id,
                'name' => $data->model->name,
            ]);

            return $next($data);
        },
    ]);

    Modelware::add('eloquent.created: '.MoneyAdded::class, [
        function ($data, Closure $next) {
            $account = $this->accountModel::where('id', $data->model->account_id)
                ->first();

            $account->balance += $data->model->amount;

            $account->save();

            return $next($data);
        },
    ]);
});

it('will record the account creation event', function () {
    $ac = AccountCreated::create([
        'account_id' => 'fake-account-id',
        'name' => 'cash',
    ]);

    expect(Instance::where('key', 'fake-account-id')->exists())->toBeTrue();

    expect(AccountData::create([
        'account_id' => 'fake-account-id',
    ])->balance)->toBe(0);

    expect($this->accountModel::where('id', 'fake-account-id')->exists())->toBeTrue();
});

it('will not record the account creation event if the account already exists', function () {

    AccountCreated::create([
        'account_id' => 'fake-account-id',
        'name' => 'cash',
    ]);

    AccountCreated::create([
        'account_id' => 'fake-account-id',
        'name' => 'cash',
    ]);

    expect(Instance::where('key', 'fake-account-id')->count())->toBe(1);
});

it('will add the money to the account', function () {
    AccountCreated::create([
        'account_id' => 'fake-account-id',
        'name' => 'cash',
    ]);

    MoneyAdded::create([
        'account_id' => 'fake-account-id',
        'amount' => 100,
    ]);

    expect(AccountData::create([
        'account_id' => 'fake-account-id',
    ])->balance)->toBe(100);

    expect($this->accountModel::where('id', 'fake-account-id')->first()->balance)->toBe(100);
});
