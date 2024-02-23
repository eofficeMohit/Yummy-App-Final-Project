
@include('.panel.general.head')


<body class="vertical-layout vertical-menu-modern 2-columns navbar-floating menu-expanded footer-static" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="" style="" data-framework="laravel" data-asset-path="index.html">
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap');

body{
	/* padding: 100px 0;
	background: #ecf0f4;
	width: 100%;
	height: 100%;
	font-size: 18px;
	line-height: 1.5;
	font-family: 'Roboto', sans-serif;
	color: #222; */
}
.container{
	/* max-width: 1230px;
	width: 100%; */
}

h1{
	font-weight: 700;
	font-size: 45px;
	font-family: 'Roboto', sans-serif;
}

.header{
	margin-bottom: 80px;
}
#description{
	font-size: 24px;
}

.form-wrap{
	background: rgba(255,255,255,1);
	width: 100%;
	max-width: 850px;
	padding: 50px;
	margin: 0 auto;
	position: relative;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}
.form-wrap:before{
	content: "";
	width: 90%;
	height: calc(100% + 60px);
	left: 0;
	right: 0;
	margin: 0 auto;
	position: absolute;
	top: -30px;
	background: #00bcd9;
	z-index: -1;
	opacity: 0.8;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}
.form-group{
	margin-bottom: 25px;
}
.form-group > label{
	display: block;
	font-size: 18px;	
	color: #000;
}
.custom-control-label{
	color: #000;
	font-size: 16px;
}
.form-control{
	height: 50px;
	background: #ecf0f4;
	border-color: transparent;
	padding: 0 15px;
	font-size: 16px;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}
.form-control:focus{
	border-color: #00bcd9;
	-webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	-moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}
textarea.form-control{
	height: 160px;
	padding-top: 15px;
	resize: none;
}

.btn{
	padding: .657rem .75rem;
	font-size: 18px;
	letter-spacing: 0.050em;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}

.btn-primary {
  color: #fff;
  background-color: #00bcd9;
  border-color: #00bcd9;
}

.btn-primary:hover {
  color: #00bcd9;
  background-color: #ffffff;
  border-color: #00bcd9;
	-webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	-moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

.btn-primary:focus, .btn-primary.focus {
  color: #00bcd9;
  background-color: #ffffff;
  border-color: #00bcd9;
  -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	-moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

.btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active,
.show > .btn-primary.dropdown-toggle {
  color: #00bcd9;
  background-color: #ffffff;
  border-color: #00bcd9;
}

.btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus,
.show > .btn-primary.dropdown-toggle:focus {
  -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	-moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}



@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap");







#container {
  /* width: 500px; */
  height: 50px;
  background-color: #fff;
  padding: 10px;
  margin: 0 20px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
}

#container .text {
  border: none;
  background: none;
  font-size: 18px;
  font-weight: 400;
}

#container #menu-wrap {
  position: relative;
  height: 25px;
  width: 25px;
}

#container #menu-wrap .dots {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  z-index: 1;
}

#container #menu-wrap .dots > div,
#container #menu-wrap .dots > div:after,
#container #menu-wrap .dots > div:before {
  height: 6px;
  width: 6px;
  background-color: rgba(49, 49, 49, 0.8);
  border-radius: 50%;
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .dots > div {
  position: relative;
}

#container #menu-wrap .dots > div:after {
  content: "";
  position: absolute;
  bottom: calc((25px / 2) - (6px / 2));
  left: 0;
}

#container #menu-wrap .dots > div:before {
  content: "";
  position: absolute;
  top: calc((25px / 2) - (6px / 2));
  left: 0;
}

#container #menu-wrap .menu {
  position: absolute;
  right: -10px;
  top: calc(-12px + 50px);
  width: 0;
  height: 0;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px 15px;
  -webkit-box-shadow: 2px 4px 6px rgba(49, 49, 49, 0.2);
  box-shadow: 2px 4px 6px rgba(49, 49, 49, 0.2);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-align: start;
  -ms-flex-align: start;
  align-items: flex-start;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
}

#container #menu-wrap .menu ul {
  list-style: none;
}

#container #menu-wrap .menu ul li {
  margin: 15px 0;
}

#container #menu-wrap .menu ul li .link {
  text-decoration: none;
  color: rgba(49, 49, 49, 0.85);
  opacity: 0;
  visibility: hidden;
}

#container #menu-wrap .toggler {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  cursor: pointer;
  z-index: 2;
}

#container #menu-wrap .toggler:hover + .dots > div,
#container #menu-wrap .toggler:hover + .dots > div:after,
#container #menu-wrap .toggler:hover + .dots > div:before {
  background-color: rgba(49, 49, 49, 0.6);
}

#container #menu-wrap .toggler:checked + .dots > div {
  -webkit-transform: translateX(calc(((25px / 2) - (6px / 2)) * -0.7071067812))
    translateY(calc(((25px / 2) - (6px / 2)) * -0.7071067812));
  -ms-transform: translateX(calc(((25px / 2) - (6px / 2)) * -0.7071067812))
    translateY(calc(((25px / 2) - (6px / 2)) * -0.7071067812));
  transform: translateX(calc(((25px / 2) - (6px / 2)) * -0.7071067812))
    translateY(calc(((25px / 2) - (6px / 2)) * -0.7071067812));
}

#container #menu-wrap .toggler:checked + .dots > div:after {
  -webkit-transform: translateX(calc(((25px / 2) - (6px / 2)) * 0.7071067812))
    translateY(calc((2 * (25px / 2) - (6px / 2)) * 0.7071067812));
  -ms-transform: translateX(calc(((25px / 2) - (6px / 2)) * 0.7071067812))
    translateY(calc((2 * (25px / 2) - (6px / 2)) * 0.7071067812));
  transform: translateX(calc(((25px / 2) - (6px / 2)) * 0.7071067812))
    translateY(calc((2 * (25px / 2) - (6px / 2)) * 0.7071067812));
}

#container #menu-wrap .toggler:checked + .dots > div:before {
  -webkit-transform: translateX(
      calc(2 * (((25px / 2) - (6px / 2)) * 0.7071067812))
    )
    translateY(
      calc(((25px / 2) - (6px / 2)) - (((25px / 2) - (6px / 2)) * 0.7071067812))
    );
  -ms-transform: translateX(calc(2 * (((25px / 2) - (6px / 2)) * 0.7071067812)))
    translateY(
      calc(((25px / 2) - (6px / 2)) - (((25px / 2) - (6px / 2)) * 0.7071067812))
    );
  transform: translateX(calc(2 * (((25px / 2) - (6px / 2)) * 0.7071067812)))
    translateY(
      calc(((25px / 2) - (6px / 2)) - (((25px / 2) - (6px / 2)) * 0.7071067812))
    );
}

