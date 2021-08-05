<body>
  
	
	<!-- mobile-nav section start here -->
	<div class="mobile-menu">
		<nav class="mobile-header primary-menu d-lg-none">
			<div class="header-logo">
				<a href="{{route('accueil')}}" class="logo"><img width="100" height="100" src="{{asset('welcome/images/logo.png')}}" alt="logo"></a>
			</div>
			<div class="header-bar" id="open-button">
	            <span></span>
	            <span></span>
	            <span></span>
	        </div>
		</nav>
		<div class="menu-wrap">
			<div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
					<path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z"/>
				</svg>
			</div>
			<nav class="menu">
				<div class="mobile-menu-area d-lg-none">
			        <div class="mobile-menu-area-inner" id="scrollbar">
		                <div class="header-bar m-menu-bar">
		                    <a href="{{route('accueil')}}" class="logo"><img src="{{asset('welcome/images/logo.png')}}" alt="logo"></a>
		                    <div class="close-button" id="close-button"></div>
		                </div>
			            <ul class="m-menu">
			                <li><a href="{{route('accueil')}}">Accueil</a> 
			                </li>
			                <li class="register"><a  href="#">S'enrégistrer</a></li>
			                <li><a href="#">Connexion</a></li>
			        </div>
			    </div>
			</nav>
		</div>
	</div>
	<!-- mobile-nav section ending here -->

	<!-- header section start here -->
	<div class="header-section style-2 d-none d-lg-block">
		
		<div class="header-bottom">
			<nav class="primary-menu">
				<div class="container container-1310">
					<div class="menu-area">
						<div class="row no-gutters justify-content-between align-items-center">
							<a href="index.html" class="logo">
								<img width="100" height="100" src="{{asset('welcome/images/logo.png')}}" alt="logo">
								<img width="100" height="100" src="{{asset('welcome/images/logo.png')}}" alt="logo">
							</a>
							<ul class="main-menu marg d-flex align-items-center">
								<li class="">
									<a href="{{route('accueil')}}">Accueil</a>
								</li>
								
							</ul>
							<ul class="main-menu d-flex align-items-center">
								
								<li><a class="register" style="border: 1px solid black; border-radius: 50px" href="{{route('signup')}}">S'enrégistrer</a></li>
								<li><a class="login" href="{{route('login')}}">Connexion</a></li>
								
								<!-- <li class="head-contact d-none d-xl-block"><a href="#"><i class="fas fa-phone"></i> +8801619-139091</a></li> -->
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
	<!-- header section ending here -->