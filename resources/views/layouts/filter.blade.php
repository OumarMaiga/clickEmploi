<?php
    $postes = App\Models\Opportunite::select('id', 'slug', 'poste')->limit(5)->get();
?>
<div class="filtre-container">
    <h3 class="filtre-title">FILTRE</h3>
    <div class="filtre-content">
        <form action="{{ route('filtre') }}" method="GET">
            <h5 class="filtre-subtitle">POSTE</h5>
            <div class="filtre-list">
                <div class="filtre-item-list">
                    @foreach ($postes as $poste)
                        <div class="form-check filtre-item">
                            <input class="form-check-input" type="checkbox" name="poste[]" value="{{ $poste->poste }}" id="{{ $poste->slug }}">
                            <label class="form-check-label" for="{{ $poste->slug }}">
                                {{ $poste->poste }}
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
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var contrat = [];
        var date = '';
        var poste = [];

        $('input[name="poste[]"]').on('change', function(e) {
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
            poste = [];
            $('input[name="poste[]"]:checked').each(function() {
                poste.push($(this).val());
            });

            contrat = [];
            $('input[name="contrat[]"]:checked').each(function() {
                contrat.push($(this).val());
            });

            date = '';
            $('input[name="date"]:checked').each(function() {
                date = $(this).val();
            });

            $.get('/filtre', {poste: poste, contrat: contrat, date: date}, function(markup) {
                $('.list').html(markup);
            }); 
        }
    })
</script>