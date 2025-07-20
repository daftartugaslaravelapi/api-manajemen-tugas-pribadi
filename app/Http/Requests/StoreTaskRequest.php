<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Izinkan jika user sudah login
        return true;
    }

    public function rules(): array
    {
        return [
            // Atribut 'judul' wajib diisi
            'judul' => 'required|string|max:255',
            // 'deskripsi' tidak wajib
            'deskripsi' => 'nullable|string',
        ];
    }
}
