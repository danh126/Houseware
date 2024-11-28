$(document).ready(function () {
    let csrf_Token = $('meta[name="csrf-token"]').attr('content');

    loadCategoriesSearch(1, search);
    loadBrandsSearch(1, search);

    $('#load-more-categories').click(function () {
        let page = $(this).data('page');
        $(this).prop('disabled', true).text('Đang tải...');

        loadCategoriesSearch(page, search);
    })

    $('#load-more-brands').click(function () {
        let page = $(this).data('page');
        $(this).prop('disabled', true).text('Đang tải...');

        loadBrandsSearch(page, search);
    })

    function loadCategoriesSearch(page, search) {
        NProgress.start();
        $.post('/load-data-categories-search', {
            'page': page,
            'search': search,
            '_token': csrf_Token
        }, (d) => {
            if (d.load_data_categories_search === 'success') {
                d.categories.data.forEach(function (category) {
                    $('#categories .list-group').append(`
                                <li>
                                    <a class="cutom-parent">
                                        <span><img src="/image/category-icon/${category.iconUrl}" width="30" alt="${category.name}"></span>
                                        &nbsp;${category.name}&nbsp;(${category.Total})
                                        <span><input type="checkbox" class="check" value="${category.id}" name="cid"></span>
                                    </a >
                                        <span class="dcjq-icon"></span>
                                </li >
                            `)
                });

                if (d.categories.next_page_url) {
                    $('#load-more-categories').data('page', page + 1).prop('disabled', false).text('Tải thêm');
                } else {
                    $('#load-more-categories').remove();
                }
            } else {
                alert('Hệ thống đang gặp sự cố!');
                $('#load-more-categories').prop('disabled', false).text('Xem thêm');
            }
        });
        NProgress.done();
    }


    function loadBrandsSearch(page, search) {
        NProgress.start();
        $.post('/load-data-brands-search', {
            'page': page,
            'search': search,
            '_token': csrf_Token
        }, (d) => {
            if (d.load_data_brands_search === 'success') {
                d.brands.forEach(function (brand) {
                    $('#brands .list-group').append(`
                                <li>
                                    <a class="cutom-parent">
                                        <span><img src="/image/brands/${brand.brandLogo}" width="30" alt="${brand.brandName}"></span>
                                        &nbsp;${brand.brandName}&nbsp;(${brand.Total})
                                        <span><input type="checkbox" class="check" value="${brand.id}" name="bid"></span>
                                    </a >
                                        <span class="dcjq-icon"></span>
                                </li >
                            `)
                });

                if (d.brands.length > 0) {
                    $('#load-more-brands').data('page', page + 1).prop('disabled', false).text('Tải thêm');
                } else {
                    $('#load-more-brands').remove();
                }
            } else {
                alert('Hệ thống đang gặp sự cố!');
                $('#load-more-brands').prop('disabled', false).text('Xem thêm');
            }
        });
        NProgress.done();
    }
});