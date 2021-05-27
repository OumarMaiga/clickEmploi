<?php

    namespace App\Repositories;

    use App\Models\Abonnee;

    class AbonneeRepository extends ResourceRepository {

        public function __construct(Abonnee $abonnee) {
            $this->model = $abonnee;
        }

    }