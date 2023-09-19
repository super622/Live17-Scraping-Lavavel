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
                                <label for="s_url">Event URL</label>
                                <input id="event_url" type="text" class="form-control" placeholder="https://event.17.live/17953-2309-jp-love" />
                            </div>
                            <div>
                                <label for="g_url">伝達者 Nickname</label>
                                <input id="nick_url" type="text" class="form-control" placeholder="ましろ🐈‍⬛️🖤mashiro🐾" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="start-date-panel">
                                <h4>Scraping 開始日</h4>
                                <div>
                                    <div>
                                        <input type="text" class="form-control date" id="start-date" data-toggle="date-picker" data-single-date-picker="true">
                                    </div>
                                    <!-- <div>
                                        <label for="start-time">開始時間</label>
                                        <input id="start-time" type="text" class="form-control flatpickr-input" />
                                    </div> -->
                                </div>
                            </div>
                            <div class="end-date-panel">
                                <h4>Scraping 終了日</h4>
                                <div>
                                    <div>
                                        <input type="text" class="form-control date" id="end-date" data-toggle="date-picker" data-single-date-picker="true">
                                    </div>
                                    <!-- <div>
                                        <label for="end-time">終了時間</label>
                                        <input id="end-time" type="text" class="form-control flatpickr-input" />
                                    </div> -->
                                </div>
                            </div>
                            <div class="start-time-panel">
                                <h4>Scraping 開始時</h4>
                                <div>
                                    <div>
                                        <input id="start-time" type="text" class="form-control flatpickr-input" />
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
    $(document).ready(function () {
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
        $('.start-scraping').on('click', function () {
            console.log('click');
            var start_date_month = '';
            var start_date_day = '';
            var start_time_hour = '';
            var start_time_minute = '';
            var end_date_month = '';
            var end_date_day = '';

            var start_date = $('#start-date').val();
            var start_time = $('#start-time').val();
            var end_date = $('#end-date').val();
            var event_url = $('#event_url').val();
            var nick_url = $('#nick_url').val();

            if(start_date == '' || start_time == '' || end_date == '') {
                toastr['warning']('開始日時と締め切り日を正確に入力してください。');
                return ;
            } else if (event_url == '' || nick_url == '') {
                toastr['warning']('Scraping 宛先に関する情報を入力してください。');
                return ;
            }

            start_date_month = start_date.split('/')[1];
            start_date_day = start_date.split('/')[2];
            start_time_hour = start_time.split(':')[0];
            start_time_minute = start_time.split(':')[1];
            end_date_month = end_date.split('/')[1];
            end_date_day = end_date.split('/')[2];

            if (end_date_month <= start_date_month && end_date_day <= start_date_day) {
                toastr['warning']('締め切りは開始日より遅くしてはいけません。');
                return ;
            }
            
            $.ajax({
                url: "http://" + request_url + "/start",
                type: "POST",
                dataType: 'json',
                crossDomain: true,
                data: {
                    start_date_month: start_date_month,
                    start_date_day: start_date_day,
                    start_time_hour: start_time_hour,
                    start_time_minute: start_time_minute,
                    end_date_month: end_date_month,
                    end_date_day: end_date_day,
                    event_url: event_url,
                    nick_url: nick_url
                },
                success: function(response) {
                    toastr[response[0]['type']](response[0]['msg']);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    toastr['error'](errorThrown);
                }
            });
        });
    }); 
</script>
@endsection
