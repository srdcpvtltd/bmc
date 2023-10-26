@extends('zdc.layout.index')

@section('title')
    {{$shop->name}} Shop Detail
@endsection

@section('styles')
    <style>
        .heading_bold {
            font-weight : bolder
        }
        .dotted-line{
            border: none;
            margin-top:0px; 
            border-top: 2px dotted black
        }
    </style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Shop</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-top">
                    <li class="nav-item"><a href="#top-tab1" class="nav-link active" class="nav-link" data-toggle="tab">Shop Detail</a></li>
                    <li class="nav-item"><a href="#top-tab2" class="nav-link" data-toggle="tab">Payment Detail</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="top-tab1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6">
                                        <span>
                                            <h5>Shop Name </h5> 
                                            <p class="font-weight-semibold">
                                                {{@$shop->shop_name}}
                                            </p>
                                            <hr class="dotted-line">
                                        </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Owner Name </h5> 
                                        <p class="font-weight-semibold">{{@$shop->owner_name}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Phone </h5> 
                                        <p class="font-weight-semibold">{{@$shop->phone}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Email </h5> 
                                        <p class="font-weight-semibold">{{@$shop->email}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Establishment Category </h5> 
                                        <p class="font-weight-semibold">{{@$shop->establishment_category->name}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Establishment </h5> 
                                        <p class="font-weight-semibold">{{@$shop->establishment->name}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Number </h5> 
                                        <p class="font-weight-semibold">{{@$shop->shop_number}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Size </h5> 
                                        <p class="font-weight-semibold">{{@$shop->shop_size}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Type </h5> 
                                        <p class="font-weight-semibold">{{@$shop->shop_type}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Structure </h5> 
                                        <p class="font-weight-semibold">{{@$shop->structure?$shop->structure->name : ' '}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Rent </h5> 
                                        <p class="font-weight-semibold">{{@$shop->shop_rent}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Rent Frequency </h5> 
                                        <p class="font-weight-semibold">{{@$shop->rent_frequency}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop ID Proof </h5> 
                                        <p class="font-weight-semibold">{{@$shop->id_proof}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Lat/Long </h5> 
                                        <p class="font-weight-semibold">{{@$shop->lat_long}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Zone </h5> 
                                        <p class="font-weight-semibold">{{@$shop->zone->name}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Ward </h5> 
                                        <p class="font-weight-semibold">{{@$shop->ward->name}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Allotment Date </h5> 
                                        <p class="font-weight-semibold">{{@$shop->allotment_date}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Number of Years </h5> 
                                        <p class="font-weight-semibold">{{@$shop->number_of_years}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Valid Upto </h5> 
                                        <p class="font-weight-semibold">{{@$shop->valid_upto}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Allotment Number </h5> 
                                        <p class="font-weight-semibold">{{@$shop->allotment_number}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Trade License Number </h5> 
                                        <p class="font-weight-semibold">{{@$shop->trade_license_number}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                                <div class="col-xl-6">  
                                    <span>
                                        <h5>Shop Address </h5> 
                                        <p class="font-weight-semibold">{{@$shop->location}}</p>
                                        <hr class="dotted-line">
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade show active" id="top-tab2">
                        <div class="card-body">
                            
                            <div class="table-responsive mt-3">
                                <table class="table datatable-save-state">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th>Invoice Date</th>
                                            <th>Payment Date</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments  as $key => $payment)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{@$payment->month}}</td>
                                            <td>{{@$payment->amount}}</td>
                                            <td>{{@$payment->created_at->format('d M,Y')}}</td>
                                            <td>{{@$payment->payment_date}}</td>
                                            <td>{{@$payment->payment_mode}}</td>
                                            <td>{{$payment->is_paid ? 'Paid' : 'Not Paid'}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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