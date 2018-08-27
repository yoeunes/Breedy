@extends('spark::layouts.app')

@section('content')
<el-main>
{{--    <home :user="user" :current-team="currentTeam" inline-template>
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">{{__('Dashboard')}}</div>

                        <div class="card-body">
                            {{__('Your application\'s dashboard.')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>--}}

    <!-- route outlet -->
    <div class="containerRouterTop">
        <router-view></router-view>
    </div>
</el-main>
@endsection
