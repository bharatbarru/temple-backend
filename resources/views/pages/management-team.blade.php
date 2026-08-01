<div class="our-team mt-3">

        @php
            $managementCategory = $teamCategories->where('name', 'management')->first();
            $teamsInManagementCategory = $teams->where('team_categories_id', $managementCategory->id);
        @endphp

        @if ($managementCategory && $teamsInManagementCategory->isNotEmpty())
            <div class="team-list">
                {{-- <div class="section-title text-center mb-3">
                    <h2 class="font-color">{{ $managementCategory->display_name }}</h2>
                </div> --}}
                <div class="row mt-5">
                    @foreach ($teamsInManagementCategory as $team)
                        <div class="col-md-4 mb-3">
                            <div class="card card-icon-2 justify-content-center shadow-3d text-center">
                                <figure class="m-0">
                                    <img src="{{ asset(TEAM_IMAGE_PATH . $team->image) }}" alt="{{ $team->name }} Image" class="w-100">
                                </figure>
                                <div class="cards-inner p-2">
                                    <h5 class="mb-0 font-color">{{ $team->name }}</h5>
                                    <p>{{ $team->designation }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

  
</div>
