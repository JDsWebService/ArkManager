@extends('layouts.user')

@section('title', 'Account Settings')

@section('content')

    {{ Form::model($user, ['route' => 'user.settings.store', 'method' => 'POST']) }}

        <div class="row justify-content-center section">
            <div class="col-sm-12">
                <h4>General Settings</h4>
                <hr>
                <div class="row form-group">
                    <label for="news_notifications" class="col-sm-5 col-form-label">Get News and Updates Regarding ArkManager?</label>
                    <div class="col-sm-7">
                        <label class="switch s-icons s-outline s-outline-primary mr-2">
                            <input type="hidden" name="news_notifications" value="0">
                            {{ Form::checkbox('news_notifications', '1', $user->news_notifications) }}
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="discord_notifications" class="col-sm-5 col-form-label">
                        Allow other users to contact you via Discord?
                        <br>
                        <span class="text-info font-italic">
                            Note: Disabling this setting will restrict your access to the trade hub, tribe applications, tribe user management, and other essential functionality of ArkManager.
                        </span>
                    </label>
                    <div class="col-sm-7">
                        <label class="switch s-icons s-outline s-outline-primary mr-2">
                            <input type="hidden" name="discord_notifications" value="0">
                            {{ Form::checkbox('discord_notifications', '1', $user->discord_notifications) }}
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="internal_notifications" class="col-sm-5 col-form-label">
                        Allow other users to contact you via ArkManager?
                        <br>
                        <span class="text-info font-italic">
                            Note: Disabling this setting will restrict your access to the trade hub, tribe applications, tribe user management, and other essential functionality of ArkManager.
                        </span>
                    </label>
                    <div class="col-sm-7">
                        <label class="switch s-icons s-outline s-outline-primary mr-2">
                            <input type="hidden" name="internal_notifications" value="0">
                            {{ Form::checkbox('internal_notifications', '1', $user->internal_notifications) }}
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

            </div> <!-- ./col-sm-12 -->
        </div> <!-- ./row section -->

    <div class="row justify-content-center section">
        <div class="col-sm-12">
            <h4>Social Media</h4>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend mr-3">
                            <span class="input-group-text">
                                <i class="fab fa-discord" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Discord Username" aria-describedby="username" value="{{ $user->fullusername }}" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend mr-3">
                            <span class="input-group-text">
                                <i class="fab fa-twitter" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Twitter Username" aria-describedby="twitter" name="twitter" placeholder="@twitter_username" {{ $user->twitter }}>
                    </div>
                </div>
            </div> <!-- ./row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend mr-3">
                            <span class="input-group-text">
                                <i class="fab fa-facebook-square" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Facebook URL" aria-describedby="facebook" name="facebook" placeholder="http://facebook.com/your_profile_page" value="{{ $user->facebook }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend mr-3">
                    <span class="input-group-text">
                        <i class="fas fa-at" style="font-size: 24px;"></i>
                    </span>
                        </div>
                        <input type="text" class="form-control" aria-label="eMail Address" aria-describedby="email" name="email" placeholder="test@example.com" value="{{ $user->email }}">
                    </div>
                </div>
            </div> <!-- ./row -->

        </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row section -->

    <div class="row justify-content-center section">
        <div class="col-sm-12">
            <h4>Mutation Tracker Settings</h4>
            <hr>
            <div class="row form-group">
                <label for="tribe_sees_dinos" class="col-sm-5 col-form-label">
                    Allow tribe to view, edit, and update your tracked dinos?
                </label>
                <div class="col-sm-7">
                    <label class="switch s-icons s-outline s-outline-primary mr-2">
                        <input type="hidden" name="tribe_sees_dinos" value="0">
                        {{ Form::checkbox('tribe_sees_dinos', '1', $user->tribe_sees_dinos) }}
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

        </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row section -->


    <div class="row justify-content-center">
        <div class="col-sm-4">
            <button class="btn btn-block btn-primary" type="submit">Save Account Settings</button>
        </div>
    </div>
    {{ Form::close() }}

@endsection
