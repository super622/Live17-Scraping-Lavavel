@extends('layouts.master')
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3></h3>
    </div>
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>基本設定</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <h4>URL</h4>
                            <div>
                                <label for="s_url">対象 URL</label>
                                <input id="s_url" type="text" class="form-control" />
                            </div>
                            <div>
                                <label for="g_url">Google Sheet URL</label>
                                <input id="g_url" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="start-date-panel">
                                <h4>Scraping 開始日時</h4>
                                <div>
                                    <div>
                                        <label for="start-date">開始日</label>
                                        <input type="text" class="form-control date" id="start-date" data-toggle="date-picker" data-single-date-picker="true">
                                    </div>
                                    <div>
                                        <label for="start-time">開始時間</label>
                                        <input id="start-time" type="text" class="form-control flatpickr-input" />
                                    </div>
                                </div>
                            </div>
                            <div class="end-date-panel">
                                <h4>Scraping 終了日時</h4>
                                <div>
                                    <div>
                                        <label for="end-date">終了日</label>
                                        <input type="text" class="form-control date" id="end-date" data-toggle="date-picker" data-single-date-picker="true">
                                    </div>
                                    <div>
                                        <label for="end-time">終了時間</label>
                                        <input id="end-time" type="text" class="form-control flatpickr-input" />
                                    </div>
                                </div>
                            </div>
                            <div class="button-panel">
                                <button type="button" class="btn btn-success rounded-pill start-scraping">開始</button>
                                <button type="button" class="btn btn-danger rounded-pill stop-scraping">停止</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    var request_url = '{{ $_SERVER['SERVER_NAME'] }}:5000';
     $( function() {
        // Init Date picker.
        $.datepicker.regional['ja'] = {
            closeText: '閉じる',
            prevText: '&#x3c;前',
            nextText: '次&#x3e;',
            currentText: '今日',
            monthNames: ['1月','2月','3月','4月','5月','6月',
            '7月','8月','9月','10月','11月','12月'],
            monthNamesShort: ['1月','2月','3月','4月','5月','6月',
            '7月','8月','9月','10月','11月','12月'],
            dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
            dayNamesShort: ['日','月','火','水','木','金','土'],
            dayNamesMin: ['日','月','火','水','木','金','土'],
            weekHeader: '週',
            dateFormat: 'yy/mm/dd',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: '年'
        };
        $(".date").datepicker( $.datepicker.regional[ "ja" ] );

        // Init Time picker.
        $('.flatpickr-input').timepicker({
            timeFormat: 'H:mm',
            interval: 15,
            defaultTime: '0',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        // Event of Start Button.
        $('.start-scraping').click(function () {
            var start_date_month = '';
            var start_date_day = '';
            var start_time_hour = '';
            var start_time_minute = '';

            var end_date_month = '';
            var end_date_day = '';
            var end_time_hour = '';
            var end_time_minute = '';

            var start_date = $('#start-date').val();
            var start_time = $('#start-time').val();
            var end_date = $('#end-date').val();
            var end_time = $('#end-time').val();
            var site_url = $('#s_url').val();
            var gsheet = $('#g_url').val();

            if(start_date == '' || start_time == '' || end_date == '' || end_time == '') {
                toastr['warning']('開始日時と締め切り日を正確に入力してください。');
                return ;
            }

            start_date_month = start_date.split('/')[1];
            start_date_day = start_date.split('/')[2];
            start_time_hour = start_time.split(':')[0];
            start_time_minute = start_time.split(':')[1];

            end_date_month = end_date.split('/')[1];
            end_date_day = end_date.split('/')[2];
            end_time_hour = end_time.split(':')[0];
            end_time_minute = end_time.split(':')[1];
            
            $.ajax({
                url: "http://" + request_url + "/start",
                type: "GET",
                dataType: 'json',
                crossDomain: true,
                data: {
                    start_date_month: start_date_month,
                    start_date_day: start_date_day,
                    start_time_hour: start_time_hour,
                    start_time_minute: start_time_minute,
                    end_date_month: end_date_month,
                    end_date_day: end_date_day,
                    end_time_hour: end_time_hour,
                    end_time_minute: end_time_minute
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        });
    });
</script>
@endsection