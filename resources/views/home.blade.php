@extends('layouts.master')
@section('content')
<div id="main">
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3></h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="header-checkbox-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="event_url" value="event" checked>
                                    <label class="form-check-label" for="event_url">
                                        Event URL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="chating_url" value="chating">
                                    <label class="form-check-label" for="chating_url">
                                        配信者
                                    </label>
                                    </div>
                                </div>
                            <div>
                                <!-- <label for="s_url">Event URL || 配信者 Nickname</label> -->
                                <input id="purpose_url" type="text" class="form-control" />
                            </div>
                            <!-- <div class="help-panel">
                                <p># 使い方</p>
                                <p>イベントURLと送信者Nicknameを2つ以上入力する場合は、「;」で区切って入力する必要があります。</p>
                                <p>例: 「https://event.17.live/17955-2309-jp-beginner02;https://event.17.live/17955-2309-jp-beginner02」, 「ほなみ🐣🍎;なみ🍎」</p>
                            </div> -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="start-date-panel">
                                <h4>Scraping 開始日</h4>
                                <div class="mb-3 position-relative" id="datepicker4">
                                    <input type="text" id="start-date" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4">
                                </div>
                            </div>
                            <div class="start-time-panel">
                                <h4>Scraping 開始時</h4>
                                <div>
                                    <div>
                                        <!-- <input id="timepicker" type="text" class="form-control flatpickr-input" /> -->
                                        <input id="start-time" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="end-date-panel">
                                <h4>Scraping 終了日</h4>
                                <div class="mb-3 position-relative" id="datepicker5">
                                    <input type="text" id="end-date" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker5">
                                </div>
                            </div>
                            <div class="end-time-panel">
                                <h4>Scraping 終了時</h4>
                                <div>
                                    <div>
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
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h4>Scraping 結果</h4>
                                <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item" role="presentation">
                                        <a href="#default-accordions-preview" class="nav-link active" data-bs-toggle="tab" role="tab" aria-controls="nav-preview" aria-selected="true">
                                            Event
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#default-accordions-code" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="nav-code" aria-selected="false">
                                            配信者
                                        </a>
                                    </li>
                                </ul> <!-- end nav-->
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="default-accordions-preview">
                                        <table class="table table-sm table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>URL</th>
                                                    <th>開始日時</th>
                                                    <th>終了日時</th>
                                                    <th>状態</th>
                                                </tr>
                                            </thead>
                                            <tbody class="event-table">
                                                <!-- <tr>
                                                    <td>ほなみ🐣🍎</td>
                                                    <td>2023-09-25 12:20</td>
                                                    <td>2023-09-26 13:30</td>
                                                    <td><span class="badge bg-primary">作動中</span></td>
                                                </tr>
                                                <tr>
                                                    <td>https://event.17.li</td>
                                                    <td>2023-09-25 00:00:00</td>
                                                    <td>2023-09-30 01:00:00</td>
                                                    <td>URLパスが正しくないため、動作を停止します。</td>
                                                </tr>
                                                <tr>
                                                    <td>https://event.17.live/17955-2309-jp-beginner02</td>
                                                    <td>2023-09-25 00:00:00</td>
                                                    <td>2023-09-30 01:00:00</td>
                                                    <td><span class="badge bg-primary">作動中</span></td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div> <!-- end preview-->
                                    <div class="tab-pane" id="default-accordions-code">
                                        <table class="table table-sm table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>URL</th>
                                                    <th>開始日時</th>
                                                    <th>終了日時</th>
                                                    <th>状態</th>
                                                </tr>
                                            </thead>
                                            <tbody class="chating-table">
                                            </tbody>
                                        </table>
                                    </div> <!-- end preview code-->
                                </div> <!-- end tab-content-->
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    var request_url = '{{ $_SERVER['SERVER_NAME'] }}:5000';
    $(document).ready(function () {
        function get_history() {
            $.ajax({
                url: "/get_history",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(xhr) {
                    var token = $('meta[name="csrf-token"]').attr("content");
                    if (token) {
                        return xhr.setRequestHeader("X-CSRF-TOKEN", token);
                    }
                },
                success: function(response) {
                    console.log("response.data ->",response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.fullScreenSpin').hide();
                }
            });
        }

        // get_history();
        // Event of Start Button.
        $('.start-scraping').on('click', function () {
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
            var purpose_url = $('#purpose_url').val();

            if(start_date == '' || start_time == '' || end_date == '') {
                toastr['warning']('開始日時と締め切り日を正確に入力してください。');
                return ;
            }
            
            if (purpose_url == '') {
                toastr['warning']('Scraping 宛先に関する情報を入力してください。');
                return ;
            }

            start_date_year = start_date.split('/')[0];
            start_date_month = start_date.split('/')[1];
            start_date_day = start_date.split('/')[2];
            start_time_hour = start_time.split(':')[0];
            start_time_minute = start_time.split(':')[1];
            end_date_year = end_date.split('/')[0];
            end_date_month = end_date.split('/')[1];
            end_date_day = end_date.split('/')[2];
            end_time_hour = end_time.split(':')[0];
            end_time_minute = end_time.split(':')[1];

            if (end_date_month < start_date_month || 
                (end_date_month == start_date_month && end_date_day < start_date_day)) {
                if(start_date_year >= end_date_year) {
                    toastr['warning']('締め切りは開始日より遅くしてはいけません。');
                    return ;
                }
            }
            url_type = $('#event_url').is(':checked');

            $.ajax({
                url: "http://" + request_url + "/start",
                type: "POST",
                dataType: 'json',
                crossDomain: true,
                data: {
                    type: url_type,
                    start_date_year: start_date_year,
                    start_date_month: start_date_month,
                    start_date_day: start_date_day,
                    start_time_hour: start_time_hour,
                    start_time_minute: start_time_minute,
                    end_date_year: end_date_year,
                    end_date_month: end_date_month,
                    end_date_day: end_date_day,
                    end_time_hour: end_time_hour,
                    end_time_minute: end_time_minute,
                    purpose_url: purpose_url,
                },
                success: function(response) {
                    toastr[response[0]['type']](response[0]['msg']);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    toastr['error']('奉仕機の接続が失敗しました。');
                }
            });
        });
    }); 
</script>
@endsection
