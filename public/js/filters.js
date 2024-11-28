$(document).ready(function () {
    getFiltersByUrl(url);

    function getFiltersByUrl(getUrl) {
        // Khai báo các key filter và lấy search URL
        let arr = ['bid', 'cid'];
        let params = new URL(window.location.toString()).searchParams;
        let dict = {};

        // Duyệt qua mảng arr lấy ra các key tương ứng từ params
        for (let i in arr) {
            let v = params.get(arr[i]);
            if (v != null) {
                dict[arr[i]] = v.split(','); // chuyển value thành dạng mảng
            }
        }

        // Duyệt qua dict để checked tương ứng với id trong input
        // ajaxComplete -> được gọi sau khi yêu cầu ajax được thực hiện
        $(document).ajaxComplete(function () {
            // Chạy lại sau khi bất kỳ AJAX nào hoàn tất
            for (let k in dict) {
                for (let i in dict[k]) {
                    $(`input[name="${k}"][value="${dict[k][i]}"]`).prop('checked', true);
                }
            }
        });

        // Hàm tạo giá trị hiển thị lên URL
        function dictToURL() {
            let brr = [];
            for (let k in dict) {
                brr.push(`${k}=${encodeURIComponent(dict[k].join(','))}`);
            }

            NProgress.start();
            let newUrl = getUrl + brr.join('&');
            window.location.href = newUrl; // Điều hướng đến URL mới
            NProgress.done();
        }

        // Bắt sự kiện click cho các input có class .check
        $(document).on('click', '#column-left .check', function () {
            let k = $(this).attr('name');
            let v = $(this).val();

            if ($(this).prop('checked')) {
                if (dict[k] === undefined) {
                    dict[k] = [v]; // Khởi tạo thành mảng với giá trị đầu tiên
                } else {
                    dict[k].push(v);
                }
            } else {
                if (dict[k].length === 1) {
                    delete dict[k]; //xóa toàn bộ nếu chỉ có 1 giá trị trong key k
                } else {
                    dict[k] = dict[k].filter((val) => val != v); //lọc ra giá trị khác v khi key k có nhiều giá trị
                }
            }
            dictToURL();
        });
    }
});