#container #menu-wrap .toggler:checked:hover + .dots > div,
#container #menu-wrap .toggler:checked:hover + .dots > div:after,
#container #menu-wrap .toggler:checked:hover + .dots > div:before {
  background-color: rgba(49, 49, 49, 0.6);
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .toggler:checked ~ .menu {
  opacity: 1;
  z-index: 5 !important;
  visibility: visible;
  /* padding: 36px 15px 30px 15px !important; */
  /* padding-top: 20px; */
  width: 220px;
  background-color: white;
  height: fit-content;
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .toggler:checked ~ .menu ul .link {
  opacity: 1;
  visibility: visible;
  -webkit-transition: 0.5s ease 0.3s;
  -o-transition: 0.5s ease 0.3s;
  transition: 0.5s ease 0.3s;
}

#container #menu-wrap .toggler:checked ~ .menu ul .link:hover {
  color: #2980b9;
  -webkit-transition: 0.2s;
  -o-transition: 0.2s;
  transition: 0.2s;
}

#container #menu-wrap .toggler:not(:checked) ~ .menu {
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .toggler:not(:checked) ~ .menu ul .link {
  opacity: 0;
  visibility: hidden;
  -webkit-transition: 0.1s;
  -o-transition: 0.1s;
  transition: 0.1s;
}

@media (max-width: 600px) {
  #container {
    position: absolute;
    top: 50px;
    width: calc(100% - 40px);
    margin: 0;
  }
}

