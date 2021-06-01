<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <h3 class="mb-3 align-items-start content-title">
                    LES DIPLOMES
                    <a href="{{ route('diplome.create') }}" class="float-right"><button class="btn-custom">AJOUTER</button></a>
                </div>
            </h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Diplome</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($diplomes as $diplome)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $diplome->libelle }}</td>
                            <td class="justify-content-between icon-content">
                                <a href="{{ route('diplome.show', $diplome->libelle) }}" class="col icon-action detail">
                                    <span class="fas fa-info">
                                    </span>
                                </a>
                                <a href="{{ route('diplome.edit', $diplome->libelle) }}" class="col icon-action icon-edit">
                                    <span class="fas fa-user-edit edit">
                                    </span>
                                </a>
                                <span class="col icon-action">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['diplome.destroy', $diplome->id], 'class' => 'd-inline-flex']) !!}
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