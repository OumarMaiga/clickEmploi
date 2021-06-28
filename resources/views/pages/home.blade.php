<x-app-layout>
    <div class="home-container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.filter')
            </div>
            <div class="col-sm-9 list">
                @include('layouts.list_opportunite')
            </div>
        </div>
    </div>
</x-app-layout>
