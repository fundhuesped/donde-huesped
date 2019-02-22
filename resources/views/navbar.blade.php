<!-- NAV BAR DESKTOP/MOBILE-->
<nav>
  <div class="nav-wrapper">
    <a href="/#/" class="brand-logo">
      <!-- WEBSITE LOGO -->
      <img class="logoTop" src="images/HUESPED_logo_donde_RGB-07_cr.png">
      <!-- MOBILE BURGER BUTTON -->
     <a href="/#/" data-activates="mobile-demo" class="button-collapse">
        <i class="mdi-navigation-menu"></i>
      </a>
      <!-- DESKTOP NAVBAR -->
      <ul class="right hide-on-med-and-down">
        <li><a class="modal-trigger tooltipped" 
          data-position="bottom" data-tooltip="Mas información"  href="#modal"><i class="mdi-action-info"></i></a></li>
        <li><a class="tooltipped" 
          data-position="bottom" data-tooltip="Lugares cercanos" href="#/localizar/all/listado"><i class="mdi-maps-place"></i></a></li>
        <li><a class="tooltipped" 
          data-position="bottom" data-tooltip="Sugerir nuevo lugar" href="form"><i class="mdi-content-add-circle-outline"></i></a></li>
        <li><a class="tooltipped" 
          data-position="bottom" data-tooltip="Buscar por listado" href="listado-paises"><i class="mdi-action-language"></i></a></li>
      </ul>

     <!-- POP NAVIGATION -->
     <ul ng-cloak ng-show="navigating"  class="left wow fadeIn nav-wrapper">
       <li><a href="javascript:history.go(-1)"><i class="mdi-navigation-chevron-left right"></i></a></li>
     </ul>

     <!-- MOBILE NAVBAR -->
     <ul class="side-nav" id="mobile-demo">

       <!-- ABOUT -->
       <li>
         <a href="#/acerca">
           <i class="mdi-action-info left"></i><span translate="about"></span>
         </a>
       </li>
       <!-- GEOLOCALIZATION SHOW EVERY PLACE -->
       <li>
         <a href="#/localizar/all/listado">
           <i class="mdi-maps-place left"></i>
           <span translate="closer"></span>
         </a>
       </li>
       <!-- FORM SUGGEST -->
       <li>
         <a href="form">
           <i class="mdi-content-add-circle-outline left"></i><span translate="seggest"></span>
         </a>
      </li>
      <!-- COUNTRY LIST -->
      <li>
        <a href="listado-paises">
          <i class="mdi-action-language left"></i>
          <span translate="list"></span>
        </a>
      </li>
    </ul>
  </div>
</nav>
<!-- END NAV BAR DESKTOP/MOBILE -->
