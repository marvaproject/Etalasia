@php
    use function Filament\Support\generate_loading_indicator_html;
@endphp

{{-- Icon picker grid — override untuk fix scroll & layout di Filament admin --}}
<div
    style="
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        max-height: 320px;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 4px 2px;
        scroll-behavior: smooth;
    "
>
    <template x-for="icon in resultsVisible" :key="icon.id">
        <div
            role="button"
            style="
                border-radius: 10px;
                padding: 10px 6px 8px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                text-align: center;
                gap: 5px;
                cursor: pointer;
                transition: background 0.12s, box-shadow 0.12s;
                border: 1.5px solid rgba(0,0,0,0.08);
                background: #f9fafb;
                min-height: 64px;
                user-select: none;
            "
            x-show="! isLoading"
            x-on:click.prevent="updateState(icon)"
            x-bind:style="
                state == icon.id
                    ? 'background: var(--color-primary-500, #FF6200); border-color: var(--color-primary-500, #FF6200); box-shadow: 0 0 0 2px rgba(255,98,0,.25);'
                    : 'background: #f9fafb; border-color: rgba(0,0,0,0.08);'
            "
            x-on:mouseenter="$el.style.background = (state == icon.id ? 'var(--color-primary-600, #e5590a)' : '#f0f0f0')"
            x-on:mouseleave="$el.style.background = (state == icon.id ? 'var(--color-primary-500, #FF6200)' : '#f9fafb')"
        >
            {{-- Icon SVG (lazy-loaded via x-intersect) --}}
            <div
                style="width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"
                x-intersect="setElementIcon($el, icon.id)"
                x-bind:style="state == icon.id ? 'color: white;' : 'color: #374151;'"
            >
                {{ generate_loading_indicator_html() }}
            </div>

            {{-- Label --}}
            <span
                style="
                    font-size: 10px;
                    line-height: 1.2;
                    color: #6b7280;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    word-break: break-word;
                    width: 100%;
                "
                x-bind:style="state == icon.id ? 'color: rgba(255,255,255,0.9);' : 'color: #6b7280;'"
                x-text="icon.label"
            ></span>
        </div>
    </template>

    {{-- Infinite scroll trigger --}}
    <div x-intersect="addSearchResultsChunk" style="grid-column: 1 / -1; height: 1px;"></div>
</div>
