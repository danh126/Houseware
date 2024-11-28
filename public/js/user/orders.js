function statusApply(status) {
    //Duyệt qua các trạng thái
    $('.track .step').each(function () {
        //Lấy value trạng thái
        let stepActive = $(this).find('.icon').attr('v');

        //Nếu value <= status thì tất cả trạng thái trước và chính nó đều active
        if (stepActive <= status) {
            $(this).addClass('active');
        }
    });

    if (status <= 2) {
        $('#content .btnCancel').removeClass('hidden');
    } else {
        $('#content .btnCancel').prop('disabled', true);
    }

    if (status === 5) {
        $('#content .btnCancel').addClass('hidden');
    }
}

//Xử lý hủy đơn hàng
$('#content .btnCancel').click(function () {
    let confirmation = confirm("Bạn có chắc chắn muốn hủy đơn hàng không?");
    if (confirmation) {
        let orderId = $(this).attr('data-orderId');
        let csrf_Token = $('meta[name="csrf-token"]').attr('content');

        NProgress.start();
        $.post('/manage/order/cancel-order', {
            'orderId': orderId,
            '_token': csrf_Token
        }, (d) => {
            if (d.cancel_order === true) {
                alert('Hủy đơn hàng thành công!');

                setTimeout(() => {
                    location.href = '/tai-khoan/don-dat-hang';
                }, 100);
            } else {
                alert('Hệ thống đang gặp sự cố!');
            }
        });
        NProgress.done();
    }
});