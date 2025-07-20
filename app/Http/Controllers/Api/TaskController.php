<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

// Import Form Requests yang sudah dibuat
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Menampilkan daftar semua tugas milik pengguna yang sedang login.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->get();
        return response()->json($tasks);
    }

    /**
     * Menyimpan tugas baru ke dalam database.
     */
    public function store(StoreTaskRequest $request)
    {
        // Membuat tugas baru yang otomatis terhubung dengan user yang sedang login
        $task = Auth::user()->tasks()->create($request->validated());

        // Mencatat log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'create_task',
            'keterangan' => "Membuat tugas baru: '{$task->judul}'"
        ]);

        return response()->json($task, 201);
    }

    /**
     * Menampilkan detail dari satu tugas spesifik.
     */
    public function show(Task $task)
    {
        // PENTING: Cek otorisasi, pastikan user hanya bisa melihat tugas miliknya
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        return response()->json($task);
    }

    /**
     * Memperbarui data tugas yang sudah ada.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // PENTING: Cek otorisasi
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        // Update task dengan data yang sudah tervalidasi
        $task->update($request->validated());

        // Mencatat log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'update_task',
            'keterangan' => "Memperbarui tugas: '{$task->judul}'"
        ]);

        return response()->json($task);
    }

    /**
     * Menghapus tugas dari database.
     */
    public function destroy(Task $task)
    {
        // Cek otorisasi
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $taskTitle = $task->judul; // Simpan judul sebelum dihapus untuk log
        $task->delete();

        // Mencatat log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'delete_task',
            'keterangan' => "Menghapus tugas: '{$taskTitle}'"
        ]);

        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }

    /**
     * Mencari tugas berdasarkan kata kunci.
     */
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);

        $keyword = $request->keyword;

        $tasks = Auth::user()->tasks()
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%");
            })
            ->latest()
            ->get();

        // Jika koleksi (hasil) tidak kosong, kembalikan datanya.
        if ($tasks->isNotEmpty()) {
            return response()->json($tasks);
        }

        // Jika kosong, kembalikan pesan 'not found'.
        return response()->json([
            'message' => 'Tugas tidak ditemukan.'
        ], 404);
    }
}
