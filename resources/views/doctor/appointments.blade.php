@extends('layout.docapp')

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
            <a href="#modal-add" uk-toggle><button class="uk-button uk-button-primary"><span uk-icon="plus"></span> Schedule Appointment</button></a>
            <div id="modal-add" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <form action="{{url('/doctor/appointment/add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h2 class="uk-modal-title">Schedule Appointment</h2>
                        <div >


                            <div class="uk-width-1-1@s">

                                <div class="uk-margin">
                                    <label class="uk-form-label">Student</label>
                                        <div class="uk-form-controls">
                                            <select name="student_id" id="">
                                                <option value="">Select Students</option>
                                                @foreach($students as $stud)
                                                <option value="{{$stud->id}}"> {{ $stud->name}} </option>
                                                @endforeach
                                            </select>
                                          {{-- <input type="text" name="student_name" class="uk-input" value="" id=""> --}}
                                        </div>

                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">Reason</label>
                                        <div class="uk-form-controls">
                                            <textarea type="text" name="reason" class="uk-input" value="" id=""></textarea>
                                        </div>

                                </div>

                               


                              
                                
                            </div>
                        </div>
                            <br>
                            <span id="enter">
                            </span>
                        

                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                            <button class="uk-button uk-button-primary" type="submit">Save</button>
                        </p>
                    </form>
                </div>
            </div>
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
                        <th>NAME OF PATIENT</th>
                        <th>REASON</th>
                        <th>APPOINTMENT DATE</th>
                        <th>DATE CREATED</th>
                        <th>STATUS</th>
                        <th style="min-width: 70px">CHECK</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->clinic_id ?? "" }}</td>
                            <td>{{ $appointment->doctor_name ?? ""}}</td>
                            <td>{{ $appointment->student_name ?? ""}}</td>
                            <td>{{ $appointment->reason ?? ""}}</td>
                            <td>{{ $appointment->appointment_time ?? "" }}</td>
                            <td>{{ $appointment->created_at ?? "" }}</td>
                            <td>{{ strtoupper($appointment->status  ?? "") }}</td>
                            <td>
                                <a href="#modal-edit{{$appointment->id}}" uk-toggle><span uk-icon="pencil"></span></a>
                                <div id="modal-edit{{$appointment->id}}" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body">
                                        <form action="{{url('/doctor/appointment/approve/'.$appointment->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h2 class="uk-modal-title">Appointment Details</h2>
                                            <div >


                                                <div class="uk-width-1-1@s">
                                                    <div class="uk-margin">
                                                        <label class="uk-form-label">Name</label>
                                                            <div class="uk-form-controls">
                                                               {{ $appointment->student_name ?? "" }}
                                                            </div>

                                                    </div>
                                                    <div class="uk-margin">
                                                        <label class="uk-form-label">Reason</label>
                                                            <div class="uk-form-controls">
                                                                {{  $appointment->reason ?? ""  }}
                                                            </div>

                                                    </div>

                                                    <div class="uk-margin">
                                                        <label class="uk-form-label">Choose Doctor</label>
                                                            <div class="uk-form-controls">
                                                                <select name="doctor_id" id="" class="uk-form-controls" required>
                                                                    <option value="">Select Doctor</option>
                                                                    @foreach($doctors as $doc)
                                                                    <option value="{{$doc->id}}">{{$doc->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                    </div>
                                                    <div class="uk-margin">
                                                        <label class="uk-form-label">Doctor's note</label>
                                                            <div class="uk-form-controls">
                                                                <textarea type="text" name="doctors_note" class="uk-textarea" rows="5"  value="" id=""></textarea>
                                                            </div>

                                                    </div>

                                                    <div class="uk-margin">
                                                        <label class="uk-form-label">Date/Time for appointment</label>
                                                            <div class="uk-form-controls">
                                                                <input type="datetime-local" name="appointment_date">
                                                            </div>

                                                    </div>


                                                    
                                                </div>
                                            </div>
                                                <br>
                                                <span id="enter">
                                                </span>
                                            

                                            <p class="uk-text-right">
                                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                                <button class="uk-button uk-button-primary" type="submit">Save</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
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
