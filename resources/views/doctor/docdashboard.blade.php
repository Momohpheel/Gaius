@extends('layout.docapp')

@section('content')
<div class="uk-container" style="padding: 10px">
    <h2 style="font-weight: bold">Dashboard</h2>

    <div>
        <div class="uk-child-width-1-3@m uk-child-width-1-2 uk-grid-small uk-grid-match" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">STUDENTS</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{ $output['students'] }}</div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(39, 174, 96, 0.05);color: #27AE60 ">
                            <a href="{{url('/doctor/students')}}" style="text-decoration: none;color: #27AE60;font-weight: 600">+All Students</a>
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
                        <div style="text-align: center;padding: 10px;background: rgba(244, 0, 35, 0.05);color: #F40023 ">
                            <a href="{{url('/')}}" style="text-decoration: none;color: #F40023;font-weight: 600">+Add Prescription</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">PENDING APPOINTMENTS</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{ $output['pending_appointment'] }}</div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(255, 174, 52, 0.1);color: #FFAE34 ">
                            <a  style="text-decoration: none;color: #FFAE34;font-weight: 600">Pending Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">ALL APPOINTMENTS</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500">{{ $output['appointments']}}</div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(2, 0, 75, 0.05);color: #02004B ">
                            <a href="{{url('/doctor/appointment')}}" style="text-decoration: none;color: #02004B;font-weight: 600">+Check Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">MEDICATIONS / DRUGS</div>
                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500"> - </div>
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(182, 110, 2, 0.05);color: #B66E02 ">
                            <a href="{{url('/')}}" style="text-decoration: none;color: #B66E02;font-weight: 600">+Add Medications</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="padding: 0px 0px;">
                    <div style="text-align: right">
                        <div style="padding: 20px 30px">
                            <div style="color: #7E7E7E; font-size: 12px;">DOCTORS</div>

                            <div style="font-size: 30px;line-height: 33px;color: #000;font-weight: 500; ">{{ $output['doctors'] }}</div>
                            {{-- {{number_format($total_payments/100,2)}} --}}
                        </div>
                        <div style="text-align: center;padding: 10px;background: rgba(13, 111, 225, 0.05);color: #0D6FE1 ">
                            <a href="{{url('/doctor/all')}}" style="text-decoration: none;color: #0D6FE1;font-weight: 600; ">+Add Doctor</a>
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
                        <th>STUDENT NAME</th>
                        <th>DATE/TIME</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach($output['appointment_list'] as $list) 
                    <tr>
                        <td> {{ $list->doctor_name ?? "" }} </td>
                        <td> {{ $list->student_name ?? "" }} </td>
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
            <div style="font-size: 18px;">Pending Appointments</div>
            <br>
            <div class="uk-card uk-card-default uk-card-body" style="padding: 0px">
                <table class="uk-table uk-table-divider">
                    <tbody>
                    @foreach($output['accepted_appointment'] as $list) 
                    <tr>
                        <td>
                            {{ $list->student_name ?? ""}} <br>
                            {{ $list->clinic_id ?? "No Clinic ID"}}
                        </td>
                        <td style="text-align: right">
                            {{ $list->created_at ?? "" }}
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
