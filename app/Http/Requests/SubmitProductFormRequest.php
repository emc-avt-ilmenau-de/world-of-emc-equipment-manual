<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitProductFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'components' => 'required|array',
            'components.*' => 'array',
            'components.*.*' => 'string', // Adjust based on the exact structure of your components
        ];
    }

    // Method to process components and prepare selected items
    public function process()
    {
        return $this->input('components', []);
    }
}
