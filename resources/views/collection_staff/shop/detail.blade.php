@extends('collection_staff.layout.index')

@section('title')
    {{$shop->name}} Shop Detail
@endsection

@section('styles')
    <style>
        .heading_bold {
            font-weight : bolder
        }
    </style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header bg-dark header-elements-inline">
                <h5 class="card-title">{{$shop->name}} Shop Detail</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-success-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Name </h5> <p class="font-weight-semibold">{{@$shop->shop_name}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-success-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Owner Name </h5> <p class="font-weight-semibold">{{@$shop->owner_name}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-success-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Phone </h5> <p class="font-weight-semibold">{{@$shop->phone}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-success-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Email </h5> <p class="font-weight-semibold">{{@$shop->email}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-danger-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Establishment Category </h5> <p class="font-weight-semibold">{{@$shop->establishment_category->name}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-danger-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Establishment </h5> <p class="font-weight-semibold">{{@$shop->establishment->name}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-danger-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Number </h5> <p class="font-weight-semibold">{{@$shop->shop_number}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-danger-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Size </h5> <p class="font-weight-semibold">{{@$shop->shop_size}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-warning-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Type </h5> <p class="font-weight-semibold">{{@$shop->shop_type}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-warning-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Structure </h5> <p class="font-weight-semibold">{{@$shop->structure?$shop->structure->name : ' '}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-warning-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Rent </h5> <p class="font-weight-semibold">{{@$shop->shop_rent}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-warning-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Rent Frequency </h5> <p class="font-weight-semibold">{{@$shop->rent_frequency}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-teal-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop ID Proof </h5> <p class="font-weight-semibold">{{@$shop->id_proof}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-teal-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Lat/Long </h5> <p class="font-weight-semibold">{{@$shop->lat_long}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-teal-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Zone </h5> <p class="font-weight-semibold">{{@$shop->zone->name}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-teal-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Ward </h5> <p class="font-weight-semibold">{{@$shop->ward->name}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-primary-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Allotment Date </h5> <p class="font-weight-semibold">{{@$shop->allotment_date}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-primary-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Number of Years </h5> <p class="font-weight-semibold">{{@$shop->number_of_years}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-primary-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Valid Upto </h5> <p class="font-weight-semibold">{{@$shop->valid_upto}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card border-left-3 border-left-primary-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Allotment Number </h5> <p class="font-weight-semibold">{{@$shop->allotment_number}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card border-left-3 border-left-info-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Trade License Number </h5> <p class="font-weight-semibold">{{@$shop->trade_license_number}}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card border-left-3 border-left-info-400 rounded-left-0">
                                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <span><h5>Shop Address </h5> <p class="font-weight-semibold">{{@$shop->location}}</p></span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

@endsection

@section('scripts')

@endsection