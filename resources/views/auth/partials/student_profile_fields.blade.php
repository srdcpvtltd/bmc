
    <div class="col-md-3">
        <label>College</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="college_id" id="college_id"  class="form-control select-search" data-fouc>
                <option selected disabled>Select College</option>
                @foreach(App\Models\User::where('role_id',2)->where('is_verified',1)->where('is_active',1)->get() as $college)
                <option value="{{$college->id}}">{{$college->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Course</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="course_id" id="student_course_id"  class="form-control select-search" data-fouc>
                <option selected disabled>Select Course</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Semester</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="semester_id" id="student_semester_id"  class="form-control select-search" data-fouc>
                <option selected disabled>Select Semester</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Enrollment Year</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="enrollment_year"  class="form-control select-search" data-fouc>
                <option selected disabled>Select Enrollment Year</option>
                @for($i = 2015;$i < 2031;$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Roll Number</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" value="{{old('roll_number')}}" placeholder="Student Roll Number" name="roll_number">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label>Phone</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" minlength="10" maxlength="10" class="form-control" value="{{old('phone')}}" placeholder="Student Phone" name="phone">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label>Father's Name</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" value="{{old('fathers_name')}}" placeholder="Student Father Name" name="fathers_name">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label> Mother's Name</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" value="{{old('mother_name')}}" placeholder="Student Mother Name" name="mother_name">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label>Blood Group</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            
            <select  name="blood_group"  class="form-control select-search" data-fouc>
                <option selected disabled>Select</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Date of Birth</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="date" class="form-control" value="{{old('date_of_birth')}}" placeholder="Student Blood Group" name="date_of_birth">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label>Nationality</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="nationality"  class="form-control select-search" data-fouc>
                <option selected value="Indian">Indian</option>
                <option value="Other">Other</option>
            </select>
        
        </div>
    </div>
    <div class="col-md-3">
        <label>Gender</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="radio" name="gender"  value="Male" class=""> Male 
            <input type="radio" name="gender" value="Female" class=""> Female 
            <input type="radio" name="gender" value="Sehmale" class=""> Sehmale 
        </div>
    </div>
    <div class="col-md-12">
        <p><h5>Present Address :</h5></p>
    </div>
    <input type="hidden" name="type[]" value="Temparory">
    <div class="col-md-3">
        <label>Plot No/Village</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" id="temparory_address" value="{{old('address')}}" placeholder="Plot No/Village" name="addresses[]">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>  
    <div class="col-md-3">
        <label>Landmark</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" id="temparory_landmark" value="{{old('landmark')}}" placeholder="Landmark" name="landmark[]">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label>Country</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="country[]" id="temparory_country_id"  class="form-control select-search" data-fouc>
                <option selected disabled>Select Country</option>
                @foreach(App\Models\Country::all() as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>State</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="state[]" id="temparory_state_id"  class="form-control select-search" data-fouc>
                <option selected disabled>Select State</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>City</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <select  name="city[]" id="temparory_city_id"  class="form-control select-search" data-fouc>
                <option selected disabled>Select City</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Town</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" id="temparory_town" value="{{old('town')}}" placeholder="Town" name="town[]">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <label>Pin</label>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" id="temparory_pin" value="{{old('pin')}}" placeholder="Pin" name="pin[]">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <p><h5>Permanent Address :</h5></p>
        <input type="checkbox" name="same_as_temparory" id="same_as_temparory"> Same as Temparory
    </div>
    <input type="hidden" name="type[]" value="Permenant">
    <div class="row permenant_fields">
        <div class="col-md-3">
            <label>Plot No/Village</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" id="permenant_address" value="{{old('address')}}" placeholder="Plot No/Village" name="addresses[]">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>
        </div>  
        <div class="col-md-3">
            <label>Landmark</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" id="permenant_landmark" value="{{old('landmark')}}" placeholder="Landmark" name="landmark[]">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label>Country</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <select  name="country[]" id="permenant_country_id"  class="form-control select-search" data-fouc>
                    <option>Select Country</option>
                    @foreach(App\Models\Country::all() as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label>State</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <select  name="state[]" id="permenant_state_id"  class="form-control select-search" data-fouc>
                    <option>Select State</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label>City</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <select  name="city[]" id="permenant_city_id"  class="form-control select-search" data-fouc>
                    <option>Select City</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label>Town</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" id="permenant_town" value="{{old('town')}}" placeholder="Town" name="town[]">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label>Pin</label>
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" id="permenant_pin" value="{{old('pin')}}" placeholder="Pin" name="pin[]">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>
        </div>

    </div>
