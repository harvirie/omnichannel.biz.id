import React, { useState } from 'react';
import { 
  PhoneCall, 
  MessageSquare, 
  BarChart3, 
  HeadphonesIcon, 
  Globe, 
  Zap,
  CheckCircle2,
  Menu,
  X,
  ArrowRight
} from 'lucide-react';

export default function App() {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

  return (
    <div className="min-h-screen bg-slate-50 font-sans text-slate-900">
      {/* Navbar */}
      <nav className="fixed w-full bg-white/90 backdrop-blur-md z-50 border-b border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-20">
            <div className="flex items-center gap-2">
              <div className="bg-blue-600 p-2 rounded-lg">
                <HeadphonesIcon className="h-6 w-6 text-white" />
              </div>
              <span className="font-bold text-xl tracking-tight text-slate-800">OmniServe</span>
            </div>
            
            {/* Desktop Menu */}
            <div className="hidden md:flex items-center space-x-8">
              <a href="#fitur" className="text-slate-600 hover:text-blue-600 font-medium transition-colors">Fitur</a>
              <a href="#usecase" className="text-slate-600 hover:text-blue-600 font-medium transition-colors">Use Case</a>
              <a href="#analitik" className="text-slate-600 hover:text-blue-600 font-medium transition-colors">Analitik Data</a>
              <button className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full font-medium transition-all shadow-sm hover:shadow-md">
                Jadwalkan Demo
              </button>
            </div>

            {/* Mobile Menu Button */}
            <div className="md:hidden flex items-center">
              <button 
                onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                className="text-slate-600 hover:text-blue-600"
              >
                {isMobileMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
              </button>
            </div>
          </div>
        </div>

        {/* Mobile Menu Panel */}
        {isMobileMenuOpen && (
          <div className="md:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-4 space-y-1 shadow-lg">
            <a href="#fitur" className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">Fitur</a>
            <a href="#usecase" className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">Use Case</a>
            <a href="#analitik" className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">Analitik Data</a>
            <div className="pt-2">
              <button className="w-full bg-blue-600 text-white px-4 py-3 rounded-xl font-medium">
                Jadwalkan Demo
              </button>
            </div>
          </div>
        )}
      </nav>

      {/* Hero Section */}
      <section className="pt-32 pb-20 lg:pt-40 lg:pb-28 px-4 overflow-hidden">
        <div className="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
          <div className="space-y-8">
            <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-100/50 text-blue-700 font-medium text-sm border border-blue-200">
              <Zap className="h-4 w-4" /> <span>Platform Call Center Masa Depan</span>
            </div>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-slate-900">
              Satu Layar untuk <span className="text-blue-600">Semua Saluran Komunikasi</span> Pelanggan Anda
            </h1>
            <p className="text-lg md:text-xl text-slate-600 leading-relaxed max-w-lg">
              Tingkatkan kepuasan pelanggan dan produktivitas tim dengan aplikasi call center omnichannel yang menghubungkan suara, chat, email, dan media sosial dalam satu tempat.
            </p>
            <div className="flex flex-col sm:flex-row gap-4">
              <button className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
                Mulai Gratis 14 Hari <ArrowRight className="h-5 w-5" />
              </button>
              <button className="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-8 py-4 rounded-full font-semibold text-lg transition-all flex items-center justify-center">
                Pelajari Lebih Lanjut
              </button>
            </div>
            <div className="pt-4 flex items-center gap-4 text-sm text-slate-500">
              <div className="flex items-center gap-1"><CheckCircle2 className="h-4 w-4 text-green-500"/> Tanpa Kartu Kredit</div>
              <div className="flex items-center gap-1"><CheckCircle2 className="h-4 w-4 text-green-500"/> Setup dalam 5 Menit</div>
            </div>
          </div>
          <div className="relative">
            <div className="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-400 rounded-[2rem] blur opacity-30 animate-pulse"></div>
            <img 
              src="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" 
              alt="Call Center Agent using Omnichannel app" 
              className="relative rounded-[2rem] shadow-2xl w-full object-cover h-[500px]"
            />
            
            {/* Floating UI Elements for visual effect */}
            <div className="absolute -left-6 top-1/4 bg-white p-4 rounded-xl shadow-xl flex items-center gap-3 animate-bounce" style={{ animationDuration: '3s' }}>
              <div className="bg-green-100 p-2 rounded-full text-green-600"><PhoneCall className="h-5 w-5"/></div>
              <div>
                <div className="text-xs text-slate-500">Panggilan Masuk</div>
                <div className="font-semibold text-sm">Budi Santoso</div>
              </div>
            </div>
            <div className="absolute -right-6 bottom-1/4 bg-white p-4 rounded-xl shadow-xl flex items-center gap-3 animate-bounce" style={{ animationDuration: '4s', animationDelay: '1s' }}>
              <div className="bg-blue-100 p-2 rounded-full text-blue-600"><MessageSquare className="h-5 w-5"/></div>
              <div>
                <div className="text-xs text-slate-500">WhatsApp Baru</div>
                <div className="font-semibold text-sm">Tanya Produk...</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Strong Message: Converting Service to Data */}
      <section id="analitik" className="py-24 bg-slate-900 text-white relative overflow-hidden">
        {/* Background decorative elements */}
        <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        <div className="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/20 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
        
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="grid lg:grid-cols-2 gap-16 items-center">
            <div className="order-2 lg:order-1">
              <img 
                src="https://images.unsplash.com/photo-1759752394755-1241472b589d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxkYXRhJTIwYW5hbHl0aWNzJTIwZGFzaGJvYXJkJTIwc2NyZWVufGVufDF8fHx8MTc3ODE0NTkwNnww&ixlib=rb-4.1.0&q=80&w=1080" 
                alt="Data Analytics Dashboard" 
                className="rounded-2xl shadow-2xl border border-slate-700/50 object-cover h-[450px] w-full"
              />
            </div>
            <div className="order-1 lg:order-2 space-y-8">
              <h2 className="text-3xl md:text-5xl font-bold leading-tight">
                Berhenti Sekadar Merespon. <br />
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">
                  Ubah Setiap Interaksi Menjadi Data.
                </span>
              </h2>
              <p className="text-slate-300 text-lg md:text-xl leading-relaxed">
                Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan menjadi wawasan bisnis yang kuat secara real-time.
              </p>
              
              <ul className="space-y-4 pt-4">
                {[
                  'Identifikasi tren keluhan sebelum menjadi krisis',
                  'Ukur kinerja agen secara objektif dengan metrik akurat',
                  'Pahami preferensi saluran komunikasi pelanggan Anda',
                  'Ekspor data untuk diolah ke platform CRM andalan Anda'
                ].map((item, idx) => (
                  <li key={idx} className="flex items-start gap-3">
                    <div className="bg-blue-500/20 p-1 rounded-full mt-1">
                      <CheckCircle2 className="h-5 w-5 text-blue-400" />
                    </div>
                    <span className="text-slate-200 text-lg">{item}</span>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* Ease of Use / Features */}
      <section id="fitur" className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center max-w-3xl mx-auto mb-16">
            <h2 className="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-3">Kemudahan Maksimal</h2>
            <h3 className="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Sistem Rumit yang Dibuat Begitu Sederhana</h3>
            <p className="text-lg text-slate-600">
              Desain antarmuka yang intuitif memastikan agen Anda bisa langsung bekerja tanpa perlu masa pelatihan berbulan-bulan. Fokus melayani, bukan belajar aplikasi.
            </p>
          </div>

          <div className="grid md:grid-cols-3 gap-8 mb-16">
            {/* Feature 1 */}
            <div className="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
              <div className="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6">
                <Globe className="h-7 w-7 text-blue-600" />
              </div>
              <h4 className="text-xl font-bold text-slate-900 mb-4">Integrasi Semua Channel</h4>
              <p className="text-slate-600 leading-relaxed">
                Telepon, WhatsApp, Instagram, Email, dan Live Chat dalam satu kotak masuk (inbox). Agen tidak perlu lagi berpindah-pindah tab.
              </p>
            </div>

            {/* Feature 2 */}
            <div className="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
              <div className="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6">
                <Zap className="h-7 w-7 text-yellow-500" />
              </div>
              <h4 className="text-xl font-bold text-slate-900 mb-4">Otomatisasi Cerdas</h4>
              <p className="text-slate-600 leading-relaxed">
                Distribusikan tiket secara otomatis (ACD) ke agen yang paling tepat berdasarkan keahlian atau beban kerja, kurangi waktu tunggu pelanggan.
              </p>
            </div>

            {/* Feature 3 */}
            <div className="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
              <div className="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6">
                <BarChart3 className="h-7 w-7 text-green-500" />
              </div>
              <h4 className="text-xl font-bold text-slate-900 mb-4">Laporan Siap Pakai</h4>
              <p className="text-slate-600 leading-relaxed">
                Hasilkan laporan kinerja harian, mingguan, hingga bulanan hanya dengan satu klik. Ekspor dalam format PDF atau Excel.
              </p>
            </div>
          </div>

          <div className="rounded-[2.5rem] overflow-hidden relative group">
            <img 
              src="https://images.unsplash.com/photo-1603714228681-b399854b8f80?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYXBweSUyMGN1c3RvbWVyJTIwc3VwcG9ydCUyMHRlYW18ZW58MXx8fHwxNzc4MTQ2Nzc1fDA&ixlib=rb-4.1.0&q=80&w=1080" 
              alt="Happy Support Team" 
              className="w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-105"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent flex items-end">
              <div className="p-8 md:p-12">
                <h4 className="text-2xl md:text-3xl font-bold text-white mb-2">Agen Bahagia = Pelanggan Puas</h4>
                <p className="text-slate-200 max-w-2xl text-lg">Platform yang mudah digunakan mengurangi tingkat stres agen hingga 40%, sehingga mereka bisa memberikan layanan yang lebih ramah dan solutif.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Use Cases Section */}
      <section id="usecase" className="py-24 bg-slate-50 border-t border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center max-w-3xl mx-auto mb-16">
            <h2 className="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-3">Usecase Industri</h2>
            <h3 className="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Satu Solusi Untuk Berbagai Kebutuhan Bisnis</h3>
            <p className="text-lg text-slate-600">
              Apapun industri Anda, OmniServe dirancang adaptif untuk menyesuaikan dengan alur kerja pelayanan unik milik Anda.
            </p>
          </div>

          <div className="grid md:grid-cols-2 gap-12 items-center">
            <div className="space-y-6">
              {/* Use Case Item 1 */}
              <div className="bg-white p-6 rounded-2xl border-l-4 border-blue-600 shadow-md">
                <h4 className="text-xl font-bold text-slate-900 mb-2">E-Commerce & Ritel</h4>
                <p className="text-slate-600">
                  Tingkatkan konversi penjualan dengan merespon cepat pertanyaan produk di WhatsApp dan Instagram DM. Lacak status pesanan langsung dari dashboard yang sama.
                </p>
              </div>

              {/* Use Case Item 2 */}
              <div className="bg-white p-6 rounded-2xl border-l-4 border-slate-200 hover:border-blue-400 transition-colors opacity-75 hover:opacity-100 hover:shadow-md cursor-pointer">
                <h4 className="text-xl font-bold text-slate-900 mb-2">Keuangan & Perbankan</h4>
                <p className="text-slate-600">
                  Pastikan keamanan data dengan sistem on-premise atau private cloud kami. Rekam semua pembicaraan telepon untuk keperluan kepatuhan (compliance).
                </p>
              </div>

              {/* Use Case Item 3 */}
              <div className="bg-white p-6 rounded-2xl border-l-4 border-slate-200 hover:border-blue-400 transition-colors opacity-75 hover:opacity-100 hover:shadow-md cursor-pointer">
                <h4 className="text-xl font-bold text-slate-900 mb-2">Layanan Kesehatan (Klinik & RS)</h4>
                <p className="text-slate-600">
                  Pusatkan penjadwalan janji temu pasien. Integrasi WhatsApp Blast untuk pengingat jadwal berobat sehingga mengurangi angka ketidakhadiran (no-show).
                </p>
              </div>
            </div>

            <div className="relative h-full min-h-[400px] rounded-3xl overflow-hidden shadow-2xl">
              <img 
                src="https://images.unsplash.com/photo-1758876202430-a0595cf17d3e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxidXNpbmVzcyUyMHdvbWFuJTIwdXNpbmclMjBzbWFydHBob25lJTIwZWNvbW1lcmNlfGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" 
                alt="E-commerce Use Case" 
                className="absolute inset-0 w-full h-full object-cover"
              />
              <div className="absolute inset-0 bg-blue-900/20 mix-blend-multiply"></div>
              {/* Overlay Badge */}
              <div className="absolute top-6 right-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg font-semibold text-blue-900 flex items-center gap-2">
                <span className="relative flex h-3 w-3">
                  <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span className="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                Respon Cepat
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 bg-blue-600 relative overflow-hidden">
        {/* Decorative background vectors */}
        <div className="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
          <svg viewBox="0 0 100 100" preserveAspectRatio="none" className="w-full h-full">
            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="none" stroke="currentColor" strokeWidth="2" strokeDasharray="5,5" />
            <circle cx="50" cy="50" r="40" fill="none" stroke="currentColor" strokeWidth="1" />
            <circle cx="50" cy="50" r="20" fill="currentColor" />
          </svg>
        </div>

        <div className="max-w-4xl mx-auto px-4 text-center relative z-10">
          <h2 className="text-3xl md:text-5xl font-bold text-white mb-6">Siap Mengubah Cara Anda Melayani?</h2>
          <p className="text-blue-100 text-xl mb-10 max-w-2xl mx-auto">
            Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi dan mensentralisasi pusat layanan pelanggan mereka dengan OmniServe.
          </p>
          <div className="flex flex-col sm:flex-row justify-center gap-4">
            <button className="bg-white text-blue-600 hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg">
              Mulai Uji Coba Gratis
            </button>
            <button className="bg-blue-700 text-white hover:bg-blue-800 border border-blue-500 px-8 py-4 rounded-full font-bold text-lg transition-all">
              Hubungi Sales Kami
            </button>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
          <div className="col-span-1 md:col-span-2 space-y-4">
            <div className="flex items-center gap-2">
              <div className="bg-blue-600 p-1.5 rounded-lg inline-block">
                <HeadphonesIcon className="h-5 w-5 text-white" />
              </div>
              <span className="font-bold text-xl tracking-tight text-white">OmniServe</span>
            </div>
            <p className="max-w-xs">
              Membawa masa depan layanan pelanggan ke bisnis Anda hari ini melalui platform omnichannel revolusioner.
            </p>
          </div>
          <div>
            <h4 className="text-white font-semibold mb-4">Produk</h4>
            <ul className="space-y-2">
              <li><a href="#" className="hover:text-white transition-colors">Fitur Utama</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Harga</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Integrasi API</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Keamanan Data</a></li>
            </ul>
          </div>
          <div>
            <h4 className="text-white font-semibold mb-4">Perusahaan</h4>
            <ul className="space-y-2">
              <li><a href="#" className="hover:text-white transition-colors">Tentang Kami</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Karir</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Blog</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Hubungi Kami</a></li>
            </ul>
          </div>
        </div>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-slate-800 text-sm flex flex-col md:flex-row justify-between items-center">
          <p>&copy; 2026 OmniServe Inc. Hak cipta dilindungi undang-undang.</p>
          <div className="space-x-4 mt-4 md:mt-0">
            <a href="#" className="hover:text-white transition-colors">Kebijakan Privasi</a>
            <a href="#" className="hover:text-white transition-colors">Syarat & Ketentuan</a>
          </div>
        </div>
      </footer>
    </div>
  );
}
