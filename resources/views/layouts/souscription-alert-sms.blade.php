  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header souscription-header">
          <h3 class="modal-title souscription-title" id="staticBackdropLabel">Souscrivez à l'alert sms</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="{{ route('abonnee.store') }}" class="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jour"  name="type" value="jour">
                                <label class="form-check-label" for="jour">Abonnement journalière (100f / jour) </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="semaine"  name="type" value="semaine">
                                <label class="form-check-label" for="semaine">Abonnement hebdomendaire (500f / semaine) </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="mois"  name="type" value="mois">
                                <label class="form-check-label" for="mois">Abonnement mensuelle (1 500f / mois) </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer souscription-footer">
                    <button type="submit" class="btn btn-outline-custom">
                        {{ __('Souscription') }}
                    </button>
                </div>
            </form>
      </div>
    </div>
  </div>
  
    @if (Session::has('abonnement'))
        <script>
            addEventListener('load', function(){
                $('#staticBackdrop').modal('show');
            })
        </script>
    @endif