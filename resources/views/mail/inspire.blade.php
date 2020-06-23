@component('mail::message')
# Quote

Hey can we inspire you today?

@component('mail::quote', ['author' => $author])
{{$quote}}
@endcomponent

Cheers have a nice day!
@endcomponent
