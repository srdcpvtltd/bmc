@extends('super_admin.layout.index')

@section('title')
Manage Monthly Payment Cronjob
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Create Monthly Payment Cronjob</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.cronjob.create-monthly-payment')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row"><div class="form-group col-md-6">
                        <label>Month</label>
                        <select name="month" id="month" class="form-control select-search" data-fouc required>
                            <option value="">Select Month</option>
                            <option value='Janaury'>Janaury</option>
                            <option value='February'>February</option>
                            <option value='March'>March</option>
                            <option value='April'>April</option>
                            <option value='May'>May</option>
                            <option value='June'>June</option>
                            <option value='July'>July</option>
                            <option value='August'>August</option>
                            <option value='September'>September</option>
                            <option value='October'>October</option>
                            <option value='November'>November</option>
                            <option value='December'>December</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Year</label>
                        <select name="year" id="year" class="form-control select-search" data-fouc required>
                            <option value="" >Select Year</option>
                            @for($year = 2022;$year <= 2026;$year++)
                            <option value="{{$year}}">{{$year}}</option>
                            @endfor
                        </select>
                    </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div>
                    
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

@endsection

@section('scripts')

@endsection