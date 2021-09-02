@section('heading')
    General Application Settings
@endsection
@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
      <div>
          @include('layouts.flash_message')
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border: 1px solid;">
                <div class="panel-body">
                    <div style="background-color: lightgray; padding: 10px;">
                        <form method="POST" action="{{route('generalSettings.store')}}" id="settings_form" autocomplete="off" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                            <label for="site_name" class="col-sm-3 col-form-label mt-2">School Name</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="site_name" name="site_name" placeholder="Enter site name" @if(isset($settings->site_name)) value="{{$settings->site_name}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="site_logo" class="col-sm-3 col-form-label mt-2">School Logo</label>
                            <div class="col-sm-6">
                              <input type="file" class="form-control border-input" id="site_logo" name="site_logo">
                            </div>
                            <div class="col-sm-3">
                              @if(isset($settings->site_logo))
                                <img src="{{url('').'/site_logo/'.$settings->site_logo}}" class="img-thumbnail" alt="Site Logo" style="height: 50px; width: 50px; border: 1px solid;">
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="address_1" class="col-sm-3 col-form-label mt-2">Address-1</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <textarea class="form-control border-input" rows="3" name="address_1" id="address_1" placeholder="Enter address-1">@if(isset($settings->address_1)) {{$settings->address_1}} @endif </textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="address_2" class="col-sm-3 col-form-label mt-2">Address-2</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <textarea class="form-control border-input" rows="3" name="address_2" name="address_2" id="address_2" placeholder="Enter address-2">@if(isset($settings->address_2)){{$settings->address_2}}
                                @endif </textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="website" class="col-sm-3 col-form-label mt-2">Website</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="website" name="website" placeholder="Enter website URL"  @if(isset($settings->website)) value="{{$settings->website}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="phone_1" class="col-sm-3 col-form-label mt-2">Phone-1</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="phone_1" name="phone_1" placeholder="Enter phone-1" @if(isset($settings->phone_1)) value="{{$settings->phone_1}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="phone_2" class="col-sm-3 col-form-label mt-2">Phone-2</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="phone_2" name="phone_2" placeholder="Enter phone-2" @if(isset($settings->phone_2)) value="{{$settings->phone_2}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="email_1" class="col-sm-3 col-form-label mt-2">Email-1</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <input type="email" class="form-control border-input" name="email_1" id="email_1" placeholder="email-1@example.com"  @if(isset($settings->email_1)) value="{{$settings->email_1}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="email_2" class="col-sm-3 col-form-label mt-2">Email-2</label><span class="text-danger">&#9733;</span>
                            <div class="col-sm-9">
                              <input type="email" class="form-control border-input" name="email_2" id="email_2" placeholder="email-2@example.com"  @if(isset($settings->email_2)) value="{{$settings->email_2}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="facebook" class="col-sm-3 col-form-label mt-2">Facebook</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" name="facebook" id="facebook" placeholder="Enter facebook link"  @if(isset($settings->facebook)) value="{{$settings->facebook}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="instagram" class="col-sm-3 col-form-label mt-2">Instagram</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="instagram"  name="instagram" placeholder="Enter instagram link"  @if(isset($settings->instagram)) value="{{$settings->instagram}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="twitter" class="col-sm-3 col-form-label mt-2">Twitter</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="twitter" name="twitter" placeholder="Enter twitter link"  @if(isset($settings->twitter)) value="{{$settings->twitter}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="youtube" class="col-sm-3 col-form-label mt-2">Youtube</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="youtube" name="youtube"placeholder="Enter contact no"  @if(isset($settings->youtube)) value="{{$settings->youtube}}" @endif>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="google_plus" class="col-sm-3 col-form-label mt-2">Google Plus</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control border-input" id="google_plus" name="google_plus" placeholder="Enter google plus link"  @if(isset($settings->google_plus)) value="{{$settings->google_plus}}" @endif>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12" style="text-align:center;">
                                <button type="submit" class="btn btn-info" id="settings_add_btn">Save Settings</button>
                                <button type="button" class="btn btn-default" id="cancel_btn">Cancel</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    window.addEventListener("load", function(){
    //     $('#settings_add_btn').click(function(){
    //      axios.post(''+jsUtlt.siteUrl("/generalSettings")+'', formData, {
    //         headers: {
    //           'Content-Type': 'multipart/form-data'
    //         }
    //     })
    // });
    $('#cancel_btn').click(function(){
      window.location.replace(jsUtlt.siteUrl("/home"));
    });
  });
</script>
@endsection
