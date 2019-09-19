$(document).ready(function () {
  checkRequiredField();
});

function checkRequiredField() {
  $('#reset-pass-form').submit(function () {

    // Get field value
    var password = $.trim($('#password').val());
    var confirmPassword = $.trim($('#confirm-password').val());

    // Check password empty
    if (password === '') {
      // alert('password is empty.');
      $('#message-error').text('Hãy nhập vào mật khẩu');
      $("#message-error").css("display", "block");
      $('#password').focus();
      return false;
    }

    // Check confrim-password empty
    if (confirmPassword === '') {
      // alert('confirmPassword is empty.');
      $('#message-error').text('Hãy nhập vào mật khẩu xác nhận');
      $("#message-error").css("display", "block");
      $('#confirm-password').focus();
      return false;
    }

    // Check confrim-password true
    if (password != confirmPassword) {
      // alert('confirmPassword is wrong.');
      $('#message-error').text('Mật khẩu xác nhận không đúng');
      $("#message-error").css("display", "block");
      $('#confirm-password').focus();
      return false;
    }

  });
};