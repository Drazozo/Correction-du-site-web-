 <div class="Container">
    
    <div class="MainGraphic">
    <svg class="Hummingbird" viewBox="0 0 55 41" xmlns="http://www.w3.org/2000/svg"><path d="M35.5 5L54.7.6H32.3L35.5 5zM12.4 40.8l10.3-10.1-6.2-6.7-4.1 16.8zM33.8 5.3L30.5.8l-5.4 4 8.7.5zM20.8 4.6L8.8 0l1.9 4.1 10.1.5zM0 5l15.2 15.4 7.5-14.2L0 5zM34.2 6.8l-9.9-.5-8 15.2 7.4 8.1 8-7.9 2.5-14.9z"/></svg>
    
    <svg class="Cog" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M29.18 19.07c-1.678-2.908-.668-6.634 2.256-8.328L28.29 5.295c-.897.527-1.942.83-3.057.83-3.36 0-6.085-2.743-6.085-6.126h-6.29c.01 1.043-.25 2.102-.81 3.07-1.68 2.907-5.41 3.896-8.34 2.21L.566 10.727c.905.515 1.69 1.268 2.246 2.234 1.677 2.904.673 6.624-2.24 8.32l3.145 5.447c.895-.522 1.935-.82 3.044-.82 3.35 0 6.066 2.725 6.083 6.092h6.29c-.004-1.035.258-2.08.81-3.04 1.676-2.902 5.4-3.893 8.325-2.218l3.145-5.447c-.9-.515-1.678-1.266-2.232-2.226zM16 22.48c-3.578 0-6.48-2.902-6.48-6.48S12.423 9.52 16 9.52c3.578 0 6.48 2.902 6.48 6.48s-2.902 6.48-6.48 6.48z"/></svg>
    
    </div>
   <h1 class="MainTitle">
   🚧 <b> Une erreur du serveur s'est produite </b>- 500 🚧
   <br>
      </h1>
    <p class="Main Description">
    Le serveur est actuellement surchargé - Relancer la page dans une minute pour réessayer 🚀 <br>
    Navré d'être victime de notre succès !
    </p>   
    
  </div>
  <style type="text/css">
  @color-primary: #30A9DE;
@color-secondary: #30A9DE;
@color-tertiary: #30A9DE;
@color-primary-light: #6AAFE6;
@color-primary-dark: #8EC0E4;
@Distance: 1000px;

body{
  overflow: hidden;
}



.Container {
  text-align: center;
  position: relative;
}

.MainTitle {
  display: block;
  font-size: 2rem;
  font-weight: lighter;
  text-align: center;
}

.MainDescription {
  max-width: 50%;
  font-size: 1.2rem;
  font-weight: lighter;
}

.MainGraphic {
  position: relative;
}

.Cog {
  width: 10rem;
  height: 10rem;
  fill: @color-primary-light;
  transition: easeInOutQuint();
  animation: CogAnimation 5s infinite;
}

.Spanner {
  position: absolute;
  transform: rotate(20deg);
  top: 10%;
  left: 20%;
  width: 10rem;
  height: 10rem;
  fill: @color-primary-dark;
  animation: SpannerAnimation 4s infinite;  
}

.Hummingbird{
  position: absolute;
  width: 3rem;
  height: 3rem;
  fill: @color-primary;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);  
}

@keyframes CogAnimation {
    0%   {transform: rotate(0deg);}
    100% {transform: rotate(360deg);}
}

@keyframes SpannerAnimation {
    0%   {
      transform: 
        translate3d(20px, 20px,1px)
        rotate(0deg);
    }
    10% {
      transform: 
        translate3d(-@Distance, @Distance, 1px)           
        rotate(180deg);
    }
    15% {
      transform: 
        translate3d(-@Distance, @Distance, 1px)           
        rotate(360deg);
    }    
    20% {
      transform: 
        translate3d(@Distance, -@Distance, 1px)           
        rotate(180deg);
    }
    30% {
      transform: 
        translate3d(-@Distance, @Distance, 1px)           
        rotate(360deg);
    }  
    40% {
      transform: 
        translate3d(@Distance, -@Distance, 1px)           
        rotate(360deg);
    }
    50% {
      transform: 
        translate3d(-@Distance, @Distance, 1px)           
        rotate(180deg);
    }    
    100% {
      transform: 
        translate3d(0, 0px, 0px)           
        rotate(360deg);
    }  
}
</style>
<center>
<a href="javascript:history.back()">Retourner a la page précédente</a><br>
    <a href="">Page d'accueil</a>
</div>
<script src="assets/redirect.js"></script></center>