@extends('layout.app')

@section('content')
<div class="uk-container" style="padding: 10px">

    <h2 style="font-weight: bold">SCHEDULE APPOINTMENT</h2>


    @if ( Session::has('success') )
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    @if ( Session::has('error') )
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ Session::get('error') }}</p>
        </div>
    @endif
    <div>
        <form method="post" action="/student/schedule" enctype="multipart/form-data">
@csrf
       <div class="uk-child-width-1-1@m uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
                <div>
                        <div>
                            <label for="">Reason for appointment</label>
                            <div style="background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                                <textarea rows="30" cols="30" class="uk-input uk-form-large" placeholder="" name="reason"></textarea>
                            </div>
                            <br>
                            <div>
                                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                                    <div style="padding: 10px;background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                                        <div class="custom-file-upload">
                                            <input type="file" name="image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div style="text-align: right" class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="uk-button uk-button-primary">
                                        {{ __('Schecule') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
       </div>
    </form>
    </div>
</div>
@endsection
