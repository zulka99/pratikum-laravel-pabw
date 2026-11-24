<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'content' => ['required', 'string'],

            // File lampiran opsional, maksimal 5 MB (5120 KB)
            'file' => [
                'nullable',
                'file',
                'max:5120',
                'mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip'
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'file.max' => 'Ukuran file maksimal 5 MB.',
            'file.mimes' =>
            'Tipe file harus gambar, PDF, dokumen Office, txt, atau zip.',
            'file.uploaded' => 'File gagal diunggah, periksa ukuran file.',
        ];
    }
}
