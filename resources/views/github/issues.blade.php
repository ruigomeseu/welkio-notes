@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Issues</div>
                    <div class="panel-body">
                        @if(empty($issues))
                            <div class="alert alert-info">
                                This repository has no issues.
                            </div>
                        @else
                            <ul>

                                @foreach($issues as $issue)
                                    <li><a href="{{ $issue['url'] }}">{{ $issue['title'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
