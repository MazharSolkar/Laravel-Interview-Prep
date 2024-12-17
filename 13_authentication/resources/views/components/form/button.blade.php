@props(['type','color'])

<div class="d-flex justify-content-start">
    <button type="{{$type ?? 'submit'}}" class="btn btn-{{$color ?? 'primary'}} ">{{$slot}}</button>
</div>
