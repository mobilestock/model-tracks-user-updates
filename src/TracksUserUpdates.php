<?php

namespace Mobilestock\ModelTracksUserUpdates;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

trait TracksUserUpdates
{
    public static function bootTracksUserUpdates(): void
    {
        static::creating([self::class, 'updateUserId']);
        static::updating([self::class, 'updateUserId']);
    }

    public function updateUserId(Model $model): void
    {
        $user = Auth::user();
        if (empty($user)) {
            throw new RuntimeException('Nenhum usuário autenticado encontrado');
        }

        $userId = $user->id ?? $user->userInfo()['id'];
        $model->updated_by_user ??= $userId;
    }
}
