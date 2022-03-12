import React from 'react'
import ReactDOM from 'react-dom'
import image from "./fleche.svg"

function App(){
let scrollPos = 0;
let getHeader = document.getElementById("returnToHeader");
// adding scroll event
window.addEventListener('scroll', function(){
  if ((document.body.getBoundingClientRect()).top > scrollPos){
    getHeader.style.right = "-78px";
    if (window.matchMedia("(max-width: 920px)").matches) {
        getHeader.style.right = "0px";
    }
  }else{
        getHeader.style.right = "0px";
    }
	// saves the new position for iteration.
	scrollPos = (document.body.getBoundingClientRect()).top;
})    
    return (
        <div className='p-4 d-flex justify-content-lg-end justify-content-center'>
            <a href="#start"><img src={image} /></a>
        </div>
    )
    
}

const rootElement = document.getElementById("returnToHeader")
ReactDOM.render(<App />, rootElement)




