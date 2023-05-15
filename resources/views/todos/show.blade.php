@extends('layouts.app')

@section('content')

<div class="todo">
    <div class="title">
        <p>タイトル</p>
        <p class="todo__title">{{ $todo->title }}</p>
    </div>

    <div class="content">
        <p>コンテンツ</p>
        <p class="todo__content">{{ $todo->content }}</p>

    </div>



    <div class="todo__actions">
        <a class="todo__edit-btn" href="{{ route('todo.edit', ['id' => $todo->id]) }}">編集</a>

        <form class="todo__delete-form" method="POST" action="{{ route('todo.destroy', ['todo' => $todo->id]) }}">
            @csrf
            @method('DELETE')
            <button class="todo__delete-btn"  onclick="return confirm('削除してもよろしいですか？')" type="submit">削除</button>
        </form>
    </div>
</div>


@endsection

<style>

.title{
    border: 1px solid #ccc;
    padding-bottom:30px;
    padding:30px;
}

.title :first-child{
    font-weight: bold;
}

.content{
    border: 1px solid #ccc;
    padding-bottom:30px;
    padding:30px;
}

.content :first-child{
    font-weight: bold;
}

.todo {

    padding: 10px;
    margin-bottom: 10px;
}

.todo__title {
    font-size: 24px;
    margin-bottom: 5px;
}

.todo__content {
    font-size: 16px;
    margin-bottom: 10px;
}

.todo__actions {
    display: flex;
    align-items: center;
}

.todo__edit-btn,
.todo__delete-btn {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    background-color: #f0f0f0;
    color: #333;
    text-decoration: none;
    margin-right: 10px;
    font-size: 14px;
    transition: background-color 0.2s ease-in-out;
}

.todo__edit-btn:hover,
.todo__delete-btn:hover {
    background-color: #e0e0e0;
}

.todo__delete-form {
    margin: 0;
}

.todo__delete-btn {
    background-color: #ff6666;
    color: #fff;
    transition: background-color 0.2s ease-in-out;
}

.todo__delete-btn:hover {
    background-color: #ff4d4d;
}


</style>