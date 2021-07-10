<?php
    $secteurs = App\Models\Secteur::select('id', 'slug', 'libelle')->limit(5)->get();
?>
<div class="filtre-container">
    <h3 class="filtre-title">FILTRE</h3>
    <div class="filtre-content">
        <form action="{{ route('filtre') }}" method="GET">
            <h5 class="filtre-subtitle">DOMAINE</h5>
            <div class="filtre-list">
                <div class="filtre-item-list">
                    @foreach ($secteurs as $secteur)
                        <div class="form-check filtre-item">
                            <input class="form-check-input" type="checkbox" name="secteur[]" value="{{ $secteur->id }}" id="{{ $secteur->slug }}">
                            <label class="form-check-label" for="{{ $secteur->slug }}">
                                {{ $secteur->libelle }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <h5 class="filtre-subtitle">TYPE CONTRAT</h5>
            <div class="filtre-list">
                <div class="filtre-item-list">
                    <div class="form-check filtre-item">
                        <input class="form-check-input" type="checkbox" name="contrat[]" value="cdi" id="cdi">
                        <label class="form-check-label" for="cdi">
                            CDI
                        </label>
                    </div>
                    <div class="form-check filtre-item">
                        <input class="form-check-input" type="checkbox" name="contrat[]" value="cdd" id="cdd">
                        <label class="form-check-label" for="cdd">
                            CDD
                        </label>
                    </div>
                    <div class="form-check filtre-item">
                        <input class="form-check-input" type="checkbox" name="contrat[]" value="alternance" id="alternance">
                        <label class="form-check-label" for="alternance">
                            Alternance
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <h5 class="filtre-subtitle">DATE</h5>
            <div class="filtre-list">
                <div class="filtre-item-list">
                    <div class="form-check filtre-item">
                        <input class="form-check-input" type="radio" name="date" value="24h" id="24h">
                        <label class="form-check-label" for="24h">
                            Dernière 24h 
                        </label>
                    </div>
                    <div class="form-check filtre-item">
                        <input class="form-check-input" type="radio" name="date" value="7j" id="7j">
                        <label class="form-check-label" for="7j">
                            7 derniers jour
                        </label>
                    </div>
                    <div class="form-check filtre-item">
                        <input class="form-check-input" type="radio" name="date" value="1m" id="1m">
                        <label class="form-check-label" for="1m">
                            1 mois
                        </label>
                    </div>
                </div>
            </div>
            <!--<div class="mt-4">
                <input type="submit" class="btn btn-custom" value="Click !!!">
            </div>-->
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var contrat = [];
        var date = '';
        var secteur = [];

        $('input[name="secteur[]"]').on('change', function(e) {
            e.preventDefault();
            result();
        });

        $('input[name="contrat[]"]').on('change', function(e) {
            e.preventDefault();
            result();
        });

        $('input[name="date"]').on('change', function(e) {
            e.preventDefault();
            result();
        });

        function result() {
            secteur = [];
            $('input[name="secteur[]"]:checked').each(function() {
                secteur.push($(this).val());
            });

            contrat = [];
            $('input[name="contrat[]"]:checked').each(function() {
                contrat.push($(this).val());
            });

            date = '';
            $('input[name="date"]:checked').each(function() {
                date = $(this).val();
            });

            $.get('/filtre', {secteur: secteur, contrat: contrat, date: date}, function(markup) {
                $('.list').html(markup);
            }); 
        }
    })
</script>