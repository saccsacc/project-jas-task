<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the task is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $validate = [
            'title' => 'required|string|min:2|max:150',
            'description' => 'required|string',
            'status' => 'required|in:pending,in-progress,complete',
            'user_id' => 'required|integer',
            'due_date' => 'nullable|date',
        ];

        if($this->method() ==='PUT')
            $validate['updated_at'] = 'required|date';

        return $validate;
    }
}
