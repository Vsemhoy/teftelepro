(function(){

  let trigger = document.querySelector('#leftSidenavToggler');
  let container = document.querySelector('#mainWrapper');
  let menuSide = document.querySelector('#sidebarMenu');
  let contentSide = document.querySelector('#mainContent');
  let rail = document.querySelector('#navRail');
  let container_width = container.offsetWidth;

  if (container_width > 1900)
  {
    container.classList.remove("menu-minimized");
    container.classList.add("menu-opened");
  }
  else 
  {
    container.classList.remove("menu-opened");
    container.classList.add("menu-minimized");
    
  }

  window.addEventListener('resize', function(){

    if (container.offsetWidth > 1900){
      container.classList.add("menu-opened");
    } else if (container.offsetWidth < 1901){
      container.classList.add("menu-minimized");
    }
  })
  
  trigger.addEventListener('click', function()
  {
    triggerMenu()
  });
  rail.addEventListener('click', function()
  {
    triggerMenu()
  });

function triggerMenu(){
  if (container.classList.contains("menu-opened")){
    container.classList.remove("menu-opened");
    container.classList.add("menu-minimized");
    
  } else if (container.classList.contains("menu-minimized"))
  {
    container.classList.remove("menu-minimized");
    container.classList.add("menu-opened");

  }
}

})();