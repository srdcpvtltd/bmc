
<div class="col-md-6">
    <label>College</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <select  name="teacher_college_id"  class="form-control select-search" data-fouc>
            <option selected disabled>Select College</option>
            @foreach(App\Models\User::where('role_id',2)->where('is_verified',1)->where('is_active',1)->get() as $college)
            <option value="{{$college->id}}">{{$college->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-6">
    <label>Phone</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" minlength="10" maxlength="10" class="form-control" value="{{old('teacher_phone')}}" placeholder="Student Phone" name="teacher_phone">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>