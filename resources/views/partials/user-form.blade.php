<div class="row gy-4">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Lengkap *</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $user->name ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email *</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label">Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '*' }}</label>
        <input type="password" name="password" class="form-control"
               {{ !isset($user) ? 'required' : '' }}>
    </div>

    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Konfirmasi Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '*' }}</label>
        <input type="password" name="password_confirmation" class="form-control"
               {{ !isset($user) ? 'required' : '' }}>
    </div>
</div>
