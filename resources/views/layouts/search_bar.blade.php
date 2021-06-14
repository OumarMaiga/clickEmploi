<form action="#" method="get">
    @csrf
    <div class="search-bar">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <input type="text" name="poste" class="form-control" id="poste" placeholder="POSTE" value="{{ old('poste') }}">
            </div>
            <div class="col-sm-4">
                <input type="text" name="adresse" class="form-control" id="adresse" placeholder="ADRESSE" value="{{ old('adresse') }}">
            </div>
            <div class="">
                <button class="btn-outline-custom2">
                    Click !
                </button> 
            </div>
        </div>
    </div>
</form>
