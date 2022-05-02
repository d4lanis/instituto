
<div class="card mb-4">
    <div class="card-header white-text primary-color">
        Roles - {{$user->name}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                    value="{{$role->id}}" id="roles_{{$role->id}}" name="roles[]"
                    {{$user->roles->contains($role->id) ? 'checked="checked"':''}}
                    {{$disabled}}>
                    <label class="form-check-label" for="roles_{{$role->id}}">
                        {{$role->name}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts2')
    <script>
       
    </script>
@endpush