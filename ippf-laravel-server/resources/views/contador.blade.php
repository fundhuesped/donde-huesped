<!doctype html>
<html>
  <head>
    <title>donde.huesped.org.ar | Fundación Huésped</title>

    <meta name="google-site-verification" content="RQh3eES_sArPYfFybCM87HsV6mbwmttWlAIk-Upf1EQ" />
    <meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
    <meta name="author" content="Fundación Huésped">
    <link rel="canonical" href="https://www.huesped.org.ar/donde/"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta property="og:description" content="Conoce dónde hacerte la prueba de VIH y buscar condones gratis. También encuentra los vacunatorios y centros de infectología más cercanos." />
    <meta property='og:url' content='https://www.huesped.org.ar/donde/'/>
    <meta property='og:site_name' content='Fundación Huésped'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='https://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
    <meta property='fb:app_id' content='459717130793708' />
    <meta name="twitter:card" content="summary">
    <meta name='twitter:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta name="twitter:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
    <meta name='twitter:url' content='https://www.huesped.org.ar/donde/'/>
    <meta name='twitter:image' content='https://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
    <meta name='twitter:site' content='@fundhuesped' />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css(.) styles/vendor.css -->
    <!-- bower:css -->
    <link rel='stylesheet' href='bower_components/c3/c3.css' />
    <link rel='stylesheet' href='bower_components/materialize/bin/materialize.css' />
    <link rel="stylesheet" href="bower_components/odometer/themes/odometer-theme-minimal.css"/>

    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css(.tmp) styles/main.css -->
    <link rel="stylesheet" href="styles/contador/fonts.css">
    <link rel="stylesheet" href="styles/contador/main.css">
    <!-- endbuild -->


    <!-- Icons -->
  <link rel='shortcut icon' href='https://www.huesped.org.ar/testimonios/assets/img/favicon.png'>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  </head>
  <body ng-app="dondeDataVizApp">
    <!--[if lte IE 8]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <main>
        <nav>
            <div class="nav-wrapper">
              <a href="#!" class="brand-logo"><img class="logoTop" src="images/logo_blanco.svg">
               <!-- <span ng-cloak ng-show="navBar">/ [[navBar]] </span> --></a>
              </div>
        </nav>
        <!-- CONTENIDO -->
        <div class="container">
            <div ng-view></div>
        </div>
    <!-- FIN DE CONTENIDO -->
    </main>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-57169789-2', 'auto');
        ga('send', 'pageview');

    </script>


    <!-- build:js(.) scripts/vendor.js -->
    <!-- bower:js -->
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/angular/angular.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="bower_components/angular-route/angular-route.js"></script>
    <script src="bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="bower_components/pym.js/dist/pym.js"></script>
    <script src="bower_components/d3/d3.js"></script>
    <script src="bower_components/c3/c3.js"></script>
    <script src="bower_components/lodash/lodash.js"></script>
    <script src="bower_components/angular-scroll/angular-scroll.js"></script>
    <script src="bower_components/materialize/bin/materialize.js"></script>
    <script src="bower_components/angular-materialize/src/angular-materialize.js"></script>
    <script src="bower_components/moment/moment.js"></script>
    <script src="bower_components/angular-moment/angular-moment.js"></script>
    <script src="bower_components/odometer/odometer.js"></script>
    <script src="bower_components/angular-odometer-js/dist/angular-odometer.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:js({.tmp,app}) scripts/scripts.js -->
    <script src="scripts/contador/libs/d3plus-text.v0.7.full.min.js"></script>
    <script src="scripts/contador/libs/genosha-d3-helpers.js"></script>
    <script src="scripts/contador/app.js"></script>
    <script src="scripts/contador/controllers/home.js"></script>
    <script src="scripts/contador/controllers/map.js"></script>
    <script src="scripts/contador/directives/mapChart.js"></script>
    <script src="scripts/contador/directives/votes.js"></script>
    <script src="scripts/contador/directives/diversity.js"></script>
    <!-- endbuild -->
</body>
</html>
