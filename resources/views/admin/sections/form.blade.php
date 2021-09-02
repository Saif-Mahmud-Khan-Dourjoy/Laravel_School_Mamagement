<div class="row">
    <div class="col-md-6">
        <div class="form-group">
          {{--   {{dd($section->section_name)}} --}}
            <label for="section_name">Section Name:</label><small> *</small>
            <input type="text" class="form-control" id="section_name" name="section_name" placeholder="enter section name" @if(isset($section)) value="{{$section->section_name}}" @endif>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           <div class="form-group">
              <label for="teacher">Teacher Name:</label><small> *</small>
              <select class="form-control" id="teacher" name="teacher_id">
                <option value="" disabled selected>Select Teacher Name</option>
                @foreach($teachers as $teacher)
                <option value="{{$teacher->id}}"
                    @if(isset($section))
                        @if($teacher->id == $section->teacher->id)
                            selected 
                        @endif
                    @endif
                    >{{$teacher->teacher_name}}</option>
                @endforeach
              </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @php
        $sessions = \App\Session::all();
    @endphp
    <div class="col-md-6">
        <div class="form-group">
          <label for="session">Session:</label> <small> *</small>
          <select class="form-control" id="session" name="session_id">
            <option value="" disabled selected>Select Session</option>
            @foreach($sessions as $session)
            <option value="{{$session->id}}"
                 @if(isset($section))
                    @if($session->id == $section->level_enroll->session_id)
                        selected 
                    @endif
                @endif
                >{{$session->name}}</option>
            @endforeach
          </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label for="level_enroll">Class:</label><small class="ml-2">(*select session first)</small>
          <select class="form-control" id="level_enroll" name="level_enroll_id">
           
          </select>
        </div>
    </div>
</div>
<br>


