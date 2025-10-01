<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        //ユーザーIDを追加
        $validated['user_id'] = Auth::id();

        //投稿をデータベースに保存
        $post = Post::create($validated);

        //セッションにメッセージを保存してリダイレクト
        $request->session()->flash('message', '保存しました！');
        return redirect()->route('posts.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // 投稿者以外は編集不可
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を編集する権限がありません。');
        }
        
        return view('posts.edit', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // 投稿者以外は更新不可
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を更新する権限がありません。');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        //投稿を更新
        $post->update($validated);

        //セッションにメッセージを保存してリダイレクト
        $request->session()->flash('message', '更新しました');
        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        // 投稿者以外は削除不可
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を削除する権限がありません。');
        }

        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('posts.index');
    }
    
    public function search(Request $request)
    {
        // 検索クエリ（URLの ?q=... 部分）を取得
        $query = $request->input('q');

        // Laravel Scoutの search() メソッドを使ってMeiliSearchに問い合わせ
        $posts = Post::search($query)
                     // ページネーションもそのまま使えます
                     ->paginate(10); 

        // 検索結果ビューに結果とクエリを渡す
        return view('posts.search_results', compact('posts', 'query'));
    }
}
