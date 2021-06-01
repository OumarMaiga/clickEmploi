<?php

    namespace App\Repositories;

    use App\Models\Entreprise;

    class EntrepriseRepository extends ResourceRepository {

        public function __construct(Entreprise $entreprise) {
            $this->model = $entreprise;
        }

    }