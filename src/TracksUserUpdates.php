<?php

namespace Mobilestock\ModelTracksUserUpdates;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait TracksUserUpdates
{
    public static function bootTracksUserUpdates(): void
    {
        static::creating([self::class, 'updateUserId']);
        static::updating([self::class, 'updateUserId']);
    }

    public function updateUserId(Model $model): void
    {
        $model->updated_by_user ??= Auth::id();
    }
}
