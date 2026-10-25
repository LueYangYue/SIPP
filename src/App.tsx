import { useState } from 'react'
// import ReactLogo from './assets/react.svg?react'
import reactLogo from './assets/react.svg'
import viteLogo from './assets/vite.svg'
import './App.css'
import TopNav from './components/TopNav'
import Header from './components/Header'
import Footer from './components/Footer'

const admin = {
  name: 'A202211',
  email: 'a202211@siswa.ukm.edu.my',
};

function App() {
  const [count, setCount] = useState(0)

  return (
    <>
    <TopNav />
    <Header />
      <section id="center">
        <div>
          <h1>Get started</h1>
          <p>
            Edit <code>src/App.tsx</code> and save to test <code>HMR</code>
          </p>
        </div>
        <button
          type="button"
          className="counter"
          onClick={() => setCount((count) => count + 1)}
        >
          Count is {count}
        </button>
      </section>

      <div className="ticks"></div>

      <section id="next-steps">
        <div id="docs">
          <svg className="icon" role="presentation" aria-hidden="true">
            <use href="/icons.svg#documentation-icon"></use>
          </svg>
          <h2>Documentation</h2>
          <p>Your questions, answered</p>
          <ul>
            <li>
              <a href="https://vite.dev/" target="_blank">
                <img className="logo" src={viteLogo} alt="" />
                Explore Vite
              </a>
            </li>
            <li>
              <a href="https://react.dev/" target="_blank">
                {/* <ReactLogo className="logo react" aria-hidden="true" />
                <span className="logo react" aria-hidden="true">⚛</span> */}
                <img className="logo" src={reactLogo} alt="" />
                Learn more
              </a>
            </li>
          </ul>
        </div>
        <div id="social">
          <svg className="icon" role="presentation" aria-hidden="true">
            <use href="/icons.svg#social-icon"></use>
          </svg>
          <h2>Connect with admin</h2>
          <p>Join the SIPP community</p>
          <ul>
            <li>
              <a href="https://github.com/LueYangYue/SIPP" target="_blank">
                <svg
                  className="button-icon"
                  role="presentation"
                  aria-hidden="true"
                >
                  <use href="/icons.svg#github-icon"></use>
                </svg>
                GitHub
              </a>
            </li>
            <li>
              <a href={'mailto:' + admin.email} target="_blank">
                <svg
                  className="button-icon"
                  role="presentation"
                  aria-hidden="true"
                >
                  <use href="/icons.svg#gmail-icon"></use>
                </svg>
                Gmail
              </a>
            </li>
            <li>
              <a href="https://www.youtube.com/@UKMYangYue" target="_blank">
                <svg
                  className="button-icon"
                  role="presentation"
                  aria-hidden="true"
                >
                  <use href="/icons.svg#youtube-icon"></use>
                </svg>
                Youtube
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/lue-yang-yue-4169b3325" target="_blank">
                <svg
                  className="button-icon"
                  role="presentation"
                  aria-hidden="true"
                >
                  <use href="/icons.svg#linkedin-icon"></use>
                </svg>
                LinkedIn
              </a>
            </li>
          </ul>
        </div>
      </section>

      <div className="ticks"></div>
      <section id="spacer"></section>
      <Footer />
    </>
  )
}

export default App
