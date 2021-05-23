<x-dashboard-layout>
    <div class="container content">
        <h3 class="mb-3 align-items-start content-title">
                LES EMPLOIS
                <a href="{{ route('emploi.create') }}" class="float-right"><button class="btn-custom">AJOUTER</button></a>
            </div>
        </h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover">
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
                @foreach ($emplois as $emploi)
                <?php $n = $n + 1 ?>
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ $emploi->title }} </td>
                        <td>{{ $emploi->duree }}</td>
                        <td>{{ $emploi->montant }}</td>
                        <td><i>{{ $emploi->structure }}</i></td>
                        <td class="justify-content-between icon-content">
                            <a href="{{ route('emploi.show', $emploi->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="{{ route('emploi.edit', $emploi->slug) }}" class="col icon-action icon-edit">
                                <span class="fas fa-user-edit edit">
                                </span>
                            </a>
                            <span class="col icon-action">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['emploi.destroy', $emploi->id], 'class' => 'd-inline-flex']) !!}
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
</x-dashboard-layout>