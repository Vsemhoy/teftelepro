(function(){
  let trigger = document.querySelector('#appTrigger');
  let container = document.querySelector('#appMenu');

  trigger.addEventListener('click', function()
  {
    triggerMenu()
  });


function triggerMenu(){
  if (container.classList.contains("d-none")){
    container.classList.remove("d-none");
    container.classList.add("d-block");
    
  } else if (container.classList.contains("d-block"))
  {
    container.classList.remove("d-block");
    container.classList.add("d-none");

  }
}

})();