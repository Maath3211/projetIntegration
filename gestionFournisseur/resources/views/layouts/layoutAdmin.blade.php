<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        {{-- ** Modifier pour utiliser css admin ** --}}
        <link rel="stylesheet" href="{{ asset('css/fournisseur.css') }}">
    <title>@yield('title')</title>
    @stack('scripts')
</head>
<body>
<header>
<a href="{{ route('responsable.listeFournisseur') }}" alt="Accueil du site" title="Accueil du site">
    <img src="{{asset('images/logo-v3r-v2.svg')}}" alt="logoV3R" id="logoV3R" class="img-fluid ville">
</a>
<nav class="navbar d-flex navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('responsable.listeFournisseur') }}" alt="Accueil du site" title="Accueil du site">
                <span class="brand-uni uni">uni</span><span class="brand-v3r uni">.v3r.net</span>
            </a>
            <button class="night-mode-toggle" onclick="toggleNightMode()">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" fill="white" stroke="black" stroke-width="2"/>
                    <path d="M12 2 A10 10 0 0 0 12 22" fill="black"/>
                </svg>
            </button> 
        </div>
        <ul class="nav navbar-nav">
            @yield('navbar')
        </ul>
    </div>
</nav>
</header>
    @if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p class="text-center msgErreur">{{ $error }}</p>
        @endforeach
    </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success">
            <p class="text-center msgErreur">{{ session('message') }}</p>
        </div>
    @endif
    <main>
        @yield('contenu')
    </main>
    <footer>
		<div>
			<aside class="white">
				<h5>Aide</h5>
				<p>Centre d'aide</p>
				<p>FAQ</p>
				<p>311 / Nous joindre</p>
			</aside>
		</div>
		<div>
			<aside class="white">
				<h5>Politiques</h5>
				<p>Politique de confidentialité</p>
				<p>Politique d'accessibilité numérique</p>
                <p>Conditions d'utilisation</p>
			</aside>
		</div>
		<div>
            <div>
                <aside>
                    <a href="{{ route('responsable.listeFournisseur') }}" alt="Accueil du site" title="Accueil du site">
                        <img src="{{asset('images/logo-v3r-v2.svg')}}" alt="logoV3R" id="logoV3RFooter" class="img-fluid ville">  
                    </a>
                </aside>
            </div>
			<aside class="logoFooter">
                <a href="https://www.facebook.com/villetroisrivieres" target="_blank" alt="Facebook" title="Facebook"><i class="fab fa-facebook-square fa-2x logo"></i></a>
                <a href="https://www.instagram.com/villedetroisrivieres" target="_blank" alt="Instagram" title="Instgram"><i class="fab fa-instagram fa-2x logo"></i></a>
                <a href="https://www.linkedin.com/company/ville-de-trois-rivi-res" target="_blank" alt="Linkedin" title="Linkedin"><i class="fab fa-linkedin fa-2x logo"></i></a>
                <a href="https://www.youtube.com/channel/UC4UyW0CoFiJaFCFaOzoQQ5w" target="_blank" alt="You Tube" title="You Tube"><i class="fab fa-youtube fa-2x logo"></i></a>
			</aside>
		</div>
	</footer>
<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"
    integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        if (localStorage.getItem('nightMode') === 'enabled') 
        {
            body.classList.add('night-mode');
        }
        window.toggleNightMode = () => 
        {
            if (body.classList.contains('night-mode')) 
            {
                body.classList.remove('night-mode');
                localStorage.setItem('nightMode', 'disabled');
            } 
            else 
            {
                body.classList.add('night-mode');
                localStorage.setItem('nightMode', 'enabled');
            }
        };
    });
</script>
</body>
</html>
