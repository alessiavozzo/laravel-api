<x-mail::message>
    # EMAIL FROM

    Name: {{ $lead->name }}
    Email: {{ $lead->email }}

    Message: {{ $lead->message }}


    {{ config('app.name') }}
</x-mail::message>
