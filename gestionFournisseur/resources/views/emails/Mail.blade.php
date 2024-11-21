<h1>{{ $template->sujet ?? 'No title' }}</h1>
<p>{{ $template->contenu ?? 'No Content' }}</p>
<p>{{ $fournisseur->entreprise ?? 'No name' }}</p>
@if ($raisonRefus)
    <p>Raison du refus: {{ $raisonRefus ?? 'pas de raison' }}</p>
@endif
@if ($modification)
    @foreach ($modification as $change)
        @if($change[1] != $change[2])
        <b>{{ $change[0] }}:</b> @if($change[1] != null) Ancien: {{ $change[1] }}, @endif Nouveau: <b>{{ $change[2] }}</b>
        <br>
            @endif
    @endforeach
@endif
