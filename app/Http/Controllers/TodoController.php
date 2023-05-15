<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use Illuminate\Validation\Rule;

use Carbon\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        // ログイン中のユーザーのIDを取得
        $user_id = Auth::id();

        // ログイン中のユーザーのToDoリストを取得
        $todos = Todo::where('user_id', $user_id)->get();

        // 取得したToDoリストをビューに渡す
        return view('todos.index', compact('todos'));
    }

    public function flag(Request $request, $id)
    {

        $todo = Todo::findOrFail($id);

        $todo->update([
            'flag' => $request->flag
        ]);

        return redirect()->route("todo.index");
    }



    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'deadline' => 'nullable|date',
            'category' => 'nullable'
        ]);

        if (Auth::check()) {
            $todo = new Todo;
            $todo->user_id = Auth::id();
            $todo->title = $request['title'];
            $todo->content = $request['content'];
            $todo->deadline = $request['deadline'];
            $todo->category = $request['category'];
            $todo->flag = 0;
            $todo->save();

            return redirect()->route('todo.index')->with('success', 'タスクが登録されました。');
        } else {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }
    }

    public function show($id)
    {

        $todo = Todo::find($id);

    // ToDoが存在しない場合は404エラーを返す
    if (!$todo) {
        abort(404);
    }

    // ToDoをビューに渡して、ToDoを表示する
    return view('todos.show', ['todo' => $todo]);

    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        return view('todos.edit', compact('todo'));
    }


    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todo.index')
            ->with('success', 'Todo deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        // 対象のToDoを取得
        $todo = Todo::findOrFail($id);

        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'deadline' => 'nullable|date',
            'category' => ['required', Rule::in(['仕事', 'プライベート'])],
        ]);

        // データの整形
        $deadline = $validatedData['deadline'];
        if ($deadline) {
            $validatedData['deadline'] = $deadline . ' 00:00:00';
        } else {
            $validatedData['deadline'] = null;
        }

        // ToDoを更新
        $todo->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'deadline' => $validatedData['deadline'],
            'category' => $validatedData['category'],
        ]);

        // リダイレクト
        return redirect()->route('todo.index')->with('success', 'ToDoを更新しました。');
    }
}
