<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;

class AuditLogger
{
    public static function log(
        User $admin,
        string $action,
        string $targetType,
        ?int $targetId,
        string $description
    ): void {
        AuditLog::create([
            'user_id' => $admin->id,
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'description' => $description,
            'created_at' => now(),
        ]);
    }
}