.table-image {
  td, th {
    vertical-align: middle;
  }
}
</style>

    @include('.panel.general.left-nav')
    @include('.panel.general.top-nav')

    <!-- END: Header-->



    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <!-- BEGIN: Header-->
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="content-wrapper ">


            <div class="content-body">

                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">



                        <!-- wallet Card -->
                        @if($User->user_type_slug=='administrator' || $User->user_type_slug=='country-head' || $User->user_type_slug=='admin' || $User->user_type_slug=='agency' || $User->user_type_slug=='Agent' || $User->user_type_slug=='User')

                            @if($User->user_type_slug=='country-head' || $User->user_type_slug=='admin' || $User->user_type_slug=='agency')

                            <div class="col-xl-12 col-md-12 col-12">
                                <div class="card custom-card">

                                    <div style="padding-top: 20px; padding-left: 20px;">

                                        <div style="margin-bottom: 5px">


                                            @if($User->user_type_slug=='country-head')
                                                Country Head
                                            @endif

                                            @if($User->user_type_slug=='admin')
                                                Admin
                                            @endif


                                            @if($User->user_type_slug=='agency')
                                                Agency
                                            @endif

                                            ID is <strong>{{$User->code}}</strong>


                                            @if($User->user_type_slug=='agency')
                                                    | Admin ID is <strong>{{$User->reference_code}}</strong>
                                            @endif

                                        </div>

                                        <p>Click on the link below to share with your

                                            @if($User->user_type_slug=='country-head')
                                                country-head
                                            @endif

                                            @if($User->user_type_slug=='admin')
                                                agency
                                            @endif


                                            @if($User->user_type_slug=='agency')
                                                host
                                            @endif
                                            .</p>

                                    </div>

                                    <div id="link" class="card-body" style="padding-left: 20px; font-weight: bold; cursor: pointer">



                                        @if($User->user_type_slug=='country-head')
                                            {{url('/')}}/sign-up/admin?head={{$User->code}}
                                        @endif


                                        @if($User->user_type_slug=='admin')
                                             {{url('/')}}/sign-up/agency?admin={{$User->code}}
                                        @endif


                                        @if($User->user_type_slug=='agency')
                                             {{url('/')}}/sign-up/host?agency={{$User->code}}
                                        @endif



                                    </div>

                                </div>
                            </div>

                            @endif





                            @if($User->user_type_slug=='administrator' || $User->user_type_slug=='country-head' || $User->user_type_slug=='admin' || $User->user_type_slug=='agency' || $User->user_type_slug=='Agent' || $User->user_type_slug=='User')
                                <div class="col-xl-3 col-md-3 col-12">

                                    <a href="javascript:void(0)">
                                        <div class="card custom-card">
                                            <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                                <div class="row">

                                                    <div class="col-xl-7 col-md-7 col-7 text-center">
                                                        <div class="count">{{$User->wallet}}</div>
                                                        <div class="count-title">Wallet</div>
                                                    </div>


                                                    <div class="col-xl-5 col-md-5 col-5 text-center">
                                                        <img src="{{url('panel/images/administrators.svg')}}" alt="" style="max-width: 50px">
                                                    </div>

                                                </div>






                                            </div>
                                        </div>
                                    </a>

                                </div>
                            @endif



                            @if($User->user_type_slug=='country-head')
                                <div class="col-xl-3 col-md-3 col-12">

                                    <a href="javascript:void(0)">
                                        <div class="card custom-card">
                                            <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                                <div class="row">

                                                    <div class="col-xl-7 col-md-7 col-7 text-center">
                                                        <div class="count">{{$AdminsCount}}</div>
                                                        <div class="count-title">Admins</div>
                                                    </div>


                                                    <div class="col-xl-5 col-md-5 col-5 text-center">
                                                        <img src="{{url('panel/images/administrators.svg')}}" alt="" style="max-width: 50px">
                                                    </div>

                                                </div>






                                            </div>
                                        </div>
                                    </a>

                                </div>
                            @endif



                        @endif
                        <!--/ wallet Card -->





                        <!-- Notifications Card -->
                        @if($User->user_type_slug=='administrator' || $User->user_type_slug=='country-head' || $User->user_type_slug=='admin' || $User->user_type_slug=='agency' || $User->user_type_slug=='Agent' || $User->user_type_slug=='User')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="javascript:void(0)">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">0</div>
                                                    <div class="count-title">Notifications</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/agencies.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Notifications Card -->




                        <!-- Messages Card -->
                        @if($User->user_type_slug=='administrator' || $User->user_type_slug=='country-head' || $User->user_type_slug=='admin' || $User->user_type_slug=='agency' || $User->user_type_slug=='Agent' || $User->user_type_slug=='User')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="javascript:void(0)">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">0</div>
                                                    <div class="count-title">Messages</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/agencies.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Messages Card -->




                        <!-- Subscribers Card -->
                        @if($User->user_type_slug=='administrator')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/agencies/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">0</div>
                                                    <div class="count-title">Subscribers</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/agencies.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Subscribers Card -->



                        <div class="col-xl-12 col-md-12 col-12">
                            <hr>
                        </div>


                        <!-- Administrators Card -->
                        @if($User->user_type_slug=='administrator')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/user/administrators/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$AdministratorsCount}}</div>
                                                    <div class="count-title">Administrators</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/administrators.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Administrators Card -->


                        <!-- Admin Card -->
                        @if($User->user_type_slug=='administrator')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/user/admins/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$AdminsCount}}</div>
                                                    <div class="count-title">Admin</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/admin.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Admin Card -->

                        <!-- Agencies Card -->
                        @if($User->user_type_slug=='administrator' || $User->user_type_slug=='admin')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/agencies/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$AgenciesCount}}</div>
                                                    <div class="count-title">Agencies</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/agencies.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Agencies Card -->

                        <!-- hosts Card -->
                        @if($User->user_type_slug=='administrator' || $User->user_type_slug=='agency')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/user/hosts/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$HostsCount}}</div>
                                                    <div class="count-title">Hosts</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/hosts.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ hosts Card -->

                        <!-- Agents Card -->
                        @if($User->user_type_slug=='administrator')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/user/agents/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$AgentsCount}}</div>
                                                    <div class="count-title">Agents</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/agents.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Agents Card -->

                        <!-- Users Card -->
                        @if($User->user_type_slug=='administrator')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/user/users/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$UsersCount}}</div>
                                                    <div class="count-title">Users</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/user.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/ Users Card -->


                        <!-- Block Users Card -->
                        @if($User->user_type_slug=='administrator')
                            <div class="col-xl-3 col-md-3 col-12">

                                <a href="{{url('admin/user/block/list')}}">
                                    <div class="card custom-card">
                                        <div class="card-body" style="padding: 5px 10px 5px 10px;">



                                            <div class="row">

                                                <div class="col-xl-7 col-md-7 col-7 text-center">
                                                    <div class="count">{{$BlockUsersCount}}</div>
                                                    <div class="count-title">Block</div>
                                                </div>


                                                <div class="col-xl-5 col-md-5 col-5 text-center">
                                                    <img src="{{url('panel/images/block-users.svg')}}" alt="" style="max-width: 50px">
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endif
                        <!--/Block Users Card -->



























                    </div>

                </section>
                <!-- Dashboard Ecommerce ends -->




                <!-- Basic Tables start -->
                @if($User->user_type_slug=='administrator' || $User->user_type_slug=='country-head' || $User->user_type_slug=='admin' || $User->user_type_slug=='agency' || $User->user_type_slug=='support')

                    <div class="row" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">


                                        @if($User->user_type_slug=='administrator')
                                           All Accounts
                                        @endif


                                        @if($User->user_type_slug=='country-head')
                                            Your Admins
                                        @endif

                                        @if($User->user_type_slug=='admin')
                                            Your Agencies
                                        @endif

                                        @if($User->user_type_slug=='agency')
                                            Your Hosts
                                        @endif

                                    </h4>

                                    {{--                                <button type="button" class="btn btn-primary waves-effect waves-float waves-light"  data-toggle="modal" data-target="#exampleModalCenter">Add New User</button>--}}

                                </div>
                                <div class="table-responsive">



                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Picture</th>
                                            <th>Full Name/Country</th>

                                            <th>Type/Status</th>
                                            @if($User->user_type_slug=='administrator' || $User->user_type_slug=='support')
                                                <th>Action</th>
                                            @endif
                                            <th>Admin/Agency</th>
                                            <th>Email/Number</th>
                                            <th>Registered By</th>
                                            @if($User->user_type_slug=='administrator')
                                            <th>Edit User</th>
                                            <th>User History</th>
                                            <th>Add Diamond</th>
                                            <th>Add Coins</th>
                                            <th>Block For 7 Days</th>
                                            <th>Block Permanent</th>
                                            <th>Add Store</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($Users as $UsersTemp)
                                            <tr>
                                                <td>{{$UsersTemp->created_at}}</td>
                                                <td style="text-align: center">
                                                    @if($UsersTemp->image!=null)
                                                        <img src="{{url('/uploads/'.$UsersTemp->image)}}" class="rounded-circle" style="height: 35px; width: 35px; object-fit: cover; border: 1px solid #010716;" alt="{{$UsersTemp->full_name}}" title="{{$UsersTemp->full_name}}">
                                                    @else
                                                        <img src="{{url('/general/img/default-user.jpg')}}" class="rounded-circle" style="height: 35px; width: 35px; object-fit: cover; border: 1px solid #010716;" alt="{{$UsersTemp->full_name}}" title="{{$UsersTemp->full_name}}">
                                                    @endif

                                                    <br>
                                                    {{$UsersTemp->code}}
                                                </td>
                                                <td>{{$UsersTemp->full_name}}<br>{{$UsersTemp->country_name}}</td>

                                                <td>
                                                    {{$UsersTemp->status}}
                                                    <br>
                                                    @if($UsersTemp->user_type_slug=='administrator')
                                                        <button type="button" class="btn btn-dark btn-sm" style="background-color: #3ade00 !important; border-color: #3ade00 !important;">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='country-head')
                                                        <button type="button" class="btn btn-dark btn-sm">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='admin')
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#agencyModal">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='host')
                                                        <button type="button" class="btn btn-danger btn-sm">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='agency')
                                                        <button type="button" class="btn btn-secondary btn-sm">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='agent')
                                                        <button type="button" class="btn btn-success btn-sm">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='user')
                                                        <button type="button" class="btn btn-primary btn-sm">{{$UsersTemp->user_type_title}}</button>
                                                    @elseif($UsersTemp->user_type_slug=='support')
                                                        <button type="button" class="btn btn-info btn-sm" style="background-color: #7acb00">{{$UsersTemp->user_type_title}}</button>
                                                    @endif

                                                </td>

                                                @if($User->user_type_slug=='administrator' || $User->user_type_slug=='support')
                                                    <td>
                                                        {{--                                                    <a href="javascript:void(0);" id="view_{{$UsersTemp->id}}" class="view"><i data-feather="eye"></i></a>--}}
                                                        {{--                                                    <a href="javascript:void(0);" id="edit_{{$UsersTemp->id}}" class="edit"><i data-feather="edit-2"></i></a>--}}

                                                        @if($UsersTemp->id!=$User->id && $UsersTemp->user_type_slug!='administrator')
                                                            <a href="javascript:void(0);" id="delete_{{$UsersTemp->id}}" class="delete" title="Delete"><i data-feather="trash-2"></i></a>
                                                        @endif


                                                        @if($User->user_type_slug=='support' || $User->user_type_slug=='administrator')
                                                            @if($UsersTemp->id!=$User->id && $UsersTemp->status!='Blocked' && $UsersTemp->user_type_slug!='administrator')
                                                                <a href="javascript:void(0);" id="block_{{$UsersTemp->id}}" style="color: red"  class="block" title="Block"><i data-feather="x-square"></i></a>
                                                            @endif
                                                        @endif



                                                        @if($User->user_type_slug=='support' || $User->user_type_slug=='administrator')
                                                            @if($UsersTemp->id!=$User->id && $UsersTemp->status=='Pending' && $UsersTemp->user_type_slug!='administrator')
                                                                <a href="javascript:void(0);" id="approve_{{$UsersTemp->id}}" style="color: red"  class="approve" title="Approve"><i data-feather="check"></i></a>
                                                            @endif
                                                        @endif

                                                        @if($User->user_type_slug=='support' || $User->user_type_slug=='administrator')
                                                            @if($UsersTemp->id!=$User->id && $UsersTemp->status=='Blocked' && $UsersTemp->user_type_slug!='administrator')
                                                                <a href="javascript:void(0);" id="unblocked_{{$UsersTemp->id}}" style="color: red"  class="unblocked" title="Unblocked"><i data-feather="check"></i></a>
                                                            @endif
                                                        @endif

                                                    </td>
                                                @endif

                                                <td>{{$UsersTemp->company_title}},<br>{{$UsersTemp->users2_full_name}}</td>

                                                <td>{{$UsersTemp->email}}<br>{{$UsersTemp->country_code_code.' '.$UsersTemp->number}}</td>





                                                <td>
                                                    @if($UsersTemp->created_by_user_id==null)
                                                        Direct
                                                    @else
                                                        Indirect
                                                    @endif
                                                </td>
                                            @if($User->user_type_slug=='administrator')

                                                <td>
                                                   <a href="#" class="badge bg-primary text-white" data-toggle="modal" data-target="#editUserModal">Edit User</a>
                                                </td>
                                                <td>
                                                   <a href="" class="badge bg-warning text-white" data-toggle="modal" data-target="#historyModal">Info</a>
                                                </td>
                                                <td>
                                                   <a href="" class="badge bg-success text-white" data-toggle="modal" data-target="#addDiamodsModal">Add Diamond</a>
                                                </td>
                                                <td>
                                                   <a href="" class="badge bg-secondary text-white" data-toggle="modal" data-target="#addCoinsModal">Add Coins</a>
                                                </td>
                                                <td>
                                                   <a href="" class="badge bg-danger text-white">Block For 7 Days</a>
                                                </td>
                                                <td>
                                                   <a href="" class="badge bg-danger text-white">Block Permanently</a>
                                                </td>
                                                <td>
                                                    <div id="container">
    
                                                        <div id="menu-wrap">
                                                          <input type="checkbox" class="toggler" />
                                                          <div class="dots">
                                                            <div></div>
                                                          </div>
                                                          <div class="menu">
                                                            <div style="">
                                                              <ul>
                                                                <li><a href="#" class="link"  data-toggle="modal" data-target="#addFrameStore">Add Frame</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal" data-target="#addLevelStore">Add Level</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal" data-target="#addBadgesStore">Add Badges</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal" data-target="#addEntryStore">Add Entries</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal"
                                                                    data-target="#addFrameStore">Add VIPs</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal"
                                                                    data-target="#addUniqueIdStore">Add Unique Id</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal"
                                                                    data-target="#addThemeStore">Add Theme</a></li>
                                                                <li><a href="#" class="link" data-toggle="modal"
                                                                    data-target="#addBubbleStore">Add Bubbles</a></li>
                                                              </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach


                                        </tbody>

                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Picture</th>
                                            <th>Full Name/Country</th>

                                            <th>Type/Status</th>
                                            @if($User->user_type_slug=='administrator' || $User->user_type_slug=='support')
                                                <th>Action</th>
                                            @endif
                                            <th>Admin/Agency</th>
                                            <th>Email/Number</th>
                                            <th>Registered By</th>
                                            @if($User->user_type_slug=='administrator')
                                            <th>Edit User</th>
                                            <th>User History</th>
                                            <th>Add Diamond</th>
                                            <th>Add Coins</th>
                                            <th>Block For 7 Days</th>
                                            <th>Block Permanent</th>
                                            <th>Add Store</th>
                                            @endif
                                        </tr>
                                        </thead>

                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>

                @endif



                <!-- Add Frame Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addFrameStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Store To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall1" />&nbsp;All</th>
                        <th>Title</th>
                        <th>Picture</th>
                        <th>Weekly Diamonds</th>
                        <th>Two Weeks Diamonds</th>
                        <th>Monthly Diamonds</th>
                        <th>Yearly Diamonds</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual1" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                        <td>Bootstrap 4 CDN and Starter Template</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>2.846</td>
                        <td>913</td>
                        <td>2.846</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual1" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                        <td>Bootstrap Grid 4 Tutorial and Examples</td>
                        <td>Cristina</td>
                        <td>1.434</td>
                        <td>3.417</td>
                        <td>913</td>
                        <td>2.846</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual1" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                        <td>Bootstrap Flexbox Tutorial and Examples</td>
                        <td>Cristina</td>
                        <td>1.877</td>
                        <td>1.234</td>
                        <td>913</td>
                        <td>2.846</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

   <!-- Add Level Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addLevelStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Level To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall2" />&nbsp;All</th>
                        <th>Title</th>
                        <th>Picture</th>
                        <th>Diamonds</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual2" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                        <td>Bootstrap 4 CDN and Starter Template</td>
                        <td>Cristina</td>
                        <td>913</td>
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual2" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                        <td>Bootstrap Grid 4 Tutorial and Examples</td>
                        <td>Cristina</td>
                        <td>1.434</td>
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual2" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                        <td>Bootstrap Flexbox Tutorial and Examples</td>
                        <td>Cristina</td>
                        <td>1.877</td>
                       
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Add Badges Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addBadgesStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Badge To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall3" />&nbsp;All</th>
                        <th>Title</th>
                        <th>Picture</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual3" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                     
                        <td>Cristina</td>
                        <td>913</td>
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual3" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                       
                        <td>Cristina</td>
                        <td>1.434</td>
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual3" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                      
                        <td>Cristina</td>
                        <td>1.877</td>
                       
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

   <!-- Add Entry Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addEntryStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Entries To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall4" />&nbsp;All</th>
                        <th>Title</th>
                        <th>Picture</th>
                        <th>Weekly Diamonds</th>
                        <th>Two Weeks Diamonds</th>
                        <th>Monthly Diamonds</th>
                        <th>Yearly Diamonds</th>
                        <th>Background Music</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual4" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                     
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                       
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual4" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                       
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual4" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                      
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                       
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

   <!-- Add UniqueId Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addUniqueIdStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Unique Ids To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall5" />&nbsp;All</th>
                        <th>Title</th>
                                        <th>Picture</th>
                                        <th>Weekly Diamonds</th>
                                        <th>Two Weeks Diamonds</th>
                                        <th>Monthly Diamonds</th>
                                        <th>Yearly Diamonds</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual5" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                     
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                       
                       
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual5" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                       
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                      
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual5" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                      
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                       
                       
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Add Theme Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addThemeStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Themes To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall6" />&nbsp;All</th>
                        <th>Title</th>
                        <th>Picture</th>
                        <th>Weekly Diamonds</th>
                        <th>Two Weeks Diamonds</th>
                        <th>Monthly Diamonds</th>
                        <th>Yearly Diamonds</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual6" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                     
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                       
                       
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual6" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                       
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                      
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual6" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                      
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                       
                       
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Add Bubble Modal -->
                <!-- Info Modal -->
