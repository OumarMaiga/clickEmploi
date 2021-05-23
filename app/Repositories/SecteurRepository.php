<?php

    namespace App\Repositories;

    use App\Models\Secteur;

    class SecteurRepository extends ResourceRepository {

        public function __construct(Secteur $secteur) {
            $this->model = $secteur;
        }

    }