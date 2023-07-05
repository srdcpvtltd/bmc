@extends('admin.layout.index')

@section('title')
    Dashboard
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
            <div class="card card-body">
                <div class="media mb-0">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0 text-center">
                            Shop System
                        </h3>
                    </div>
                </div>
            </div>
            
    </div>
</div>
<div class="row">
    
    <div class="col-sm-4 col-xl-4">
        <a href="{{route('admin.zone.index')}}">
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{App\Models\Zone::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Zones</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-xl-4">
        <a href="{{route('admin.ward.index')}}">
            <div class="card card-body bg-danger-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-stack-picture icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{App\Models\Ward::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Wards</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-xl-4">
        <a href="{{route('admin.location.index')}}">
            <div class="card card-body bg-orange-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{App\Models\Location::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Locations</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-blog icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-xl-4">
        <a href="{{route('admin.structure.index')}}">
            <div class="card card-body bg-teal-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-question4 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right"> 
                        <h3 class="mb-0">{{App\Models\Structure::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Structure</span>
                    </div>

                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-xl-4">
        <a href="{{route('admin.establishment.index')}}">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">

                    <div class="mr-3 align-self-center">
                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3 class="mb-0">{{App\Models\Establishment::count()}}</h3>
                        <span class="text-uppercase font-size-xs">Total Establishments</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
@section('scripts')
@endsection