<div class="modal fade" id="addBubbleStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Bubbles To Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="selectall7" />&nbsp;All</th>
                        <th>Title</th>
                        <th>Picture</th>
                        <th>Weekly Diamonds</th>
                        <th>Two Weeks Diamonds</th>
                        <th>Monthly Diamonds</th>
                        <th>Yearly Diamonds</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual7" id="customCheck1" checked>
                              <label class="custom-control-label" for="customCheck1">1</label>
                          </div>
                        </td>
                     
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                       
                       
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual7" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">2</label>
                          </div>
                        </td>
                       
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                      
                        
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input individual7" id="customCheck3">
                              <label class="custom-control-label" for="customCheck3">3</label>
                          </div>
                        </td>
                      
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                        <td>Cristina</td>
                        <td>913</td>
                       
                       
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
                <!-- Basic Tables end -->
<!-- Edit User Modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
	<header class="header">
		<h1 id="title" class="text-center">Edit User</h1>
		<!-- <p id="description" class="text-center">
			Thank you for taking the time to help us improve the platform
		</p> -->
	</header>
	<div class="form-wrap">	
		<form id="survey-form">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label id="name-label" for="name">Full Name</label>
						<input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" required>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label id="email-label" for="email">Email</label>
						<input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label id="number-label" for="number">Number</label>
						<input type="text" name="number" id="number" class="form-control" placeholder="Number" >
					</div>
				</div>
                <div class="col-md-12">
					<div class="form-group">
						<label id="number-label" for="">Code</label>
						<input type="text" name="code" id="" class="form-control" placeholder="Code" >
					</div>
				</div>

                <div class="col-md-12">
					<div class="form-group">
                        <label for="select-country">Country</label>
                        <!--   <select id="heard" required="" class="form-control" > -->
                        <select id="select-country" name="country" class="demo-default form-control" required placeholder="Confirm your country" data-parsley-errors-container="#errors">
                <option value="" selected>Confirm your country</option>
                                          <option value="AF">Afghanistan</option>
                                          <option value="AX">&Aring;land Islands</option>
                                          <option value="AL">Albania</option>
                                          <option value="DZ">Algeria</option>
                                          <option value="AS">American Samoa</option>
                                          <option value="AD">Andorra</option>
                                          <option value="AO">Angola</option>
                                          <option value="AI">Anguilla</option>
                                          <option value="AQ">Antarctica</option>
                                          <option value="AG">Antigua and Barbuda</option>
                                          <option value="AR">Argentina</option>
                                          <option value="AM">Armenia</option>
                                          <option value="AW">Aruba</option>
                                          <option value="AU">Australia</option>
                                          <option value="AT">Austria</option>
                                          <option value="AZ">Azerbaijan</option>
                                          <option value="BS">Bahamas</option>
                                          <option value="BH">Bahrain</option>
                                          <option value="BD">Bangladesh</option>
                                          <option value="BB">Barbados</option>
                                          <option value="BY">Belarus</option>
                                          <option value="BE">Belgium</option>
                                          <option value="BZ">Belize</option>
                                          <option value="BJ">Benin</option>
                                          <option value="BM">Bermuda</option>
                                          <option value="BT">Bhutan</option>
                                          <option value="BO">Bolivia, Plurinational State of</option>
                                          <option value="BA">Bosnia and Herzegovina</option>
                                          <option value="BW">Botswana</option>
                                          <option value="BV">Bouvet Island</option>
                                          <option value="BR">Brazil</option>
                                          <option value="IO">British Indian Ocean Territory</option>
                                          <option value="BN">Brunei Darussalam</option>
                                          <option value="BG">Bulgaria</option>
                                          <option value="BF">Burkina Faso</option>
                                          <option value="BI">Burundi</option>
                                          <option value="KH">Cambodia</option>
                                          <option value="CM">Cameroon</option>
                                          <option value="CA">Canada</option>
                                          <option value="CV">Cape Verde</option>
                                          <option value="KY">Cayman Islands</option>
                                          <option value="CF">Central African Republic</option>
                                          <option value="TD">Chad</option>
                                          <option value="CL">Chile</option>
                                          <option value="CN">China</option>
                                          <option value="CX">Christmas Island</option>
                                          <option value="CC">Cocos (Keeling) Islands</option>
                                          <option value="CO">Colombia</option>
                                          <option value="KM">Comoros</option>
                                          <option value="CG">Congo</option>
                                          <option value="CD">Congo, the Democratic Republic of the</option>
                                          <option value="CK">Cook Islands</option>
                                          <option value="CR">Costa Rica</option>
                                          <option value="CI">C&ocirc;te d'Ivoire</option>
                                          <option value="HR">Croatia</option>
                                          <option value="CU">Cuba</option>
                                          <option value="CY">Cyprus</option>
                                          <option value="CZ">Czech Republic</option>
                                          <option value="DK">Denmark</option>
                                          <option value="DJ">Djibouti</option>
                                          <option value="DM">Dominica</option>
                                          <option value="DO">Dominican Republic</option>
                                          <option value="EC">Ecuador</option>
                                          <option value="EG">Egypt</option>
                                          <option value="SV">El Salvador</option>
                                          <option value="GQ">Equatorial Guinea</option>
                                          <option value="ER">Eritrea</option>
                                          <option value="EE">Estonia</option>
                                          <option value="ET">Ethiopia</option>
                                          <option value="FK">Falkland Islands (Malvinas)</option>
                                          <option value="FO">Faroe Islands</option>
                                          <option value="FJ">Fiji</option>
                                          <option value="FI">Finland</option>
                                          <option value="FR">France</option>
                                          <option value="GF">French Guiana</option>
                                          <option value="PF">French Polynesia</option>
                                          <option value="TF">French Southern Territories</option>
                                          <option value="GA">Gabon</option>
                                          <option value="GM">Gambia</option>
                                          <option value="GE">Georgia</option>
                                          <option value="DE">Germany</option>
                                          <option value="GH">Ghana</option>
                                          <option value="GI">Gibraltar</option>
                                          <option value="GR">Greece</option>
                                          <option value="GL">Greenland</option>
                                          <option value="GD">Grenada</option>
                                          <option value="GP">Guadeloupe</option>
                                          <option value="GU">Guam</option>
                                          <option value="GT">Guatemala</option>
                                          <option value="GG">Guernsey</option>
                                          <option value="GN">Guinea</option>
                                          <option value="GW">Guinea-Bissau</option>
                                          <option value="GY">Guyana</option>
                                          <option value="HT">Haiti</option>
                                          <option value="HM">Heard Island and McDonald Islands</option>
                                          <option value="VA">Holy See (Vatican City State)</option>
                                          <option value="HN">Honduras</option>
                                          <option value="HK">Hong Kong</option>
                                          <option value="HU">Hungary</option>
                                          <option value="IS">Iceland</option>
                                          <option value="IN">India</option>
                                          <option value="ID">Indonesia</option>
                                          <option value="IR">Iran, Islamic Republic of</option>
                                          <option value="IQ">Iraq</option>
                                          <option value="IE">Ireland</option>
                                          <option value="IM">Isle of Man</option>
                                          <option value="IL">Israel</option>
                                          <option value="IT">Italy</option>
                                          <option value="JM">Jamaica</option>
                                          <option value="JP">Japan</option>
                                          <option value="JE">Jersey</option>
                                          <option value="JO">Jordan</option>
                                          <option value="KZ">Kazakhstan</option>
                                          <option value="KE">Kenya</option>
                                          <option value="KI">Kiribati</option>
                                          <option value="KP">Korea, Democratic People's Republic of</option>
                                          <option value="KR">Korea, Republic of</option>
                                          <option value="KW">Kuwait</option>
                                          <option value="KG">Kyrgyzstan</option>
                                          <option value="LA">Lao People's Democratic Republic</option>
                                          <option value="LV">Latvia</option>
                                          <option value="LB">Lebanon</option>
                                          <option value="LS">Lesotho</option>
                                          <option value="LR">Liberia</option>
                                          <option value="LY">Libyan Arab Jamahiriya</option>
                                          <option value="LI">Liechtenstein</option>
                                          <option value="LT">Lithuania</option>
                                          <option value="LU">Luxembourg</option>
                                          <option value="MO">Macao</option>
                                          <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                          <option value="MG">Madagascar</option>
                                          <option value="MW">Malawi</option>
                                          <option value="MY">Malaysia</option>
                                          <option value="MV">Maldives</option>
                                          <option value="ML">Mali</option>
                                          <option value="MT">Malta</option>
                                          <option value="MH">Marshall Islands</option>
                                          <option value="MQ">Martinique</option>
                                          <option value="MR">Mauritania</option>
                                          <option value="MU">Mauritius</option>
                                          <option value="YT">Mayotte</option>
                                          <option value="MX">Mexico</option>
                                          <option value="FM">Micronesia, Federated States of</option>
                                          <option value="MD">Moldova, Republic of</option>
                                          <option value="MC">Monaco</option>
                                          <option value="MN">Mongolia</option>
                                          <option value="ME">Montenegro</option>
                                          <option value="MS">Montserrat</option>
                                          <option value="MA">Morocco</option>
                                          <option value="MZ">Mozambique</option>
                                          <option value="MM">Myanmar</option>
                                          <option value="NA">Namibia</option>
                                          <option value="NR">Nauru</option>
                                          <option value="NP">Nepal</option>
                                          <option value="NL">Netherlands</option>
                                          <option value="AN">Netherlands Antilles</option>
                                          <option value="NC">New Caledonia</option>
                                          <option value="NZ">New Zealand</option>
                                          <option value="NI">Nicaragua</option>
                                          <option value="NE">Niger</option>
                                          <option value="NG">Nigeria</option>
                                          <option value="NU">Niue</option>
                                          <option value="NF">Norfolk Island</option>
                                          <option value="MP">Northern Mariana Islands</option>
                                          <option value="NO">Norway</option>
                                          <option value="OM">Oman</option>
                                          <option value="PK">Pakistan</option>
                                          <option value="PW">Palau</option>
                                          <option value="PS">Palestinian Territory, Occupied</option>
                                          <option value="PA">Panama</option>
                                          <option value="PG">Papua New Guinea</option>
                                          <option value="PY">Paraguay</option>
                                          <option value="PE">Peru</option>
                                          <option value="PH">Philippines</option>
                                          <option value="PN">Pitcairn</option>
                                          <option value="PL">Poland</option>
                                          <option value="PT">Portugal</option>
                                          <option value="PR">Puerto Rico</option>
                                          <option value="QA">Qatar</option>
                                          <option value="RE">R&eacute;union</option>
                                          <option value="RO">Romania</option>
                                          <option value="RU">Russian Federation</option>
                                          <option value="RW">Rwanda</option>
                                          <option value="BL">Saint Barth&eacute;lemy</option>
                                          <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                          <option value="KN">Saint Kitts and Nevis</option>
                                          <option value="LC">Saint Lucia</option>
                                          <option value="MF">Saint Martin (French part)</option>
                                          <option value="PM">Saint Pierre and Miquelon</option>
                                          <option value="VC">Saint Vincent and the Grenadines</option>
                                          <option value="WS">Samoa</option>
                                          <option value="SM">San Marino</option>
                                          <option value="ST">Sao Tome and Principe</option>
                                          <option value="SA">Saudi Arabia</option>
                                          <option value="SN">Senegal</option>
                                          <option value="RS">Serbia</option>
                                          <option value="SC">Seychelles</option>
                                          <option value="SL">Sierra Leone</option>
                                          <option value="SG">Singapore</option>
                                          <option value="SK">Slovakia</option>
                                          <option value="SI">Slovenia</option>
                                          <option value="SB">Solomon Islands</option>
                                          <option value="SO">Somalia</option>
                                          <option value="ZA">South Africa</option>
                                          <option value="GS">South Georgia and the South Sandwich Islands</option>
                                          <option value="ES">Spain</option>
                                          <option value="LK">Sri Lanka</option>
                                          <option value="SD">Sudan</option>
                                          <option value="SR">Suriname</option>
                                          <option value="SJ">Svalbard and Jan Mayen</option>
                                          <option value="SZ">Swaziland</option>
                                          <option value="SE">Sweden</option>
                                          <option value="CH">Switzerland</option>
                                          <option value="SY">Syrian Arab Republic</option>
                                          <option value="TW">Taiwan, Province of China</option>
                                          <option value="TJ">Tajikistan</option>
                                          <option value="TZ">Tanzania, United Republic of</option>
                                          <option value="TH">Thailand</option>
                                          <option value="TL">Timor-Leste</option>
                                          <option value="TG">Togo</option>
                                          <option value="TK">Tokelau</option>
                                          <option value="TO">Tonga</option>
                                          <option value="TT">Trinidad and Tobago</option>
                                          <option value="TN">Tunisia</option>
                                          <option value="TR">Turkey</option>
                                          <option value="TM">Turkmenistan</option>
                                          <option value="TC">Turks and Caicos Islands</option>
                                          <option value="TV">Tuvalu</option>
                                          <option value="UG">Uganda</option>
                                          <option value="UA">Ukraine</option>
                                          <option value="AE">United Arab Emirates</option>
                                          <option value="GB">United Kingdom</option>
                                          <option value="US">United States</option>
                                          <option value="UM">United States Minor Outlying Islands</option>
                                          <option value="UY">Uruguay</option>
                                          <option value="UZ">Uzbekistan</option>
                                          <option value="VU">Vanuatu</option>
                                          <option value="VE">Venezuela, Bolivarian Republic of</option>
                                          <option value="VN">Viet Nam</option>
                                          <option value="VG">Virgin Islands, British</option>
                                          <option value="VI">Virgin Islands, U.S.</option>
                                          <option value="WF">Wallis and Futuna</option>
                                          <option value="EH">Western Sahara</option>
                                          <option value="YE">Yemen</option>
                                          <option value="ZM">Zambia</option>
                                          <option value="ZW">Zimbabwe</option>
                                      </select>
					</div>
				</div>

                <div class="col-md-12">
					<div class="form-group">
						<label id="number-label" for="number">Upload Picture</label>
						<input type="file" name="image" id="number">
					</div>
				</div>
                <div class="col-md-12">
					<div class="form-group">
						<label>Type</label>
						<select id="dropdown" name="role" class="form-control" required>
							<!-- <option disabled selected value>active</option> -->
							<option value="active">Country Head</option>
							<option value="block">Topup Agent</option>
							<option value="block">Admin</option>
							<option value="block">Agency</option>
							<option value="block">User</option>
							<option value="block">Administrator</option>
							
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Status</label>
						<select id="dropdown" name="role" class="form-control" required>
							<!-- <option disabled selected value>active</option> -->
							<option value="active">Active</option>
							<option value="block">Block</option>
							
						</select>
					</div>
				</div>
			</div>
			
			


		
			<!-- <div class="row">
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary btn-block">Save</button>
				</div>
			</div> -->

		</form>
	</div>	
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Info Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Total Diamonds</th>                                       
                    <th>Total Videos</th>
                    <th>Total Audios</th>
                    <th>Total Days</th>                                       
                    <th>Elligible Hours</th>
                    <th>Diamond as Host</th>
                    <th>Diamond as Co Host</th>
                    <th>Inbox Gift Diamonds</th>
                    <th>Lucky Diamonds</th>
                    <th>Weekly Record</th>
                    <th>1-15 Days Record</th>
                    <th>16-30 Days Record</th>
                    <th>Monthly</th>
                    <th>Recharge Diamonds</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                  </tr>
                 
                </tbody>
              </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Add Diamonds -->
  <div class="modal fade" id="addDiamodsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Diamonds</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
         <label for="">Diamonds</label>
         <input type="text" class="form-control" placeholder="Number of Diamonds">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>

   <!-- Add Diamonds -->
   <div class="modal fade" id="addCoinsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Coins</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
         <label for="">Coins</label>
         <input type="text" class="form-control" placeholder="Number of Diamonds">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Agency Modal -->
  <!-- Info Modal -->
