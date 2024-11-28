@extends('shared.admin')
@section('title','Tổng doanh thu | GDX')
@section('content')
<div class="container mt-4">
    <a class="mb-2 btn btn-primary" href="/manage/order">Danh sách đơn hàng</a>

    @if(!empty($data[0]))
    <a class="mb-2 btn btn-success" href="{{route('exprot.totalRevenue')}}">Xuất PDF</a>
    @endif

    <p class="text-danger">
        <b>(*)Tổng doanh thu:</b>
        <span>được tính theo tổng đơn hàng bán theo ngày.</span>
    </p>

    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>Ngày bán</th>
                <th>Tổng doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $v)
            <tr>
                <td>{{ Carbon\Carbon::parse($v->day)->format('d/m/Y') }}</td>
                <td>{{formatMoney($v->totalRevenue)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop