$(document).ready(function () {
  $('#birth-date').mask('00/00/0000');
  $('#phone').mask('0000-0000-0000-0000');

  $('.price').mask('000.000.000.000.000', { reverse: true });
});
