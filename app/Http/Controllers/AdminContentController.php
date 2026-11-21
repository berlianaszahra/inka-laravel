<?php

namespace App\Http\Controllers;

use App\Models\AdminContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:150'],
            'category' => ['nullable', 'in:haki,hpp'],
            'edit' => ['nullable', 'integer', 'min:1'],
        ]);

        $search = $filters['q'] ?? '';
        $category = $filters['category'] ?? '';
        $editing = isset($filters['edit'])
            ? AdminContent::findOrFail($filters['edit'])
            : null;

        $contents = AdminContent::query()
            ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->latest('updated_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->appends(['q' => $search, 'category' => $category]);

        return view('admin.index', compact('contents', 'editing', 'search', 'category'));
    }

    public function store(Request $request): RedirectResponse
    {
        AdminContent::create($this->validatedContent($request));

        return redirect()->route('admin.index')->with('status', 'Materi berhasil ditambahkan.');
    }

    public function update(Request $request, AdminContent $content): RedirectResponse
    {
        $content->update($this->validatedContent($request));

        return redirect()->route('admin.index')->with('status', 'Materi berhasil diperbarui.');
    }

    public function destroy(AdminContent $content): RedirectResponse
    {
        $content->delete();

        return redirect()->route('admin.index')->with('status', 'Materi berhasil dihapus.');
    }

    private function validatedContent(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'in:haki,hpp'],
            'status' => ['required', 'in:draft,terbit'],
            'body' => ['required', 'string', 'max:20000'],
        ], [], ['title' => 'judul', 'category' => 'kategori', 'body' => 'isi materi']);
    }
}