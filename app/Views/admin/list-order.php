<?php

use CodeIgniter\Images\Image;
?>
<?= $this->extend('Template/sidebar') ?>

<?= $this->section('content') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/redmond/jquery-ui.css"></script>

<style>
  .date-picker {
    margin-left: 20px;
  }

  .date-picker {
    width: 260px;
    height: auto;
    max-height: 50px;
    background: white;
    position: relative;
    overflow: hidden;
    transition: all 0.3s 0s ease-in-out;
  }

  .date-picker .input {
    width: 100%;
    height: 50px;
    font-size: 0;
    cursor: pointer;
  }

  .date-picker .input .result,
  .date-picker .input button {
    display: inline-block;
    vertical-align: top;
  }

  .date-picker .input .result {
    width: calc(100% - 50px);
    height: 50px;
    line-height: 50px;
    font-size: 16px;
    padding: 0 10px;
    color: grey;
    box-sizing: border-box;
  }

  .date-picker .input button {
    width: 50px;
    height: 50px;
    /* background-color: #8392A7; */
    color: white;
    line-height: 50px;
    border: 0;
    font-size: 18px;
    padding: 0;
  }

  .date-picker .input button:hover {
    /* background-color: #68768A; */
  }

  .date-picker .input button:focus {
    outline: 0;
  }

  .date-picker .calendar {
    position: relative;
    width: 100%;
    /* background: #fff; */
    border-radius: 0px;
    overflow: hidden;
  }

  .date-picker .ui-datepicker-inline {
    position: relative;
    width: 100%;
  }

  .date-picker .ui-datepicker-header {
    height: 100%;
    line-height: 50px;
    /* background: #8392A7; */
    color: #fff;
    margin-bottom: 10px;
  }

  .date-picker .ui-datepicker-prev,
  .date-picker .ui-datepicker-next {
    width: 20px;
    height: 20px;
    text-indent: 9999px;
    border: 2px solid #fff;
    border-radius: 100%;
    cursor: pointer;
    overflow: hidden;
    margin-top: 12px;
  }

  .date-picker .ui-datepicker-prev {
    float: left;
    margin-left: 12px;
  }

  .date-picker .ui-datepicker-prev:after {
    transform: rotate(45deg);
    margin: -43px 0px 0px 8px;
  }

  .date-picker .ui-datepicker-next {
    float: right;
    margin-right: 12px;
  }

  .date-picker .ui-datepicker-next:after {
    transform: rotate(-135deg);
    margin: -43px 0px 0px 6px;
  }

  .date-picker .ui-datepicker-prev:after,
  .date-picker .ui-datepicker-next:after {
    content: '';
    position: absolute;
    display: block;
    width: 4px;
    height: 4px;
    border-left: 2px solid #fff;
    border-bottom: 2px solid #fff;
  }

  .date-picker .ui-datepicker-prev:hover,
  .date-picker .ui-datepicker-next:hover,
  .date-picker .ui-datepicker-prev:hover:after,
  .date-picker .ui-datepicker-next:hover:after {
    border-color: #68768A;
  }

  .date-picker .ui-datepicker-title {
    text-align: center;
  }

  .date-picker .ui-datepicker-calendar {
    width: 100%;
    text-align: center;
  }

  .date-picker .ui-datepicker-calendar thead tr th span {
    display: block;
    width: 100%;
    color: #8392A7;
    margin-bottom: 5px;
    font-size: 13px;
  }

  .date-picker .ui-state-default {
    display: block;
    text-decoration: none;
    color: #b5b5b5;
    line-height: 40px;
    font-size: 12px;
  }

  .date-picker .ui-state-default:hover {
    /* background: rgba(0, 0, 0, 0.02); */
  }

  .date-picker .ui-state-highlight {
    color: #68768A;
  }

  .date-picker .ui-state-active {
    color: #68768A;
    /* background-color: rgba(131, 146, 167, 0.12); */
    font-weight: 600;
  }

  .date-picker .ui-datepicker-unselectable .ui-state-default {
    color: #eee;
    border: 2px solid transparent;
  }

  .date-picker.open {
    max-height: 400px;
  }

  .date-picker.open .input button {
    /* background: #68768A; */
  }
</style>
<!-- 
<span class="datepicker-toggle">
  <span class="datepicker-toggle-button"></span>
  <input type="date" class="datepicker-input">
</span> -->


<div class="date-picker">
  <div class="input">
    <div class="result">Select Date: <span></span></div>
    <button><i class="fa fa-calendar"></i></button>
  </div>
  <div class="calendar"></div>
</div>


<!-- Embedding PHP array as JSON in a hidden input -->
<input type="hidden" id="phpArray" value="<?php echo htmlspecialchars(json_encode($date)); ?>">
<script>
  $(function() {
    $('.calendar').on('click', function() {
      $('.calendar')
    })
    var disabledDates = JSON.parse(document.getElementById('phpArray').value);
    $(".calendar").datepicker({
      dateFormat: 'dd/mm/yy',
      firstDay: 1,
      beforeShowDay: function(date) {
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [disabledDates.indexOf(string) == -1]
      }
    }).on('change', function() {
      var $me = $(this),
        $parent = $me.parents('.date-picker');
      $parent.toggleClass('open');
    });

    $(document).on('click', '.date-picker .input', function(e) {
      var $me = $(this),
        $parent = $me.parents('.date-picker');
      $parent.toggleClass('open');
    });


    $(".calendar").on("change", function() {
      var $me = $(this),
        $selected = $me.val(),
        $parent = $me.parents('.date-picker');
      $parent.find('.result').children('span').html($selected);
    });

  });
</script>
<?= $this->endSection(); ?>