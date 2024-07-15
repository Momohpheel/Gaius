@extends('layout.app')

@section('content')
<div class="uk-container" style="padding: 10px">
    <h2 style="font-weight: bold">Dashboard</h2>
    <br>
    <h3>You're welcome {{ $output['user']->name }}</h3>
    <h6>MATRIC NUMBER : {{ $output['user']->matric_number }}</h6>
    <br>
    <div>
        <div class="uk-child-width-1-3@m uk-child-width-1-2 uk-grid-small uk-grid-match" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">APPOINTMENT</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500"> {{ $output['appointments']}}</div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                            <a href="{{url('/student/schedule-appointment')}}" style="text-decoration: none;color: #27AE60;font-weight: 600">Schedule an appointment</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">RECORD</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500"> - </div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(244, 0, 35, 0.05);color: #F40023 ">
                            <a href="#modalrecord" style="text-decoration: none;color: #F40023;font-weight: 600" uk-toggle>Check Medical Records</a>
                         <!-- This is the modal -->
                         <div id="modalrecord" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body m-l-dialog">
                                <h3 class="uk-modal-title" style="font-size: 20px">{{ $output['user']->name }}</h3>
                                <div>
                                    <span style="padding: 5px 10px;background: rgba(242, 7, 7, 0.1);color:#F2AD07 ">MEDICAL RECORD</span> 
                                </div>
                                <br>

                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-1-3@m" style="border-right: 1px solid #EFEFEF">
                                        <div style="font-size: 12px;color: #C4C4C4">MEDICAL DETAILS</div>
                                        <div style="color: #25282B">
                                            <div>Genotype: {{ $output['record']->genotype }}</div>
                                            <div>Blood Group: {{ $output['record']->bloodgroup }}</div>
                                            <div>Deformity (Yes/No): {{ $output['record']->deformity }}</div>
                                            <div>Type of Deformity: {{ $output['record']->deformityType }}</div>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3@m" style="border-right: 1px solid #EFEFEF">
                                        {{-- <div style="font-size: 12px;color: #C4C4C4">CUSTOMER DETAILS</div> --}}
                                        <div style="color: #25282B">
                                            Recurring Illness : {{ $output['record']->recurringIllness }}
                                        </div>
                                        <div style="color: #25282B">
                                            Phone Number: {{ $output['record']->phoneNumber }}
                                        </div>
                                    </div>
                                    <div class="uk-width-expand@m">
                                        <div style="font-size: 12px;color: #C4C4C4">RECORD</div>
                                        <div style="color: #25282B">
                                           CLINIC ID: {{ $output['record']->clinicId }}
                                        </div>
                                    </div>
                                </div>
                              
                                <hr>
                                <div style="background-color: #f1f1f1; border-radius: 5px;padding: 5px 10px">NOTE: Take note of your Clinic ID</div>
                                <br>
                                
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">PRESCRIPTIONS</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{ $output['prescription'] }}</div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(255, 174, 52, 0.1);color: #FFAE34 ">
                            <a href="{{url('/student/prescription')}}" style="text-decoration: none;color: #FFAE34;font-weight: 600">+Get Prescriptions</a>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

    <br>
    <br>

    <div class="uk-grid-small" uk-grid>
        <div class="uk-width-2-3@m">
            <div style="font-size: 18px;">Recent Appointments</div>
            <br>
            <div class="uk-card uk-card-default uk-card-body" style="padding: 0px">
                <table class="uk-table uk-table-divider">
                    <thead class="m-th">
                    <tr>
                        <th>DOCTOR NAME</th>
                        <th>DATE/TIME</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach($output['appointment_list'] as $list) 
                    <tr>
                        <td> {{ $list->doctor_name ?? "" }} </td>
                        <td> {{ $list->appointment_time ?? "" }} </td>
                        <td>
                          @if($list->status == 'pending') <span style="padding: 5px 10px;background: rgba(26, 183, 89, 0.1);color:#e6ea0b ">PENDING</span>  @endif
                          @if($list->status == 'accepted') <span style="padding: 5px 10px;background: rgba(26, 183, 89, 0.1);color:#221ab7 ">ACCEPTED</span>  @endif
                          @if($list->status == 'completed') <span style="padding: 5px 10px;background: rgba(26, 183, 89, 0.1);color:#1AB759 ">COMPLETED</span>  @endif
                        </td>
                    </tr>
                    @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="uk-width-expand@m">
            <div style="font-size: 18px;">Accepted Appointments</div>
            <br>
            <div class="uk-card uk-card-default uk-card-body" style="padding: 0px">
                <table class="uk-table uk-table-divider">
                    <tbody>
                    @foreach($output['accepted_appointment'] as $list) 
                    <tr>
                        <td>
                            {{ $list->doctor_name ?? ""}}
                        </td>
                        <td style="text-align: right">
                            {{ $list->appointment_time ?? "" }}
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
