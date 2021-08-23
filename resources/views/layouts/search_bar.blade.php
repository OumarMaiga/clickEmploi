<form action="{{ route('search') }}" method="get">
    <div class="search-bar">
        <div class="d-flex justify-content-md-center">
            <div class="col-lg-4 col-md-5">
                <input type="text" name="title" class="form-control" id="title" placeholder="TITRE" value="{{ old('title') }}">
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
