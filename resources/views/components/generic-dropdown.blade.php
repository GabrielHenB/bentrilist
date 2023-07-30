@props(['trigger'])
{{-- uses alpineJS --}}
<div class="dropdown" x-data="{isOpen: false}">
    <div class="dropdown-trigger">
        <button class="dropdown-trigger-btn" x-on:click="isOpen = !isOpen">
            {{ $trigger }}
            <span class="dropdown-icon">\/</span>
        </button>
    </div>
    <div class="dropdown-menu dropdown-options" x-show="isOpen" x-on:click-away="isOpen = false">
        {{ $slot }}
    </div>
</div>
