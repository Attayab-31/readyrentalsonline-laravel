@extends('layouts.accounts')
@section("styles")
@endsection
@section('content')
    <div class="row g-3 chat-index-layout">
        @include('Account.Chat.threadList', [
            'threadList' => $db_data['threadList'],
            'columnClass' => 'col-12 col-lg-7 col-xl-6 col-xxl-5',
        ])
    </div>
    <!-- end chat-wrapper -->
@endsection
