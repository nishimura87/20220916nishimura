<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Todo List</title>
  </head>
  <body>
    <div class="content">
      <div class="todo_list">
        <div class="top_con">
          <h1 class="title">Todo List</h1>
          @if (Auth::check())
          <div class="top_cont_right">
            <p class='login_con'>「{{ $user->name }}」でログイン中</p>
          @endif
          <form action="{{ route('logout') }}" method="POST">
            @csrf
          <button type="submit" class="btn-logout">ログアウト</button>
          </form>
          </div>  
        </div>
        <a class="btn-find" href="{{ route('find') }}">タスク検索</a>
        @if (count($errors) > 0)
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
          @endif
        <form action="/add" method="POST"class="input_task">
          @csrf
          <input type="text" class="input_add" name="task_name">
          <select class="tag_id" name="tag_id">
          @foreach(config('pref') as $tag => $tag_id)
            <option value="{{ $tag_id }}">{{ $tag_id }}</option>
          @endforeach
          </select>
          <input class="btn-add" type="submit" value="追加">
        </form>
        <table calss = "table table-todo">
          <tr>
            <th>作成日</th>
            <th>タスク名</th>
            <th>更新</th>
            <th>削除</th>
          </tr>
          @foreach ($todos as $todo)
          <tr>
            <td>{{ $todo->created_at }}</td>
            <form action="{{ route('todo.update', ['id'=>$todo->id]) }}" method="POST">
            @csrf
            <td>
            <input type ="hidden" name="id" value="{{ $todo->id }}">
            <input type="text" name="task_name"  id="task_name" value="{{ $todo->task_name }}" class=task_con></td>
            <select class="tag_name" name="tag_name" id="tag_name" value="{{ $tag->tag->getTagname() }}" >
            <td><button type="submit" class="btn-update">更新</button></td>
            </form>
            <td>
              <form action="{{ route('todo.delete', ['id'=>$todo->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn-delete">削除</button>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </body>
</html>