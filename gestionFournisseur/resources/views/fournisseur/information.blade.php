@extends('layouts.fournisseur')
@section('title', 'Informations')
@section('navbar')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
            data-boundary="viewport" aria-expanded="false">
            <i class="fas fa-user" style="font-size: 1.5rem; color: white;"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
            <li>
                <form action="{{ route('fournisseur.password.edit') }}" method="GET" class="px-3 py-2">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-100">Changer le mot de passe</button>
                </form>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('fournisseur.logout') }}" method="POST" class="px-3 py-2">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-100">Déconnexion</button>
                </form>
            </li>
        </ul>
    </li>
@endsection
@section('contenu')
    <div class="text-center py-5">
        <h1>Informations</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="custom-box">
                    <h5>État de la demande</h5>
                    <p><span class="icon">✔️</span> {{ $fournisseur->statut }}</p>
                    @if ($fournisseur->statut == 'Désactivée')
                        <form action="{{ route('fournisseur.storeActive') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Réactiver mon compte</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('fournisseur.storeDesactive') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Retirer mon compte</button>
                            </div>
                        </form>
                    @endif
                </div>

                <div class="custom-box">
                    <h5>Identification</h5>
                    <p>{{ $fournisseur->entreprise }}</p>
                    <p>{{ $fournisseur->neq }}</p>
                    <p>{{ $fournisseur->email }}</p>
                    <form action="{{ route('fournisseur.identification.edit') }}" method="GET">
                        @csrf

                        <button type="submit" class="btn btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="custom-box">
                    <h5>Adresse</h5>
                    <p>{{ $coordonnees->noCivic }}, rue {{ $coordonnees->rue }}<br>{{ $coordonnees->ville }}
                        ({{ $coordonnees->province }}) {{ $codePostal }}</p>
                    <p>Bureau: {{ $coordonnees->bureau }}</p>
                    <p>Site Web: {{ $coordonnees->site }}</p>
                    <p>📞 T: {{ $coordonnees->typeTel }} N: {{ $numero }} P: {{ $coordonnees->poste }}</p>
                    <p>📞 T: {{ $coordonnees->typeTel2 }} N: {{ $numero2 }} P: {{ $coordonnees->poste2 }}</p>
                    <form action="{{ route('fournisseur.coordonnees.edit') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="custom-box">
                    <h5>Contacts</h5>
                    <a id="plus1" href="{{ route('fournisseur.contact') }}">&#8853;</a>
                    <p>{{ $contacts->prenom }}
                        {{ $contacts->nom }}<br>{{ $contacts->fonction }}<br>{{ $contacts->courriel }}<br>{{ $contacts->telephone }}
                    </p>
                </div>
            </div>
            <!-- Right side sections -->
            <div class="col-md-6">
                <div class="custom-box">
                    <h5>Produits et services offerts</h5>
                    <p><strong>Approvisionnements</strong></p>
                    @php
                        $codeUtilise = collect();
                        $dernierCode = null;
                    @endphp

                    @foreach ($unspscCollection as $uc)
                        @if ($dernierCode === null || $dernierCode !== $uc->code_categorie)
                            @if ($dernierCode !== null)
                                </ul>
                            @endif
                            <h5>{{ $uc->nature }}</h5>
                            <p>{{ $uc->categorie }}</p>
                            <ul>
                                @php
                                    $dernierCode = $uc->code_categorie;
                                @endphp
                        @endif

                        @if (!$codeUtilise->contains($uc->code_categorie))
                            @php
                                $codeUtilise->push($uc->code_categorie);
                            @endphp
                        @endif


                        <li>{{ $uc->code }} - {{ $uc->description }}</li>
                    @endforeach
                    @if ($dernierCode !== null)
                        </ul>
                    @endif

                    <div class="custom-box">
                        <h5>Détails et spécifications</h5>
                        <p>{{ $unspscFournisseur->first()->details }}</p>
                    </div>
                    <form action="{{ route('fournisseur.UNSPSC.edit', $unspscFournisseur->first()->fournisseur_id) }}"
                        method="GET">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                    </form>

                    <div class="custom-box">
                        <h5>Licence RBQ</h5>
                        <p>{{ $rbq->licenceRBQ }} – {{ $rbq->typeLicence }} <span class="icon">✔️</span>
                            {{ $rbq->statut }}</p>
                        <p><strong>Catégories autorisées</strong></p>
                        <ul>
                            <li>{{ $categorie->codeSousCategorie }} {{ $categorie->nom }}</li>
                        </ul>
                    </div>
                    <form action="{{ route('fournisseur.RBQ.edit', [$rbq]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                    </form>
                    @if ($files && count($files) > 0)
                        <div class="custom-box">
                            <h5>Documents</h5>
                            @foreach ($files as $file)
                                <p>
                                <form action="{{ route('fournisseur.deleteFile', $file->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </button>
                                </form>
                                <span class="icon-pdf">📄</span> {{ $file->nomFichier }} {{ $file->tailleFichier_KO }} Ko
                                {{ $file->created_at }}
                                </p>
                            @endforeach
                            <div class="form-group">
                                <a href="{{ route('fournisseur.importation') }}" class="btn btn-secondary">Ajouter un
                                    nouveau fichier</a>
                            </div>
                        </div>
                    @else
                        <div class="custom-box">
                            <h5>Document</h5>
                            <p>Aucun document disponible.</p>
                            @if ($fournisseur->statut != 'Désactivée')
                                <div class="form-group">
                                    <a href="{{ route('fournisseur.importation') }}" class="btn btn-secondary">Ajouter un
                                        fichier</a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection






    {{-- 
@if (isset($fournisseur))
    <div class="container-fluid text-center ">
        <h1 class="titreForm"> Page d'informations de NEQ : {{$fournisseur->neq}} <br> EMAIL : {{$fournisseur->email}} <br>ENTREPRISE : {{$fournisseur->entreprise}} STATUT: {{$fournisseur->statut}}</h1>
        <h1 class="titreForm"> LICENCERBQ: {{$rbq->licenceRBQ}} STATUT: {{$rbq->statut}} <br> TYPELICENCE: {{$rbq->typeLicence}} </h1>
        <h1 class="titreForm"> Code Sous categorie: {{$categorie->codeSousCategorie}} <br> nom categorie: {{$categorie->nom}} <br> type categorie: {{$categorie->nomCategorie}} </h1>
        <h1 class="titreForm"> details unspsc: {{$unspsc->details}} <br> id unspsc: {{$unspsc->idUnspsc}} </h1>
        <h1 class="titreForm"> details unspsc: {{$unspscCode->nature}} <br> id unspsc: {{$unspscCode->categorie}} <br>description: {{$unspscCode->description}} </h1>
        <h1 class="titreForm"> details Contact: {{$contact->nom}} <br> </h1>
        <h1 class="titreForm"> details rue: {{$coordonee->rue}}</h1>
        <h1 class="titreForm"> details nom Fichier: {{$file->nomFichier}}</h1>
    
    </div> 
@endif --}}
