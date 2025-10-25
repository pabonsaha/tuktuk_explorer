<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'thumbnail'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Max 2MB
            'tour_duration'     => ['required', 'string', 'max:100'],
            'starting_price'    => ['required', 'numeric', 'min:0'],
            'num_of_people'     => ['required', 'integer', 'min:1'],
            'note'              => ['nullable', 'string'],

            // Dynamic List Fields (JSON Fields in the Blade template)
            'specifications'        => ['nullable', 'array'],
            'specifications.*'      => ['required', 'string', 'max:255'],

            'requirements'          => ['nullable', 'array'],
            'requirements.*'        => ['required', 'string', 'max:255'],

            'tour_highlights'       => ['nullable', 'array'],
            'tour_highlights.*'     => ['required', 'string', 'max:255'],

            // Meeting Point (Array of objects)
            'meeting_point'         => ['nullable', 'array'],
            'meeting_point.*.name'  => ['required', 'string', 'max:255'],
            'meeting_point.*.link'  => ['nullable', 'url', 'max:500'], // Assuming link is a URL

            // Dynamic Tour Images (Multiple Files)
            'images'                => ['nullable', 'array'],
            'images.*'              => ['image', 'required','mimes:jpeg,png,jpg,webp', 'max:2048'], // Each image is max 2MB
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
