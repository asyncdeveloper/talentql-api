<?php

namespace App\Http\Requests;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        if ($this->getMethod() === 'POST') {
            return $user->can('create', Todo::class);
        } elseif ($this->getMethod() === 'PATCH') {
            return $user->can('update', $this->todo);
        } elseif ($this->getMethod() === 'DELETE') {
            return $user->can('delete', $this->todo);
        }
        return $user->can('view', $this->todo);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->getMethod() === 'PATCH') {
            return [
                'title' => 'nullable|string|min:3|max:191',
                'body' => 'nullable|string',
                'due_date' => 'nullable|date_format:Y-m-d H:i:s|after:now',
                'is_completed' => 'nullable|boolean',
                'project_id' => [
                    'nullable',
                    Rule::exists('projects', 'id')->where(function ($query) {
                        $query->whereUserId($this->user()->id);
                    })
                ]
            ];
        }

        if($this->getMethod() === 'POST') {
            return [
                'title' => 'required|string|min:3|max:191',
                'body' => 'nullable|string',
                'due_date' => 'nullable|date_format:Y-m-d H:i:s|after:now',
                'project_id' => [
                    'nullable',
                    Rule::exists('projects', 'id')->where(function ($query) {
                        $query->whereUserId($this->user()->id);
                    })
                ]
            ];
        }

        return [];
    }

    public function validated() {
        return array_merge($this->validator->validated(), [
            'user_id' => $this->user()->id,
            'is_completed' => $this->get('is_completed') ?? false
        ]);
    }
}
