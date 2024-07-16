@props(['roles', 'name' => 'role_id', 'id' => 'role_id'])

<div class="form-group">
    <select name="{{ $name }}" id="{{ $id }}" class="form-control">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->role }}</option>
        @endforeach
    </select>
</div>
