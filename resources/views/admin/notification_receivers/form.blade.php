<div class="row">
    <div class="col-md-6">
        @php
           // dd(substr($notificationReceiver->phone, 2, strlen($notificationReceiver->phone)));
        @endphp
        <input type="hidden" name="nr_id" id="nr_id" value="{{isset($notificationReceiver->id) ? $notificationReceiver->id : ''}}">
        <div class="form-group">
            <label for="name">Receiver Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Receiver Name" @if(isset($notificationReceiver->id)) value="{{$notificationReceiver->name}}" @endif>
                @if ($errors->has('name'))
                     <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
                @endif
         </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="example@example.com" @if(isset($notificationReceiver->id)) value="{{$notificationReceiver->email}}" @endif>
                @if ($errors->has('email'))
                     <span class="help-block" style="color: red;">{{ $errors->first('email') }}</span>
                @endif
            </div>
         </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Contact No." @if(isset($notificationReceiver->id)) value="{{substr($notificationReceiver->phone, 2, strlen($notificationReceiver->phone))}}" @endif>
             @if ($errors->has('phone'))
                     <span class="help-block" style="color: red;">{{ $errors->first('phone') }}</span>
            @endif
         </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="notification_type_id">Notification Type</label>
            <select class="form-control" name="notification_type_id" id="notification_type">
                <option value="" selected disabled>Select Notification Type</option>
                @foreach($n_types as $type)
                    <option value="{{$type->id}}"
                        @if(isset($notificationReceiver->id))
                            @if($notificationReceiver->notification_type_id == $type->id)
                                selected
                            @endif
                        @endif
                        >{{$type->type_name}}</option>
                @endforeach
            </select>
             @if ($errors->has('notification_type_id'))
                     <span class="help-block" style="color: red;">{{ $errors->first('notification_type_id') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="status">Active Status</label>
            <label class="switch">
              <input type="checkbox"
                @if(!isset($notificationReceiver->id))
                    checked
                @elseif(isset($notificationReceiver->id))
                    {{ ($notificationReceiver->status == 1) ? 'checked':''}}
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
