import heroImg from '../assets/hero.png'
import reactLogo from '../assets/react.svg'
import viteLogo from '../assets/vite.svg'

export default function Footer() {
    return (
        <footer>
            <p>This website is built with React<span><img className="logo" src={reactLogo} width="24" height="24" alt="React logo" /></span> 
            and Vite<span><img className="logo" src={viteLogo} width="24" height="24" alt="Vite logo" /></span>. 
            Special thanks is extended to the community of these technologies. </p>
            <div className="hero" max-width="32" max-height="32">
                <img src={heroImg} className="base" width="170" height="179" alt="" />
                <img src={reactLogo} className="framework" alt="React logo" />
                <img src={viteLogo} className="vite" alt="Vite logo" />
            </div>
        </footer>
    )
}