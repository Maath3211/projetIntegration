@extends('layouts.fournisseur')

@section('title', 'Fournisseurs sélectionnés')

@section('contenu')
<div class="container mt-4">
    <h2 class="text-center mb-4">Fournisseurs sélectionnés</h2>

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
                                    <div><i class="fas fa-phone"></i> {{ $fournisseur->coordonnees->numero }}</div>
                                @else
                                    <div>N/A</div>
                                @endif
                            </td>
                            <td>
                                @if($fournisseur->contacts->isNotEmpty())
                                    @foreach($fournisseur->contacts as $contact)
                                        <div>
                                            <i class="fas fa-user"></i> {{ $contact->nom }}, {{ $contact->fonction }}<br>
                                            <i class="fas fa-envelope"></i> {{ $contact->courriel }}<br>
                                            <i class="fas fa-phone"></i> {{ $contact->telephone }}
                                        </div>
                                        <hr>
                                    @endforeach
                                @else
                                    <div>Aucun contact disponible</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="contacted_{{ $fournisseur->id }}" value="1">
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
