<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            return $user->can('create', Project::class);
        } elseif ($this->getMethod() === 'PATCH') {
            return $user->can('update', $this->project);
        } elseif ($this->getMethod() === 'DELETE') {
            return $user->can('delete', $this->project);
        }
        return $user->can('view', $this->project);
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
                'name' => 'nullable|string|min:3|max:191',
                'description' => 'nullable|string|min:3|max:191'
            ];
        }

        if($this->getMethod() === 'POST') {
            return [
                'name' => 'required|string|min:3|max:191',
                'description' => 'nullable|string|min:3|max:191'
            ];
        }

        return [];
    }

    public function validated() {
        return array_merge($this->validator->validated(), [
            'user_id' => $this->user()->id
        ]);
    }
}
