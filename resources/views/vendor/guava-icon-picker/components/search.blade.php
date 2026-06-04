@php
    use function Filament\Support\generate_loading_indicator_html;
@endphp

@props([
    'field',
    'sets',
    'searchPrompt',
    'isDropdown' => false,
])

{{--
    Override: Tanpa set-selector dropdown.
    Hanya search box + icon grid, inline di dalam section.
    Selalu inline (bukan floating absolute) dan didesain rapi sebagai panel.
--}}
<div
    x-bind="dropdownMenu"
    x-cloak
    style="
        display: flex;
        flex-direction: column;
        padding: 18px;
        background: #ffffff;
        border: 1.5px solid rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        margin-top: 14px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    "
>
    {{-- Header Panel (Tanpa tombol Tutup, penutupan via preview bar/klik luar) --}}
    <div style="margin-bottom: 14px;">
        <span style="font-size: 13px; font-weight: 600; color: #1f2937;">Pilih Ikon Kategori</span>
    </div>

    {{-- Hidden select — diperlukan Alpine binding, tidak ditampilkan --}}
    <select x-bind="setSelect" x-model="set" style="display: none;" aria-hidden="true">
        <option value="">@lang('filament-icon-picker::icon-picker.all-icons')</option>
        @foreach($sets as $set)
            <option value="{{ $set->getId() }}">{{ $set->label }}</option>
        @endforeach
    </select>

    {{-- Search Input Wrapper --}}
    <div style="margin-bottom: 18px;">
        <x-filament::input.wrapper>
            <x-filament::input x-bind="searchInput" :placeholder="$searchPrompt"></x-filament::input>
        </x-filament::input.wrapper>
    </div>

    <x-guava-icon-picker::searching :field="$field" />
    <x-guava-icon-picker::no-results-found :field="$field"/>

    {{ $field->getSearchResultsViewComponent() }}
</div>
