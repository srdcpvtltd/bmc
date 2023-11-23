@extends('super_admin.layout.index')

@section('title')
View Shops
@endsection

@section('content')


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Shop Report</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">

        {{-- <form method="GET" id="searchForm">
            <div class="row">
                <div class="form-group col-2">
                    <label>Zone</label>
                    <select  name="zone_id" id="zone_id" class="form-control select-search" data-fouc required>
                        <option selected disabled>Select zone-</option>
                        @foreach(App\Models\Zone::all() as $zone)
                        <option @if(request()->zone_id == $zone->id) selected @endif value="{{$zone->id}}">{{$zone->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-2">
                    <label>Choose Ward</label>
                    <select  name="ward_id" id="ward_id" class="form-control select-search" data-fouc required>
                        <option selected disabled>Select Ward</option>
                        @if(request()->ward_id)
                        @foreach(App\Models\Ward::all() as $ward)
                        <option @if(request()->ward_id == $ward->id) selected @endif value="{{$ward->id}}">{{$ward->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-3">
                    <label>Choose Establishment</label>
                    <select  name="establishment_id" id="establishment_id"  class="form-control select-search" data-fouc required>
                        <option disabled selected >Select Establishment</option>
                        @foreach(App\Models\Establishment::all() as $establishment)
                        <option @if(request()->establishment_id == $establishment->id) selected @endif value="{{$establishment->id}}">{{$establishment->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-2">
                    <label>Shop Name</label>
                    <input type="text" name="shop_name" value="{{request()->shop_name}}" class="form-control">
                </div>
                <div class="form-group col-2">
                    <br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form> --}}

        <div class="row" style="margin-top:20px!important;">
            <div class="col-md-12">
                <table class="table datatable-button-html5-basic">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop Name</th>
                            <th>Shop No</th>
                            <th>Establishment</th>
                            <th>Zone</th>
                            <th>Ward</th>
                            <th>Owner Name</th>
                            <th>Owner Phone</th>
                            <th>Allotment Date</th>
                            <th>Allotment No</th>
                            <th>Valid Upto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops  as $key => $shop)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a href="{{route('super_admin.shop.detail',$shop->id)}}">{{$shop->shop_name}}</a></td>
                            <td>{{@$shop->establishment_shop->shop_number}}</td>
                            <td>{{@$shop->establishment->name}}</td>
                            <td>{{@$shop->zone->name}}</td>
                            <td>{{@$shop->ward->name}}</td>
                            <td>{{$shop->owner_name}}</td>
                            <td>{{$shop->phone}}</td>
                            <td>{{$shop->allotment_date}}</td>
                            <td>{{$shop->allotment_number}}</td>
                            <td>{{$shop->valid_upto}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        $('#zone_id').change(function(){
            id = this.value;
            $.ajax({
                url: "{{route('super_admin.shop.get_wards')}}",
                method: 'post',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(result){
                    wards = result.wards;
                    $('#ward_id').empty();
                    $('#ward_id').append('<option disabled>Select Ward</option>');
                    for (i=0;i<wards.length;i++){
                        $('#ward_id').append('<option value="'+wards[i].id+'">'+wards[i].name+'</option>');
                    }
                }
            });
        });
    });
</script>
@endsection
