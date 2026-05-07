import { ArrowRight, Search, Star, Phone, MessageCircle, Instagram, Mail, CheckCircle2, Globe, Zap, BarChart3, Headphones } from 'lucide-react';
import { Link } from 'react-router';
import { CustomersSection } from '../components/CustomersSection';

export function Home() {
  return (
    <>
      {/* Hero Section */}
      <section className="p-4 md:p-6 bg-[#7A9E7E] flex flex-col justify-center relative flex-1 min-h-[calc(100vh-6rem)] overflow-x-hidden">
        <div className="relative w-full max-w-[1400px] mx-auto flex flex-col items-center justify-center pt-8 lg:pt-0">
          
          {/* Responsive Hero (Desktop & Mobile) */}
          <div className="w-full relative pb-10 md:pb-0">
            {/* Top Card */}
            <div className="relative z-10 w-[300vw] -left-[55vw] md:w-full md:left-0 transition-all" style={{ aspectRatio: '2000.62 / 1163.2' }}>
              <svg viewBox="0 0 2000.62 1163.2" className="absolute inset-0 w-full h-full drop-shadow-xl" preserveAspectRatio="xMidYMid meet">
                <path fill="#EBF4E3" d="M 64 0 A 64 64 0 0 0 0 64 L 0 950.62 A 64 64 0 0 0 64 1014.62 L 678 1014.62 A 74.29 74.29 0 0 1 752.29 1088.91 A 74.29 74.29 0 0 0 826.58 1163.2 L 1936.62 1163.2 A 64 64 0 0 0 2000.62 1099.2 L 2000.62 212.88 A 64 64 0 0 0 1936.62 148.88 L 826.58 148.88 A 74.44 74.44 0 0 1 752.14 74.44 A 74.44 74.44 0 0 0 677.7 0 Z"/>
              </svg>

              {/* Inner Image Container (Desktop) */}
              <div className="hidden md:block absolute z-10 rounded-[2.5vw] overflow-hidden shadow-2xl" style={{ top: '17.55%', right: '4.5%', bottom: '11.45%', width: '43%' }}>
                <img src="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" className="absolute inset-0 w-full h-full object-cover" alt="Call center agent" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#1C2C1F]/90 via-[#1C2C1F]/20 to-transparent"></div>
                
                {/* Recommended Card */}
                <div className="absolute bottom-[6%] left-[6%] right-[6%] pointer-events-none">
                  <h3 className="text-[1.6vw] xl:text-2xl mb-[1vw] xl:mb-3 text-white drop-shadow-md">Recommended</h3>
                  <div className="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-[1vw] xl:p-5 text-white shadow-xl">
                    <div className="flex items-center gap-2 mb-1">
                      <h4 className="font-medium text-[1.1vw] xl:text-lg text-white">Panggilan Masuk</h4>
                      <div className="bg-[#FDB854] p-1 rounded-full">
                        <Star className="h-3 w-3 text-white fill-white" />
                      </div>
                      <span className="text-[0.8vw] xl:text-sm font-semibold ml-1">(2.3k+)</span>
                    </div>
                    <p className="text-[0.85vw] xl:text-sm text-white/90">
                      Budi Santoso - Keluhan Produk<br/>
                      <span className="text-[0.75vw] xl:text-xs opacity-80">Menunggu antrean (0:45)</span>
                    </p>
                  </div>
                </div>
              </div>

              {/* Left Content (Desktop) */}
              <div className="hidden md:flex absolute top-[7%] left-[5%] w-[38%] z-20 flex-col">
                <div className="flex items-center gap-[0.55vw] xl:gap-2 mb-[2.2vw] xl:mb-8">
                  <div className="bg-[#415B45] p-[0.55vw] xl:p-2 rounded-[0.8vw] xl:rounded-xl shadow-sm">
                    <Headphones className="h-[1.66vw] w-[1.66vw] xl:h-6 xl:w-6 text-white" />
                  </div>
                  <span className="font-bold text-[1.4vw] xl:text-2xl tracking-tight text-[#1C2C1F]">OmniServe</span>
                </div>

                <h1 className="text-[3.2vw] xl:text-[58px] text-[#1C2C1F] mb-[1.38vw] xl:mb-5 leading-[1.05]">
                  Satu Layar untuk<br/>Semua Saluran.
                </h1>
                <p className="text-[#4F6854] text-[1vw] xl:text-base max-w-[92%] mb-[2.2vw] xl:mb-8 font-medium leading-relaxed">
                  Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.
                </p>

                {/* Search Bar */}
                <div className="flex items-center bg-white p-[0.4vw] xl:p-1.5 rounded-full w-full shadow-sm mb-[2.2vw] xl:mb-8 border border-[#d2e3c9]">
                  <Link to="/harga" className="bg-[#567558] hover:bg-[#415B45] transition-colors text-white px-[1.2vw] py-[0.6vw] rounded-full text-[0.85vw] xl:text-sm font-semibold whitespace-nowrap">Coba Gratis</Link>
                  <button className="px-[1vw] py-[0.6vw] text-[0.85vw] xl:text-sm font-semibold text-[#4F6854] hover:bg-slate-50 rounded-full transition-colors">Demo</button>
                  <div className="flex-1 px-3 text-[0.8vw] xl:text-sm text-slate-400 font-medium overflow-hidden text-ellipsis whitespace-nowrap">Pusat Layanan...</div>
                  <button className="bg-[#FDB854] hover:bg-[#e89e3a] transition-colors p-[0.6vw] xl:p-2.5 rounded-full text-white shadow-md flex-shrink-0">
                    <Search className="h-[1.1vw] w-[1.1vw] xl:h-5 xl:w-5" />
                  </button>
                </div>

                {/* Trusted */}
                <div className="flex items-center gap-[0.8vw] xl:gap-3">
                  <div className="bg-[#1C2C1F] p-[0.55vw] xl:p-2 rounded-full">
                    <Star className="h-[1.1vw] w-[1.1vw] xl:h-5 xl:w-5 text-[#FDB854] fill-[#FDB854]" />
                  </div>
                  <div>
                    <div className="italic text-[1vw] xl:text-base text-[#1C2C1F] font-medium">Tanpa Kartu Kredit</div>
                    <div className="text-[0.8vw] xl:text-sm font-semibold text-[#4F6854]">Setup 5 Menit</div>
                  </div>
                </div>
              </div>

              {/* Mobile Content */}
              <div className="flex md:hidden absolute top-0 z-20 flex-col px-6 pt-8 pb-6" style={{ width: '100vw', left: '55vw', height: '100%' }}>

                <div className="translate-y-[70px] -translate-x-[10px] mb-[70px]">
                  <h1 className="text-4xl text-[#1C2C1F] font-bold leading-[1.05] mb-3 drop-shadow-sm mt-[5px]">
                    Satu Layar untuk<br/>Semua Saluran.
                  </h1>
                  <p className="text-[#4F6854] text-[15px] font-medium leading-relaxed mb-5 w-[90%]">
                    Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed.
                  </p>
                </div>

                {/* Search Bar */}
                <div className="flex items-center bg-white p-1.5 rounded-full shadow-sm mb-5 border border-[#d2e3c9] w-full max-w-[340px]">
                  <Link to="/harga" className="bg-[#567558] hover:bg-[#415B45] text-white px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap">Coba Gratis</Link>
                  <div className="flex-1 px-3 text-xs text-slate-400 font-medium overflow-hidden text-ellipsis whitespace-nowrap">Pusat Layanan...</div>
                  <button className="bg-[#FDB854] p-2 rounded-full text-white shadow-md shrink-0">
                    <Search className="h-4 w-4" />
                  </button>
                </div>

                {/* Mobile Image Container */}
                <div className="relative mt-auto w-full max-w-[340px] mx-auto shrink-0 h-[200px] rounded-3xl overflow-hidden shadow-xl border border-white/20 -translate-y-[80px] -translate-x-[10px]">
                  <img src="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" className="absolute inset-0 w-full h-full object-cover" alt="Call center agent" />
                  <div className="absolute inset-0 bg-gradient-to-t from-[#1C2C1F]/90 via-[#1C2C1F]/20 to-transparent"></div>
                  
                  <div className="absolute bottom-3 left-3 right-3">
                    <div className="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-3 text-white shadow-lg">
                      <div className="flex items-center gap-2 mb-1">
                        <h4 className="font-medium text-sm text-white">Panggilan Masuk</h4>
                        <div className="bg-[#FDB854] p-1 rounded-full">
                          <Star className="h-3 w-3 text-white fill-white" />
                        </div>
                      </div>
                      <p className="text-xs text-white/90">Budi Santoso - Keluhan Produk</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            {/* Bottom Card */}
            <div className="relative z-20 w-[300vw] -left-[55vw] md:w-full md:left-0 transition-all max-md:!-mt-[9.6vw]" style={{ aspectRatio: '2000.62 / 448.88', marginTop: '-2.99%' }}>
              <svg viewBox="0 0 2000.62 448.88" className="absolute inset-0 w-full h-full text-[#1C2C1F]"
                preserveAspectRatio="xMidYMid meet"
                style={{ filter: 'drop-shadow(-8px 8px 0px #FDB854)' }}>
                <path fill="currentColor" d="M 64 0 L 674.58 0 A 76 76 0 0 1 750.58 76 A 76 76 0 0 0 826.58 152 L 1936.62 152 A 64 64 0 0 1 2000.62 216 L 2000.62 384.88 A 64 64 0 0 1 1936.62 448.88 L 64 448.88 A 64 64 0 0 1 0 384.88 L 0 64 A 64 64 0 0 1 64 0 Z"/>
              </svg>

              {/* Desktop Bottom Card Content */}
              <div className="hidden md:flex absolute inset-0 z-10 items-center justify-between px-[6%]">
                <div className="text-white">
                  <h2 className="text-[2.5vw] xl:text-5xl mb-[1.38vw] xl:mb-5 text-[#EBF4E3] leading-tight">
                    Integrasi<br/><em className="text-[#FDB854] italic">Tanpa Batas</em>
                  </h2>
                  <Link to="/fitur" className="flex items-center w-fit shadow-lg rounded-full bg-[#FDB854] hover:bg-[#e89e3a] transition-all p-[0.27vw] xl:p-1 pr-[0.41vw] xl:pr-1.5 cursor-pointer hover:scale-105">
                    <span className="text-white px-[1.38vw] xl:px-5 py-[0.41vw] xl:py-1.5 font-semibold text-[0.85vw] xl:text-sm">Pelajari</span>
                    <div className="bg-[#e89e3a] text-white p-[0.41vw] xl:p-1.5 rounded-full">
                      <ArrowRight className="h-[1vw] w-[1vw] xl:h-4 xl:w-4" />
                    </div>
                  </Link>
                </div>

                <div className="flex gap-[1.2vw] xl:gap-4" style={{ marginTop: '3.47%' }}>
                  {[
                    { icon: Phone, label: 'Telepon' },
                    { icon: MessageCircle, label: 'WhatsApp' },
                    { icon: Instagram, label: 'Instagram' },
                    { icon: Mail, label: 'Email' }
                  ].map(({ icon: Icon, label }) => (
                    <div key={label} className="border border-[#2C4131] rounded-[1.11vw] xl:rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/80">
                      <Icon className="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-[#FDB854] mb-[0.55vw] xl:mb-2 group-hover:scale-110 transition-transform" />
                      <span className="text-[0.75vw] xl:text-xs text-slate-200 font-medium">{label}</span>
                    </div>
                  ))}
                </div>
              </div>

              {/* Mobile Bottom Card Content */}
              <div className="flex md:hidden absolute top-[15%] z-10 flex-col justify-center px-6 -translate-y-[10px] -translate-x-[20px]" style={{ width: '100vw', left: '55vw', height: '85%' }}>
                <div className="text-white mb-5">
                  <h2 className="text-3xl mb-3 text-[#EBF4E3] leading-tight">
                    Integrasi<br/><em className="text-[#FDB854] italic">Tanpa Batas</em>
                  </h2>
                  <Link to="/fitur" className="flex items-center w-fit shadow-lg rounded-full bg-[#FDB854] transition-all p-1 pr-1.5">
                    <span className="text-white px-4 py-1 font-semibold text-xs">Pelajari Lebih Lanjut</span>
                    <div className="bg-[#e89e3a] text-white p-1 rounded-full">
                      <ArrowRight className="h-3 w-3" />
                    </div>
                  </Link>
                </div>

                <div className="flex gap-3 overflow-x-auto pb-4 pt-2 -mx-2 px-2 w-[100vw] snap-x snap-mandatory scroll-smooth hide-scrollbar" style={{ scrollbarWidth: 'none' }}>
                  {[
                    { icon: Phone, label: 'Telepon' },
                    { icon: MessageCircle, label: 'WhatsApp' },
                    { icon: Instagram, label: 'Instagram' },
                    { icon: Mail, label: 'Email' }
                  ].map(({ icon: Icon, label }) => (
                    <div key={label} className="border border-[#EBF4E3]/30 rounded-xl p-3 min-w-[28vw] snap-center flex flex-col items-center justify-center text-center bg-[#7A9E7E] shrink-0 shadow-sm">
                      <Icon className="h-6 w-6 text-[#FDB854] mb-2 drop-shadow-sm" />
                      <span className="text-xs text-white font-medium">{label}</span>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section Harmonized with OmniServe Colors */}
      <section className="py-20 bg-[#1C2C1F] relative overflow-hidden">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-[#415B45]/40 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        <div className="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#FDB854]/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>

        <div className="max-w-4xl mx-auto px-4 text-center relative z-10">
          <h2 className="text-3xl md:text-5xl font-bold text-white mb-6">Siap Mengubah Cara Anda Melayani?</h2>
          <p className="text-[#EBF4E3] text-xl mb-10 max-w-2xl mx-auto opacity-90">
            Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi pusat layanan pelanggan mereka dengan OmniServe.
          </p>
          <div className="flex flex-col sm:flex-row justify-center gap-4">
            <Link to="/harga" className="bg-[#FDB854] text-white hover:bg-[#e89e3a] px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
              Mulai Uji Coba Gratis
            </Link>
            <button className="bg-transparent text-white hover:bg-white/10 border border-white/30 px-8 py-4 rounded-full font-bold text-lg transition-all">
              Hubungi Sales Kami
            </button>
          </div>
        </div>
      </section>

      <CustomersSection />
    </>
  );
}
