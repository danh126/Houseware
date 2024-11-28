$(document).ready(function () {
    function countQuantityProducts() {
        let itemCart = $('#content #cart').children('tr');

        let quantity = itemCart.length;

        if (quantity === 0) {
            let message = 'Bạn chưa thêm sản phẩm nào vào giỏ hàng!';
            $('#content #cart').append(`<tr><td class="text-center" colspan="7">${message}</td></tr>`)
            $('#content .checkout').prop('disabled', true);
        }

        $('#content .countProducts').text(quantity + ' sản phẩm');

        return quantity;
    }

    function TotalPriceOrders() {
        //Total 
        let cart = $('#content #cart').children('tr');
        let Total = 0;

        for (let i = 0; i < cart.length; i++) {
            Total += parseInt(cart.eq(i).find('input[name="total"]').val());
        }

        if (!isNaN(Total)) {
            $('#content .total-sub').text(Total.toLocaleString('de-DE') + ' VNĐ');
            $('#content .total').text(Total.toLocaleString('de-DE') + ' VNĐ');
        } else {
            $('#content .total-sub').text('');
            $('#content .total').text('');
        }
    }

    function loadDataCartsMini() {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.post('/gio-hang/getData', {
            '_token': csrfToken
        }, (d) => {
            let content = '';
            let countItems = d.items.length;

            d.items.forEach(function (item) {
                content += `      <tr>
                                        <td class="text-center" style="width:80px">
                                            <a href="/chi-tiet-san-pham-p${item.id_product}"> <img
                                                    src="/image/product/${item.imageUrl}"
                                                    style="width:70px" alt="${item.productName}" title="${item.productName}"
                                                    class="preview"> </a>
                                        </td>
                                        <td class="text-left" style="max-width: 50px; display: inline-block; 
                                        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"> <a class="cart_product_name"
                                                href="/chi-tiet-san-pham-p${item.id_product}">${item.productName}</a> </td>
                                        <td class="text-center"> x${item.quantity}</td>
                                        <td class="text-center">${Number(item.price).toLocaleString('de-DE') + ' VNĐ'}</td>
                                        <td class="text-right">
                                            <a href="/chi-tiet-san-pham-p${item.id_product}" class="fa fa-edit"></a>
                                        </td>
                                        <td class="text-right">
                                            <a class="fa fa-times fa-delete" data-id-product ="${item.id_product}"></a>
                                        </td>
                                    </tr>`
            });

            $('#cart .cart-total-full').text(`${countItems} sản phẩm`);
            $('#views-cart').html(content);
            $('#cart .sub-total').text(d.subTotal.toLocaleString('de-DE') + ' VNĐ');
            $('#cart .total').text(d.subTotal.toLocaleString('de-DE') + ' VNĐ');

            // if (countItems === 0) {
            //     $('#cart .checkout-cart').prop('disabled', true);
            // }

            //Delete Item Cart Mini
            $('.fa-delete').click(function () {
                let tr = $(this).closest('tr');
                let id_product = $(this).data('id-product');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.post('/gio-hang/delete', {
                    'id_product': id_product,
                    '_token': csrfToken
                }, (d) => {
                    if (d.deleteCart === true) {
                        tr.remove();
                        loadDataCartsMini();
                        // $('#content .clearCart').click();
                    }
                    // console.log(d);
                });
            });
        });
    }

    function countItemByWishList() {
        let itemWishList = $('#wishlist').children('tr');
        let quantity = itemWishList.length;

        if (quantity === 0) {
            let messsage = 'Bạn chưa thêm sản phẩm yêu thích nào!';
            $('#wishlist').append(`
            <tr>
                <td colspan="5" class="text-center">${messsage}</td>
            </tr>
        `);
        }
    }

    loadDataCartsMini();
    TotalPriceOrders();
    countQuantityProducts();
    countItemByWishList();

    $('.addToCart').click(function () {
        loadDataCartsMini();
    });

    $('#content .checkout').click(function () {
        location.href = '/dat-hang';
    });

    //Update Quantity
    $('#content #cart .updateQuantity').click(function () {
        let product = $(this).parent().parent().parent();
        let id_product = product.attr('v');
        let quantity = product.find('input[name="quantity"]').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        NProgress.start();
        $.post('/gio-hang/update', {
            'id_product': id_product,
            'quantity': quantity,
            '_token': csrfToken
        }, (d) => {
            if (d.updateCart === true) {
                let price = product.find('input[name="price"]').val();
                let total_product = price * quantity;

                product.find('#total-product').text(total_product.toLocaleString('de-DE') + ' VNĐ');

                product.find('input[name="total"]').val(total_product);
                TotalPriceOrders();
            }
        });
        NProgress.done();
    });

    //Delete Product In Carts
    $('#content .clearCart').click(function () {
        let product = $(this).parent().parent();
        let id_product = product.attr('v');

        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        NProgress.start();
        $.post('/gio-hang/delete', {
            'id_product': id_product,
            '_token': csrfToken
        }, (d) => {
            if (d.deleteCart === true) {
                product.remove();
                loadDataCartsMini();
                TotalPriceOrders();
                countQuantityProducts();
            }
        });
        NProgress.done();
    });

    // Delete Item In WishList
    $('#content .delWishList').click(function () {
        let product_id = $(this).parent().closest('tr').attr('v');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        NProgress.start();
        $.post('/wishlist/delete', {
            'product_id': product_id,
            '_token': csrfToken
        }, (d) => {
            if (d.deleteWishList === true) {
                $(this).parent().closest('tr').remove();
                countItemByWishList();
            } else {
                alert('Hệ thống đang gặp sự cố!');
            }
        });
        NProgress.done();
    });
});