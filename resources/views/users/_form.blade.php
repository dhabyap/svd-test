<label for="name">Nama</label>
<input id="name" name="name" type="text" value="{{ old('name', $user?->name) }}" maxlength="255" required autofocus>
@error('name') <div class="error">{{ $message }}</div> @endif

<label for="email">Email</label>
<input id="email" name="email" type="email" value="{{ old('email', $user?->email) }}" maxlength="255" required autocomplete="email">
@error('email') <div class="error">{{ $message }}</div> @endif

<label for="password">Password</label>
<input id="password" name="password" type="password" value="{{ old('password') }}" minlength="8" {{ $user ? '' : 'required' }} autocomplete="new-password">
<small class="muted">Minimal 8 karakter. {{ $user ? 'Kosongkan jika tidak ingin mengubah password.' : '' }}</small>
@error('password') <div class="error">{{ $message }}</div> @endif

<label for="password_confirmation">Konfirmasi password</label>
<input id="password_confirmation" name="password_confirmation" type="password" minlength="8" {{ $user ? '' : 'required' }} autocomplete="new-password">
@error('password_confirmation') <div class="error">{{ $message }}</div> @endif

<div style="margin-top: 22px">
    <label>Daftar hobi</label>
    <div id="hobby-list">
        @php($rows = old('hobbies', $user?->hobbies?->pluck('name')?->all() ?? ['']))
        @foreach ($rows as $row)
            <div class="hobby-row" style="display:flex; gap:8px; margin-bottom:8px">
                <input name="hobbies[]" type="text" value="{{ $row }}" maxlength="255" placeholder="Nama hobi" style="flex:1">
                <button type="button" class="button secondary" onclick="this.parentElement.remove()">Hapus</button>
            </div>
        @endforeach
    </div>
    <button type="button" class="button secondary" onclick="addHobbyRow()">＋ Tambah hobi</button>
</div>

<script>
function addHobbyRow() {
    const list = document.getElementById('hobby-list');
    const row = document.createElement('div');
    row.className = 'hobby-row';
    row.style.display = 'flex';
    row.style.gap = '8px';
    row.style.marginBottom = '8px';
    row.innerHTML = '<input name="hobbies[]" type="text" value="" maxlength="255" placeholder="Nama hobi" style="flex:1">' +
        '<button type="button" class="button secondary" onclick="this.parentElement.remove()">Hapus</button>';
    list.appendChild(row);
}
</script>

<p class="actions" style="margin-top: 22px">
    <button type="submit">{{ $submitLabel }}</button>
    <a class="button secondary" href="{{ route('web.users.index') }}">Batal</a>
</p>