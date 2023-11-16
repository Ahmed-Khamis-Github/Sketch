 
<div class="form-group">
    <label for="Role_Name">Role Name</label>
   <x-form.input name='name' :value="$role->name" type="text"  />
</div>
 
  <fieldset>
<legend>{{ _('Abilities') }}</legend>
 @foreach (config('abilities') as $ability_code=>$ability_name )
    <div class="row mb-2">
        <div class="col-md-6">
            {{ $ability_name }}
        </div>
        <div class="col-md-2">
            <input type="radio" name="abilities[{{ $ability_code }}]" value='allow' @checked(($role_abilities[$ability_code]  ?? '')=='allow') > Allow
        </div>

        <div class="col-md-2">
            <input type="radio" name="abilities[{{ $ability_code }}]" value='deny' @checked(($role_abilities[$ability_code] ?? '')=='deny') > Deny
        </div>

        
    </div>
@endforeach
  </fieldset>
<div class="form-group">
    <button type="submit" class="btn btn-primary mb-2">{{ $button_name ?? Save }}</button>
</div>
