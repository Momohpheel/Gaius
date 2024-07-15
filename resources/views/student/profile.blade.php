@extends('layout.app')

@section('content')
<div class="uk-container" style="padding: 10px">

    <h2 style="font-weight: bold">PROFILE</h2>


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
        <form method="post" action="/student/profile">
@csrf
       <div class="uk-child-width-1-1@m uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
                <div>
                        <div>

                            <label for="">Full Name</label>
                            <div style="background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                                <input  type="text"  style="max-height: 150px" class="uk-input inputField" name="name" value="{{$user->name}}"  required>
                            </div>

                            <br>
                            <label for="">Matric Number</label>
                            <div style="background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                                <input  type="text"  style="max-height: 150px" class="uk-input inputField" name="matricNumber" value="{{$user->matric_number}}"  disabled>
                            </div>
                            <br>

                            <label for="">Email Address</label>
                            <div style="background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                                <input  type="email"  style="max-height: 150px" class="uk-input inputField" name="email" value="{{$user->email}}"  required>
                            </div>
                            <br>
                            
                          
                           
                            <br>
                            <div style="text-align: right" class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="uk-button uk-button-primary">
                                        {{ __('Update') }}
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
