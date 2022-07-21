import { useEffect, useState } from "react";
import logo from './images/fleche.svg'
import './App.scss'


export default function App() {
  const [showPos, setShowPos] = useState(false);
  

  useEffect(() => {

    window.addEventListener("scroll", () => {
      if (window.pageYOffset && window.scrollY) {
        setShowPos('5px');
      } else {
        setShowPos('-55px');
      }
    })

    const interval = setInterval(() => {
      setShowPos('-55px');
    }, 10000);

    return () => clearInterval(interval);
  })

  const scrollToTop = () =>{
    window.scrollTo({
      top: 0, 
      behavior: 'auto'
    });
  };

  return (
    <>
      {showPos && (
        <div id="returnToHeader" onClick={scrollToTop} style={{ right : showPos }}>
        <img alt="start" vrel="preload" src={logo} />
    </div>
      )}
    </>
  );
}



