<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Prenom & Nom</th>
            <th>Domaine d'activité</th>
            <th>Niveau d'étude</th>
            <th>Durée d'experience</th>
        </tr>
    </thead>
    <tbody>
        <?php $n = 0 ?>
        @foreach ($users as $user)
            <?php 
                $n = $n + 1;
                $secteurs = $user->secteurs()->get();
                $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
            ?>
            <tr>
                <th>{{ $n }}</th>
                <td>{{ $user->nom." ".$user->prenom }}</td>
                <td>{{ $secteurs->implode('libelle', ', ') }}</td>
                <td>{{ $diplome != null ? $diplome->libelle : "" }}</td>
                <td>{{ $user->experience_professionnel }}</td>
            </tr>
        @endforeach
    </tbody>
</table>