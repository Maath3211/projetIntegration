@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/zoomDemandeFournisseur.css') }}">
@section('contenu')
    <div id="container">
        <a href="{{ route('responsable.demandeFournisseur') }}" class="btn btn-info">Retour</a>
        <header>
            <div>
                <a href="/">
                    <h5 class="compagny">LOGO-VILLE3R</h5>
                </a>
            </div>
            <style>
                .custom-box {
                    border: 1px solid #000;
                    padding: 10px;
                    margin: 10px;
                    border-radius: 5px;
                }

                .icon {
                    font-size: 1.5em;
                    color: green;
                }

                .icon-pdf {
                    font-size: 1.2em;
                    color: red;
                }
            </style>
        </header>



        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-box">
                        <h5>État de la demande</h5>
                        @if ($fn->statut == 'attente')
                            En attente
                        @elseif($fn->statut == 'confirme')
                            ✔️ Acceptée le {{ $fn->dateStatut }}
                        @elseif($fn->statut == 'refusé')
                            Refusé le {{ $fn->dateStatut }}
                            @if ($fn->raisonRefus)
                                <p>Raison de refus: {{ $fn->raisonRefus }}</p>
                            @endif
                        @endif
                    </div>

                    <div class="custom-box">
                        <h5>Identification</h5>
                        <p>NEQ: {{ $fn->neq }}</p>
                        <p>{{ $fn->entreprise }}</p>
                        <p>{{ $fn->email }}</p>
                    </div>

                    <div class="custom-box">
                        <h5>Adresse</h5>
                        <p>{{ $coord->noCivic . ', ' . $coord->rue }}</p>
                        <p>{{ $coord->ville . ' (' . $coord->province . ') ' . $coord->codePostal }}</p>
                        <p><a href="https://{{ $coord->site }} " target='blank'>{{ $coord->site }}</a></p>
                        <p>{{ $coord->typeTel . ' ' . substr($coord->numero, 0, 3) . '-' . substr($coord->numero, 3, 3) . '-' . substr($coord->numero, 6) }}
                        </p>
                        @if ($coord->typeTel2 && $coord->numero2)
                            <p>{{ $coord->typeTel2 . ' ' . substr($coord->numero2, 0, 3) . '-' . substr($coord->numero2, 3, 3) . '-' . substr($coord->numero2, 6) }}
                            </p>
                        @endif
                        {{-- <p>📞 800-555-8473<br>📠 819-555-3478</p> --}}
                    </div>



                    <div class="custom-box">
                        <h5>Contacts</h5>
                        <a id="plus1" href="{{ route('fournisseur.contact') }}">&#8853;</a>
                        
                        @if ($contacts)
                            <ul>
                                @foreach ($contacts as $contact)
                                <form action="{{ route('fournisseur.deleteContact', $contact->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btImage""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </button>
                                </form>

                                <form action="{{ route('fournisseur.editContact', $contact->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btImage">
                                        &#9881;
                                </button>
                                </form>
                                    <li>

                                        <p>{{ $contact->prenom }}
                                            {{ $contact->nom }}</p>
                                        <p>{{ $contact->fonction }}</p>
                                        <p><a href="mailto:{{ $contact->courriel }}">{{ $contact->courriel }}</a></p>
                                        <p>{{ $contact->typeTelephone }}:
                                            {{ substr($contact->telephone, 0, 3) . '-' . substr($contact->telephone, 3, 3) . '-' . substr($contact->telephone, 6) }}
                                            {{ $contact->poste ? '#' . $contact->poste : 'Aucun' }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>


                    <form action="{{ route('responsable.accepterFournisseur', $fn->neq) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success" id="btAccepter">Accepter</button>
                    </form>
                    <form action="{{ route('responsable.refuserFournisseur', $fn->neq) }}" method="post" id="form1">
                        @csrf
                        <a class="btn btn-danger" id="btRefuser">Refuser</a>
                    </form>
                </div>




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
                    </div>

                    <div class="custom-box">
                        <h5>Détails et spécifications</h5>
                        @foreach ($unspscFournisseur as $uf)
                            <p>{{ $uf->details }}</p>
                        @endforeach
                    </div>




                    <div class="custom-box">
                        <h5>Licence RBQ</h5>
                        {{ substr($rbq->licenceRBQ, 0, 4) . '-' . substr($rbq->licenceRBQ, 4, 4) . '-' . substr($rbq->licenceRBQ, 8) }}
                        @if ($rbq->statut == 'Valide')
                            {{ $rbq->typeLicence }} ✔️ Valide
                        @else
                            {{ $rbq->statut }}
                        @endif
                        <p><strong>Catégories autorisées</strong></p>
                        <ul>
                            <li>{{ $categories->codeSousCategorie . ' ' . $categories->nom . ' ' . $categories->nomCategorie }}
                            </li>
                        </ul>
                    </div>








                    <div class="custom-box">
                        <h5>Brochures et cartes d'affaire</h5>
                        @foreach ($files as $file)
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
                            @endif
                            <a href="{{ route('responsable.telechargerFichier', [$fn->neq, $file->id]) }}">
                                {{ $file->nomFichier }},
                                {{ number_format($file->tailleFichier_KO / 1024000, 2) }} mo</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



        <script src="{{ asset('js/zoomDemandeFournisseur.js') }}"></script>
    @endsection
