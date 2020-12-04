<div class="user-profile layout-spacing">
    <div class="widget-content widget-content-area">
        <div class="d-flex justify-content-between">
            <h3 class="pb-3">Profile</h3>
        </div>
        <div class="text-center user-info">
            <img src="{{ $user->avatar }}" alt="avatar">
            <p class="">{{ $user->fullusername }}</p>
        </div>
        <div class="user-info-list">
            <div class="">
                <ul class="contacts-block list-unstyled">
                    <li class="contacts-block__item">
                        <i class="fas fa-campground"></i> Tribe of {{ $user->tribe->name }}
                    </li>
                    <li class="contacts-block__item">
                        <i class="fas fa-users"></i> {{ $user->tribe->memberCount }} Tribe Members
                    </li>
                    <li class="contacts-block__item">
                        <i class="fas fa-users"></i> Member Since {{ $user->memberSince }}
                    </li>


                    <li class="contacts-block__item">
                        <ul class="list-inline">
                            @if($user->facebook != null)
                            <li class="list-inline-item">
                                <div class="social-icon">
                                    <a href="{{ $user->facebook }}" class="user-profile-card-social">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </div>
                            </li>
                            @endif
                            @if($user->twitter != null)
                                <li class="list-inline-item">
                                    <div class="social-icon">
                                        <a href="{{ $user->twitter }}" class="user-profile-card-social">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
