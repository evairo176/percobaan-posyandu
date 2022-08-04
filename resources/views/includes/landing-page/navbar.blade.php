<?php

use Illuminate\Support\Facades\DB;

$website = DB::table('tb_website')->where('id', 1)->first();

// dd($website);
?>
<header>
    <a href="#" id="logo_d">
        <img src="storage/website/{{$website->picture}}" class="logo" alt="">
    </a>
    <div class="toggle"></div>
    <div class="navigation">
        <ul>
            <li>
                <a href="#" class="active">Home</a>
            </li>
            <!-- <li>
                <a href="#">Features</a>
            </li> -->
            <!-- <li>
                <a href="#">About</a>
            </li> -->
            @if($user = Auth::user())
            @if($user->role)
            <li>
                <a href="{{url('logout')}}" class="login">logout</a>
            </li>
            @endif
            @else
            <li>
                <a href="{{url('login')}}" class="login">Login</a>
            </li>
            @endif

        </ul>
    </div>
</header>