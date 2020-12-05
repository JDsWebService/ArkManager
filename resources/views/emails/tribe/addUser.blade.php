@component('mail::message')
# Hello There {{ $user->username }}!

{{ $sendingUser->fullusername }} is sending you a request to join their tribe ({{ $tribe->name }}) on Ark Manager! To accept this invitation, please click on the Accept Invite button below.

Being a part of a tribe will allow you to post trade requests on the Ark Manager Trade Hub, allow you to see all of your tribemates Dino Breeding Mutations, and more!

@component('mail::button', ['url' => route('tribe.user.acceptInvite', $token)])
Join {{ $tribe->name }}
@endcomponent

Good luck out there survivor,<br>
ArkManager.app Staff Team

If you have received this message in error, please ignore this email.
@endcomponent
