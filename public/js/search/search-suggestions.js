$(document).ready(function () {
    let suggestion_list = $('#suggestion-list');
    let search_input = $('.autosearch-input');

    let debounceTimeout; // giới hạn gọi ajax

    $(search_input).on('input', function () {
        clearTimeout(debounceTimeout); // xóa timeout người dùng gửi yêu cầu trước đó

        //Sau khi người dùng nhập và không thay đổi trong vòng 500ms thì gửi ajax
        debounceTimeout = setTimeout(() => {
            let query = $(this).val().trim();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            suggestion_list.empty();

            if (query !== '') {
                $.ajax({
                    type: "post",
                    url: "/search-suggestions",
                    data: {
                        'q': query,
                        '_token': csrfToken
                    },
                    success: function (d) {
                        if (d.search_suggestions === 'failed') {
                            alert('Hệ thống đang gặp sự cố!');
                        } else if (d.search_suggestions === 'success') {
                            d.products.forEach(function (product) {
                                suggestion_list.removeClass('invisible');
                                suggestion_list.append(`
                                        <a href="/tim-kiem-san-pham?search=${product.productName.replace(/\s+/g, '+')}"><li>${product.productName}</li></a>
                                    `)
                            })
                        }
                    }
                });
            }
        }, 500);// Delay 500ms
    })

    // Lắng nghe sự kiện click ngoài input hoặc danh sách gợi ý để ẩn danh sách
    $(document).on('click', function (e) {
        if (!search_input.is(e.target) && !suggestion_list.is(e.target) && suggestion_list.has(e.target).length === 0) {
            suggestion_list.addClass('invisible');
            suggestion_list.empty();
        }
    });
});