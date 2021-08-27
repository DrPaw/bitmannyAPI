@extends('include.user')

@section('content')
 <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="card-title">{{$page_title}}</h4>
                            </div>
                             @include('partials.settings')
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="personal_validate" action="" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="row">
                        <div class="form-group col-6">
                            <label for="InputFirstname" class="col-form-label">@lang('First Name:')</label>
                            <input type="text" class="form-control" id="InputFirstname" name="firstname"
                                       placeholder="@lang('First Name')" value="{{$user->firstname}}" >
                        </div>

                        <div class="form-group col-6">
                            <label for="lastname" class="col-form-label">@lang('Last Name:')</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                       placeholder="@lang('Last Name')" value="{{$user->lastname}}">
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email" class="col-form-label">@lang('E-mail Address:')</label>
                            <input type="email" readonly class="form-control" id="email" name="email" placeholder="@lang('E-mail Address')" value="{{$user->email}}" required="">
                        </div>

                        <div class="form-group col-6">
                            <input type="hidden" id="track" name="country_code">
                            <label for="phone" class="col-form-label">@lang('Mobile Number')</label>
                            <input type="tel" readonly class="form-control pranto-control" id="phone" name="mobile" value="{{$user->mobile}}" placeholder="@lang('Your Contact Number')" required>
                        </div>
                    </div>






                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="address" class="col-form-label">@lang('Address:')</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="@lang('Address')" value="{{$user->address->address}}" required="">
                        </div>

                         <div class="form-group col-6">
                         <label for="address" class="col-form-label">@lang('Country:')<small>&nbsp;({{$user->address->country}})</small> </label>
                        <select onchange="print_state('state', this.selectedIndex);" id="country"   class="form-control"  name="country"/>

                        </select>
                        <script language="javascript">print_country("country");</script>
                        </div>

                        <div class="form-group col-6">
                            <label for="state" class="col-form-label">@lang('State:') <small>&nbsp;({{$user->address->state}})</small> </label>
                            <select type="text" class="form-control" id="state" name="state" placeholder="@lang('state')" value="{{$user->address->state}}" required="">
                            <option>Select A State</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label for="zip" class="col-form-label">@lang('Zip Code:')</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="@lang('Zip Code')" value="{{$user->address->zip}}" required="">
                        </div>

                        <div class="form-group col-6">
                            <label for="city" class="col-form-label">@lang('City:')</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   placeholder="@lang('City')" value="{{$user->address->city}}" required="">
                        </div>

                    </div>




                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                            <label for="city" class="col-form-label">@lang('Avatar:')</label>
                             <div class="file-upload-wrapper" data-text="Change Photo">
                                                        <input type="file" name="image" accept="image/*" type="file"
                                                            class="file-upload-field" value="">
                            </div>
										</div>
                        </div>
                    </div>



											<button type="submit" class="btn btn-primary mt-1">Update Profile</abutton

                </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



@endsection
