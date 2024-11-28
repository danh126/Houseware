@extends('shared.admin')
@section('content')
<div class="container-fluid">
    <h1 class="text-center">Cập nhật thuộc tính</h1>
    <form method="post">
        @csrf
        <div class="row">
            <label for="name" class="form-label col-2">Name</label>
            <div class="col-7">
                <input type="text" name="name" value="{{$o->name}}" id="name" class="form-control" required>
            </div>
        </div>
        <div class="mt-2">
            <button class="offset-2 btn btn-primary">Cập nhật</button>
            <a href="/manage/attribute" class="btn btn-outline-primary">Quay lại</a>
        </div>
    </form>
</div>
@stop