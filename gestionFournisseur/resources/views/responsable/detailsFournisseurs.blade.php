@extends('layouts.layoutAdmin')
@section('navbar')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" data-boundary="viewport" aria-expanded="false">
        <i class="fas fa-user"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
        <li>
            <form action="{{ route('admin.logout') }}" method="POST" class="px-3 py-2">
                @csrf
                <button type="submit" class="btn btn-secondary w-100">Déconnexion</button>
            </form>
        </li>
    </ul>
</li>
@endsection
@section('contenu')
<div class="container mt-4">
    <h1 class="text-center mb-4">Fournisseurs sélectionnés</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Fournisseur</th>
                    <th>Téléphone</th>
                    <th>Contact</th>
                    <th>Contacté</th>
                </tr>
            </thead>
            <tbody>
                @if($fournisseurs->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Aucun fournisseur sélectionné.</td>
                    </tr>
                @else
                    @foreach($fournisseurs as $fournisseur)
                        <tr>
                            <td>
                                <strong>{{ $fournisseur->entreprise }}</strong><br>
                                <span>{{ $fournisseur->email }}</span>
                            </td>
                            <td>
                                @if($fournisseur->coordonnees)
                                    <div><i class="fas fa-phone"></i> {{ $fournisseur->coordonnees->formatPhoneNumber($fournisseur->coordonnees->numero) }}</div>
                                @else
                                    <div>N/A</div>
                                @endif
                            </td>
                            <td >
                                @if($fournisseur->contacts->isNotEmpty())
                                <div class="scroll">
                                    @foreach($fournisseur->contacts as $contact)
                                        <div>
                                            <i class="fas fa-user profil"></i> {{ $contact->nom }}, {{ $contact->fonction }}<br>
                                            <i class="fas fa-envelope"></i> {{ $contact->courriel }}<br>
                                            <i class="fas fa-phone"></i> {{ $contact->formatPhoneNumber($contact->telephone) }}
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                @else
                                    <div>Aucun contact disponible</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="custom-checkbox-container">
                                <label for="{{$fournisseur->id}}" class="custom-checkbox-label">
                                    <input type="checkbox" class="custom-checkbox" id="{{$fournisseur->id}}"> 
                                    <span class="checkbox-custom"></span>        
                                </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Bouton d'exportation CSV -->
    <div class="text-center">
        <a href="#" onclick="exportSelectedSuppliers()" class="btn btn-primary mb-3">Exporter en CSV</a>
    </div>

    <script>
        //FIXME: Je ne peux pas le mettre dans son propre fichier sinon rien ne fonctionne
        function exportSelectedSuppliers() {
            // Récupère les paramètres de l'URL actuelle
            const params = new URLSearchParams(window.location.search);
            const supplierIds = params.get('ids'); // Récupère les IDs déjà dans l'URL

            if (supplierIds) {
                // Construit l'URL d'exportation CSV avec les IDs
                let url = `{{ route('export.csv') }}?supplier_ids=${supplierIds}`;
                window.location.href = url; // Redirige vers l'URL d'exportation
            } else {
                alert('Aucun fournisseur sélectionné pour l\'exportation.');
            }
        }
    </script>
</div>
@endsection
