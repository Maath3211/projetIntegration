@extends('layouts.fournisseur')
@section('title', 'Informations')
@section('navbar')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" data-boundary="viewport" aria-expanded="false">
        <i class="fas fa-user"></i>
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
<div class="text-center">
    <h1>INFORMATIONS</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="custom-box">
                <h4>État de la demande</h4>
                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill info" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg></span> {{$fournisseur->statut}}
                </p>
                @if ($fournisseur->statut == 'Désactivée')
                    <form action="{{ route('fournisseur.storeActive', ['id' => $fournisseur->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Réactiver mon compte</button>
                        </div>
                    </form>
                    @elseif ($fournisseur->statut != 'À réviser' && $fournisseur->statut != 'Refusée')
                    <form action="{{ route('fournisseur.storeDesactive', ['id' => $fournisseur->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Retirer mon compte</button>
                        </div>
                    </form>
                @endif
                <p>Date de création : {{substr($fournisseur->created_at,0,10)}}</p>
                <p>Dernière modification : {{substr($fournisseur->updated_at,0,10)}}</p>
            </div>
            <div class="custom-box">
                <h4>Identification</h4>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-buildings-fill info" viewBox="0 0 16 16">
                    <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                </svg>  {{$fournisseur->entreprise}}
                </p>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-fingerprint info" viewBox="0 0 16 16">
                    <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                    <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332q0 .613-.066 1.221A.5.5 0 0 1 6 8.447q.06-.555.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8m-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329"/>
                    <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334m.3 1.67a.5.5 0 0 1 .449.546 10.7 10.7 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.7 9.7 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                    <path d="M3.902 4.222a5 5 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 4 4 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556m6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705M3.68 5.842a.5.5 0 0 1 .422.568q-.044.289-.044.59c0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.5 6.5 0 0 0 3.058 7q0-.375.054-.736a.5.5 0 0 1 .568-.422m8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.5 10.5 0 0 0 .584-2.678.5.5 0 0 1 .54-.456"/>
                    <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865m-.89 1.257a.5.5 0 0 1 .04.706A5.48 5.48 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346m12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                </svg>  {{ $fournisseur->neq ?: 'Aucun' }}
                </p>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-at-fill info" viewBox="0 0 16 16">
                    <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                    <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
                </svg>  {{$fournisseur->email}}
                </p>
                <form action="{{ route('fournisseur.identification.edit', ['id' => $fournisseur->id]) }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            Modifier
                        </button>
                    </div>
                </form>
            </div>

            <div class="custom-box">
                <h4>Adresse</h4>
                <p>{{$fournisseur->coordonnees->noCivic}}, rue {{$fournisseur->coordonnees->rue}}, {{$fournisseur->coordonnees->bureau}}<br>{{$fournisseur->coordonnees->ville}} ({{$fournisseur->coordonnees->province}}) {{$codePostal}}</p>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-browser-edge info" viewBox="0 0 16 16">
                    <path d="M9.482 9.341c-.069.062-.17.153-.17.309 0 .162.107.325.3.456.877.613 2.521.54 2.592.538h.002c.667 0 1.32-.18 1.894-.519A3.84 3.84 0 0 0 16 6.819c.018-1.316-.44-2.218-.666-2.664l-.04-.08C13.963 1.487 11.106 0 8 0A8 8 0 0 0 .473 5.29C1.488 4.048 3.183 3.262 5 3.262c2.83 0 5.01 1.885 5.01 4.797h-.004v.002c0 .338-.168.832-.487 1.244l.006-.006z"/>
                    <path d="M.01 7.753a8.14 8.14 0 0 0 .753 3.641 8 8 0 0 0 6.495 4.564 5 5 0 0 1-.785-.377h-.01l-.12-.075a5.5 5.5 0 0 1-1.56-1.463A5.543 5.543 0 0 1 6.81 5.8l.01-.004.025-.012c.208-.098.62-.292 1.167-.285q.194.001.384.033a4 4 0 0 0-.993-.698l-.01-.005C6.348 4.282 5.199 4.263 5 4.263c-2.44 0-4.824 1.634-4.99 3.49m10.263 7.912q.133-.04.265-.084-.153.047-.307.086z"/>
                    <path d="M10.228 15.667a5 5 0 0 0 .303-.086l.082-.025a8.02 8.02 0 0 0 4.162-3.3.25.25 0 0 0-.331-.35q-.322.168-.663.294a6.4 6.4 0 0 1-2.243.4c-2.957 0-5.532-2.031-5.532-4.644q.003-.203.046-.399a4.54 4.54 0 0 0-.46 5.898l.003.005c.315.441.707.821 1.158 1.121h.003l.144.09c.877.55 1.721 1.078 3.328.996"/>
                </svg>  {{ $fournisseur->coordonnees->site ?: 'Aucun' }}</p>
                
                <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill info" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                </svg> {{$fournisseur->coordonnees->typeTel}} : {{$numero}} 
                @if($fournisseur->coordonnees->poste)
                    Poste: {{$fournisseur->coordonnees->poste}}
                @endif
                </p>
                @if($fournisseur->coordonnees->typeTel2 || $numero2 || $fournisseur->coordonnees->poste2)
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill info" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    @if($fournisseur->coordonnees->typeTel2)
                        {{$fournisseur->coordonnees->typeTel2}}
                    @endif
                    @if($numero2)
                        {{ $fournisseur->coordonnees->typeTel2 ? ':' : '' }} {{$numero2}}
                    @endif
                    @if($fournisseur->coordonnees->poste2)
                        Poste: {{$fournisseur->coordonnees->poste2}}
                    @endif
                </p>
                @endif
                <form action="{{ route('fournisseur.coordonnees.edit', ['id' => $fournisseur->id]) }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            Modifier
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="custom-box">
                <h4>Contacts</h4>
                <p>
                    @if ($fournisseur->contacts != null)
                        <ul>
                            @php
                                $premier = true;
                            @endphp
                            <div id="contactsList">
                                @foreach ($fournisseur->contacts as $contact)
                                    <div class="contact-item" style="display: {{ $loop->iteration <= 3 ? 'block' : 'none' }}">
                                        @if (!$loop->first)
                                            ________________________________________
                                            <br>
                                        @endif
            
                                        <li>
                                            <p>{{ $contact->prenom }} {{ $contact->nom }}</p>
                                            <p>{{ $contact->fonction }}</p>
                                            <p><a href="mailto:{{ $contact->courriel }}">{{ $contact->courriel }}</a></p>
                                            <p>{{ $contact->typeTelephone }}:
                                                {{ substr($contact->telephone, 0, 3) . '-' . substr($contact->telephone, 3, 3) . '-' . substr($contact->telephone, 6) }}
                                                {{ $contact->poste ? 'ext ' . $contact->poste : '' }}
                                            </p>
                                        </li>
                                        <form class="divContactForm" action="{{ route('fournisseur.deleteContact', $contact->id) }}"
                                            method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btFake">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0076d5"
                                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form class="divContactForm" action="{{ route('fournisseur.editContact', $contact->id) }}"
                                            method="GET">
                                            @csrf
                                            <button type="submit" class="btFake">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0076d5"
                                                    class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
            
            
            
                    @endif
                </p>
                <div id="btsContacts">
                    <form class="divContactForm" action="{{ route('fournisseur.addContactCreer', $fournisseur->id) }}"
                        method="get">
                        @method('get')
                        <button type="submit" class="btn btn-secondary" id="btAjouterContact">
                            <svg width="25px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    sketch:type="MSPage">
                                    <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -1087.000000)"
                                        fill="white">
                                        <path
                                            d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z"
                                            id="plus-circle" sketch:type="MSShapeGroup">
            
                                        </path>
                                    </g>
                                </g>
                            </svg> &ensp;
                            Ajouter
                        </button>
                    </form>
            
                    @if ($fournisseur->contacts->count() > 3)
                        <div class="text-center">
                            <button id="showAllContacts" class="btn btn-primary">
                                Voir plus {{-- ({{ $contacts->count() - 3 }} autre) --}}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
            
    <!-- Right side sections -->
        <div class="col-md-6">
            <div class="custom-box">
                <h4>Produits et services offerts</h4>
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
                <h4>Détails et spécifications</h4>
                <p>{{ $fournisseur->unspscCodes->pluck('details')->first() }}</p>
                <form action="{{ route('fournisseur.UNSPSC.edit', $unspscFournisseur->first()->fournisseur_id) }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            Modifier
                        </button>
                    </div>
                </form>
            </div>

            <div class="custom-box">
                <h4>Licence RBQ</h4>
                <p>{{ $rbq->licenceRBQ }} – {{ $rbq->typeLicence }}</p>
                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill info" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg></span>  {{$rbq->statut}}
                </p>
                <p><strong>Catégories autorisées</strong></p>
                <ul>
                    <li>{{ $categorie->codeSousCategorie ?? 'N/A' }} {{ $categorie->nom ?? 'N/A' }}</li>
                </ul>
                <form action="{{ route('fournisseur.RBQ.edit', [$rbq]) }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            Modifier
                        </button>
                    </div>
                </form>
             </div>




             @if (empty($fournisseur->finance->fournisseur_id))

             @else
                <div class="custom-box">
                    <h4>Finances</h4>
                    <p><strong>TPS :</strong> {{$fournisseur->finance->tps ?? 'N/A'}}<br><strong>TVQ :</strong> {{$fournisseur->finance->tvq ?? 'N/A'}}</p>
                    <p><strong>Conditions de paiement</strong><br>{{$fournisseur->finance->paiement ?? 'N/A'}}</p>
                    <p><strong>Devise</strong><br>{{$fournisseur->finance->devise ?? 'N/A'}}</p>
                    <p><strong>Mode de communication</strong><br>{{$fournisseur->finance->communication ?? 'N/A'}}</p>
                    <form action="{{ route('fournisseur.finances.edit',$unspscFournisseur->first()->fournisseur_id) }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                Modifier
                            </button>
                        </div>
                    </form>
                </div>
            @endif


            @if ($fournisseur->files && count($fournisseur->files) > 0)
                <div class="custom-box">
                    <h4>Documents</h4>
                    @foreach ($fournisseur->files as $file)
                        <p>
                            <form action="{{ route('fournisseur.deleteFile', $file->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </button>
                            </form>
                            {{-- <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                              </svg> --}}

                              <a href="{{ route('responsable.telechargerFichier', [$fournisseur->neq, $file->id]) }}">
                              <?php $extension = pathinfo($file->nomFichier, PATHINFO_EXTENSION); ?>
                            @if ($extension == 'png')
                                <img src="{{ asset('images/icons/png.png') }}" class="imgFormat">
                            @elseif($extension == 'pdf')
                                <img src="{{ asset('images/icons/pdf.png') }}" class="imgFormat">
                            @elseif($extension == 'jpg' || $extension == 'jpeg')
                                <img src="{{ asset('images/icons/jpg.png') }}" class="imgFormat">
                            @elseif($extension == 'txt' || $extension == 'doc' || $extension == 'docx')
                                <img src="{{ asset('images/icons/txt.png') }}" class="imgFormat">
                            @elseif($extension == 'xls' || $extension == 'xlsx' || $extension == 'csv')
                                <img src="{{ asset('images/icons/xls.png') }}" class="imgFormat">
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                              </svg>
                            @endif
                              
                                <span class="file-info">{{ $file->nomFichier }} {{ $file->tailleFichier_KO }} Ko {{ $file->created_at }}</span></a>

                              
                        </p>
                    @endforeach
                    <div class="form-group">
                        <a href="{{ route('fournisseur.importation.edit', $fournisseur->id) }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                            Ajouter un nouveau fichier
                        </a>
                    </div>
                </div>
            @else
                <div class="custom-box">
                    <h4>Document</h4>
                    <p>Aucun document disponible.</p>
                    @if ($fournisseur->statut != 'Désactivée')
                        <div class="form-group">
                            <a href="{{ route('fournisseur.importation.edit', $fournisseur->id) }}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                Ajouter fichier
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


<script src="{{ asset('js/showContacts.js') }}"></script>