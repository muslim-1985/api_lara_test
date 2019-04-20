<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json(compact('articles'), 200);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        Article::create([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);
        return response()->json(['message' => 'article successfully created'], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        try {
            $article = Article::findOrFail($id);
            $article->update([
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);
            return response()->json(['message' => 'article successfully updated'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'article not found'], 500);
        }
    }

    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);
            return response()->json(compact('article'), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'article not found'], 500);
        }
    }

    public function delete($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json(['message' => 'Your article has been successfully deleted'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'article not found'], 500);
        }
    }
}
