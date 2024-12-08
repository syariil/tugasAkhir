<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Highlight::query();
        if ($request->has('search') && !empty($request->search)) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        $highlight = $query->paginate(2);
        $highlight->appends(['search' => $request->search]);

        return view('backend.highlight.index', ['highlight' => $highlight]);
    }

    public function add()
    {
        return view('backend.highlight.add');
    }

    public function store(Request $request)
    {
        // dd($request);
        $input = $request->validate([
            'judul' => 'required|string',
            'url' => 'required|string',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
        ]);

        $input = $request->except('_token');

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnail = time() . '_'  . '_thumbnail.' . $request->file('thumbnail')->extension();
            $request->file('thumbnail')->storeAs('public/image/thumbnail', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }


        Highlight::create($input);
        return redirect()->route('highlight.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Highlight $id)
    {
        return view('backend.highlight.edit', ['highlight' => $id]);
    }

    public function update(Highlight $id, Request $request)
    {
        $input = $request->validate([
            'judul' => 'required|string',
            'url' => 'required|string',
            'thumbnail' => 'nullable',
        ]);

        $input = $request->except('_token');

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnail = time() . '_'  . '_thumbnail.' . $request->file('thumbnail')->extension();
            if (Storage::exists('public/image/thumbnail/' . $id->thumbnail)) {
                Storage::delete('public/image/thumbnail/' . $id->thumbnail);
            }
            $request->file('thumbnail')->storeAs('public/image/thumbnail', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }
        $id->update($input);
        return redirect()->route('highlight.index')->with('success', 'Data berhasil diupdate');
    }

    public function delete(Highlight $id)
    {
        if (Storage::exists('public/image/thumbnail/' . $id->thumbnail)) {
            Storage::delete('public/image/thumbnail/' . $id->thumbnail);
        }
        $id->delete();
        return redirect()->route('highlight.index')->with('success', 'Data berhasil dihapus');
    }
}
