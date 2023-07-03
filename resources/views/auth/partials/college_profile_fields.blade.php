<div class="col-md-3">
    <label>College Name</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" id="college_name" class="form-control" value="{{old('college_name')}}" placeholder="College Name" name="college_name">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <label>Principal Name</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" class="form-control" value="{{old('principal_name')}}" placeholder="Principal Name" name="principal_name">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <label>Phone</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" minlength="10" maxlength="10" class="form-control" value="{{old('mobile')}}" placeholder="Phone" name="mobile">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <label>Affiliation Document</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="file" class="form-control"  placeholder="Principal Name" name="document">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <label>State</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <select  name="state_id" id="college_state_id"  class="form-control select-search" data-fouc>
            <option selected disabled>Select State</option>
            @foreach(App\Models\State::all() as $state)
            <option value="{{$state->id}}">{{$state->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-3">
    <label>District</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <select  name="city_id" id="college_city_id"  class="form-control select-search" data-fouc>
            <option selected disabled>Select District</option>
        </select>
    </div>
</div>
<div class="col-md-3">
    <label>City</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" class="form-control" value="{{old('district')}}" placeholder="City" name="district">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <label>Year of Establishment</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" class="form-control" value="{{old('year_of_establishment')}}" placeholder="Year of Establishment" name="year_of_establishment">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-6">
    <label>Address</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="text" class="form-control" value="{{old('address')}}" placeholder="Address" name="address">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
    <br>
    <button class="btn btn-sm btn-primary" type="button" id="add_row_for_courses">Add More Course Field</button>
</div>
<div class="col-md-6">
    <label>Course </label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <select  name="course_ids[]"  class="form-control select-search" data-fouc>
            <option selected disabled>Select Course</option>
            @foreach(App\Models\Course::all() as $course)
            <option value="{{$course->id}}">{{$course->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-6">
    <label>Course Seats</label>
    <div class="form-group form-group-feedback form-group-feedback-left">
        <input type="number" class="form-control" value="" placeholder="Course Seats" name="course_seats[]">
        <div class="form-control-feedback">
            <i class="icon-user text-muted"></i>
        </div>
    </div>
</div>