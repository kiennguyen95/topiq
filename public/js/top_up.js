$(document).ready(function () {
  checkNumeric();
  checkRequiredField();
});

function checkNumeric() {
  $("#card-seri").on("keypress keyup blur", function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });

  $("#card-pin").on("keypress keyup blur", function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });
}

function checkRequiredField() {
  $('#top-up-form').submit(function () {

    var cardValue = $('#card-value').val();
    var cardSeri = $.trim($('#card-seri').val());
    var cardPin = $.trim($('#card-pin').val());
  
    if (!$('input:radio', this).is(':checked')) {
      $('#top-up-err-msg').text('Hãy chọn nhà mạng cung cấp');
      $("#top-up-err-msg").css("display", "block");
      return false;
    }
  
    if (!cardValue) {
      $('#top-up-err-msg').text('Hãy chọn mệnh giá thẻ');
      $("#top-up-err-msg").css("display", "block");
      return false;
    }
  
    if (cardSeri === '') {
      $('#top-up-err-msg').text('Hãy nhập vào số seri');
      $("#top-up-err-msg").css("display", "block");
      $('#card-seri').focus();
      return false;
    }
  
    if (cardPin === '') {
      $('#top-up-err-msg').text('Hãy nhập vào mã thẻ');
      $("#top-up-err-msg").css("display", "block");
      $('#card-pin').focus();
      return false;
    }
  });
}