<?php

use App\Models\HousekeepingPermission;
use App\Models\HousekeepingSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function sensitiveInfo($string)
{
    $len = strlen($string);

    return substr($string, 0, 3) . str_repeat('*', 6) . substr($string, $len - 4, 6);
}

function setting(string $setting): string
{
    return HousekeepingSetting::query()->where('key', '=', $setting)->first()->value ?? '';
}

function hasPermission($user, string $permission): bool
{
    return $user->rank >= HousekeepingPermission::query()
            ->where('permission', '=', $permission)
            ->first()->min_rank;
}