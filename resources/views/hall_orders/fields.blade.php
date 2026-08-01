<!-- Hall Request Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('hall_request_id', 'Hall Request Id:') !!}
    {!! Form::text('hall_request_id', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> --}}

<!-- Hall Order Form -->
<div class="container-fluid px-2">
     <!-- Event Type Section -->
     <div class="row mb-4 p-2">
        <div class="col-12">
            <h5 class="section-title mb-3">Event Information</h5>
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('type_of_event', 'Type Of Event:') !!}
            <div class="radio-block ">
                <label class="px-2">{!! Form::radio('type_of_event', 'personal', null, ['required']) !!} <span>Personal</span></label>
                <label class="px-2">{!! Form::radio('type_of_event', 'community', null, ['required']) !!} <span>Community</span></label>
                <label class="px-2">{!! Form::radio('type_of_event', 'hindu_temple', null, ['required']) !!} <span>For Hindu Temple</span></label>
            </div>
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('event_duration', 'Event Type:') !!}
            <div class="radio-block">
                <label class="px-2">{!! Form::radio('event_duration', 'one-day') !!} <span>One Day</span></label>
                <label class="px-2">{!! Form::radio('event_duration', 'multiple-days') !!} <span>Multiple Days</span></label>
            </div>
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('date_of_event', 'Date Of the Event:') !!}
            {!! Form::text('date_of_event', null, ['class' => 'form-control dateonlypicker', 'required','id'=>'date_of_event']) !!}
        </div>
        <div class="form-group col-md-6" id="end_date_container" style="display: none;">
            {!! Form::label('end_date_of_event', 'End Date Of the Event:') !!}
            {!! Form::text('end_date_of_event', null, ['class' => 'form-control  dateonlypicker', 'id'=>'end_date_of_event']) !!}
        </div>
        

        <div class="form-group col-md-6">
            {!! Form::label('hall_event_type_id','Hall Event Type:') !!}
            {!! Form::select('hall_event_type_id', $hallEventTypes, null, ['class' => 'form-control select2', 'id' => 'hall_event_type_id', 'placeholder' => 'Select Event']) !!}
        </div>
    </div>

    <div id="hall_booking_details_content" style="display: none;">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="form-title">Hall Booking Details</h4>
            </div>
        </div>
        <!-- Hall Selection Section -->
        <div class="row mb-4 px-2 ">
            
            <div class="col-12">
                <div class="hall-selection-container">
                    <div class="row">
                        @foreach($hallsWithAddonsAndCosts as $hall)
                        <div class="col-md-12 col-lg-12 mb-4">
                            <div class="hall-item card shadow-sm"
                                 data-monday-cost="{{ $hall['monday_cost'] }}"
                                 data-tuesday-cost="{{ $hall['tuesday_cost'] }}"
                                 data-wednesday-cost="{{ $hall['wednesday_cost'] }}"
                                 data-thursday-cost="{{ $hall['thursday_cost'] }}"
                                 data-friday-cost="{{ $hall['friday_cost'] }}"
                                 data-saturday-cost="{{ $hall['saturday_cost'] }}"
                                 data-sunday-cost="{{ $hall['sunday_cost'] }}"
                                 data-monday-three-day-cost="{{ $hall['monday_three_day_cost'] }}"
                                 data-tuesday-three-day-cost="{{ $hall['tuesday_three_day_cost'] }}"
                                 data-wednesday-three-day-cost="{{ $hall['wednesday_three_day_cost'] }}"
                                 data-thursday-three-day-cost="{{ $hall['thursday_three_day_cost'] }}"
                                 data-friday-three-day-cost="{{ $hall['friday_three_day_cost'] }}"
                                 data-saturday-three-day-cost="{{ $hall['saturday_three_day_cost'] }}"
                                 data-sunday-three-day-cost="{{ $hall['sunday_three_day_cost'] }}"
                                 data-hall-id="{{ $hall['id'] }}">
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input main-hall-checkbox" 
                                               id="hall_{{ $hall['id'] }}" 
                                               name="selected_halls[]" 
                                               value="{{ $hall['id'] }}"
                                               data-hall-id="{{ $hall['id'] }}">
                                        <label class="form-check-label h5 mb-0 d-flex justify-content-between w-100" for="hall_{{ $hall['id'] }}">
                                            <span>{{ $hall['name'] }}</span>
                                            <span class="text-muted small" id="hall_display_cost_{{ $hall['id'] }}"></span>
                                        </label>
                                        <!-- Add hidden input for hall cost -->
                                        <input type="hidden" name="hall_costs[{{ $hall['id'] }}]" id="hall_cost_{{ $hall['id'] }}" value="0">
                                    </div>
                                    
                                    <!-- Addons for this hall -->
                                    <div class="hall-addons border-top pt-3" id="addons_{{ $hall['id'] }}" style="display: none;">
                                        <div class="addon-section">
                                            <h6 class="text-secondary font-weight-bold mb-3">Available Addons:</h6>
                                            @foreach($hall['addons'] as $addon)
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input hall-addon-checkbox" 
                                                           id="addon_{{ $addon['id'] }}" 
                                                           name="selected_addons[{{ $hall['id'] }}][]" 
                                                           value="{{ $addon['id'] }}"
                                                           data-addon-id="{{ $addon['id'] }}"
                                                           data-hall-id="{{ $hall['id'] }}"
                                                           data-monday-cost="{{ $addon['monday_cost'] }}"
                                                           data-tuesday-cost="{{ $addon['tuesday_cost'] }}"
                                                           data-wednesday-cost="{{ $addon['wednesday_cost'] }}"
                                                           data-thursday-cost="{{ $addon['thursday_cost'] }}"
                                                           data-friday-cost="{{ $addon['friday_cost'] }}"
                                                           data-saturday-cost="{{ $addon['saturday_cost'] }}"
                                                           data-sunday-cost="{{ $addon['sunday_cost'] }}">
                                                    <label class="form-check-label d-flex justify-content-between w-100" for="addon_{{ $addon['id'] }}">
                                                        <span>{{ $addon['name'] }}</span>
                                                        <span class="addon-display-cost" id="addon_display_cost_{{ $addon['id'] }}" style="color: black; font-weight: bold;"></span>
                                                    </label>
                                                    <!-- Add hidden input for addon cost -->
                                                    <input type="hidden" name="addon_costs[{{ $hall['id'] }}][{{ $addon['id'] }}]" id="addon_cost_{{ $addon['id'] }}" value="0">
                                                    @if(stripos($addon['name'], 'pre-event prep time') !== false)
                                                    <div class="prep-time-hours mt-2" style="display: none;">
                                                        <label class="small">Hours:</label>
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm prep-time-decrease">-</button>
                                                            <input type="number" class="form-control form-control-sm prep-time-select text-center" 
                                                                   name="prep_time_hours[{{ $addon['id'] }}]"
                                                                   data-addon-id="{{ $addon['id'] }}"
                                                                   value="1" min="1" max="6">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm prep-time-increase">+</button>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
   
       

         <!-- Date and Time Section -->
     <div class="row mb-4">
        <div class="col-12">
            <h5 class="section-title">Date & Time</h5>
        </div>

        <div class="form-group col-md-6">
            {!! Form::label('alternate_date_of_event', 'Alternate Date Of Event:') !!}
            {!! Form::text('alternate_date_of_event', null, ['class' => 'form-control dateonlypicker','id'=>'alternate_date_of_event']) !!}
        </div>

        <div class="form-group col-md-6">
            <div class="d-flex flex-column">
                {!! Form::label('start_time', 'Start Time:') !!}
                {!! Form::select('start_time', [
                    '05:00' => '5:00 AM',
                    '06:00' => '6:00 AM',
                    '07:00' => '7:00 AM',
                    '08:00' => '8:00 AM',
                    '09:00' => '9:00 AM',
                    '10:00' => '10:00 AM',
                    '11:00' => '11:00 AM',
                    '12:00' => '12:00 PM',
                    '13:00' => '1:00 PM',
                    '14:00' => '2:00 PM',
                    '15:00' => '3:00 PM',
                    '16:00' => '4:00 PM',
                    '17:00' => '5:00 PM',
                    '18:00' => '6:00 PM',
                    '19:00' => '7:00 PM'
                ], null, ['class' => 'form-control select2', 'placeholder' => 'Select Start Time']) !!}
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="d-flex flex-column">
            {!! Form::label('duration', 'Duration:') !!}
            {!! Form::select('duration', [
                '1' => '1 Hour',
                '2' => '2 Hours',
                '3' => '3 Hours',
                '4' => '4 Hours',
                '5' => '5 Hours',
                '6' => '6 Hours',
                '7' => '7 Hours',
                '8' => '8 Hours',
                '9' => '9 Hours',
                '10' => '10 Hours',
                '11' => '11 Hours',
                '12' => '12 Hours',
                '13' => '13 Hours',
                '14' => '14 Hours',
                '15' => '15 Hours',
                '16' => '16 Hours',
                '17' => '17 Hours',
                '18' => '18 Hours',
                '19' => '19 Hours',
                '20' => '20 Hours',
                '21' => '21 Hours',
                '22' => '22 Hours',
                '23' => '23 Hours',
                '24' => '24 Hours'
            ], null, ['class' => 'form-control select2', 'placeholder' => 'Select Duration']) !!}
        </div>
    </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <h4>Personal Details</h4>
        </div>
        <div class="form-group col-sm-4">
            {!! Form::label('community_name', 'Community Name:') !!}
            {!! Form::text('community_name', null, ['class' => 'form-control', 'maxlength' => 255, 'id' => 'community_name_field']) !!}
        </div>
    
        <!-- First Name Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('first_name', 'First Name:') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
        </div>
    
        <!-- Last Name Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('last_name', 'Last Name:') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => 255, 'id' => 'last_name_field']) !!}
        </div>
    
        <!-- Mobile Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('mobile', 'Mobile:') !!}
            {!! Form::text('mobile', null, ['class' => 'form-control digits-input', 'required', 'maxlength' => 255]) !!}
        </div>
    
        <!-- Email Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
        </div>
    
        <!-- Address Field -->
        <div class="form-group col-sm-12 col-lg-4">
            {!! Form::label('address', 'Address:') !!}
            {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
        </div>
    
        <!-- Country Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('country', 'Country:') !!}
            {!! Form::text('country', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
        </div>
    
        <!-- State Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('state', 'State:') !!}
            {!! Form::text('state', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
        </div>
    
        <!-- City Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('city', 'City:') !!}
            {!! Form::text('city', null, ['class' => 'form-control']) !!}
        </div>
    
        <!-- Pincode Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('pincode', 'Pincode:') !!}
            {!! Form::text('pincode', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4>Other Details</h4>
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('total_amount', 'Total Amount:') !!}
            {!! Form::number('total_amount', null, ['class' => 'form-control']) !!}
        </div>
    
        <!-- Admin Comments Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('admin_comments', 'Admin Comments:') !!}
            {!! Form::textarea('admin_comments', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
        </div>
    
        <div class="form-group col-sm-6">
            {!! Form::label('payment_status', 'Payment Status:') !!}
            {!! Form::text('payment_status', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
        </div>
    
        <!-- Terms Conditions Field -->
        <div class="form-group col-sm-6">
            <div class="form-check">
                {!! Form::hidden('terms_conditions', 0, ['class' => 'form-check-input']) !!}
                {!! Form::checkbox('terms_conditions', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('terms_conditions', 'Terms Conditions', ['class' => 'form-check-label']) !!}
            </div>
        </div>
    </div>
</div>
</div> 

@push('page_scripts')
    <script type="text/javascript">
        $('#date_of_event').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    </script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('#alternate_date_of_event').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    </script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date_of_event').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    </script>
@endpush

@push('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Function to toggle community name field visibility and event duration
        function toggleCommunityNameField() {
            var selectedType = $('input[name="type_of_event"]:checked').val();
            if (selectedType === 'personal') {
                $('#community_name_field').closest('.form-group').hide();
                // Set event duration to one-day and hide end date
                $('input[name="event_duration"][value="one-day"]').prop('checked', true);
                $('#end_date_container').hide();
                $('#end_date_of_event').prop('required', false);
                // Show last name field for personal events and make it required
                $('#last_name_field').closest('.form-group').show();
                $('#last_name_field').prop('required', true);
            } else if (selectedType === 'community') {
                $('#community_name_field').closest('.form-group').show();
                // Hide last name field for community events and remove required
                $('#last_name_field').closest('.form-group').hide();
                $('#last_name_field').prop('required', false);
            } else {
                $('#community_name_field').closest('.form-group').show();
                // Show last name field for other event types and make it required
                $('#last_name_field').closest('.form-group').show();
                $('#last_name_field').prop('required', true);
            }
        }

        // Function to toggle end date field visibility
        function toggleEndDateField() {
            var selectedDuration = $('input[name="event_duration"]:checked').val();
            var selectedType = $('input[name="type_of_event"]:checked').val();
            
            // If event type is personal, always hide end date
            if (selectedType === 'personal') {
                $('#end_date_container').hide();
                $('#end_date_of_event').prop('required', false);
                return;
            }
            
            // Otherwise, show/hide based on duration
            if (selectedDuration === 'multiple-days') {
                $('#end_date_container').show();
                $('#end_date_of_event').prop('required', true);
            } else {
                $('#end_date_container').hide();
                $('#end_date_of_event').prop('required', false);
            }
        }

        // Function to toggle hall addons visibility and handle Pre-Event Prep Time
        function toggleHallAddons() {
            $('.main-hall-checkbox').each(function() {
                var hallId = $(this).data('hall-id');
                var addonsContainer = $('#addons_' + hallId);
                var hallCard = $(this).closest('.hall-item');
                
                if ($(this).is(':checked')) {
                    addonsContainer.slideDown(200);
                    hallCard.addClass('border-primary');
                    
                    // Find and select Pre-Event Prep Time addon
                    var prepTimeAddon = addonsContainer.find('.hall-addon-checkbox').filter(function() {
                        return $(this).next('label').text().trim().toLowerCase().includes('pre-event prep time');
                    });
                    if (prepTimeAddon.length) {
                        prepTimeAddon.prop('checked', true);
                        // Show the hours selector
                        prepTimeAddon.closest('.form-check').find('.prep-time-hours').show();
                    }
                } else {
                    addonsContainer.slideUp(200);
                    hallCard.removeClass('border-primary');
                    // Uncheck all addons when hall is unchecked
                    addonsContainer.find('.hall-addon-checkbox').prop('checked', false);
                    // Hide all prep time hours selectors
                    addonsContainer.find('.prep-time-hours').hide();
                }
            });
        }

        // Function to calculate number of days between two dates
        function calculateDaysBetweenDates(startDate, endDate) {
            var start = new Date(startDate);
            var end = new Date(endDate);
            var diffTime = Math.abs(end - start);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays + 1; // Include both start and end dates
        }

        // Function to update total amount and hall display costs
        function updateTotalAmount() {
            var selectedEventType = $('input[name="type_of_event"]:checked').val();
            var dateOfEvent = $('#date_of_event').val();
            var endDateOfEvent = $('#end_date_of_event').val();
            var eventDuration = $('input[name="event_duration"]:checked').val();

            // Toggle visibility of hall booking details content
            if (dateOfEvent && eventDuration) {
                $('#hall_booking_details_content').slideDown(200);
            } else {
                $('#hall_booking_details_content').slideUp(200);
            }

            if (selectedEventType === 'hindu_temple') {
                $('#total_amount').val(0);
                // Also reset hall display costs to $0.00 for hindu_temple events
                $('.main-hall-checkbox').each(function() {
                    var hallId = $(this).data('hall-id');
                    $('#hall_display_cost_' + hallId).text('$' + (0).toFixed(2));
                    $('#hall_cost_' + hallId).val(0);
                });
                // Also reset addon display costs to $0.00 for hindu_temple events
                $('.hall-addon-checkbox').each(function() {
                    var addonId = $(this).data('addon-id');
                    $('#addon_display_cost_' + addonId).text('$' + (0).toFixed(2));
                    $('#addon_cost_' + addonId).val(0);
                });
                return; // Exit if hindu_temple event
            }

            // Calculate total based on selected halls and addons
            var grandTotal = 0;

            if (dateOfEvent) {
                var eventDate = new Date(dateOfEvent);
                var dayOfWeek = eventDate.getDay(); // 0 for Sunday, 1 for Monday, ..., 6 for Saturday
                var dayNames = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                var currentDayName = dayNames[dayOfWeek];

                $('.main-hall-checkbox').each(function() {
                    var hallId = $(this).data('hall-id');
                    var hallItem = $(this).closest('.hall-item');
                    var hallCost = 0;

                    if (eventDuration === 'one-day') {
                        hallCost = parseFloat(hallItem.data(currentDayName + '-cost')) || 0;
                    } else if (eventDuration === 'multiple-days' && endDateOfEvent) {
                        // For multiple days, calculate based on number of days
                        var numberOfDays = calculateDaysBetweenDates(dateOfEvent, endDateOfEvent);
                        if (numberOfDays === 1) {
                            // If only one day, use the weekday cost
                            hallCost = parseFloat(hallItem.data(currentDayName + '-cost')) || 0;
                        } else {
                            // If multiple days, use the three-day cost as base and multiply by number of days
                            var baseCost = parseFloat(hallItem.data(currentDayName + '-three-day-cost')) || 0;
                            hallCost = baseCost * numberOfDays;
                        }
                    }
                    
                    $('#hall_display_cost_' + hallId).text('$' + hallCost.toFixed(2));
                    $('#hall_cost_' + hallId).val(hallCost.toFixed(2));

                    if ($(this).is(':checked')) {
                        grandTotal += hallCost;

                        // Update and add addon costs for selected hall
                        $('#addons_' + hallId + ' .hall-addon-checkbox').each(function() {
                            var addonItem = $(this);
                            var addonCost = parseFloat(addonItem.data(currentDayName + '-cost')) || 0;
                            var addonId = addonItem.data('addon-id');
                            var hallId = addonItem.closest('.hall-item').data('hall-id');

                            // Update the addon display cost
                            var addonDisplayCost = $('#addon_display_cost_' + addonId);
                            if (addonDisplayCost.length) {
                                var displayCost = addonCost;
                                if (eventDuration === 'multiple-days' && endDateOfEvent) {
                                    var numberOfDays = calculateDaysBetweenDates(dateOfEvent, endDateOfEvent);
                                    displayCost = addonCost * numberOfDays;
                                }
                                addonDisplayCost.text('$' + displayCost.toFixed(2));
                                
                                // Set the addon cost in the hidden input
                                var addonCostInput = $('#addon_cost_' + addonId);
                                if (addonCostInput.length) {
                                    addonCostInput.val(displayCost.toFixed(2));
                                    console.log('Setting addon cost for addon ' + addonId + ': ' + displayCost.toFixed(2));
                                }
                            }

                            if (addonItem.is(':checked')) {
                                // Check if this is a Pre-Event Prep Time addon
                                if (addonItem.next('label').text().trim().toLowerCase().includes('pre-event prep time')) {
                                    var hours = parseInt(addonItem.closest('.form-check').find('.prep-time-select').val()) || 1;
                                    addonCost = addonCost * hours;
                                    // Update the hidden input with the new cost
                                    var addonCostInput = $('#addon_cost_' + addonId);
                                    if (addonCostInput.length) {
                                        addonCostInput.val(addonCost.toFixed(2));
                                        console.log('Setting prep time addon cost for addon ' + addonId + ': ' + addonCost.toFixed(2));
                                    }
                                }
                                
                                // Multiply addon cost by number of days for multiple-day events
                                if (eventDuration === 'multiple-days' && endDateOfEvent) {
                                    var numberOfDays = calculateDaysBetweenDates(dateOfEvent, endDateOfEvent);
                                    addonCost = addonCost * numberOfDays;
                                    // Update the hidden input with the final cost
                                    var addonCostInput = $('#addon_cost_' + addonId);
                                    if (addonCostInput.length) {
                                        addonCostInput.val(addonCost.toFixed(2));
                                        console.log('Setting final addon cost for addon ' + addonId + ': ' + addonCost.toFixed(2));
                                    }
                                }
                                
                                grandTotal += addonCost;
                            } else {
                                // If addon is not checked, set its cost to 0
                                var addonCostInput = $('#addon_cost_' + addonId);
                                if (addonCostInput.length) {
                                    addonCostInput.val('0');
                                    console.log('Setting addon cost to 0 for unchecked addon ' + addonId);
                                }
                            }
                        });
                    } else {
                        // If hall is not checked, reset addon display costs to $0.00
                        $('#addons_' + hallId + ' .hall-addon-checkbox').each(function() {
                            var addonId = $(this).data('addon-id');
                            var addonDisplayCost = $('#addon_display_cost_' + addonId);
                            if (addonDisplayCost.length) {
                                addonDisplayCost.text('$0.00');
                                var addonCostInput = $('#addon_cost_' + addonId);
                                if (addonCostInput.length) {
                                    addonCostInput.val('0');
                                    console.log('Setting addon cost to 0 for unchecked addon ' + addonId);
                                }
                            }
                        });
                    }
                });
            } else {
                // If no date or duration selected, reset all costs and total
                $('.main-hall-checkbox').each(function() {
                    var hallId = $(this).data('hall-id');
                    $('#hall_display_cost_' + hallId).text('$0.00');
                    $('#hall_cost_' + hallId).val('0');

                    $('#addons_' + hallId + ' .hall-addon-checkbox').each(function() {
                        var addonId = $(this).data('addon-id');
                        var addonDisplayCost = $('#addon_display_cost_' + addonId);
                        if (addonDisplayCost.length) {
                            addonDisplayCost.text('$0.00');
                            var addonCostInput = $('#addon_cost_' + addonId);
                            if (addonCostInput.length) {
                                addonCostInput.val('0');
                                console.log('Setting addon cost to 0 for addon ' + addonId);
                            }
                        }
                    });
                });
            }

            $('#total_amount').val(grandTotal.toFixed(2));
        }

        // Initial check on page load
        toggleCommunityNameField();
        toggleEndDateField();
        toggleHallAddons();
        updateTotalAmount(); // Call this to set initial costs and total

        // Listen for changes on type of event radio buttons
        $('input[name="type_of_event"]').change(function() {
            toggleCommunityNameField();
            toggleEndDateField();
            updateTotalAmount();
        });

        // Listen for changes on event duration radio buttons
        $('input[name="event_duration"]').change(function() {
            toggleEndDateField();
            updateTotalAmount();
        });

        // Listen for changes on date of event
        $('#date_of_event').change(function() {
            updateTotalAmount();
        });

        // Listen for changes on hall checkboxes
        $('.main-hall-checkbox').change(function() {
            toggleHallAddons();
            updateTotalAmount();
        });

        // Listen for changes on addon checkboxes
        $('.hall-addon-checkbox').change(function() {
            updateTotalAmount();
        });

        // Ensure the datepicker change event is triggered when a date is selected
        $('#date_of_event').on('changeDate', function() {
            $(this).change();
        });

        // Add event listener for prep time hours selection
        $(document).on('change', '.prep-time-select', function() {
            updateTotalAmount();
        });

        // Modify the addon checkbox change handler to show/hide hours selector
        $(document).on('change', '.hall-addon-checkbox', function() {
            var prepTimeHours = $(this).closest('.form-check').find('.prep-time-hours');
            if ($(this).next('label').text().trim().toLowerCase().includes('pre-event prep time')) {
                if ($(this).is(':checked')) {
                    prepTimeHours.show();
                } else {
                    prepTimeHours.hide();
                }
            }
            updateTotalAmount();
        });

        // Add handlers for prep time hours increase/decrease buttons
        $(document).on('click', '.prep-time-increase', function() {
            var input = $(this).siblings('.prep-time-select');
            var currentVal = parseInt(input.val());
            if (currentVal < 6) {
                input.val(currentVal + 1).trigger('change');
            }
        });

        $(document).on('click', '.prep-time-decrease', function() {
            var input = $(this).siblings('.prep-time-select');
            var currentVal = parseInt(input.val());
            if (currentVal > 1) {
                input.val(currentVal - 1).trigger('change');
            }
        });

        // Prevent manual input of invalid values
        $(document).on('input', '.prep-time-select', function() {
            var val = parseInt($(this).val());
            if (isNaN(val) || val < 1) {
                $(this).val(1);
            } else if (val > 6) {
                $(this).val(6);
            }
        });

        // Add event listener for end date changes
        $('#end_date_of_event').change(function() {
            updateTotalAmount();
        });
    });
</script>
@endpush