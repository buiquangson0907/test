@if (session('success'))
    <input type="hidden" class="toast-alert success" data-id="success" value="{{ session('success') }}">
@endif
@if (session('error'))
    <input type="hidden" class="toast-alert error" data-id="error" value="{!! session('error') !!}">
@endif
@if (session('permission'))
    <input type="hidden" class="toast-alert permission" data-id="permission" value="{!! session('permission') !!}">
@endif
@if ($errors->any())
    <input type="hidden" class="toast-alert warning" data-id="warning" value="{{ implode("<br>",$errors->all()) }}">
@endif
