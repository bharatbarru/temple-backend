<!-- Name Field -->
<div class="col-sm-6">


    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('name', 'Name:') !!} <span class="float-right ">{{ $customer->name }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('email', 'Email:') !!}<span class="float-right ">{{ $customer->email }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('mobile', 'Mobile:') !!}<span class="float-right ">{{ $customer->mobile }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <label for="display_name">{!! Form::label('address', 'Address:') !!}</label><span class="float-right ">{{ $customer->address }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            <label for="display_name">{!! Form::label('pincode', 'Pincode:') !!}</label><span class="float-right ">{{ $customer->pincode }}</span>
        </li>
     
        <li class="nav-item">
            <label for="slug">{!! Form::label('publish', 'Publish:') !!}</label>
            <span class="float-right">{{ $customer->publish }}</span>
        </li>
      
        </ul>






</div>


