
<h1>{{ $template->sujet ?? 'No title'}}</h1>
<p>{{ $template->contenu ?? 'No Content'}}</p>
<p>{{ $fournisseur->entreprise ?? 'No name'}}</p>
@if($raisonRefus)
    <p>Raison du refus: {{ $raisonRefus ?? 'pas de raison'}}</p>
@endif