<div class="row">
	<div class="col-md-12 mb-3">
		<div class="form-group">
		   <label class="control-label col-md-6" for="DeviceName">Device Name</label>
		   <div class="col-md-6">
			   <input class="form-control" value="{{old('DeviceName',((isset($att_device)) ? $att_device->DeviceName : '' ))}}" name="DeviceName" placeholder="Device Name">
		   </div>
		</div>
	</div>

	<div class="col-md-12 mb-3">
		<div class="form-group">
		   <label class="control-label col-md-6" for="MachineNo">Machine No</label>
		   <div class="col-md-6">
			   <input class="form-control" value="{{old('MachineNo',((isset($att_device)) ? $att_device->MachineNo : '' ))}}" name="MachineNo" placeholder="Machine No">
		   </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 mb-3">
		<div class="form-group">
		   <label class="control-label col-md-6" for="CommType">Comm Type</label>
		   <div class="col-md-6">				
				<select class="form-control TaxInput valid" id="CommType" name="CommType" autocomplete="off">
					<option value="TCP" {{(old('CommType',((isset($att_device)) ? $att_device->CommType : '' )) == "TCP" ? 'selected' : '')}}>TCP</option>
					<option value="COM" {{(old('CommType',((isset($att_device)) ? $att_device->CommType : '' )) == "COM" ? 'selected' : '')}}>COM</option>
					<option value="USB" {{(old('CommType',((isset($att_device)) ? $att_device->CommType : '' )) == "USB" ? 'selected' : '')}}>USB</option>
				</select>
		   </div>
		</div>
	</div>

	<div class="col-md-12 mb-3">
		<div class="form-group">
		   <label class="control-label col-md-6" for="IPAddress">IP Address</label>
		   <div class="col-md-6">
			   <input class="form-control" value="{{old('IPAddress',((isset($att_device)) ? $att_device->IPAddress : '' ))}}" name="IPAddress" placeholder="IP Address">
		   </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 mb-3">
		<div class="form-group">
		   <label class="control-label col-md-6" for="Port">Port</label>
		   <div class="col-md-6">
			   <input class="form-control" value="{{old('Port',((isset($att_device)) ? $att_device->Port : '' ))}}" name="Port" placeholder="Port">
		   </div>
		</div>
	</div>

	<div class="col-md-12 mb-5">
		<div class="form-group">
		   <label class="control-label col-md-6" for="DeviceType">Device Type</label>
		   <div class="col-md-6">			   	
			   	<select class="form-control TaxInput" id="DeviceType" name="DeviceType">
			   		<option value="C" {{(old('CommType',((isset($att_device)) ? $att_device->DeviceType : '' )) == "C" ? 'selected' : '')}}>Card</option>
					<option value="FC" {{(old('DeviceType',((isset($att_device)) ? $att_device->DeviceType : '' )) == "FC" ? 'selected' : '')}}>Finger and Card</option>
					<option value="FFC" {{(old('DeviceType',((isset($att_device)) ? $att_device->DeviceType : '' )) == "FFC" ? 'selected' : '')}}>Face Finger and Card</option>
				</select>
		   </div>
		</div>
	</div>
</div>