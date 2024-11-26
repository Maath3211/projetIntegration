<link rel="stylesheet" href="{{ asset('css/role.css') }}">

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <h2 class="my-4">Liste employés</h2>
            <ul class="list-group">
                @foreach ($responsables as $responsable)
                    <li class="list-group-item d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-1">{{ $responsable->email }}</h5>
                                <small class="text-muted">{{ $responsable->role }}</small>


                                <form id="formSupprimer"
                                    action="{{ route('responsable.deleteResponsable', $responsable->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
