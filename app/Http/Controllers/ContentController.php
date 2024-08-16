<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'product_id' => ['required', 'string', 'unique:products'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'in:published,draft'],
            'content_type' => ['nullable', 'in:text,video, image, video/image'],
            'video_url' => ['nullable', 'string'],
            'custom_content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'rank' => ['nullable', 'string'],
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->product_id = $request->product_id;
        $content->status = 'published';
        $content->video_url = $request->video_url;
        $content->custom_content = $request->custom_content;
        if ($request->video_url && $request->hasFile('image')) {
            $content->content_type = 'video/image';
        } else if ($content->image && !$request->hasFile('image')) {
            $content->content_type = 'image';
        } else {
            $content->content_type = 'text';
        }
        $content->description = $request->description;
        $maxRank = Content::where('product_id', $request->product_id)->max('rank');
        $content->rank = $maxRank + 1;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/contents', 'public');
            $content->image = $imagePath;
        }
        $content->save();

        return redirect()->back()->with('success', 'Conteúdo criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'in:published,draft'],
            'content_type' => ['nullable', 'in:text,video, image, video/image'],
            'video_url' => ['nullable', 'string'],
            'custom_content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'rank' => ['nullable', 'string'],
        ]);

        $content = Content::findOrFail($id);
        $content->title = $request->title;
        $content->description = $request->description;
        $content->content_type = $request->content_type;
        $content->status = $content->status;
        $content->video_url = $request->video_url;
        $content->custom_content = $request->custom_content;
        if ($request->video_url && $request->hasFile('image')) {
            $content->content_type = 'video/image';
        } else if ($content->image && !$request->hasFile('image')) {
            $content->content_type = 'image';
        } else {
            $content->content_type = 'text';
        }
        if ($request->hasFile('image')) {
            // Excluir a imagem antiga se existir
            if ($content->image) {
                Storage::disk('public')->delete($content->image);
            }
            $imagePath = $request->file('image')->store('uploads/contents', 'public');
            $content->image = $imagePath;
        }
        $content->save();

        return redirect()->back()->with('success', 'Conteúdo atualizado com sucesso. ');
    }
    public function find($id)
    {
        $content = Content::findOrFail($id);
        return view('products.edit-content', compact('content'));
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }
        $content->delete();

        return redirect()->back()->with('success', 'Conteúdo deletado com sucesso.');
    }

    public function moveUp($id)
    {
        $content = Content::findOrFail($id);
        $previousContent = Content::where('rank', '<', $content->rank)->orderBy('rank', 'desc')->first();

        if ($previousContent) {
            $previousRank = $previousContent->rank;
            $previousContent->rank = $content->rank;
            $previousContent->save();

            $content->rank = $previousRank;
            $content->save();
        }

        return redirect()->back();
    }

    public function moveDown($id)
    {
        $content = Content::findOrFail($id);
        $nextContent = Content::where('rank', '>', $content->rank)->orderBy('rank', 'asc')->first();

        if ($nextContent) {
            $nextRank = $nextContent->rank;
            $nextContent->rank = $content->rank;
            $nextContent->save();

            $content->rank = $nextRank;
            $content->save();
        }

        return redirect()->back();
    }
    public function updateStatus($id, Request $request)
    {
        $content = Content::findOrFail($id);

        $content->status = $request->has('status') ? 'published' : 'draft';
        $content->save();

        return redirect()->back()->with('success', 'Status do conteúdo atualizado com sucesso!');
    }
}
