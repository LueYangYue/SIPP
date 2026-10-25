import sippLogo from '../assets/sipp.png';
import Login from './Login.tsx';

export default function TopNav() {
  return (
    <div className="navbar bg-gray-800 text-white p-4">
      <a className="logo sipp" href="#">
        <img src={sippLogo} alt="SIPP Logo" width="32" height="32" />
      </a>
      <nav className="navbar-menu">
        <a href="../contact_faq.html" target="_blank">FAQ</a>
        <a href="mailto:a202211@siswa.ukm.edu.my">Contact Us</a>
        <button onClick={() => <Login />}>Log In</button>
      </nav>
    </div>
  );
}