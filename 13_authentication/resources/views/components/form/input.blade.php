@props(['name','type', 'placeholder', 'value'])

<div class="mb-3 col-12 col-lg-6 col-md-6 col-sm-12">
    <label for="{{$name}}" class="form-label">{{ucfirst($name)}}</label>
    <input type="{{$type}}" class="form-control" name="{{$name}}" id="{{$name}}" placeholder="{{$placeholder ?? ''}}" value="{{$value ?? null}}" />
    @error($name) <span class="text-danger">{{$message}}</span> @enderror
</div>
