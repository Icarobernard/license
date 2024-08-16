<!-- Navbar -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top position-absolute top-0 z-index-3 w-100 py-2">
  <div class="container-fluid">
    <a href="{{route('vitrine')}}">
      <img style="margin-left:10px; position:static;" height="40px" width="140px" src="../../assets/img/logos/logo.png">
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav ms-auto">
        @if (auth()->user())
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ url('vitrine') }}">
            <i class="fa fa-chart-pie opacity-6 me-1"></i>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="{{ url('perfil') }}">
            <i class="fa fa-user opacity-6 me-1"></i>
            Perfil
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link me-2" href="https://www.youtube.com/@EquipeNODZ" target="_blank">
            <i class="fas fa-user-circle opacity-6 me-1"></i>
            Nosso canal no youtube
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<style>
  /* Styles for the navbar */
  #navbar {
    transition: background-color 0.3s, box-shadow 0.3s;
  }

  .navbar-transparent {
    background-color: transparent !important;
    color: white !important;
  }

  .navbar-scrolled {
    background-color: black !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .navbar-transparent .nav-link,
  .navbar-transparent .navbar-toggler-icon {
    color: white !important;
  }

  .navbar-scrolled .nav-link,
  .navbar-scrolled .navbar-toggler-icon {
    color: white !important;
  }

  /* Mobile Styles */
  @media (max-width: 993.20px) {

    .navbar-transparent .nav-link,
    .navbar-transparent .navbar-toggler-icon {
      color: black !important;
      /* Black text on mobile */
    }

    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-toggler-icon {
      color: black !important;
      /* Black text on mobile */
    }
  }
</style>

<script>
  window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
      navbar.classList.remove('navbar-transparent');
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
      navbar.classList.add('navbar-transparent');
    }
  });

  // Initial load
  document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');
    navbar.classList.add('navbar-transparent');
  });
</script>