@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Repositories</div>
                    <div class="panel-body">
                        <ul>
                        @foreach($repositories as $repository)
                            <li><a href="/repositories/{{ $repository['owner']['login'] }}/{{ $repository['name'] }}/issues">{{ $repository['name'] }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
