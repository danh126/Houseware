@extends('shared.admin')
@section('content')
<div class="container">
    <a class="mt-2 mb-2 btn btn-primary" href="/manage/attribute/add">Thêm thuôc tính</a>
    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>ID thuộc tính</th>
                <th>Tên thuộc tính</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attr as $a)
            <tr>
                <td>{{$a->id}}</td>
                <td>{{$a->name}}</td>
                <td>
                    <a class="btn btn-primary" href="/manage/attribute/edit/{{$a->id}}">Cập nhật</a>
                    <a class="btn btn-danger" href="/manage/attribute/delete/{{$a->id}}">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop