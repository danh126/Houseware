/* -------------------------------------------------------------------------------- /
	
	Magentech jQuery
	Created by Magentech
	v1.0 - 20.9.2016
	All rights reserved.
	
/ -------------------------------------------------------------------------------- */


// Cart add remove functions
var cart = {
	'add': function (product_id, quantity, price, product_name, img) {
		addProductNotice(
			`Bạn đã thêm ${quantity} sản phẩm`,
			`<img src="/image/product/${img}" alt="${product_name}">`,
			`<h3><a href="/chi-tiet-san-pham/${product_id}">${product_name}</a></br><a class="cart" href="/gio-hang">Đi đến giỏ hàng</a>!</h3>`,
			'success'
		);

		addToCart(product_id, quantity, price);
		// remove(product_id);
	},
}


var wishlist = {
	'add': function (product_id, price, product_name, img) {
		var csrfToken = $('meta[name="csrf-token"]').attr('content');

		$.post('/wishlist/add', {
			'product_id': product_id,
			'price': price,
			'_token': csrfToken
		}, (d) => {
			if (d.login === false) {
				window.location.href = '/tai-khoan/dang-nhap';
			} else if (d.addWishList === true || d.checkWishList === true) {
				addProductNotice(
					`Bạn đã thêm sản phẩm yêu thích`,
					`<img src="/image/product/${img}" alt="${product_name}">`,
					`<h3><a href="/chi-tiet-san-pham/${product_id}">${product_name}</a></br><a class="cart" href="/tai-khoan/san-pham-yeu-thich">Sản phẩm yêu thích</a>!</h3>`,
					'success'
				);
			} else {
				alert('Hệ thống đang gặp sự cố!');
			}
		});
	}
}

var compare = {
	'add': function (product_id) {
		addProductNotice('Product added to compare', '<img src="/image/demo/shop/product/e11.jpg" alt="">', '<h3>Success: You have added <a href="#">Apple Cinema 30"</a> to your <a href="#">product comparison</a>!</h3>', 'success');
	}
}

/* ---------------------------------------------------
	jGrowl – jQuery alerts and message box
-------------------------------------------------- */
function addProductNotice(title, thumb, text, type) {
	$.jGrowl.defaults.closer = false;

	var tpl = thumb + '<h3>' + text + '</h3>';
	$.jGrowl(tpl, {
		life: 4000,
		header: title,
		speed: 'slow',
		theme: type
	});
}

function addToCart(product_id, quantity, price) {
	var csrfToken = $('meta[name="csrf-token"]').attr('content');

	$.post('/gio-hang/them-vao-gio', {
		'id_product': product_id,
		'quantity': quantity,
		'price': price,
		'_token': csrfToken
	}, (d) => {
		// console.log(d);
	});
}


