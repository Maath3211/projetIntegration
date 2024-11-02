@extends('layouts.fournisseur')

@section('title', 'Fournisseurs sélectionnés')

@section('contenu')
<div class="container">
    <h2>Fournisseurs sélectionnés</h2>
    <table class="table table-bordered">
        <thead>
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
                    <td colspan="4">Aucun fournisseur sélectionné.</td>
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
                        <td>
                            <input type="checkbox" name="contacted_{{ $fournisseur->id }}" value="1">
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Bouton d'exportation CSV -->
    <a href="#" onclick="exportSelectedSuppliers()" class="btn btn-primary mb-3">Exporter en CSV</a>

    <script>
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
