<div class="user-profile layout-spacing">
    <div class="widget-content widget-content-area">
        <div class="d-flex justify-content-between">
            <h3 class="pb-3">Tribe Quick Info</h3>
        </div>
        <div class="text-center user-info">
            <img src="{{ $tribe->image_public_path }}" alt="avatar">
            <p class="">{{ $tribe->name }}</p>
        </div>

        <div class="user-info-list">
            <div class="">
                <ul class="contacts-block list-unstyled">
                    <li class="contacts-block__item">
                        <i class="fas fa-users"></i> {{ $tribe->memberCount }} Tribe Members
                    </li>
                    <li class="contacts-block__item">
                        <i class="fas fa-users"></i> Founded On {{ $tribe->founded_on }}
                    </li>


                    <li class="contacts-block__item">
                        <ul class="list-inline">
                                <li class="list-inline-item">
                                    <div class="social-icon">
                                        <a href="#" class="user-profile-card-social">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
                                    </div>
                                </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div> <!-- ./user-info-list -->
    </div>
</div>
