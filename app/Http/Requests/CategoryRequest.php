<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $model = $this->route('category');

        return [
            'parentId' => ['bail', 'nullable', 'integer', Rule::exists(Category::class, 'id')->whereNull('parent_id')],
            'name' => ['bail', 'required', 'string', 'max:255'],
            'slug' => ['bail', 'required', 'string', 'max:255', Rule::unique(Category::class)->ignore($model->id ?? null)],
            'active' => ['bail', 'boolean'],
        ];
    }
}
