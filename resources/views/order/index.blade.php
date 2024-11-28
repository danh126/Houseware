@extends('shared.admin')
@section('title','Danh sách đơn hàng | GDX')
@section('content')
<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/manage">Trang chủ</a></li>
        <li class="breadcrumb-item active">Đơn hàng</li>
    </ol>

    <a class="mb-2 btn btn-primary" href="/manage/order/total-revenue">Tổng doanh thu</a>
    <a class="mb-2 btn btn-success" href="/manage/order">Làm mới</a>

    <!-- Form tìm kiếm -->
    <form action="" method="GET" class="d-flex justify-content-end mb-3">
        <input type="date" name="search" value="{{$_GET['search'] ?? null}}" class="form-control w-25">
        <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
    </form>

    <!-- Hiển thị thông báo thành công -->
    @if ($orders[0] == null)
    <div class="alert alert-danger">
        Không có đơn đặt hàng nào!
    </div>
    @endif

    <p class="text-danger">
        <b>(*)Thanh toán có 2 trường hợp:</b>
        <span>thanh toán online & thanh toán khi nhận hàng.</span>
    </p>

    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>ID đơn hàng</th>
                <th>Tên tài khoản</th>
                <th>Tên khách hàng</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt hàng</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody id="orders">
            @foreach($orders as $v)
            <tr v="{{$v->order_id}}">
                <td>{{$v->order_id}}</td>
                <td class="text-truncate" style="max-width: 180px;">{{!empty($v->user_fullname) ? $v->user_fullname : 'Chưa có tài khoản'}}</td>
                <td class="text-truncate" style="max-width: 180px;">{{!empty($v->customer_fullname) ? $v->customer_fullname : 'Đã đăng nhập'}}</td>
                <td>{{formatMoney($v->total_amount)}}</td>
                <td>{{$v->created_at->format('d/m/Y H:i')}}</td>
                <td class="payment" data-payment="{{$v->payment}}"><span>{{$v->payment == 1 ? 'Đã thanh toán' : 'Chưa thanh toán'}}</span></td>
                <td class="status" data-status="{{$v->status_order}}"><span>{{$v->status_order}}</span></td>
                <td>
                    <button class="btn btn-primary detail">Chi tiết</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex">
        <div class="ms-auto">
            {{$orders->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="detailOrder" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailOrderLabel"></h1>
                <button type="button" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <table class="show table table-bordered">
                </table>
                <div class="total">
                </div>
                <div class="process">
                    <select name="process_shipping" class="form-select" id="process_shipping">
                    </select>
                </div>
                <div id="result" class="text-success">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary update-status">Cập nhật đơn hàng</button>
                <button type="button" class="btn btn-danger cancel-order">Hủy đơn hàng</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    function formatCurrency(amount) {
        let formattedAmount = new Intl.NumberFormat('vi-VN').format(amount);
        return formattedAmount.replace(/,/g, '.') + ' VNĐ';
    }

    $('#detailOrder .btn-close').click(function() {
        $('#detailOrder').hide();
        location.reload();
    });

    // Xử lý order detail
    $('#orders .detail').click(function() {
        let orderId = $(this).parent().closest('tr').attr('v');
        let csrf_Token = $('meta[name="csrf-token"]').attr('content');

        $.post('/manage/order/order-detail', {
            'orderId': orderId,
            '_token': csrf_Token
        }, (d) => {
            let orderStatus = d.order_detail[0].status;

            $.each(d.order_detail, function(index, value) {
                $('#detailOrderLabel').html('Chi tiết đơn hàng #<span>' + orderId + '</span>');
                $('#detailOrder .show').append(`
                    <tr>
                        <td class="border">
                            <img src="/image/product/${value.imageUrl}" width="50" alt="">
                        </td>
                        <td class="border">${value.productName}</td>
                        <td class="border">${value.quantity}</td>
                        <td class="border">${formatCurrency(value.price)}</td>
                    </tr>
                `);
            });

            $('#detailOrder .total').append(`
                    <p><b>Giảm giá:</b> - ${formatCurrency(d.order_detail[0].order_discount)}</p>
                    <p><b>Tổng tiền:</b> ${formatCurrency(d.order_detail[0].total_amount)}</p>
                    <p><b>Trạng thái thanh toán:</b> ${d.order_detail[0].payment == 1 ? 'Đã thanh toán' : 'Chưa thanh toán'}</p>
                    <p><b>Ghi chú:</b> ${d.order_detail[0].note}</p>
                    <p><b>Trạng thái:</b></p>
            `);

            $.each(d.process_shipping, function(index, value) {
                $('#process_shipping').append(`
                    <option value="${value.id}">${value.name}</option>
                `);

                if (value.id === orderStatus) {
                    $('#process_shipping option[value="' + value.id + '"]').prop('selected', true);
                }

                let statusId = $('#process_shipping').val();

                if (statusId >= 3) {
                    $('#detailOrder .cancel-order').prop('disabled', true);
                }

                if (statusId == 5) {
                    $('#detailOrder .cancel-order').prop('disabled', true);
                    $('#detailOrder .update-status').prop('disabled', true);
                }
            });
        });

        $('#detailOrder').show();
    });

    //Xử lý update status
    $('#detailOrder .update-status').click(function() {
        let orderId = $('#detailOrderLabel span').text();
        let statusId = $('#process_shipping').val();
        let csrf_Token = $('meta[name="csrf-token"]').attr('content');

        $.post('/manage/order/update-status', {
            'orderId': orderId,
            'statusId': statusId,
            '_token': csrf_Token
        }, (d) => {
            if (d.update_status === true) {
                let result = $('#result');
                result.text('Cập nhật trạng thái đơn hàng thành công!');

                setTimeout(() => {
                    result.text('');
                }, 3000);
            } else {
                alert('Hệ thống đang gặp sự cố!');
            }
        });
    });

    //Xử lý cancel order
    $('#detailOrder .cancel-order').click(function() {
        let confirmation = confirm("Bạn có chắc chắn muốn hủy đơn hàng không?");
        if (confirmation) {
            let orderId = $('#detailOrderLabel span').text();
            let csrf_Token = $('meta[name="csrf-token"]').attr('content');

            $.post('/manage/order/cancel-order', {
                'orderId': orderId,
                '_token': csrf_Token
            }, (d) => {
                if (d.cancel_order === true) {
                    let result = $('#result');
                    result.text('Hủy đơn hàng thành công!');

                    setTimeout(() => {
                        result.text('');
                        location.reload();
                    }, 3000);
                } else {
                    alert('Hệ thống đang gặp sự cố!');
                }
            });
        }
    });

    //Thêm css trong trạng thái vận chuyển
    $('.status').each(function() {
        let status_shipping = $(this).data('status');

        switch (status_shipping) {
            case 'Chờ đơn vị vận chuyển':
                $(this).find('span').addClass('waiting');
                break;
            case 'Đang vận chuyển':
                $(this).find('span').addClass('in-transit');
                break;
            case 'Tiến hành giao hàng':
                $(this).find('span').addClass('shipping');
                break;
            case 'Đã giao':
                $(this).find('span').addClass('delivered');
                break;

            default:
                $(this).find('span').addClass('processing')
                break;
        }
    });

    //Thêm css cho trạng thái thanh toán
    $('.payment').each(function() {
        let status_payment = $(this).data('payment');

        switch (status_payment) {
            case 1:
                $(this).find('span').addClass('paid');
                break;

            default:
                $(this).find('span').addClass('unpaid');
                break;
        }
    })
</script>
@stop