<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prenom & Nom</th>
            <th scope="col">Domaine d'activité</th>
            <th scope="col">Niveau d'étude</th>
            <th scope="col">Durée d'experience</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $n = 0 ?>
        @foreach ($users as $user)
            <?php 
                $n = $n + 1;
                $domaines = $user->domaines()->get();
                $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
            ?>
            <tr>
                <th scope="row">{{ $n }}</th>
                <td>{{ $user->nom." ".$user->prenom }}</td>
                <td>{{ $domaines->implode('libelle', ', ') }}</td>
                <td>{{ $diplome != null ? $diplome->libelle : "" }}</td>
                <td>{{ $user->experience_professionnel }}</td>
                <td class="justify-content-between icon-content">
                    <a href="{{ route('user.show', $user->email) }}" class="col icon-action detail">
                        <span class="fas fa-info">
                        </span>
                    </a>                                
                </td>
            </tr>
        @endforeach
    </tbody>
</table>