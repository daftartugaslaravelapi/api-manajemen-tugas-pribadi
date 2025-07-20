<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'sometimes' berarti validasi hanya berjalan jika field ini dikirim
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status_selesai' => 'sometimes|boolean',
        ];
    }
}
