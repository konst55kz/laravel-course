<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Comments\Store as StoreRequest;
use App\Http\Requests\Comments\Update as UpdateRequest;

use App\Models\Post;
use App\Models\Video;
use App\Models\Comment;

class Comments extends Controller
{
    const FOR_MODELS = [
        'post' => Post::class,
        'video' => Video::class
    ];

    public function index()
    {
        //
    }

    public function create()
    {
        abort(404);
    }

    public function store(StoreRequest $request)
    {
        $modelName = self::FOR_MODELS[$request->for];
        $model = $modelName::findOrFail($request->id);
        $model->comments()->create($request->only(['text']));
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->validated());
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        //
    }
}
