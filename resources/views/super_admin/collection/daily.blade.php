@extends('super_admin.layout.index')

@section('title')
    Daily Collection
@endsection

@section('content')
<div class="row">
    @foreach(App\Models\Zone::all() as $zone)
        @if($zone->getCollection() > 0)
        <div class="col-sm-4 col-xl-4">
            <a href="{{route('super_admin.collection.show_daily',$zone->id)}}">
                <div class="card card-body bg-teal-400 has-bg-image">
                    <div class="media">
                        <div class="mr-3 align-self-center">
                            <i class="icon-question4 icon-3x opacity-75"></i>
                        </div>
                        <div class="media-body text-right"> 
                            <h3 class="mb-0">{{$zone->getCollection()}}</h3>
                            <span class="text-uppercase font-size-xs">{{$zone->name}}</span>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        @endif
    @endforeach
</div>
@endsection
@section('scripts')
@endsection
