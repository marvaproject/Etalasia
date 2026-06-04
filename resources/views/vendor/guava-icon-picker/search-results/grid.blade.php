@php
use function Filament\Support\generate_loading_indicator_html;
@endphp

{{--
    Icon picker grid — custom override
    - 4:3 Landscape cards with Filament-style design
    - Scoped CSS rules to enforce center paragraph text alignment and proportional sizing.
--}}
<style>
    .custom-icon-card {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        aspect-ratio: 4 / 3 !important;
        /* 4:3 landscape ratio */
        border: 1px solid #d1d5db !important;
        /* Distinct visible border */
        background-color: #ffffff !important;
        border-radius: 8px !important;
        padding: 6px 4px !important;
        transition: background-color 0.15s, border-color 0.15s, box-shadow 0.15s !important;
    }

    .custom-icon-card svg {
        width: 26px !important;
        height: 26px !important;
        display: block !important;
        margin: 0 auto !important;
    }

    .custom-icon-card span {
        display: block !important;
        text-align: center !important;
        /* Center paragraph text alignment */
        width: 100% !important;
        max-width: 100% !important;
        word-break: break-word !important;
        line-height: 1.2 !important;
        margin-top: 4px !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        color: #4b5563 !important;
    }
</style>

<div
    style="
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 4px;
    ">
    <template x-for="icon in resultsVisible" :key="icon.id">
        <div
            role="button"
            tabindex="0"
            class="custom-icon-card"
            style="
                width: 100%;
                cursor: pointer;
                outline: none;
            "
            x-show="! isLoading"
            x-on:click.prevent="updateState(icon)"
            x-bind:style="
                state == icon.id
                    ? 'background-color: rgba(255, 98, 0, 0.06) !important; border-color: #FF6200 !important; box-shadow: 0 0 0 2.5px rgba(255, 98, 0, 0.12) !important;'
                    : 'background-color: #ffffff !important; border-color: #d1d5db !important;'
            "
            x-on:mouseenter="if (state != icon.id) { $el.style.backgroundColor='rgba(255, 98, 0, 0.02)'; $el.style.borderColor='rgba(255, 98, 0, 0.35)'; }"
            x-on:mouseleave="if (state != icon.id) { $el.style.backgroundColor='#ffffff'; $el.style.borderColor='#d1d5db'; }">
            {{-- Icon (lazy-loaded via x-intersect) --}}
            <div
                style="
                    width: 20px;
                    height: 20px;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    flex-shrink: 0;
                "
                x-bind:style="state == icon.id ? 'color: #FF6200;' : 'color: #4b5563;'"
                x-intersect="setElementIcon($el, icon.id)">
                {!! generate_loading_indicator_html() !!}
            </div>

            {{-- Label — 1 or 2 lines, centered like a paragraph --}}
            <span
                x-bind:style="state == icon.id ? 'color: #FF6200 !important; font-weight: 600 !important;' : 'color: #4b5563 !important;'"
                x-text="icon.label.replace(/^[OSMC]\s+/, '').replace(/^\w/, (c) => c.toUpperCase())"></span>
        </div>
    </template>

    {{-- Infinite scroll trigger --}}
    <div x-intersect="addSearchResultsChunk" style="grid-column: 1 / -1; height: 1px;"></div>
</div>