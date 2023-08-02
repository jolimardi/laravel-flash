<div class="flash-messages">
    @if (MyFlash::has())
        @foreach (MyFlash::getMessages() as $type => $messages)
            @foreach ($messages as $message)
                <div class="alert alert-{{ $type }}">
                    {{ $message }}
                </div>
            @endforeach
        @endforeach
    @endif
</div>
