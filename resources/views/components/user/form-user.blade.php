
{{-- Name --}}
{{-- antes del cambio pero se crea par el rol
<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
    value="{{old('name')? old('name'): (isset($user)? $user->name: '')}}">
    @error('name')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
--}}
<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <select name="role" id="role" class="form-control">
        @foreach ($roles as $role)
            <option value="{{$role}}">{{$role}}</option>
        @endforeach
        {{-- esto no sirve hasta donde iba selected="{{isset($user)?($role == $user .>roles[0]->name ? true : false): false}}" --}}
    </select>
    {{-- <input type="text" name="role" class="form-control @error('role') is-invalid @enderror"
    value="{{old('role')? old('role'): (isset($user)? $user->role: '')}}"> --}}
    @error('role')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

{{-- name --}}
<div class="mb-3">
	<label for="name" class="form-label">Nombre</label>
	<input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
	value="{{old('name')? old('name'): (isset($user)? $user->name: '')}}"	>

	@error('name')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>

{{-- Last Name --}}
<div class="mb-3">
    <label for="last_name" class="form-label">Apellido</label>
    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
    value="{{old('last_name')? old('last_name'): (isset($user)? $user->last_name: '')}}">
    @error('last_name')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
{{-- number id --}}
<div class="mb-3">
    <label for="number_id" class="form-label">Cedula</label>
    <input type="number" name="number_id" class="form-control @error('number_id') is-invalid @enderror"
    value="{{old('number_id')? old('number_id'): (isset($user)? $user->number_id: '')}}">
    @error('number_id')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
{{-- email --}}
<div class="mb-3">
    <label for="email" class="form-label">Correo</label>
    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
    value="{{old('email')? old('email'): (isset($user)? $user->email: '')}}">
    @error('email')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
{{-- password --}}
<div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
{{-- password confirmation --}}
<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
    @error('password_confirmation')
        <span class="invalid-feedback" role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
{{-- Buttons --}}
<a href="/Users" class="btn btn-danger me-2">Cancelar</a>
<button type="submit" class="btn btn-primary">Enviar</button>
