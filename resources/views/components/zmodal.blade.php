@props(['id', 'maxWidth'])

@php
    // $id = $id ?? md5($attributes->wire('model'));
    $id = $id ?? 'zModal';
    // $id = 'zzz';

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
    <div class="modal-dialog modal-dialog-scrollable {{ $maxWidth }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    {{ $title }}
                </div>
                <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-1 pb-1">
                <h6>{{ $content }}</h6>
            </div>
            <div class="modal-footer bg-light">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
