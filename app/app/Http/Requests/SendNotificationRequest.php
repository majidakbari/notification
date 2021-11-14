<?php

namespace App\Http\Requests;

use App\Entities\Notification;
use App\Rules\IranianPhoneNumberValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'to' => ['required', 'string', 'max:60', $this->getToValidationRule()],
            'name' => ['required', 'string', 'max:60'],
            'message' => ['required', 'string', 'max:10000'],
            'type' => ['required', Rule::in(Notification::getAllValidTypes())]
        ];
    }

    private function getToValidationRule(): string | IranianPhoneNumberValidationRule | null
    {
        $type = $this->get('type');
        if (!in_array($type, Notification::getAllValidTypes())) {
            return null;
        }
        return $type === Notification::TYPE_SMS_LABEL ? new IranianPhoneNumberValidationRule() : 'email';
    }
}
