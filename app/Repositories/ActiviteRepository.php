<?php

    namespace App\Repositories;

    use App\Models\Activite;

    class ActiviteRepository extends ResourceRepository {

        public function __construct(Activite $activite) {
            $this->model = $activite;
        }

    }