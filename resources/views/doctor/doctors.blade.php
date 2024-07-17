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
        <div><h2 style="font-weight: bold">DOCTORS</h2></div>
        <br>
        <div style="text-align: right">
            <a href="#modal-add" uk-toggle><button class="uk-button uk-button-primary"><span uk-icon="plus"></span> Add Doctor</button></a>
            <div id="modal-add" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <form action="{{url('/doctor/add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h2 class="uk-modal-title">Add New Doctor</h2>
                        <div >


                            <div class="uk-width-1-1@s">

                                <div class="uk-margin">
                                    <label class="uk-form-label">Name</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="fullName" class="uk-input" value="" id="">
                                        </div>

                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">Email</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="email" class="uk-input" value="" id="">
                                        </div>

                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">Password</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="password" class="uk-input" value="" id="">
                                        </div>

                                </div>


                               <div class="uk-margin">
                                    <label class="uk-form-label">Sex</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="sex" class="uk-input" value="" id="">
                                        </div>

                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label">Qualification</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="qualification" class="uk-input" value="" id="">
                                        </div>

                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label">Level</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="level" class="uk-input" value="" id="">
                                        </div>

                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">Start Date</label>
                                        <div class="uk-form-controls">
                                            <input type="text" name="start_date" class="uk-input" value="" id="">
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
                        <th>DOCTOR NAME</th>
                        <th>SEX</th>
                        <th>QUALIFICATION</th>
                        <th>LEVEL</th>
                        <th>START DATE</th>
                        <th>STATUS</th>
                        {{-- <th style="min-width: 70px">EDIT</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($doctor as $doc)
                    <tr>
                        <td> {{ $doc->name}} </td>
                        <td>{{ $doc->sex}}</td>
                        <td>{{ $doc->qualification}}</td>
                        <td>{{ $doc->level}}</td>
                        <td>{{ $doc->start_date}}</td>
                        <td>{{ $doc->status}}</td>
                        {{-- <td>
                            <a href="#modal-edit{{$doc->id}}" uk-toggle><span uk-icon="pencil"></span></a>
                        </td> --}}
                    </tr>
                 @endforeach
                    </tbody>
                </table>
              
            </div>
        </div>
    </div>
</div>
@endsection
