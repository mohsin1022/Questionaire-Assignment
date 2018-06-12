@extends('layouts.app')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@section('content')
<div class="flex-center position-ref full-height container">
    <h3 class="page-title">Questionaire List</h3>

    <p>
    <a href="{{ route('questionaire.create')}}" class="btn btn-success">Add New</a>
    </p>

    <div class="panel panel-default">
        @if (\Session::has('update'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('update') !!}</li>
            </ul>
        </div>
    @endif

        <div class="panel-body">
        <table class="table table-bordered table-striped {{ count($questionairs) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Number of Questions</th>
                        <th>Duration</th>
                        <th>Resumable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questionairs) > 0)
                        @foreach ($questionairs as $questionair)
                            <tr data-entry-id="{{ $questionair->id}}">
                                
                                <td>{{ $questionair->name }}</td>
                            <td>{{ $questionair->questions_count}} | <a href="/questions/add/{{$questionair->id}}" class="">Add</a></td>
                                <td>{{ \Carbon\CarbonInterval::minutes($questionair->duration)  }}</td>
                                <td>{{ $questionair->can_resume ? 'Yes' :'No'}}</td>                                
                                
                                <td>
                                
                                <a href="{{ route('questionaire.edit',[$questionair->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('Are you sure ?');",
                                        'route' => ['questionaire.destroy', $questionair->id]
                                       )) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                       @endforeach
                    @else
                        <tr>
                            <td colspan="7">No Entries in Table</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('javascript')
    
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $('.table').dataTable();
    </script>

@stop