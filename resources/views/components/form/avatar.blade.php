@props(['name'])

<input type="radio" id="{{ $name }}" name="avatar" value="{{ $name }}.png" class="mt-6" checked>
<img src="{{ asset('images/avatars/' . $name . '.png') }}" alt="" width="60" height="60" class="rounded-full -ml-10" >
