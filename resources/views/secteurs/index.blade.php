<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 align-items-start content-title">
                    LES DOMAINES D'ACTIVITE
                    <a href="{{ route('secteur.create') }}" class="float-right"><button class="btn-custom">AJOUTER</button></a>
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Domaine</th>
                    <th scope="col">Activités spécifique</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($secteurs as $secteur)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $secteur->categorie }}</td>
                            <td>{{ $secteur->libelle }}</td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('secteur.show', $secteur->slug) }}" class="col icon-action detail">
                                    <span class="fas fa-info">
                                    </span>
                                </a>
                                <a href="{{ route('secteur.edit', $secteur->slug) }}" class="col icon-action icon-edit">
                                    <span class="fas fa-user-edit edit">
                                    </span>
                                </a>
                                <span class="col icon-action">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['secteur.destroy', $secteur->id], 'class' => 'd-inline-flex']) !!}
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