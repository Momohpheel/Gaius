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
        <div><h2 style="font-weight: bold">STUDENTS</h2></div>
       
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
                        <th>NAME OF STUDENT</th>
                        <th>EMAIL</th>
                        <th>PHONE NUMBER</th>
                        <th>MATRIC NUMBER</th>
                        
                        <th style="min-width: 70px">MEDICAL RECORD</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($students as $student)
                    <tr>
                        <td>{{ $student['clinic_id'] }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student['phone'] }}</td>
                        <td>{{ $student->matric_number }}</td>
                        <td>
                            <a href="#modal-edit{{$student->id}}" uk-toggle><span uk-icon="pencil"></span></a>
                            <div id="modal-edit{{$student->id}}" uk-modal>
                                <div class="uk-modal-dialog uk-modal-body">
                                    <form action="{{url('/doctor/student/record/'.$student->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <h2 class="uk-modal-title">Medical Record</h2>
                                        <div >

                                            <label class="uk-form-label">CLINIC ID</label>
                                                        <div class="uk-form-controls">
                                                            {{ $student['record']->clinicId }}
                                                        </div>

                                            <div class="uk-width-1-1@s">
                                                <div class="uk-margin">
                                                    <label class="uk-form-label">Genotype</label>
                                                        <div class="uk-form-controls">
                                                            <input type="text" name="genotype" class="uk-input" value="{{$student['record']->genotype}}" id="">
                                                        </div>
                
                                                </div>
                
                                                <div class="uk-margin">
                                                    <label class="uk-form-label">Blood Group</label>
                                                        <div class="uk-form-controls">
                                                            <input type="text" name="bloodgroup" class="uk-input" value="{{$student['record']->bloodgroup}}" id="">
                                                        </div>
                
                                                </div>
                
                                                <div class="uk-margin">
                                                    <label class="uk-form-label">Deformity</label>
                                                        <div class="uk-form-controls">
                                                            <input type="text" name="deformity" class="uk-input" value="{{$student['record']->deformity}}" id="">
                                                        </div>
                
                                                </div>
                
                
                                               <div class="uk-margin">
                                                    <label class="uk-form-label">Type of Deformity</label>
                                                        <div class="uk-form-controls">
                                                            <input type="text" name="deformityType" class="uk-input" value="{{$student['record']->deformityType}}" id="">
                                                        </div>
                
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label">Recurring Illness</label>
                                                        <div class="uk-form-controls">
                                                            <input type="text" name="recurringIllness" class="uk-input" value="{{$student['record']->recurringIllness}}" id="">
                                                        </div>
                
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label">Phone Number</label>
                                                        <div class="uk-form-controls">
                                                            <input type="text" name="phoneNumber" class="uk-input" value="{{$student['record']->phoneNumber}}" id="">
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
