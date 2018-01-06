@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                建立新 Task
            </div>

            <div class="panel-body">
                <!-- 錯誤訊息顯示區塊 -->
                @if ($errors->any())
                    <!-- 表單錯誤清單 -->
                    <div class="alert alert-danger">
                        <strong>請檢查您輸入的資料！</strong>
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- 新任務的表單 -->
                <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- 任務名稱 -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="title" id="task-name" class="form-control" value="">
                        </div>
                    </div>

                    <!-- 增加任務按鈕-->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i>建立 Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- 目前任務 -->
        <div class="panel panel-default">
            <div class="panel-heading">
                目前任務
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- 表頭 -->
                    <thead>
                        <th>Task</th>
                        <th width="200">&nbsp;&nbsp;</th>
                    </thead>

                    <!-- 表身 -->
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <!-- 任務名稱 -->
                                <td class="table-text">
                                    <div class="{{ ($task->completed)? 'check' : '' }}">
                                        {{ $task->title }}
                                    </div>
                                </td>
                                <td>
                                @if (! $task->completed)
                                    <!-- 完成 Task 按鈕 -->
                                    <form action="{{ url('tasks/'.$task->id) }}" method="POST" class="form-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-check"></i>完成
                                        </button>
                                    </form>
                                @endif
                                    <!-- 刪除 Task 按鈕 -->
                                    <form action="{{ url('tasks/'.$task->id) }}" method="POST" class="form-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>刪除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection