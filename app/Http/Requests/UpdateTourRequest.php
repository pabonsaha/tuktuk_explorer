<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTourRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Set this to true if the user is authenticated and authorized to create tours
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tours', 'title')->ignore($this->route('id'))
            ],

            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'tour_duration' => ['required', 'string', 'max:100'],
            'starting_price' => ['required', 'numeric', 'min:0'],
            'num_of_people' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string'],

            'specifications' => ['nullable', 'array'],
            'specifications.*' => ['required', 'string', 'max:255'],

            'requirements' => ['nullable', 'array'],
            'requirements.*' => ['required', 'string', 'max:255'],

            'tour_highlights' => ['nullable', 'array'],
            'tour_highlights.*' => ['required', 'string', 'max:255'],

            'meeting_point' => ['nullable', 'array'],
            'meeting_point.*.name' => ['required', 'string', 'max:255'],
            'meeting_point.*.link' => ['required', 'max:500'],

            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'required', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Get custom attribute names for error messages.
     * This helps display friendly names for array fields (e.g., "Specification 1").
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'specifications.*' => 'specification',
            'requirements.*' => 'requirement',
            'tour_highlights.*' => 'tour highlight',
            'images.*' => 'tour image',
            'meeting_point.*.name' => 'meeting point',
            'meeting_point.*.link' => 'meeting point',
        ];
    }
}
