<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'company'         => ['nullable'],
            'bio'             => ['nullable'],
            'profile_picture' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }

    public function handlePictureRequest()
    {
        $profile = $this->user();
        $profileData = $this->validated();

        if ($this->hasFile('profile_picture')) {
            $picture = $this->profile_picture;

            $fileName = "profilePicture{$profile->id}." . $picture->getClientOriginalExtension();

            // $picture->move(
            // public_path('upload'),
            // $fileName);

            // $fileName = Storage::putFileAs('uploads', $picture, $fileName);
            $fileName = $picture->storeAs('uploads', $fileName);

            $profileData['profile_picture'] = $fileName;
        }
        return $profileData;
    }
}
