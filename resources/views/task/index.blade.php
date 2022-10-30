<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
 
    
</head>
 
<body class="flex flex-col min-h-[100vh]">

        <h1>ToDo投稿</h1>
        <div class="top"><a href='{{route('home.index')}}'>TOPへ</a></div>
        <form action="{{route('task.store')}}" method="POST">
            @csrf
            <div class="task">
                <h2>タイトル</h2>
                <input type="text" name="task[task]" placeholder="タイトル"　value="{{ old('task.task') }}"/>
                @error('task.task')
                    <div class='mt-3'>
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                @enderror
                <h2>締切</h2>
                <input type="datetime-local" name="task[limit]" value="{{ old('task.limit') }}">
                @error('task.limit')
                    <div class='mt-3'>
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                @enderror
                <h2>メモ</h2>
                <textarea type="datetime-local" name="task[memo]" value="{{ old('task.memo') }}"></textarea>
            </div>
            <input type="submit" value="保存"/>
        </form>
        
        <h1>タスク一覧</h1>
        @if($tasks->isEmpty())
        <p>現在のタスクはありません</p>
        @else
        
        @foreach ($tasks as $item)
            <tr>
                <td class="px-3 py-4 text-sm text-gray-500">
                    <div>
                        {{ $item->task }}
                    </div>
                    <div>
                        {{date('Y年n月j日 g:i', strtotime($item->limit))}}
                    </div>
                    <div>
                        {{ $item->memo }}
                    </div>
                </td>
                <td class="p-0 text-right text-sm font-medium">
                    <div class="flex justify-end">
                        <div>
                            <form action="{{ route('task.update', $item->id) }}"
                                method="post"
                                class="inline-block text-gray-500 font-medium"
                                role="menuitem" tabindex="-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{$item->status}}">
                                <button type="submit"
                                 class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerald-800 transition-colors">完了</button>
                            </form>
                        </div>
                        <div>
                            <a href="{{ route('task.edit', $item->id) }}"
                                class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                        </div>
                        <div>
                            <form onsubmit="return deleteTask()"
                                action="{{ route('task.destroy', $item->id) }}" method="post"
                                class="inline-block text-gray-500 font-medium"
                                role="menuitem" tabindex="-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        @endif
    <script>
        function deleteTask() {
            if (confirm('本当に削除しますか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>
 
</html>