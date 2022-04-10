<form action="" method="get" id="search-form">
    <div class="search-bar">
        <div class="search-bar-content">
            <div class="col-lg-4 col-md-6">
                <input type="text" name="domaine" class="form-control" id="domaine" placeholder="Domaine d'activité (Ex: Marketing)" value="{{ old('domaine') }}">
            </div>
            <div class="button-search">
                <button class="btn-custom" id="btn-search">
                    Rechercher
                </button> 
            </div>
        </div>
    </div>
</form>
<script>
    
    if(searchForm = document.getElementById('search-form')) {
        searchForm.addEventListener("submit", function submitHandle(e) {
            e.preventDefault();
            var url = window.location.href;
            var domaine = document.getElementById('domaine').value;
            if(domaine == "") {
                return false;
            }
            window.location.replace(url + "opportunite/domaine/" + domaine);
        })
    }
      
</script>