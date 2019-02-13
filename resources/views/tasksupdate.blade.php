@extends('layouts.app')

@section('content')
<div class="panel panel-default">
                <div class="panel-heading">
                    Update Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form  action="{{ url('task/'.$task->id.'/save/') }}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                            </div>
                        </div>
                        <!-- UPDATE Task Button -->
                        <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-check"></i>Save
                                </button>
                                </form>

                        </div>
                        <form style="" action="{{ url('/') }}" method="GET">

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-arrow-left"></i>Back
                                                </button>
                        </form>
                        
                    </div>
                </div>
            </div>
@endsection