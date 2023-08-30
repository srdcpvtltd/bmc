@extends('admin.layout.index')

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
            <div class="card-header header-elements-inline">
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
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Name :</p>
                            <p>{{@$shop->shop_name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Owner Name :</p>
                            <p>{{@$shop->owner_name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Phone :</p>
                            <p>{{@$shop->phone}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Email :</p>
                            <p>{{@$shop->email}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Establishment Category :</p>
                            <p>{{@$shop->establishment_category->name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Establishment :</p>
                            <p>{{@$shop->establishment->name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Establishment Shop Number :</p>
                            <p>{{@$shop->establishment_shop->shop_number}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Number :</p>
                            <p>{{@$shop->shop_number}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Size :</p>
                            <p>{{@$shop->shop_size}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Type :</p>
                            <p>{{@$shop->shop_type}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Rent :</p>
                            <p>{{@$shop->shop_rent}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Rent :</p>
                            <p>{{@$shop->shop_rent}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Rent Frequency :</p>
                            <p>{{@$shop->shop_rent}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop ID Proof :</p>
                            <p>{{@$shop->id_proof}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Lat/Long :</p>
                            <p>{{@$shop->lat_long}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Zone :</p>
                            <p>{{@$shop->zone->name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Ward :</p>
                            <p>{{@$shop->ward->name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Address :</p>
                            <p>{{@$shop->location}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Shop Allotment Date :</p>
                            <p>{{@$shop->allotment_date}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Number of Years :</p>
                            <p>{{@$shop->number_of_years}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Valid Upto :</p>
                            <p>{{@$shop->valid_upto}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="heading_bold">Allotment Number :</p>
                            <p>{{@$shop->allotment_number}}</p>
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