@props(['id', 'maxWidth'])

@php
    // $id = $id ?? md5($attributes->wire('model'));
    $id = $id ?? 'zConfirm';

    $maxWidth = [
        'sm' => ' modal-sm',
        'md' => '',
        'lg' => ' modal-lg',
        'xl' => ' modal-xl',
        'full' => 'modal-fullscreen'
    ][$maxWidth ?? 'md'];
@endphp

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    {{-- <div class="modal-dialog modal-dialog-scrollable" role="document"> --}}
    <div class="modal-dialog {{ $maxWidth }}" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $title }}
                </h5>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4 pb-4">
                <h6>{{ $content }}</h6>
            </div>
            <div class="modal-footer bg-light">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
