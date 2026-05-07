import { CheckCircle2, BarChart3, TrendingUp, Users } from 'lucide-react';
import { Link } from 'react-router';

export function Analitik() {
  return (
    <div className="flex-1 bg-[#F4F9F0] w-full">
      {/* Header Area */}
      <div className="bg-[#1C2C1F] py-20 relative overflow-hidden">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-[#415B45]/40 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        <div className="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#FDB854]/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
        
        <div className="max-w-7xl mx-auto px-6 relative z-10 text-center">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FDB854]/20 border border-[#FDB854]/30 text-[#FDB854] mb-6">
            <BarChart3 className="w-4 h-4" />
            <span className="text-sm font-semibold tracking-wide uppercase">Analitik Data</span>
          </div>
          <h1 className="text-4xl md:text-6xl font-bold text-white mb-6">
            Berhenti Sekadar Merespon.<br />
            <span className="text-[#FDB854]">Ubah Interaksi Menjadi Data.</span>
          </h1>
          <p className="text-[#EBF4E3] text-lg md:text-xl max-w-2xl mx-auto">
            Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan.
          </p>
        </div>
      </div>

      {/* Main Content Area */}
      <section className="py-24">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid lg:grid-cols-2 gap-16 items-center">
            <div className="order-2 lg:order-1 relative">
              <div className="absolute -inset-4 bg-[#7A9E7E]/20 rounded-[2.5rem] transform -rotate-2"></div>
              <img
                src="https://images.unsplash.com/photo-1759752394755-1241472b589d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxkYXRhJTIwYW5hbHl0aWNzJTIwZGFzaGJvYXJkJTIwc2NyZWVufGVufDF8fHx8MTc3ODE0NTkwNnww&ixlib=rb-4.1.0&q=80&w=1080"
                alt="Data Analytics"
                className="relative rounded-2xl shadow-2xl border border-white/50 object-cover h-[450px] w-full"
              />
            </div>
            
            <div className="order-1 lg:order-2 space-y-8">
              <h2 className="text-3xl font-bold leading-tight text-[#1C2C1F]">
                Wawasan Real-Time untuk Keputusan Bisnis Cerdas
              </h2>
              <p className="text-[#4F6854] text-lg leading-relaxed">
                Platform analitik kami dirancang khusus untuk memantau sentimen pelanggan dan mengukur produktivitas agen secara komprehensif.
              </p>
              
              <ul className="space-y-4 pt-4">
                {[
                  'Identifikasi tren keluhan sebelum menjadi krisis',
                  'Ukur kinerja agen secara objektif dengan metrik akurat',
                  'Pahami preferensi saluran komunikasi pelanggan Anda',
                  'Prediksi lonjakan panggilan berdasarkan riwayat data'
                ].map((item) => (
                  <li key={item} className="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-[#d2e3c9]">
                    <div className="bg-[#EBF4E3] p-1.5 rounded-full mt-0.5 shrink-0">
                      <CheckCircle2 className="h-5 w-5 text-[#415B45]" />
                    </div>
                    <span className="text-[#1C2C1F] font-medium">{item}</span>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* Metrics Section */}
      <section className="bg-white py-24 border-t border-[#d2e3c9]">
        <div className="max-w-7xl mx-auto px-6">
          <div className="text-center mb-16">
            <h2 className="text-3xl font-bold text-[#1C2C1F] mb-4">Metrik Utama yang Dipantau</h2>
            <p className="text-[#4F6854]">Segala indikator kinerja kunci (KPI) pusat layanan dalam satu layar.</p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8">
            {[
              { title: 'Customer Satisfaction (CSAT)', val: '98%', desc: 'Tingkat kepuasan rata-rata dari interaksi', icon: Users },
              { title: 'First Contact Resolution', val: '85%', desc: 'Persentase masalah yang diselesaikan di kontak pertama', icon: CheckCircle2 },
              { title: 'Average Handling Time', val: '3.2m', desc: 'Waktu rata-rata penyelesaian masalah pelanggan', icon: TrendingUp }
            ].map((metric) => (
              <div key={metric.title} className="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] text-center hover:-translate-y-1 transition-transform">
                <div className="bg-[#FDB854] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-md">
                  <metric.icon className="w-6 h-6" />
                </div>
                <h3 className="text-[#4F6854] font-medium mb-2">{metric.title}</h3>
                <div className="text-4xl font-bold text-[#1C2C1F] mb-3">{metric.val}</div>
                <p className="text-sm text-[#4F6854]/80">{metric.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
      
      {/* Mini CTA */}
      <section className="bg-[#7A9E7E] py-16 text-center">
        <h2 className="text-2xl font-bold text-white mb-6">Mulai Gunakan Analisis Data Hari Ini</h2>
        <Link to="/harga" className="inline-block bg-[#FDB854] text-white px-8 py-3 rounded-full font-bold hover:bg-[#e89e3a] transition-colors shadow-lg">
          Lihat Paket Harga
        </Link>
      </section>
    </div>
  );
}