<div class="modal fade" id="agencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agencies</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="">
        <div class="modal-body">
            <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Date</th>
                                        <th>Admin</th>
                                        <th>Picture</th>
                                        <th>Full Name</th>
                                        <th>Email/Number</th>
                                        <th>Agency</th>
                                        <th>Type</th>
                                        @if($User->user_type_slug=='administrator')
                                            <th>Action</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Registered By</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                   
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                   
                  </tr>
                 
                </tbody>
              </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </form>
      </div>
    </div>
  </div>

                @if($User->user_type_slug=='Agent')


                    <!-- Basic Tables start -->
                    <div class="row" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Transactions</h4>

                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light"  data-toggle="modal" data-target="#exampleModalCenter">Transfer</button>

                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($Transactions as $TransactionsTemp)
                                            <tr>
                                                <td>{{$TransactionsTemp->created_at}}</td>

                                                @if($User->id==$TransactionsTemp->created_by_user_id)
                                                    <td>{{$TransactionsTemp->users_full_name}} {{$TransactionsTemp->users_code}}</td>
                                                @else
                                                    <td>{{$TransactionsTemp->users2_full_name}} {{$TransactionsTemp->users2_code}}</td>
                                                @endif

                                                @if($User->id==$TransactionsTemp->created_by_user_id)
                                                    <td>{{$TransactionsTemp->users2_full_name}} {{$TransactionsTemp->users2_code}}</td>
                                                @else
                                                    <td>{{$TransactionsTemp->users_full_name}} {{$TransactionsTemp->users_code}}</td>
                                                @endif

                                                <td>{{$TransactionsTemp->amount}}</td>

                                                @if($User->id==$TransactionsTemp->created_by_user_id)
                                                    <td>{{$TransactionsTemp->type}}</td>
                                                @else
                                                    <td>Credit</td>
                                                @endif

                                                <td>{{$TransactionsTemp->status}}</td>
                                            </tr>
                                        @endforeach


                                        </tbody>

                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Basic Tables end -->

                @endif



            </div>
        </div>

    </div>
    <!-- End: Content-->



    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    @include('.panel.general.footer')
    @include('.panel.general.modal')


    @include('.panel.general.script')


    <script>
        $( document ).ready(function() {
            $("#link").click(function(event){
                var range = document.createRange();
                range.selectNode(document.getElementById("link"));
                window.getSelection().removeAllRanges(); // clear current selection
                window.getSelection().addRange(range); // to select text
                document.execCommand("copy");
                window.getSelection().removeAllRanges();// to deselect
                alert('Copied to Clipboard');
            });
        });
    </script>

    <script>


        function validatealpha(alpha) {
            var reno = /^[a-zA-Z\s]+$/;
            return reno.test(alpha);
        }

        function validateEmail(youremail) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(youremail);
        }


        function validatenum(num) {
            var reno = /^\d+$/;
            return reno.test(num);
        }



        $('.approve').on('click',function (e) {
            e.preventDefault();



            var inc=0;

            var string = jQuery(this).attr("id");
            var array = string.split('_');
            var id=array[1];


            if (id !== '') {

                if (validatenum(id)) {
                    inc++;
                } else {
                    alert('ID is invalid');
                    return null;
                }

            } else {
                alert('ID is required');
                return null;
            }





            if(inc===1){

                var config    =  project.Config;
                var dataApiUrl   = config.getApiUrl();
                var dataAppUrl   = config.getAppUrl();
                var dataTokenGet = config.getToken();

                var fdata =new FormData();
                fdata.append('id',id);

                $.ajax({
                    url: dataApiUrl+'/user/approve',
                    data: fdata,
                    type: 'POST',
                    timeout: 300000, //Set your timeout value in milliseconds or 0 for unlimited
                    dataType:'json',
                    processData: false,
                    contentType: false,


                    beforeSend: function(){


                        $('.approve').attr('disabled', 'disabled');

                        $("#alert").css("display", "none");
                        $("#loading").css("display", "block");

                    },


                    success:function(data){


                        $("#loading").css("display", "none");


                        $('.approve').removeAttr('disabled');


                        if(data['error']!=true){

                            window.location.href= dataAppUrl+'/admin/dashboard';

                        }else{
                            alert(data['message']);
                        }





                    },
                    error: function(xmlhttprequest, textstatus, message) {

                        if(textstatus==="timeout") {
                            alert('Timeout Please try again.');
                        }else {
                            if(navigator.onLine) {

                                if(textstatus==="error"){
                                    alert(message);
                                }

                            }else {
                                alert('Check your internet connection then try again later.');
                            }
                        }


                        $("#loading").css("display", "none");


                        $('.approve').removeAttr('disabled');
                    }


                });

            }else {
                $("#alert").css("display", "block").text('Valid email required.');
            }


        });

        $('.block').on('click',function (e) {
            e.preventDefault();



            var inc=0;

            var string = jQuery(this).attr("id");
            var array = string.split('_');
            var id=array[1];


            if (id !== '') {

                if (validatenum(id)) {
                    inc++;
                } else {
                    alert('ID is invalid');
                    return null;
                }

            } else {
                alert('ID is required');
                return null;
            }





            if(inc===1){

                var config    =  project.Config;
                var dataApiUrl   = config.getApiUrl();
                var dataAppUrl   = config.getAppUrl();
                var dataTokenGet = config.getToken();

                var fdata =new FormData();
                fdata.append('id',id);

                $.ajax({
                    url: dataApiUrl+'/user/block',
                    data: fdata,
                    type: 'POST',
                    timeout: 300000, //Set your timeout value in milliseconds or 0 for unlimited
                    dataType:'json',
                    processData: false,
                    contentType: false,


                    beforeSend: function(){


                        $('.block').attr('disabled', 'disabled');

                        $("#alert").css("display", "none");
                        $("#loading").css("display", "block");

                    },


                    success:function(data){


                        $("#loading").css("display", "none");


                        $('.block').removeAttr('disabled');


                        if(data['error']!=true){

                            window.location.href= dataAppUrl+'/admin/dashboard';

                        }else{
                            alert(data['message']);
                        }





                    },
                    error: function(xmlhttprequest, textstatus, message) {

                        if(textstatus==="timeout") {
                            alert('Timeout Please try again.');
                        }else {
                            if(navigator.onLine) {

                                if(textstatus==="error"){
                                    alert(message);
                                }

                            }else {
                                alert('Check your internet connection then try again later.');
                            }
                        }


                        $("#loading").css("display", "none");


                        $('.block').removeAttr('disabled');
                    }


                });

            }else {
                $("#alert").css("display", "block").text('Valid email required.');
            }


        });

        $('.unblocked').on('click',function (e) {
            e.preventDefault();



            var inc=0;

            var string = jQuery(this).attr("id");
            var array = string.split('_');
            var id=array[1];


            if (id !== '') {

                if (validatenum(id)) {
                    inc++;
                } else {
                    alert('ID is invalid');
                    return null;
                }

            } else {
                alert('ID is required');
                return null;
            }





            if(inc===1){

                var config    =  project.Config;
                var dataApiUrl   = config.getApiUrl();
                var dataAppUrl   = config.getAppUrl();
                var dataTokenGet = config.getToken();

                var fdata =new FormData();
                fdata.append('id',id);

                $.ajax({
                    url: dataApiUrl+'/user/unblocked',
                    data: fdata,
                    type: 'POST',
                    timeout: 300000, //Set your timeout value in milliseconds or 0 for unlimited
                    dataType:'json',
                    processData: false,
                    contentType: false,


                    beforeSend: function(){


                        $('.unblocked').attr('disabled', 'disabled');

                        $("#alert").css("display", "none");
                        $("#loading").css("display", "block");

                    },


                    success:function(data){


                        $("#loading").css("display", "none");


                        $('.unblocked').removeAttr('disabled');


                        if(data['error']!=true){

                            window.location.href= dataAppUrl+'/admin/dashboard';

                        }else{
                            alert(data['message']);
                        }





                    },
                    error: function(xmlhttprequest, textstatus, message) {

                        if(textstatus==="timeout") {
                            alert('Timeout Please try again.');
                        }else {
                            if(navigator.onLine) {

                                if(textstatus==="error"){
                                    alert(message);
                                }

                            }else {
                                alert('Check your internet connection then try again later.');
                            }
                        }


                        $("#loading").css("display", "none");


                        $('.unblocked').removeAttr('disabled');
                    }


                });

            }else {
                $("#alert").css("display", "block").text('Valid email required.');
            }


        });

        $('.delete').on('click',function (e) {
            e.preventDefault();



            var inc=0;

            var string = jQuery(this).attr("id");
            var array = string.split('_');
            var id=array[1];


            if (id !== '') {

                if (validatenum(id)) {
                    inc++;
                } else {
                    alert('ID is invalid');
                    return null;
                }

            } else {
                alert('ID is required');
                return null;
            }





            if(inc===1){

                var config    =  project.Config;
                var dataApiUrl   = config.getApiUrl();
                var dataAppUrl   = config.getAppUrl();
                var dataTokenGet = config.getToken();

                var fdata =new FormData();
                fdata.append('id',id);

                $.ajax({
                    url: dataApiUrl+'/user/delete',
                    data: fdata,
                    type: 'POST',
                    timeout: 300000, //Set your timeout value in milliseconds or 0 for unlimited
                    dataType:'json',
                    processData: false,
                    contentType: false,


                    beforeSend: function(){


                        $('.delete').attr('disabled', 'disabled');

                        $("#alert").css("display", "none");
                        $("#loading").css("display", "block");

                    },


                    success:function(data){


                        $("#loading").css("display", "none");


                        $('.delete').removeAttr('disabled');


                        if(data['error']!=true){

                            window.location.href= dataAppUrl+'/admin/dashboard';

                        }else{
                            alert(data['message']);
                        }





                    },
                    error: function(xmlhttprequest, textstatus, message) {

                        if(textstatus==="timeout") {
                            alert('Timeout Please try again.');
                        }else {
                            if(navigator.onLine) {

                                if(textstatus==="error"){
                                    alert(message);
                                }

                            }else {
                                alert('Check your internet connection then try again later.');
                            }
                        }


                        $("#loading").css("display", "none");


                        $('.delete').removeAttr('disabled');
                    }


                });

            }else {
                $("#alert").css("display", "block").text('Valid email required.');
            }


        });

    </script>

<script>
    $(".selectall1").click(function(){
$(".individual1").prop("checked",$(this).prop("checked"));
});

$(".selectall2").click(function(){
$(".individual2").prop("checked",$(this).prop("checked"));
});

$(".selectall3").click(function(){
$(".individual3").prop("checked",$(this).prop("checked"));
});
$(".selectall4").click(function(){
$(".individual4").prop("checked",$(this).prop("checked"));
});
$(".selectall5").click(function(){
$(".individual5").prop("checked",$(this).prop("checked"));
});
$(".selectall6").click(function(){
$(".individual6").prop("checked",$(this).prop("checked"));
});
$(".selectall7").click(function(){
$(".individual7").prop("checked",$(this).prop("checked"));
});
</script>
</body>
</html>
