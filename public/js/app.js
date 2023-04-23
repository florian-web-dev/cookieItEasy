
// ------------- Ici JavaScriptpour Apparition au scroll 
// documentation | https://developer.mozilla.org/fr/docs/Web/API/Intersection_Observer_API 


// L'API Intersection Observer permet de mettre en place une fonction callback qui est appelée quand un élément

const ratio = .1
const options = {
    root: null,   
    rootMargin: '0px',
    threshold: ratio
  }
  
  const handleIntersect = function (entries, observer) {
      entries.forEach(function (entry){
          if (entry.intersectionRatio > ratio){
              entry.target.classList.remove('reveal') //add est remplacer par remove   
              //entry.target.classList.remove('traslateright')
              observer.unobserve(entry.target)
          }
      })
    //   console.log('handleIntersect')
  }

  const observer = new IntersectionObserver(handleIntersect, options);
  document.querySelectorAll('.reveal').forEach(function(r){
      observer.observe(r) // r comme reveal
  })





