@php
    use Filament\Support\Enums\IconSize;
    use Filament\Support\Facades\FilamentAsset;
    use Illuminate\View\ComponentAttributeBag;
    use function Filament\Support\generate_icon_html;
    use function Filament\Support\generate_loading_indicator_html;

    $key = $getKey();
    $statePath = $getStatePath();
    $state = $field->getState();
    $isDisabled = $isDisabled();
    $displayName = $getDisplayName();
    $placeholder = $getPlaceholder();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-load
        x-load-src="{{ FilamentAsset::getAlpineComponentSrc('icon-picker-component', 'guava/filament-icon-picker') }}"
        x-data="iconPickerComponent({
                key: @js($key),
                state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
                displayName: @js($displayName),
                isDropdown: true,
                shouldCloseOnSelect: true,
                getSetUsing: async(state) => {
                    return await $wire.callSchemaComponentMethod(@js($key), 'getSetJs', { state })
                },
                getIconsUsing: async (set) => {
                    let icons = await $wire.callSchemaComponentMethod(@js($key), 'getIconsJs', { set });
                    return icons.filter(icon => !icon.id.startsWith('heroicon-') || icon.id.includes('-o-'));
                },
                getIconSvgUsing: async(id) => {
                    return await $wire.callSchemaComponentMethod(@js($key), 'getIconSvgJs', { id })
                },
                verifyStateUsing: async(state) => {
                    return await $wire.callSchemaComponentMethod(@js($key), 'verifyState', { state })
                }
            })"
        x-init="
            minimumItems = 36;
            resultsPerPage = 18;

            // Use Object.defineProperty to intercept all reads/writes to 'fuse' and force custom substring search
            Object.defineProperty($data, 'fuse', {
                get() {
                    return {
                        search: (query) => {
                            if (!query) return [];
                            const keywords = query.toLowerCase().split(/\s+/).filter(Boolean);
                            const matches = this.icons.filter(icon => {
                                const id = (icon.id || '').toLowerCase();
                                const label = (icon.label || '').toLowerCase();
                                const name = (icon.name || '').toLowerCase();
                                return keywords.every(kw => id.includes(kw) || label.includes(kw) || name.includes(kw));
                            });
                            return matches.map(item => ({ item }));
                        }
                    };
                },
                set(value) {
                    // Do nothing to prevent overriding our custom getter
                },
                configurable: true,
                enumerable: true
            });

            // Override createFuseObject to be a no-op to avoid the CPU/memory overhead of compiling original Fuse indexes
            $data.createFuseObject = function() {};
            
            // Queue system to throttle icon SVG requests
            const iconQueue = [];
            let iconProcessing = false;
            
            const processIconQueue = () => {
                if (iconProcessing || iconQueue.length === 0) return;
                iconProcessing = true;
                
                // Fetch in batches of up to 6 icons
                const batch = iconQueue.splice(0, 6);
                
                Promise.all(batch.map(item => {
                    // Check if the element is still in the DOM (e.g. it hasn't been removed during search filtering)
                    if (!document.body.contains(item.element)) {
                        if (item.after) item.after();
                        return Promise.resolve();
                    }

                    return $wire.callSchemaComponentMethod(@js($key), 'getIconSvgJs', { id: item.id })
                        .then(svg => {
                            if (svg && document.body.contains(item.element)) {
                                item.element.innerHTML = svg;
                            }
                        })
                        .catch(err => console.error(err))
                        .finally(item.after);
                })).finally(() => {
                    iconProcessing = false;
                    // Wait 60ms before processing the next batch to ensure Livewire sends a separate HTTP payload
                    setTimeout(processIconQueue, 60);
                });
            };
            
            setElementIcon = function(element, id, after = null) {
                if (!id) {
                    if (after) after();
                    return;
                }
                iconQueue.push({ element, id, after });
                processIconQueue();
            };
        "
        {{ $getExtraAttributeBag()->class(['flex flex-col gap-2']) }}
        style="position: relative;"
    >
        {{-- ── Status bar: clickable to toggle panel ── --}}
        <div
            @if(!$isDisabled)
                x-on:click="dropdownOpen = !dropdownOpen"
                style="
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 10px 14px;
                    border-radius: 8px;
                    background: rgba(0, 0, 0, 0.02);
                    border: 1.5px solid rgba(0, 0, 0, 0.08);
                    min-height: 48px;
                    cursor: pointer;
                    transition: background 0.15s, border-color 0.15s;
                "
                x-on:mouseenter="$el.style.background='rgba(0, 0, 0, 0.04)'; $el.style.borderColor='rgba(0, 0, 0, 0.12)'"
                x-on:mouseleave="$el.style.background='rgba(0, 0, 0, 0.02)'; $el.style.borderColor='rgba(0, 0, 0, 0.08)'"
            @else
                style="
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 10px 14px;
                    border-radius: 8px;
                    background: rgba(0, 0, 0, 0.04);
                    border: 1.5px solid rgba(0, 0, 0, 0.08);
                    min-height: 48px;
                    opacity: 0.7;
                    cursor: not-allowed;
                "
            @endif
        >
            {{-- Preview ikon terpilih --}}
            <div
                style="
                    width: 24px;
                    height: 24px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                    color: #FF6200;
                "
                x-data="{ loading: false }"
            >
                <span x-cloak x-show="loading">{{ generate_loading_indicator_html() }}</span>
                
                {{-- Placeholder icon when empty --}}
                <span
                    x-show="!loading && !state"
                    style="display: flex; align-items: center; justify-content: center; color: #9ca3af; opacity: 0.5;"
                >
                    {!! generate_icon_html('heroicon-o-tag')?->toHtml() !!}
                </span>

                {{-- Actual selected icon --}}
                <span
                    x-show="!loading && state"
                    x-init="$watch('state', (newValue) => {
                        loading = true
                        setElementIcon($el, newValue, () => loading = false)
                     })"
                    style="display: flex; align-items: center; justify-content: center;"
                >
                    @if($state)
                        {{ generate_icon_html($state) }}
                    @endif
                </span>
            </div>

            {{-- Nama ikon terpilih / placeholder --}}
            <span
                style="
                    font-size: 13px;
                    font-weight: 500;
                "
                x-bind:style="{ color: !displayName ? '#9ca3af' : '#374151' }"
                x-text="displayName ? displayName.replace(/^[OSMC]\s+/, '').replace(/^\w/, (c) => c.toUpperCase()) : '{{ $placeholder }}'"
            ></span>

            {{-- Tombol hapus (ditempatkan di samping teks) --}}
            @if(!$isDisabled)
                <button
                    type="button"
                    x-show="state"
                    x-cloak
                    x-on:click.prevent.stop="updateState(null)"
                    style="
                        width: 22px;
                        height: 22px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: transparent;
                        border: none;
                        cursor: pointer;
                        flex-shrink: 0;
                        transition: color 0.15s;
                        color: #9ca3af;
                    "
                    x-on:mouseenter="$el.style.color='#ef4444';"
                    x-on:mouseleave="$el.style.color='#9ca3af';"
                    title="Hapus ikon"
                >
                    {{
                        generate_icon_html(
                            'heroicon-s-x-mark',
                            attributes: (new ComponentAttributeBag())->class(['w-3.5 h-3.5'])
                        )
                    }}
                </button>
            @endif

            {{-- Chevron toggle indicator (diposisikan di ujung kanan) --}}
            @if(!$isDisabled)
                <div style="margin-left: auto; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <div
                        style="
                            width: 20px;
                            height: 20px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #9ca3af;
                            transition: transform 0.2s;
                        "
                        x-bind:style="{ transform: dropdownOpen ? 'rotate(180deg)' : 'none' }"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            @endif
        </div>

        {{-- Hidden state input --}}
        <x-filament::input type="hidden" x-model="state"/>

        {{-- ── Grid ikon panel (inline panel) ── --}}
        @if(!$isDisabled)
            <div x-show="dropdownOpen" x-cloak style="margin-top: 2px;">
                <x-guava-icon-picker::search
                    :field="$field"
                    :sets="$getAllowedSets()"
                    :search-prompt="$getSearchPrompt()"
                    :is-dropdown="true"
                />
            </div>
        @endif
    </div>
</x-dynamic-component>
