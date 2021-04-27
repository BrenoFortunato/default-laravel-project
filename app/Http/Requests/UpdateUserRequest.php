<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        $updateRules = str_replace("id_to_ignore", request()->user_id, User::$rules);
        if (request()->keep_password) {
            unset($updateRules['password']);
        }

        return $updateRules;
    }
}
