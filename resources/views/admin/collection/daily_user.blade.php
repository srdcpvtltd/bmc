@extends('admin.layout.index')

@section('title')
    Daily Collection By Collection Agent
@endsection

@section('content')
<div class="card">

    <div class="card-header header-elements-inline">
        <h5 class="card-title">Search Payment By Date</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body"> 
        <form class="form-inline" method="GET">
            <div class="form-group">
                <label>Date</label>
                <input type="date" value="{{$date}}" name="date" class="form-control ml-2">
            </div>
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>
    </div>
</div>

@foreach($users as $user)
<div class="row">
    <div class="col-sm-6 col-xl-4">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-user icon-3x text-success-400"></i>
                </div>

                <div class="media-body text-right">
                    <a href="{{route('admin.collection.show_daily',$user->id)}}">
                        <h3 class="font-weight-semibold mb-0">{{$user->name}}</h3>
                    </a>
                    <span class="text-uppercase font-size-sm text-muted">Collection Agent Name</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-cash icon-3x text-indigo-400"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">{{$user->cash_amount}}</h3>
                    <span class="text-uppercase font-size-sm text-muted">Total Cash Collection</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card card-body">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-coins icon-3x text-warning-400"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="font-weight-semibold mb-0">{{$user->upi_amount}}</h3>
                    <span class="text-uppercase font-size-sm text-muted">Total UPI Collection</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('scripts')
@endsection
