<?php

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Inmanturbo\Instances\Facades\Instances;
use Workbench\App\Models\UserCreatedEvent;
use Workbench\App\Models\UserNameChangedEvent;

beforeEach(function () {

    Schema::create('users', function ($table) {
        $table->uuid('id')->primary();
        $table->string('name');
        $table->timestamps();
    });

    $this->userModel = new class extends \Illuminate\Database\Eloquent\Model
    {
        use HasUuids;

        protected $table = 'users';

        protected $guarded = [];
    };

    Event::listen('eloquent.created: '. UserCreatedEvent::class, function ($model) {
        $this->userModel->create([
            'id' => $model->user_id,
            'name' => $model->name,
        ]);
    });

    Event::listen('eloquent.created: '. UserNameChangedEvent::class, function ($model) {
        $this->userModel->where('id', $model->user_id)->update([
            'name' => $model->name,
        ]);
    });

});

it('creates a user when a UserCreatedEvent is stored', function () {
    UserCreatedEvent::create([
        'name' => 'John Doe',
        'user_id' => 'fake-uuid',
    ]);

    expect(Instances::instanceModel()::count())->toBe(1);
    expect($this->userModel->count())->toBe(1);
    expect($this->userModel->first()->name)->toBe('John Doe');
    expect($this->userModel->first()->id)->toBe('fake-uuid');
});

it('updates a user when a UserNameChangedEvent is stored', function () {
    UserCreatedEvent::create([
        'name' => 'John Doe',
        'user_id' => 'fake-uuid',
    ]);

    expect(Instances::instanceModel()::count())->toBe(1);
    
    UserNameChangedEvent::create([
        'user_id' => 'fake-uuid',
        'name' => 'Jane Doe',
    ]);

    expect(Instances::instanceModel()::count())->toBe(2);

    expect($this->userModel->count())->toBe(1);
    expect($this->userModel->first()->fresh()->name)->toBe('Jane Doe');
    expect($this->userModel->first()->id)->toBe('fake-uuid');
});