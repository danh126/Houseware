//Hàm kiểm tra các ký tự đặc biệt 
function containsSpecialChars(str) {
    const specialChars = /[!@#$%^&*(),.?":{}|<>]/g;
    return specialChars.test(str);
}

//Hàm kiểm tra Phone
function isValidPhoneNumber(phone) {
    var phonePattern = /^(0[1-9]{1}[0-9]{8}|1[0-9]{10})$/;
    return phonePattern.test(phone);
}

//Hàm kiểm tra Email
function isValidEmail(email) {
    var emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return emailPattern.test(email);
}

function clearText(text) {
    return setTimeout(() => {
        text.text('');
    }, 4000);
}