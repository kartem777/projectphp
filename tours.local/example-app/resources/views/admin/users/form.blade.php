<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control">
</div>
<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>
<div class="mb-3">
    <label for="phone_number" class="form-label">Phone Number</label>
    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number ?? '') }}" class="form-control">
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin"
        {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_admin">Is Admin</label>
</div>
