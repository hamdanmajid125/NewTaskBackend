<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="index-2.html" title=""><img src="{{ asset($favicon) }}" alt=""></a>
            </div>
            <div class="search-bar">
                <!-- <form>
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit"><i class="la la-search"></i></button>
                </form> -->
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('user.dashboard') }}" title="">
                            <span><img src="{{ asset("images/icon5.png") }}" alt=""></span>
                            Jobs
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="menu-btn">
                <a href="#" title=""><i class="fa fa-bars"></i></a>
            </div>
            <div class="user-account">
                <div class="user-info">
                    <img class="profile-img" src="{{ asset(Auth::user()->image) }}" alt="">
                    <a  href="#" title="">{{ Auth::user()->name }}</a>
                    <i class="la la-sort-down"></i>
                </div>
                <div class="user-account-settingss">
                    <h3 class="tc"><a href="{{ route('logout') }}" title="">Logout</a></h3>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="search-sec">
    <div class="container">
        <div class="search-box">
            {{-- <form>
                <input type="text" name="search" placeholder="Search keywords">
                <button type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</div>
