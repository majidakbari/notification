<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * @property int $id
 * @property string $to
 * @property string $name
 * @property string $message
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Notification extends Model
{
    use HasFactory;

    public const TYPE_SMS = 1;
    public const TYPE_SMS_LABEL = 'sms';
    public const TYPE_EMAIL = 2;
    public const TYPE_EMAIL_LABEL = 'email';

    protected $table = 'notifications';

    public function getTypeAttribute(int $value): string
    {
        return match($value) {
            self::TYPE_SMS => self::TYPE_SMS_LABEL,
            self::TYPE_EMAIL => self::TYPE_EMAIL_LABEL,
            default => throw new InvalidArgumentException()
        };
    }
}
