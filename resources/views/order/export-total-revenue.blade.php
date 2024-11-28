<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gia Dung Xanh</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<style>
    body {
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body>
    <h1>{{$title}}</h1>
    <p><b>Ngày in:</b> {{$date}}</p>
    <table>
        <thead>
            <tr>
                <th>Ngày bán</th>
                <th>Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($totalRevenue as $v)
            <tr>
                <td>{{ Carbon\Carbon::parse($v->day)->format('d/m/Y') }}</td>
                <td>{{formatMoney($v->totalRevenue)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>