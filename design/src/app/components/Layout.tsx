import { useState } from 'react';
import { Outlet, Link, useLocation } from 'react-router';
import { Headphones, Menu, X, ArrowRight } from 'lucide-react';

export function Layout() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const location = useLocation();

  const navLinks = [
    { name: 'Fitur', path: '/fitur' },
    { name: 'Use Case', path: '/use-case' },
    { name: 'Analitik Data', path: '/analitik' },
    { name: 'Harga', path: '/harga' },
  ];

  return (
    <div className="min-h-screen bg-[#7A9E7E] flex flex-col">
      {/* Mobile Navbar */}
      <nav className="md:hidden fixed w-full bg-[#EBF4E3]/90 backdrop-blur-md z-50 border-b border-[#d2e3c9]">
        <div className="px-4">
          <div className="flex justify-between items-center h-20">
            <Link to="/" className="flex items-center gap-2" onClick={() => setMobileMenuOpen(false)}>
              <div className="bg-[#415B45] p-2 rounded-lg">
                <Headphones className="h-6 w-6 text-white" />
              </div>
              <span className="font-bold text-xl tracking-tight text-[#1C2C1F]">OmniServe</span>
            </Link>
            <button onClick={() => setMobileMenuOpen(!mobileMenuOpen)} className="text-[#4F6854]">
              {mobileMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            </button>
          </div>
        </div>
        {mobileMenuOpen && (
          <div className="bg-[#EBF4E3] border-b border-[#d2e3c9] px-4 pt-2 pb-4 space-y-1 shadow-lg absolute w-full">
            {navLinks.map((link) => (
              <Link
                key={link.path}
                to={link.path}
                onClick={() => setMobileMenuOpen(false)}
                className={`block px-3 py-2 rounded-md font-medium ${
                  location.pathname === link.path ? 'text-[#FDB854] bg-[#1C2C1F]/5' : 'text-[#4F6854] hover:text-[#567558]'
                }`}
              >
                {link.name}
              </Link>
            ))}
          </div>
        )}
      </nav>

      {/* Desktop & Tablet Header Wrapper (Floating Rounded Square) */}
      <div className="hidden md:flex fixed top-6 left-0 w-full z-50 justify-center pointer-events-none px-4">
        <header className="w-full max-w-[1100px] pointer-events-auto transition-all duration-300 bg-[#1C2C1F]/95 backdrop-blur-md border border-white/10 shadow-2xl rounded-[2rem]">
          <div className="px-6 h-20 flex justify-between items-center">
            {/* Logo */}
            <div className="w-1/4">
            <Link to="/" className="flex items-center gap-2">
              <div className="bg-[#415B45] p-2 rounded-xl shadow-sm">
                <Headphones className="h-6 w-6 text-white" />
              </div>
              <span className="font-bold text-2xl tracking-tight text-white">OmniServe</span>
            </Link>
          </div>

          {/* Desktop Navigation */}
          <nav className="flex-1 flex justify-center gap-8">
            {navLinks.map((link) => (
              <Link
                key={link.path}
                to={link.path}
                className={`group relative text-sm font-medium transition-all duration-300 hover:text-[#FDB854] hover:-translate-y-0.5 ${
                  location.pathname === link.path ? 'text-[#FDB854]' : 'text-white'
                }`}
              >
                {link.name}
                <span className={`absolute -bottom-2 left-1/2 -translate-x-1/2 h-0.5 bg-[#FDB854] rounded-full transition-all duration-300 ${
                  location.pathname === link.path ? 'w-full opacity-100' : 'w-1 opacity-0 group-hover:opacity-100 group-hover:w-full'
                }`}></span>
              </Link>
            ))}
          </nav>

          {/* Sign In Button */}
          <div className="w-1/4 flex justify-end">
            <div className="group relative flex items-center shadow-lg rounded-full bg-[#FDB854] p-1 pr-1.5 cursor-pointer overflow-hidden transition-all duration-300 hover:shadow-[0_8px_20px_rgba(253,184,84,0.4)] hover:-translate-y-0.5 active:scale-95">
              <div className="absolute inset-0 w-full h-full pointer-events-none rounded-full overflow-hidden z-0">
                <div className="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/20 rounded-[40%] transition-all duration-700 ease-in-out group-hover:top-[-20%] group-hover:rotate-90"></div>
                <div className="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/30 rounded-[45%] transition-all duration-1000 ease-in-out delay-75 group-hover:top-[-20%] group-hover:rotate-[120deg]"></div>
              </div>
              <span className="relative z-10 text-white px-6 py-1.5 font-bold text-sm tracking-wide">Masuk</span>
              <div className="relative z-10 bg-[#e89e3a] text-white p-1.5 rounded-full transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 shadow-sm">
                <ArrowRight className="h-4 w-4" />
              </div>
            </div>
          </div>
        </div>
        </header>
      </div>

      {/* Main Content */}
      <main className="flex-1 md:pt-32 pt-20 flex flex-col">
        <Outlet />
      </main>

      {/* Shared Footer */}
      <footer className="bg-[#1C2C1F] text-white/70 py-12 border-t border-white/10">
        <div className="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
          <div className="col-span-1 md:col-span-2">
            <div className="flex items-center gap-2 mb-4">
              <div className="bg-[#415B45] p-2 rounded-lg">
                <Headphones className="h-5 w-5 text-white" />
              </div>
              <span className="font-bold text-xl tracking-tight text-white">OmniServe</span>
            </div>
            <p className="max-w-xs text-sm leading-relaxed mb-6">
              Satu layar untuk semua saluran. Tingkatkan kepuasan pelanggan dengan sistem omnichannel terbaik.
            </p>
          </div>
          <div>
            <h4 className="text-white font-semibold mb-4">Produk</h4>
            <ul className="space-y-2 text-sm">
              <li><Link to="/fitur" className="hover:text-[#FDB854] transition-colors">Fitur Utama</Link></li>
              <li><Link to="/analitik" className="hover:text-[#FDB854] transition-colors">Analitik Data</Link></li>
              <li><Link to="/use-case" className="hover:text-[#FDB854] transition-colors">Use Case</Link></li>
              <li><Link to="/harga" className="hover:text-[#FDB854] transition-colors">Harga</Link></li>
            </ul>
          </div>
          <div>
            <h4 className="text-white font-semibold mb-4">Perusahaan</h4>
            <ul className="space-y-2 text-sm">
              <li><a href="#" className="hover:text-[#FDB854] transition-colors">Tentang Kami</a></li>
              <li><a href="#" className="hover:text-[#FDB854] transition-colors">Karir</a></li>
              <li><a href="#" className="hover:text-[#FDB854] transition-colors">Hubungi Kami</a></li>
            </ul>
          </div>
        </div>
        <div className="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-white/10 text-sm text-center">
          &copy; {new Date().getFullYear()} OmniServe. Hak Cipta Dilindungi.
        </div>
      </footer>
    </div>
  );
}
