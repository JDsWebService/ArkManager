@extends('layouts.admin')

@section('title', 'Viewing ' . $user->fullusername)

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <h4>User Information</h4>
            <hr>
            <table class="table table-borderless table-sm text-white">
                <tr>
                    <th>Provider:</th>
                    <td>{{ $user->provider }}</td>
                </tr>
                <tr>
                    <th>Provider ID:</th>
                    <td>{{ $user->provider_id }}</td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Discriminator:</th>
                    <td>{{ $user->discriminator }}</td>
                </tr>
                <tr>
                    <th>Full Username:</th>
                    <td>{{ $user->fullusername }}</td>
                </tr>
                <tr>
                    <th>Avatar Link:</th>
                    <td>
                        <a href="{{ $user->avatar }}" class="text-white" target="_blank">
                            Image Link <i class="fas fa-external-link-alt"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>eMail:</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>eMail Verified:</th>
                    <td>
                        @if($user->email_verified)
                            <span class="text-success">Verified</span>
                        @else
                            <span class="text-danger">Not Verified</span>
                        @endif
                    </td>
                </tr>
                @if($user->twitter)
                    <tr>
                        <th>Twitter Link:</th>
                        <td>
                            <a href="{{ $user->twitter }}" class="text-white">
                                Twitter <i class="fas fa-external-link-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endif
                @if($user->facebook)
                    <tr>
                        <th>Facbook Link:</th>
                        <td>
                            <a href="{{ $user->facebook }}" class="text-white">
                                Facbook <i class="fas fa-external-link-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>Locale:</th>
                    <td>{{ $user->locale }}</td>
                </tr>
                <tr>
                    <th>Two Factor Enabled:</th>
                    <td>
                        @if($user->two_factor)
                            <span class="text-success">Enabled</span>
                        @else
                            <span class="text-danger">Disabled</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Is Admin:</th>
                    <td>
                        @if($user->isAdmin)
                            <span class="text-success">Admin</span>
                        @else
                            <span class="text-danger">Not Admin</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created On:</th>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('m/d/Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Last Updated:</th>
                    <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('m/d/Y H:i:s') }}</td>
                </tr>
            </table>
        </div> <!-- /.col-sm-4 -->

        <div class="col-sm-8">

            <div class="row">
                <div class="col-sm-6">
                    <h4>Terms & Conditions</h4>
                    <hr>
                    <table class="table table-borderless table-sm text-white">
                        <tr>
                            <th>ToS Accept:</th>
                            <td>
                                @if($user->tos_accept)
                                    <span class="text-success">Accepted</span>
                                @else
                                    <span class="text-danger">Not Accepted</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Privacy Accept:</th>
                            <td>
                                @if($user->privacy_accept)
                                    <span class="text-success">Accepted</span>
                                @else
                                    <span class="text-danger">Not Accepted</span>
                                @endif
                            </td>
                        </tr>
                        @if($user->tos_accept)
                            <tr>
                                <th>ToS Timestamp:</th>
                                <td>{{ \Carbon\Carbon::parse($user->tos_accept_date)->format('m/d/Y H:i:s') }}</td>
                            </tr>
                        @endif
                        @if($user->privacy_accept)
                            <tr>
                                <th>Privacy Timestamp:</th>
                                <td>{{ \Carbon\Carbon::parse($user->privacy_accept_date)->format('m/d/Y H:i:s') }}</td>
                            </tr>
                        @endif
                    </table>
                </div> <!-- /.col-sm-6 -->

                <div class="col-sm-6">
                    <h4>Notification Settings</h4>
                    <hr>
                    <table class="table table-borderless table-sm text-white">
                        <tr>
                            <th>News Notifications:</th>
                            <td>
                                @if($user->news_notifications)
                                    <span class="text-success">Enabled</span>
                                @else
                                    <span class="text-danger">Disabled</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Discord Notifications:</th>
                            <td>
                                @if($user->discord_notifications)
                                    <span class="text-success">Enabled</span>
                                @else
                                    <span class="text-danger">Disabled</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Internal Notifications:</th>
                            <td>
                                @if($user->internal_notifications)
                                    <span class="text-success">Enabled</span>
                                @else
                                    <span class="text-danger">Disabled</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div> <!-- /.col-sm-6 -->
            </div> <!-- /.row -->

            <div class="row">
                <div class="col-sm-12">

                    <h4>Tribe Info</h4>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-sm table-borderless text-white">
                                <tr>
                                    <th>Tribe See Dinos:</th>
                                    <td>
                                        @if($user->tribe_sees_dinos)
                                            <span class="text-success">Allowed</span>
                                        @else
                                            <span class="text-danger">Not Allowed</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($user->tribe_id)
                                    <tr>
                                        <th>Tribe Name:</th>
                                        <td>{{ $user->tribe->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tribe Image:</th>
                                        <td>
                                            @if($user->tribe->image_public_path == 'https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found')
                                                <span class="text-warning">Default Tribe Image</span>
                                            @else
                                                <a href="{{ asset($user->tribe->image_public_path) }}" target="_blank" class="text-white">
                                                    Tribe Image <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Discord Link:</th>
                                        <td>
                                            @if($user->tribe->discord_link)
                                                <a href="{{ $user->tribe->discord_link }}" class="text-white" target="_blank">
                                                    {{ $user->tribe->discord_link }} <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @else
                                                <span class="text-warning">No Discord Link</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Is Tribe Owner:</th>
                                        <td>
                                            @if($user->tribe->isUserTribeOwner)
                                                <span class="text-success">True</span>
                                            @else
                                                <span class="text-danger">False</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Founded On:</th>
                                        <td>
                                            {{ \Carbon\Carbon::parse($user->tribe->founded_on)->format('m/d/Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>UUID:</th>
                                        <td>{{ $user->tribe->uuid }}</td>
                                    </tr>
                                    <tr>
                                        <th>Home Server:</th>
                                        <td> {{ $user->tribe->homeServer->name }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th colspan="2">
                                            <span class="text-danger">USER NOT IN TRIBE</span>
                                        </th>
                                    </tr>
                                @endif
                            </table>
                        </div> <!-- /.col-sm-6 -->
                        @if($user->tribe_id)
                            <div class="col-sm-6">
                                <h6>Tribe Description:</h6>
                                <hr>
                                <p>{!! $user->tribe->description !!}</p>
                            </div> <!-- /.col-sm-6 -->
                        @endif
                    </div> <!-- /.row -->

                </div> <!-- /.col-sm-12 -->
            </div> <!-- /.row -->

        </div> <!-- /.col-sm-8 -->

    </div> <!-- /.row.justify-content-center -->


@endsection
