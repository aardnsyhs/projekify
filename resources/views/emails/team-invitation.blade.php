@component('mail::message')
    # You’ve been invited to {{ $team->name }}

    {{ $inviter->name }} invited you to join **{{ $team->name }}**.

    @component('mail::button', ['url' => $acceptUrl])
        Accept Invitation
    @endcomponent

    If you didn’t expect this, just ignore this email.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
