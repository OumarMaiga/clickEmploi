<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 d-flex align-items-center content-title">
                    LES STAGES
                    <a href="{{ route('stage.create') }}" class="ml-auto"><button class="btn-custom">AJOUTER</button></a>
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Durée</th>
                    <th scope="col">montant</th>
                    <th scope="col">Entité</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($stages as $stage)
                    <?php 
                        $n = $n + 1;
                        $entreprise = App\Models\Entreprise::where('id', $stage->entreprise_id)->first(); 
                    ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $stage->title }} </td>
                            <td>{{ $stage->duree }}</td>
                            <td>{{ $stage->montant }}</td>
                            <td><i>{{ $entreprise->libelle }}</i></td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('stage.show', $stage->slug) }}" class="col icon-action detail">
                                    <span class="fas fa-info">
                                    </span>
                                </a>
                                <a href="{{ route('stage.edit', $stage->slug) }}" class="col icon-action icon-edit">
                                    <span class="fas fa-user-edit edit">
                                    </span>
                                </a>
                                <span class="col icon-action">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['stage.destroy', $stage->id], 'class' => 'd-inline-flex']) !!}
                                            <button class="" type="submit" onclick="confirm('Vraiment supprimer cet utilisateur ?')">
                                                <span class="fas fa-user-times supp"></span>
                                            </button>
                                            {!! Form::submit('', ['class' => '', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                                        
                                    {!! Form::close() !!}
                                </span>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>