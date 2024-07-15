@extends('layout.app')

@section('content')
<div class="uk-container" style="padding: 0px 10px">
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

    <div class="uk-child-width-expand" uk-grid>
        <div><h2 style="font-weight: bold">Appointments</h2></div>
        <br>
        <div style="text-align: right">
            <a href="{{url('/student/schedule-appointment')}}"><button class="uk-button uk-button-primary"><span uk-icon="plus"></span> Schedule Appointment</button></a>
        </div>
    </div>

    <div  uk-grid>
        <div class="uk-width-1-4@m">
            <div class="uk-margin">
                <form method="get" class="uk-search uk-search-default" style="width: 100%">
                    <button type="submit" class="uk-search-icon-flip" uk-search-icon></button>
                    <input class="uk-search-input" name="search" value="" type="search" placeholder="Search ID">
                </form>
            </div>
        </div>
        <div class="uk-width-3-4@m">
            <form method="get" class="uk-grid-small uk-form-horizontal" uk-grid>
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="form-horizontal-select" style="width: 50px"><ion-icon name="funnel-outline"></ion-icon> </label>
                    <div class="uk-form-controls" style="margin-left: 50px;">
                        <select class="uk-select" id="form-horizontal-select" name="sort" onchange="this.form.submit()">
                            <option value="newest" >newest</option>
                            <option value="newest" >oldest</option>
                            {{-- <option value="status" @if($sort_by == 'status') selected @endif >status</option>
                            <option value="highest_amount" @if($sort_by == 'highest_amount') selected @endif >highest amount</option>
                            <option value="lowest_amount" @if($sort_by == 'lowest_amount') selected @endif >lowest amount</option> --}}
                        </select>
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="form-horizontal-select" style="width: 50px"><ion-icon name="filter-outline"></ion-icon> </label>
                    <div class="uk-form-controls" style="margin-left: 50px;">
                        <select class="uk-select" id="form-horizontal-select" name="status" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="uk-grid-small" uk-grid>
        <div class="uk-width-3-3@m">
            <div class="uk-hidden@m">
                <br>
                <div><img src="<?php echo e(asset('img/swipe.png')); ?>" style="width: 60px" alt=""> swipe table rows to view content</div>
            </div>
            <div class="uk-card uk-card-default uk-card-body uk-overflow-auto" style="padding: 0px">
                <table class="uk-table uk-table-middle uk-table-divider">
                    <thead class="m-th">
                    <tr>
                        <th>CLINIC ID</th>
                        <th>NAME OF DOCTOR</th>
                        <th>REASON</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th style="min-width: 70px">CHECK</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->clinic_id ?? "" }}</td>
                        <td>{{ $appointment->doctor_name ?? ""}}</td>
                        <td>{{ $appointment->reason ?? ""}}</td>
                        <td>{{ $appointment->appointment_time ?? "" }}</td>
                        <td>{{ strtoupper($appointment->status  ?? "") }}</td>
                        <td>
                          
                        </td>
                        
                    </tr>
                 @endforeach
                    </tbody>
                </table>
              
            </div>
        </div>
    </div>
</div>
@endsection
