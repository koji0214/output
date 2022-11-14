@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ToDo投稿</h1>
    <div class="input-group">
        <form action="{{route('task.store')}}" method="POST">
            @csrf
        
            
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="task[task]" placeholder="何をする？" value="{{ old('task.task') }}"/>
                        @error('task.task')
                            <div class='mt-3'>
                                <p class="text-red-500">{{$message}}</p>
                            </div>
                        @enderror
                    </div>
                        
                
                    <div class="col">
                        <input class="form-control" type="datetime-local" name="task[limit]" value="{{ old('task.limit') }}">
                        @error('task.limit')
                            <div class='mt-3'>
                                <p class="text-red-500">{{$message}}</p>
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <select class="form-control" name="task[category]">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <textarea class="form-control ms-2 me-7" name="task[memo]" placeholder="メモ" value="{{ old('task.memo') }}"></textarea>
                </div>
                
            
                <button type="submit" class="btn btn-outline-secondary mt-2 btn-lg">保存</button>
            
        </form>
    </div>
</div>
    
<div class="container mt-2">
    <h1>タスク一覧</h1>
    <div class="container">
        
        @if($tasks->isEmpty())
        <p>現在のタスクはありません</p>
        @else
        
        
            @foreach ($tasks as $item)
            <div class="row p-3 bg-light border mt-1">
                <div class="col-7">
                    <div class="fs-4 fw-bold">
                        {{ $item->task }}
                    </div>
                    <div>
                        {{date('Y年n月j日 g:i', strtotime($item->limit))}}
                    </div>
                    <div>
                        {{ $item->memo }}
                    </div>
                    カテゴリー：<span class="fw-bold">{{$categories[$item->task_category_id]->category_name}}</span>
                </div>
                
                <div class="col-5">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('task.update', $item->id) }}"
                                method="post"
                                class="inline-block text-gray-500 font-medium"
                                role="menuitem" tabindex="-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{$item->status}}">
                                <button type="submit"
                                 class="w-100 py-4 text-primary btn btn-outline-secondary">完了</button>
                            </form>
                        </div>
                            
                        <div class="col">
                            <a class="btn btn-outline-secondary w-100 py-4" href="{{ route('task.edit', $item->id) }}"
                            class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                        </div>
                            
                        <div class="col">
                            <form onsubmit="return deleteTask()"
                                action="{{ route('task.destroy', $item->id) }}" method="post"
                                class="inline-block text-gray-500 font-medium"
                                role="menuitem" tabindex="-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                class="py-4 w-100 btn btn-outline-secondary">削除</button>
                            </form>
                        </div>
                            
                    </div>
                    
                </div>
            </div>
            @endforeach
        
            
        @endif
    </div>
        
</div>    
@endsection
@section('js')
    <script>
        function deleteTask() {
            if (confirm('本当に削除しますか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection