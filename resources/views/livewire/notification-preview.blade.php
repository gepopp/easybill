<div>
    <div class="pb-0 text-gray-800">
        <div class="flex justify-between">
            <p class="font-semibold">Von:</p>
            <p class="mb-3">{{ $this->getFrom() }}</p>
        </div>
        <div class="flex justify-between">
        <p class="font-semibold">Betreff:</p>
        <p class="mb-3">{{ $this->getSubject() }}</p>
        </div>
        <p class="font-semibold">Nachricht:</p>
    </div>
    <div class="bg-logo-gray">
        <iframe src="data:text/html;base64,{{ ($this->getContent()) }}" width="100%" height="600px"></iframe>
    </div>
</div>
