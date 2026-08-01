{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
<section class="book-a-table pb-0">
    <div class="container">
        <div class="card rounded-0 bg-primary  p-5">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-5 block text-light">
                    <div class="inner">
                        <div class="timings">
                            <h2 class="font-700 border-bottom pb-3">Our Timings</h2>
                        {!! applicationSettings('timings') !!}
                        </div>
                        <div class="section-title  text-light title-left">
                            <h2>{!! applicationSettings('queries-title') !!}</h2>
                        </div>
                        <p class="h5 font-400">
                            {!! applicationSettings('queries-description') !!}
                        </p>
                        <p class="h5">{!! applicationSettings('queries-booking-title') !!}</p>
                        <a class="d-block" href="tel:{!! applicationSettings('primary-phone-number') !!}"><i class="flaticon-telephone"></i> {!! applicationSettings('primary-phone-number') !!}</a>
                        <a class="d-block" href="mailto:{!! applicationSettings('primary-email') !!}"><i class="flaticon-email-1"></i> {!! applicationSettings('primary-email') !!}</a>
                    </div>
                </div>
                <div class="col-md-7 form">
                    <div class="card card-body text-dark">
                        <h4 class="font-700">Book a Table Now</h4>
                        {{-- <p class="sub-title font-400">Drop us a message and we’ll get back</p>  --}}
                        <form action="{{ url('booking-form-submission') }}" method="POST" id="booking-form">
                            {{ csrf_field() }}
                            <div class="row">
                                @honeypot
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fulltName">Name</label>
                                        <input name="name" type="text" class="form-control" id="fullName"
                                            placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="email" class="form-control" id="email"
                                            placeholder="yourname@mail.com" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number </label>
                                        <input name="phone" type="tel" class="form-control" id="phoneNumber"
                                            placeholder="+91 999 999 9999" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datetime">Date and Time</label>
                                        <input name="datetime" type="text" class="form-control" id="datetime" required>
                                    </div>
                                </div>                              
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="adultNumber">Number of adults</label>
                                        <input name="adultNumber" type="tel" class="form-control" id="adultNumber"
                                            placeholder="Number of adults" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="childNumber">Number of children</label>
                                        <input name="childNumber" type="tel" class="form-control" id="childNumber"
                                            placeholder="Number of adults" required>
                                    </div>
                                </div>
                                <div class="col-md-12">


                                    <div class="our-captcha">
                                    <div class="g-recaptcha" data-callback="imNotARobot"
                                        data-sitekey="6LcCslYqAAAAAC3oPw2Lz-QPQoiZRDrdnfBoSa8H"></div>
                                    <div id="captchaerrors"></div>
                                    </div>



                                    <button type="submit" class="btn btn-secondary w-100 mt-3" value="Send Message"
                                        id="contact_btn">
                                        <span>Send Message</span>



                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@include('pages.recaptcha')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr for date and time picker
        flatpickr('#datetime', {
            enableTime: true, // Enable time selection
            dateFormat: 'd-M-Y h:i K', // Format: day-month-year hour:minute AM/PM (e.g., 15-Apr-2024 03:30 PM)
        });
    </script>
