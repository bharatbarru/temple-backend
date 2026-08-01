<!-- Name Field -->
<div class="col-sm-6">


    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('name', 'Name:') !!} <span class="float-right ">{{ $hallAddon->name }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('description', 'Description:') !!}<span class="float-right ">{{ $hallAddon->description }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('image', 'Image:') !!}
            @if (!empty($hallAddon->image))
                <span class="float-right "> <img src="{{ asset(HALL_ADDON_IMAGE_PATH . $hallAddon->image) }}"
                        alt="" height="50"></span>
            @endif
        </li>

    </ul>
    <!-- Hall Cost Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hall Name</th>
                    <th>Monday Cost</th>
                    <th>Tuesday Cost</th>
                    <th>Wednesday Cost</th>
                    <th>Thursday Cost</th>
                    <th>Friday Cost</th>
                    <th>Saturday Cost</th>
                    <th>Sunday Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hallAddon->hallAddonCosts as $cost)
                    <tr>
                        <td>{{ $cost->hall->name }}</td>
                        <td>{{ formatAmount($cost->monday_cost) }}</td>
                        <td>{{ formatAmount($cost->tuesday_cost) }}</td>
                        <td>{{ formatAmount($cost->wednesday_cost) }}</td>
                        <td>{{ formatAmount($cost->thursday_cost) }}</td>
                        <td>{{ formatAmount($cost->friday_cost) }}</td>
                        <td>{{ formatAmount($cost->saturday_cost) }}</td>
                        <td>{{ formatAmount($cost->sunday_cost) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
