@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            {{-- Priorité au logo Culture Bénin avec fallback sur le slot si nécessaire --}}
            @if (trim($slot) === 'Laravel' || empty(trim($slot)))
                <img src="{{ config('app.url') }}/img/logo-removebg.png" class="logo" alt="Culture Bénin" style="height: 60px; width: auto;">
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>

{{-- Style forcé pour le bouton vert Culture Bénin --}}
<style>
    .button-primary {
        background-color: #008751 !important;
        border-top: 10px solid #008751 !important;
        border-right: 18px solid #008751 !important;
        border-bottom: 10px solid #008751 !important;
        border-left: 18px solid #008751 !important;
        border-radius: 25px !important; /* Pour un look moderne et arrondi */
    }
</style>