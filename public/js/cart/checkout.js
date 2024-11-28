$(document).ready(function () {
    $(window).on('beforeunload', function () {
        $('#input-coupon').val('');
        $('#coupon-apply').find('input[name="couponApply"]').val('');

        $('input[name="shipCode"]').prop('checked', true);
        $('input[name="vnpay"]').prop('checked', false);
    });

    let carts = $('#content .views-cart').children('tr');
    if (carts.length === 0) {
        $('#button-coupon').prop('disabled', true);
        $('#button-confirm').prop('disabled', true);
    }

    // Load Data Districts By Province Id
    $('#content #province').change(function () {
        $(this).find('.defaut').remove();

        let province_id = $(this).val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Kiểm tra nếu có giá trị province_id
        if (!province_id) return;

        $.post('/cart/districts', {
            'province_id': province_id,
            '_token': csrfToken
        }, (d) => {
            let items = '';

            // Dùng map() để tránh lỗi với dữ liệu rỗng
            if (d.districts && d.districts.length > 0) {
                items = d.districts.map(district =>
                    `<option value="${district.district_id}">${district.name}</option>`
                ).join('');
            }

            $('#district').html(items);

            // Tự động gọi change nếu có dữ liệu districts mới
            if (d.districts && d.districts.length > 0) {
                $('#content #district').change();
            }
        });
    });

    // Load Data Wards By District Id
    let debounceTimer;
    $('#content #district').change(function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            let district_id = $(this).val();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            if (!district_id) return;

            $.post('/cart/wards', {
                'district_id': district_id,
                '_token': csrfToken
            }, (d) => {
                let items = '';

                if (d.wards && d.wards.length > 0) {
                    items = d.wards.map(ward =>
                        `<option value="${ward.wards_id}">${ward.name}</option>`
                    ).join('');
                }

                $('#ward').html(items);
            });
        }, 300);  // Thực hiện sau 300ms kể từ khi người dùng dừng nhập
    });


    //Sub Total 
    function subTotalCheckout() {
        let carts = $('#content .views-cart').children('tr');
        let subTotal = 0;

        for (let i = 0; i < carts.length; i++) {
            subTotal += parseInt(carts.eq(i).find('input[name="total"]').val());
        }

        $('#content .sub-total-checkout').text(subTotal.toLocaleString('de-DE') + ' ' + 'VNĐ');

        return subTotal;
    }

    //Total checkout
    function totalCheckout(coupon, shipping) {
        let total = subTotalCheckout();

        if (coupon) {
            total = total - coupon;
        } else if (shipping) {
            total = total + shipping;
        }

        $('#content .total-checkout').text(total.toLocaleString('de-DE') + ' ' + 'VNĐ');
        $('#total_amount').val(total);

        return total;
    }

    subTotalCheckout();

    totalCheckout();

    function validateInformation() {
        //Validate Customer Information
        let fullname = $('#input-payment-fullname').val();
        let email = $('#input-payment-email').val();
        let phone = $('#input-payment-phone').val();

        let error_checkout = false;

        if (fullname === '') {
            let error_fullname = $('#content .error-fullname');
            error_fullname.text('Vui lòng nhập Họ & Tên!');

            error_checkout = true;
            clearText(error_fullname);
        } else if (containsSpecialChars(fullname)) {
            let error_fullname = $('#content .error-fullname');
            error_fullname.text('Họ & Tên không được chứa ký tự đặc biệt!');

            error_checkout = true;
            clearText(error_fullname);
        }

        if (!isValidEmail(email)) {
            let error_email = $('#content .error-email');
            error_email.text('Email không hợp lệ!');

            error_checkout = true;
            clearText(error_email);
        } else if (email === '') {
            let error_email = $('#content .error-email');
            error_email.text('Vui lòng nhập Email!');

            error_checkout = true;
            clearText(error_email);
        }

        if (phone.length < 10 || phone.length > 10) {
            let error_phone = $('#content .error-phone');
            error_phone.text('Số điện thoại không hợp lệ!');

            error_checkout = true;
            clearText(error_phone);
        } else if (phone === '') {
            let error_phone = $('#content .error-phone');
            error_phone.text('Vui lòng nhập số điện thoại!');

            error_checkout = true;
            clearText(error_phone);
        }

        return error_checkout;
    }

    function validateAddress() {
        //Validate Address
        let address = $('#input-payment-address').val();
        let province_id = $('#province').val();
        let district_id = $('#district').val();
        let wards_id = $('#ward').val();

        let error_checkout = false;

        if (address === '') {
            let error_address = $('#content .error-address');
            error_address.text('Vui lòng nhập địa chỉ giao hàng!');

            error_checkout = true;
            clearText(error_address);
        }

        if (!province_id) {
            let error_province = $('#content .error-province');
            error_province.text('Vui lòng chọn Tỉnh / Thành Phố!');

            error_checkout = true;
            clearText(error_province);
        }

        if (!district_id) {
            let error_district = $('#content .error-district');
            error_district.text('Vui lòng chọn Quận / Huyện!');

            error_checkout = true;
            clearText(error_district);
        }

        if (!wards_id) {
            let error_ward = $('#content .error-ward');
            error_ward.text('Vui lòng chọn Phường / Xã!');

            error_checkout = true;
            clearText(error_ward);
        }

        return error_checkout;
    }

    //Xử lý lấy giá vận chuyển


    //Coupon Apply
    $('#button-coupon').click(function () {
        validateInformation();

        if (!hasAddress() || !hasUser()) {
            validateAddress();
        }

        if (!validateInformation() && (hasAddress() || !validateAddress())) {
            let code_coupon = $('#input-coupon').val();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let error_coupon = false;

            let result_coupon = $('#content .result-coupon');

            //Validate
            if (code_coupon === '') {
                result_coupon.text('Mã giảm giá chưa được nhập.');
                error_coupon = true;
                clearText(result_coupon);
            } else if (containsSpecialChars(code_coupon)) {
                result_coupon.text('Mã giảm giá không hợp lệ.');
                error_coupon = true;
                clearText(result_coupon);
            }

            //Check Code Coupon
            if (!error_coupon) {
                NProgress.start();
                $.post('/coupon/check', {
                    '_token': csrfToken,
                    'code_coupon': code_coupon
                }, (d) => {
                    if (d.checkCoupon === false) {
                        result_coupon.text('Mã giảm giá không tồn tại.');
                        clearText(result_coupon);
                    } else if (d.checkCoupon === true) {
                        $('#input-coupon').val(code_coupon);
                        $('#input-coupon').prop('disabled', true);
                        $(this).prop('disabled', true);

                        result_coupon.text('Áp dụng mã giảm giá thành công!');
                        clearText(result_coupon);

                        let couponApply = d.coupon_apply;
                        let subTotal = parseInt(subTotalCheckout());
                        let coupon = subTotal - (subTotal * couponApply);

                        $('#coupon-apply').show();
                        $('#coupon-apply .coupon').text('- ' + coupon.toLocaleString('de-DE') + ' ' + 'VNĐ');
                        $('#coupon-apply').find('input[name="couponApply"]').val(coupon);
                        totalCheckout(coupon);
                    } else {
                        alert('Hệ thống đang gặp sự cố!');
                    }
                });
                NProgress.done();
            }
        }
    });

    $('input[name="shipCode"], input[name="vnpay"]').on('change', function () {
        $('input[name="shipCode"], input[name="vnpay"]').not(this).prop('checked', false);
    });

    let vnpay_payment;

    $('input[name="vnpay"]').on('change', function () {
        vnpay_payment = true;
    });

    //Confirm Checkout
    $('#content #button-confirm').click(function () {
        // console.log(vnpay_payment);

        // return false;

        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        let fullname = $('#input-payment-fullname').val();
        let email = $('#input-payment-email').val();
        let phone = $('#input-payment-phone').val();

        let address = $('#input-payment-address').val();
        let province_id = $('#province').val();
        let district_id = $('#district').val();
        let wards_id = $('#ward').val();
        let note = $('#confirm_comment').val();

        let coupon = $('#coupon-apply').find('input[name="couponApply"]').val();
        coupon = coupon ? coupon : 0;

        let total = $('#total_amount').val();

        function processCheckout(url, object) {
            NProgress.start();
            if (vnpay_payment) {
                $.post('/vnpay/payment', object, (d) => {
                    location.href = d.url_payment;
                });
            } else {
                $.post(url, object, (d) => {
                    if (d.checkout === true) {
                        let orderId = d.orderId;
                        location.href = `/dat-hang-thanh-cong/id-${orderId}`;
                    } else {
                        alert("Hệ thống đang gặp sự cố!");
                    }
                });
            }
            NProgress.done();
        }

        //Customer Checkout
        if (!hasUser()) {

            if (!hasAddress()) {
                validateAddress();
            }

            if (!validateInformation() && !validateAddress()) {
                let urlCustomer = '/cart/doCheckoutCustomer';
                let dataCustomer = {
                    'fullname': fullname,
                    'email': email,
                    'phone': phone,
                    'address': address,
                    'province_id': province_id,
                    'district_id': district_id,
                    'wards_id': wards_id,
                    'order_discount': coupon,
                    'total_amount': total,
                    'note': note,
                    '_token': csrfToken
                };

                processCheckout(urlCustomer, dataCustomer);
            }

            return;
        }

        let urlUserCheckout = '/cart/doCheckoutUser';

        //User Checkout
        if (hasUser() && !hasAddress()) {
            //Kiểm tra nếu User chưa có thông tin
            if (!validateAddress() && !validateInformation()) {
                let data = {
                    'fullname': fullname,
                    'email': email,
                    'phone': phone,
                    'address': address,
                    'province_id': province_id,
                    'district_id': district_id,
                    'wards_id': wards_id,
                    'order_discount': coupon,
                    'total_amount': total,
                    'note': note,
                    '_token': csrfToken
                };

                processCheckout(urlUserCheckout, data);
            }
        } else if (!validateInformation()) {
            let data = {
                'fullname': fullname,
                'email': email,
                'phone': phone,
                'address': address,
                'order_discount': coupon,
                'total_amount': total,
                'note': note,
                '_token': csrfToken
            };

            processCheckout(urlUserCheckout, data);
        }
    });
});