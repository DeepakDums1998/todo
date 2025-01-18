<?php

// app/Http/Requests/UpdateTodoItemStatusRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoItemStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Allow all users to update the status
        // You can add authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => 'required|in:completed,skipped,active', // Validate that the status is one of the accepted values
        ];
    }

    /**
     * Customize the response for failed validation.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be one of: completed, skipped, or active.',
        ];
    }
}
