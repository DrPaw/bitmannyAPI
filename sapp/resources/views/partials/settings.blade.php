 <div class="card-body">
                                <ul>
                                    <li class="nav-item">
                                        <a href="{{route('user.edit-profile')}}" class="nav-link @if(Request::is('user/edit-profile')) active @endif">
                                            <i class="mdi mdi-account"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('user.twoFA')}}" class="nav-link @if(Request::is('user/security/two/step')) active @endif">
                                            <i class="fa fa-qrcode"></i>
                                            <span>2FA Security</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('user.change-password')}}" class="nav-link @if(Request::is('user/change-password')) active @endif">
                                            <i class="la la-lock"></i>
                                            <span>Password Settings</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('user.kyc')}}" class="nav-link @if(Request::is('user/verification/kyc')) active @endif">
                                            <i class="fa fa-shield"></i>
                                            <span>KYC Verification</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('user.sessionlog')}}" class="nav-link @if(Request::is('user/security/session-log')) active @endif">
                                            <i class="la la-key"></i>
                                            <span>Login Session</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
