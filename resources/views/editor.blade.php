@extends('layouts.showeditor')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <a href="/editor?depart_id=2">depart 1</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">Content Editors</div>

                <div class="panel-body">
                        @if (count($editors))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:20%">หน่วยงาน/สังกัด</th>
                                    <th style="width:15%">ชื่อ-สกุล <a href="/editor?sort=asc">asc</a></th>
                                    <th style="width:35%">รับผิดชอบ</th>
                                    <th style="width:10%">หมายเลขโทรศัพท์</th>
                                    @if(\Auth::check())
                                    <th style="width:8%">Admin</th>
                                    @endif
                                </tr>                                
                            </thead>
                            <tbody>
                                @foreach($editors as $key=>$editor)
                                <tr>
                                    <td>{{ $key + $editors->firstItem() }}</td>
                                    <td>{{ $editor->depart->departname }}</td>
                                    <td>{{ $editor->fname . ' ' . $editor->lname }}</td>
                                    <td>{{ $editor->job }}</td>
                                    <td>{{ $editor->contact }}</td>
                                    @if(\Auth::check())
                                    <td>-</td>
                                    @endif
                                </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                        @endif
                            
                        
                    {{$editors->links()}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
