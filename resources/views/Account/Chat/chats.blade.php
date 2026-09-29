@extends('layouts.accounts')
@section("styles")
@endsection
@section('content')
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        @include('Account.Chat.threadList' , ['threadList' => $db_data['threadList']])
    </div>
    <!-- end chat-wrapper -->
@endsection