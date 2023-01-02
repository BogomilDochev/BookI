@props(['name'])

<input type="radio" id="{{ $name }}" name="avatar" value="{{ $name }}.png" class="mt-6" checked>
<img src="/images/avatars/{{ $name }}.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >
