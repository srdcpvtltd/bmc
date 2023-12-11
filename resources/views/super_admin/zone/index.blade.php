@extends('super_admin.layout.index')

@section('title')
Manage Zone
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Zone</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('super_admin.zone.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Zone Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Zone Image</label>
                            <input name="image" type="file" class="form-control" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Zone Background Color</label>
                            <input name="background_color" type="color" class="form-control" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Zone Icon Name</label>
                            <input name="icon_name" type="text" class="form-control" placeholder="Enter Icon Name" >
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

<div class="card">

    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Background Color</th>
                <th>Icon Name</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Zone::all()  as $key => $zone)
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    @if($zone->image)
                    <img src="{{asset($zone->image)}}" height="100" width="100" alt="">
                    @endif
                </td>
                <td>{{$zone->name}}</td>
                <td>{{$zone->background_color}}</td>
                <td>{{$zone->icon_name}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" name="{{$zone->name}}" 
                        background_color="{{$zone->background_color}}" icon_name="{{$zone->icon_name}}"  
                        id="{{$zone->id}}" class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route('super_admin.zone.destroy',$zone->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Zone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Zone Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Zone Image</label>
                        <input name="image" type="file" class="form-control" placeholder="Enter Name" >
                    </div>
                    <div class="form-group">
                        <label>Zone Background Color</label>
                        <input name="background_color" id="background_color" type="color" class="form-control" placeholder="Enter Name" >
                    </div>
                    <div class="form-group ">
                        <label>Zone Icon Name</label>
                        <input name="icon_name" id="icon_name" type="text" class="form-control" placeholder="Enter Icon Name" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let name = $(this).attr('name');
            let id = $(this).attr('id');
            let icon_name = $(this).attr('icon_name');
            let background_color = $(this).attr('background_color');
            $('#background_color').val(background_color);
            $('#icon_name').val(icon_name);
            $('#name').val(name);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('super_admin.zone.update','')}}' +'/'+id);
        });
    });
</script>
@endsection