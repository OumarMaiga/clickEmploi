<form action="{{ route('search') }}" method="get">
    @csrf
    <div class="search-bar">
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-md-5">
                <input type="text" name="poste" class="form-control" id="poste" placeholder="POSTE" value="{{ old('poste') }}">
            </div>
            <div class="col-lg-4 col-md-5 adresse-search">
                <input type="text" name="adresse" class="form-control" id="adresse" placeholder="ADRESSE" value="{{ old('adresse') }}">
            </div>
            <div class="button-search">
                <button class="btn-custom">
                    Click !
                </button> 
            </div>
        </div>
    </div>
</form>
