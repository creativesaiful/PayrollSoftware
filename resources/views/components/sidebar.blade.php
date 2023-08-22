<div id="sidebar">
    <h2>Admin Panel</h2>
    <ul class="list-unstyled">
        <li><a href="{{route('leave.index')}}"><i class="fas fa-home"></i> Leave List</a></li>
        <li><a href="{{route('leave.create')}}"><i class="fas fa-home"></i> Leave create</a></li>


        <!-- Add more menu items here -->

        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf

            <x-responsive-nav-link href="{{ route('logout') }}"
                           @click.prevent="$root.submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </ul>
</div>
