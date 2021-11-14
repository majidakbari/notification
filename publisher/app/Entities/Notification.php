<?php

namespace App\Entities;

use Carbon\Carbon;
use Database\Factories\Entities\NotificationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * @property int $id
 * @property string $to
 * @property string $name
 * @property string $message
 * @property int $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $sent
 *
 * @method static NotificationFactory factory(...$parameters)
 */
class Notification extends Model
{
    use HasFactory;

    public const TYPE_SMS = 1;
    public const TYPE_SMS_LABEL = 'sms';
    public const TYPE_EMAIL = 2;
    public const TYPE_EMAIL_LABEL = 'email';

    protected $table = 'notifications';

    protected $casts = [
        'sent' => 'bool'
    ];

    public static function getTypeDatabaseValue(string $value): int
    {
        return match($value) {
            self::TYPE_SMS_LABEL => self::TYPE_SMS,
            self::TYPE_EMAIL_LABEL => self::TYPE_EMAIL,
            default => throw new InvalidArgumentException()
        };
    }

    public static function getAllValidTypes(): array
    {
        return [
            self::TYPE_SMS_LABEL,
            self::TYPE_EMAIL_LABEL
        ];
    }
}
