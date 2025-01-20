<div>
    @if($message)
        <div class="p-4 rounded-lg {{ $status === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} mb-4">
            <div class="flex items-center">
                @if($status === 'success')
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                @else
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                @endif
                {{ $message }}
            </div>
        </div>
    @endif
</div>
