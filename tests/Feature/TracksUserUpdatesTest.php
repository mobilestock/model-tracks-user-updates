<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mobilestock\ModelTracksUserUpdates\TracksUserUpdates;

class TestModel extends Model
{
    use TracksUserUpdates;

    protected $fillable = ['name', 'updated_by_user'];
}

class TestModelWithoutFillable extends Model
{
    use TracksUserUpdates;

    protected $fillable = ['name'];
}

beforeEach(function () {
    Auth::shouldReceive('id')->andReturn(1)->byDefault();
});

dataset('userId', ['logged in' => 1, 'logged out' => null]);

it('should fill updated_by_user when creating a new model if the field is fillable', function (?int $loggedUser) {
    Auth::shouldReceive('id')->andReturn($loggedUser);

    $model = new TestModel();
    $model->save();

    expect($model->updated_by_user)->toBe($loggedUser);
})->with('userId');

it('should update updated_by_user when updating an existing model if the field is fillable', function () {
    Auth::shouldReceive('id')->andReturn(2);

    $model = new TestModel();
    $model->exists = true;
    $model->id = 1;
    $model->name = 'Test';
    $model->save();

    expect($model->updated_by_user)->toBe(2);
});

it('should not overwrite updated_by_user if it is already defined', function () {
    Auth::shouldReceive('id')->andReturn(1);

    $model = new TestModel();
    $model->updated_by_user = 5;
    $model->save();

    expect($model->updated_by_user)->toBe(5);
});
