<x-mail::message>
# Welcome, {{ $user->name }}!

We're excited to have you join us at {{ config('app.name') }}.

If you have any questions or need help getting started, feel free to reach out. We're here to support you.

<x-mail::button :url="url('/')">
Visit Our Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
