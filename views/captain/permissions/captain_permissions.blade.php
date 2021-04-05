

 @php 
 $addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
 @endphp
 @if ($addon != null)
     @if($addon->activated) 
         <label class="checkbox">
             <input type="checkbox" name="permissions[]" value="1007" @php if(isset($permissions) && in_array(1007, $permissions)) echo "checked"; @endphp>
             <span></span>{{ translate('Captain Index') }}
         </label>
     @endif
 @endif