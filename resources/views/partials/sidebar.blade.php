<nav class="w3-sidebar w3-bar-block w3-collapse w3-top" style="z-index:3;width:250px; background: linear-gradient(to bottom, #f8f9fa, #e9e4d4);" id="mySidebar">

    <div class="w3-container w3-display-container w3-padding-32">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" style="width:100%; border-radius: 100px;">
        </a>
    </div>

    @foreach ($categories as $category)
        <div class="w3-large w3-text-grey" style="font-weight:bold">
            <a href="{{ route('category.show', $category->id) }}" class="w3-bar-item w3-button">{{ $category->name }}</a>
        </div>
    @endforeach

    <div class="w3-padding-64"> 
      
      <a href="{{ url('/contact') }}" class="w3-bar-item w3-button w3-padding">Kontakt</a>
      <a href="{{ url('/about') }}" class="w3-bar-item w3-button w3-padding">O nama</a>
      @guest
          <div class="w3-large w3-text-grey" style="font-weight:bold">
            <a href="{{ route('login') }}" class="w3-bar-item w3-button">Login</a>
          </div>
      @endguest

      @auth
          <div class="w3-large w3-text-grey" style="font-weight:bold">
            <form action="{{ route('logout') }}" method="POST" class=" w3-text-grey" style="font-weight:bold">
                @csrf
                <button type="submit" class="w3-bar-item w3-button w3-padding" >
                    Logout
                </button>
            </form>

          </div>
      @endauth
    </div>
</nav>

<style>
    .w3-sidebar a {
        color: #333;
        transition: background 0.3s, color 0.3s;
    }

    .w3-sidebar a:hover,
    .w3-sidebar button:hover {
        background: #d6d0c1;
        color: black;
    }

    .w3-sidebar button {
        color: #333;
        text-align: left;
    }
</style>
