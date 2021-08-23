@extends('layouts.master')

{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bgdark text-white">Login</div>
                        <h4 class="text-center">Login</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                            </div>


                            <br>
                            <button type="submit" class="btn btn-dark btn-block" id="login_btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@push('scripts')

<script>
    $(document).ready(function(){
        // console.log("enter");
        $('#login_btn').click(function(e){
            // console.log("enter");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            e.preventDefault();
            var email = $(#email).val();
            var password = $(#password).val();

            $.ajax({
                // console.log("enter");
                url: '/user_login',
                type: 'POST',

                data:{
                    email:email,
                    password:password
                },

                success:function(data){
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            $('#notifDiv').fadeIn();
                            $('#notifDiv').css('background','green');
                            $('#notifDiv').text('User Successfully Login');
                            setTimeout(() => {
                                $('#notfiDiv').fadeout();
                            }, 3000);
                            window.location = "{{ route('home') }}"
                        }
                    } else{
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background','red');
                        $('#notifDiv').text('An error occured. Please try again later');

                        setTimeout(()=>{
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                }
            });

            // console.log('hi');
        });
    });

</script>

@endpush
