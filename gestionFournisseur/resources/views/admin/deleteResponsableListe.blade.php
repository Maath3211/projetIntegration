@section('title', 'Roles')
<link rel="stylesheet" href="{{ asset('css/role.css') }}">

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h2 class="my-4">Liste employés</h2>

            <ul class="list-group">
                @foreach ($responsables as $responsable)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <!-- Left-aligned email -->
                        <h5 class="mb-1 flex-shrink-0" style="width: 30%;">{{ $responsable->email }}</h5>
                        
                        <!-- Center-aligned role -->
                        <h5 id="role" class="text-center mx-auto" style="width: 40%;">{{ $responsable->role }}</h5>
                        
                        <!-- Right-aligned delete button -->
                        <form id="formSupprimer" action="{{ route('responsable.deleteResponsable', $responsable->id) }}" method="POST" class="flex-shrink-0" style="width: 20%;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger w-100">Supprimer</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            
            
            

        </div>
    </div>
</div>
