@extends('layouts.master')

{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bgdark text-white">Registration</div>
                        <h4 class="text-center">Registration</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
                            </div>

                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter Confirm Password">
                            </div>
                            <br>
                            <br>
                            <button type="submit" class="btn btn-dark btn-block" id="save_form">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')

<script>
    $(document).ready(function() {
       $('#save_form').on('click', function(e){
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();

            var form = $(this).parents('form');
            $(form).validate({
                rules:{
                    fname :{
                        required: true,
                    },

                    lname:{
                        required: true,
                    },

                    email:{
                        required:true,
                    },

                    password:{
                        required:true,
                        minlength: 6,
                    },

                    cpassword:{
                        required:true,
                        equalTo:"#password",
                    },
                },

                messages: {
                    fname: "Full name is required",
                    lname: "Last Name is required",
                    email: "Email is required",
                    password: "password is required",
                    cpassword: "Confirm password is required",
                    cpassword: {
                        equalTo: "confirm password not matched"
                    },
                },
                highlight: function(element){
                    $(element).addClass('error')
                },
                submitHandler: function(){
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/save_user',
                        data: formData,
                        dataType : 'JSON',
                        processData: false,
                        contentType: false,
                        success:function (data) {
                            if(data.exists){
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','red');
                                $('#notifDiv').text('Email already exists');
                                setTimeout(() =>
                                {
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                            } else if(data.success){
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','green');
                                $('#notifDiv').text('User Registered Successfully');
                                setTimeout(() =>
                                {
                                    $('#notifDiv').fadeOut();
                                }, 3000);

                                $('[name = "fname"]').val('');
                                $('[name = "lname"]').val('');
                                $('[name = "email"]').val('');
                                $('[name = "password"]').val('');
                                $('[name = "cpassword"]').val('');
                            } else{
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','red');
                                $('#notifDiv').text('An error occured please try later');
                                setTimeout(() =>
                                {
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                            }
                        }
                    });
                }
            });

            console.log('hi');
            // e.preventDefault();
       });
    });
</script>

@endpush
