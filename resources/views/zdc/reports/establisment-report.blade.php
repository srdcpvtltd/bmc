@extends('zdc.layout.index')

@section('title')
Establishment Report
@endsection

@section('content')

<div class="card">

    <div class="card-header header-elements-inline">
        <h5 class="card-title">Establishment Report</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table datatable-button-html5-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Total Shops</th>
                    <th>Vacant Shops</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($establisments  as $key => $establishment)
                <tr>
                    <td>{{$key+1}}</td>
                    {{-- <td><a href="{{route('admin.establishment.edit',$establishment->id)}}">{{$establishment->name}}</a></td> --}}
                    <td>{{$establishment->name}}</td>

                    <td>{{$establishment->establishment_category->name}}</td>
                    <td>{{$establishment->total_shops}}</td>
                    <td>{{$establishment->total_shops - $establishment->shops->count()}}</td>
                    <td></td>
                    {{-- <td></td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection
