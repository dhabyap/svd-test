<label for="name">Nama hobby</label>
<input id="name" name="name" type="text" value="{{ old('name', $hobby?->name) }}" maxlength="255" required autofocus>
@error('name') <div class="error">{{ $message }}</div> @enderror

<p class="actions" style="margin-top: 22px">
    <button type="submit">{{ $submitLabel }}</button>
    <a class="button secondary" href="{{ route('hobbies.index') }}">Batal</a>
</p>
