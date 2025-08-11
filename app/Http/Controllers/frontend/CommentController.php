<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display comments for a specific multimedia
     */
    public function index(Request $request, $multimediaId)
    {
        $multimedia = Multimedia::findOrFail($multimediaId);
        
        $comments = $multimedia->comments()
            ->with('user:id,name,foto')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('home.multimedia.comments', compact('multimedia', 'comments'));
    }

    /**
     * Store a new comment
     */
    public function store(Request $request, $multimediaId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan komentar');
        }

        $request->validate([
            'content' => 'required|string|min:3|max:1000'
        ], [
            'content.required' => 'Komentar tidak boleh kosong',
            'content.min' => 'Komentar minimal 3 karakter',
            'content.max' => 'Komentar maksimal 1000 karakter'
        ]);

        $multimedia = Multimedia::findOrFail($multimediaId);

        Comment::create([
            'user_id' => Auth::id(),
            'multimedia_id' => $multimedia->id,
            'content' => $request->content
        ]);

        return redirect()->route('frontend.multimedia.show', $multimedia->id)
            ->with('success', 'Komentar berhasil ditambahkan');
    }

    /**
     * Update a comment
     */
    public function update(Request $request, $commentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit komentar');
        }

        $comment = Comment::findOrFail($commentId);

        // Check if user owns the comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda hanya bisa mengedit komentar sendiri');
        }

        $request->validate([
            'content' => 'required|string|min:3|max:1000'
        ], [
            'content.required' => 'Komentar tidak boleh kosong',
            'content.min' => 'Komentar minimal 3 karakter',
            'content.max' => 'Komentar maksimal 1000 karakter'
        ]);

        $comment->update([
            'content' => $request->content
        ]);

        return redirect()->route('frontend.multimedia.show', $comment->multimedia_id)
            ->with('success', 'Komentar berhasil diperbarui');
    }

    /**
     * Delete a comment
     */
    public function destroy($commentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menghapus komentar');
        }

        $comment = Comment::findOrFail($commentId);

        // Check if user owns the comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda hanya bisa menghapus komentar sendiri');
        }

        $multimediaId = $comment->multimedia_id;
        $comment->delete();

        return redirect()->route('frontend.multimedia.show', $multimediaId)
            ->with('success', 'Komentar berhasil dihapus');
    }


}