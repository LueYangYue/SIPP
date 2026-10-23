import uniLogo from '../assets/uni_logo.png';

export default function Header() {
  return (
    <header className="bg-gray-800 text-white p-4">
      <h1 className="text-xl font-bold">My Application</h1>
      <a className="header-logo" href="landing.html">
        <img src={uniLogo} alt="University Logo" width="32" height="32" />
      </a>
      <nav className="navbar-menu">
        <a href="../contact_faq.html" target="_blank">FAQ</a>
        <a href="mailto:a202211@siswa.ukm.edu.my">Contact Us</a>
        <button onClick={() => (window.location.href="login.html")}>Log In</button>
      </nav>
    </header>
  );
}