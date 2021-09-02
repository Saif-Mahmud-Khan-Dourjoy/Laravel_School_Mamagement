<div class="row">
   <input type="hidden" name="oc_id" id="oc_id" value="{{isset($occasionalNotification->id) ? $occasionalNotification->id : ''}}">
    <div class="col-md-4">
        <div class="form-group">
            <label for="oc_name">Occasion Name</label>
            <input type="text" class="form-control" name="name" id="oc_name" placeholder="Enter Occasion Name" @if(isset($occasionalNotification->id)) value="{{$occasionalNotification->name}}" @endif>
                @if ($errors->has('name'))
                     <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
                @endif
         </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
          <label for="date">Occasion Date</label>
          <input style="border: 1px solid;" type="text" name="date" class="form-control pick-date" id="date" placeholder="yyyy-mm-dd" autocomplete="off"
              @if(isset($occasionalNotification->id))
                value="{{$occasionalNotification->date}}"
              @endif
            >
            @if ($errors->has('date'))
                 <span class="help-block" style="color: red;">{{ $errors->first('date') }}</span>
            @endif
       </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
          <label for="send_to">Send SMS To</label>
          <select class="form-control" name="send_to" id="send_to">
              @if(!isset($occasionalNotification->id))
                <option value="1" >Students</option>
                <option value="2">Teachers</option>
                <option value="3">Both</option>
              @elseif(isset($occasionalNotification->id))
                <option value="1" {{ ($occasionalNotification->send_to == 1) ? 'selected':''}}>Students</option>
                <option value="2" {{ ($occasionalNotification->send_to == 2) ? 'selected':''}}>Teachers</option>
                <option value="3" {{ ($occasionalNotification->send_to == 3) ? 'selected':''}}>Both</option>
              @endif
          </select>
           @if ($errors->has('send_to'))
              <span class="help-block" style="color: red;">{{ $errors->first('send_to') }}</span>
          @endif
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
           <label for="text">Text Message</label>
           <textarea style="border: 1px solid;" name="text" id="text" rows="5" class="form-control" placeholder="Enter SMS">
                @if(isset($occasionalNotification->id)) 
                      {{$occasionalNotification->text}}
                 @endif
           </textarea>
             @if ($errors->has('text'))
                <span class="help-block" style="color: red;">{{ $errors->first('text') }}</span>
            @endif
         </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="status">Active Status</label>
            <label class="switch">
              <input type="checkbox"
                @if(!isset($occasionalNotification->id))
                    checked
                @elseif(isset($occasionalNotification->id))
                    {{ ($occasionalNotification->status == 1) ? 'checked':''}}
                @endif
              name="status">
              <span class="slider round mt-5"></span>
            </label>
             @if ($errors->has('status'))
                <span class="help-block" style="color: red;">{{ $errors->first('status') }}</span>
             @endif
         </div>
    </div>
</div>

