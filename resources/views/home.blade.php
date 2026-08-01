@extends('layouts.app')
@section('content')
<div class="container-fluid p-5">

    <div class="mb-5 text-center">
    <h2 style="background:#980406; color:#fff; padding:30px 70px; display: inline-block; border-radius: 10px; " >Welcome to <br/>Hindu Temple, Omaha <br/>Admin Dashboard</h2>
    </div>

    @if(getLoggedInUserRole() == 'super admin' || getLoggedInUserRole() == 'Developer Admin')
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-primary card-outline admin-card">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="icon bg-primary"><span class="material-symbols-outlined">
                                    spa
                                </span></div>
                        </div>
                        <h2 class="profile-username text-center mb-5">Pooja Requests</h2>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                View
                                <!-- <i>(30)</i>  -->
                                <a href="{{ route('pujaOrders.index') }}" class="float-right">
                                    <span class="material-symbols-outlined">
                                        east
                                    </span>
                                </a>
                            </li>
                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-primary card-outline admin-card">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="icon bg-secondary"><span class="material-symbols-outlined">
                            hallway
                                </span></div>
                        </div>
                        <h2 class="profile-username text-center mb-5">Social Hall Orders</h2>
                        <ul class="list-group list-group-unbordered ">
                            <li class="list-group-item">
                            View <a href="{{ route('hallOrders.index') }}" class="float-right">
                                    <span class="material-symbols-outlined">
                                        east
                                    </span>
                                </a>
                            </li>
                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-primary card-outline admin-card">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="icon bg-tertiary"><span class="material-symbols-outlined">
                            festival
                                </span></div>
                        </div>
                        <h2 class="profile-username text-center mb-5">Temple Tours Request</h2>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                            View <a href="{{ route('templeTours.index') }}" class="float-right">
                                    <span class="material-symbols-outlined">
                                        east
                                    </span>
                                </a>
                            </li>
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
    @endif
</div>
@endsection