

@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        {{--  <show-editor source="/api/editor" title="Editor Data" />  --}}
        <app-editor></app-editor>
    </div>
</div>
@endsection
