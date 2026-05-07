import { Globe, Zap, BarChart3, ShieldCheck, MessageSquare, Headphones } from 'lucide-react';
import { Link } from 'react-router';

export function Fitur() {
  return (
    <div className="flex-1 bg-white w-full">
      {/* Header Area */}
      <div className="bg-[#EBF4E3] py-20 border-b border-[#d2e3c9]">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <h1 className="text-4xl md:text-5xl font-bold text-[#1C2C1F] mb-6">
            Fitur <span className="text-[#415B45]">OmniServe</span>
          </h1>
          <p className="text-[#4F6854] text-lg md:text-xl max-w-2xl mx-auto">
            Sistem canggih yang dibuat sederhana. Desain antarmuka intuitif memastikan tim Anda langsung bekerja tanpa pelatihan panjang.
          </p>
        </div>
      </div>

      {/* Main Features Grid */}
      <section className="py-24">
        <div className="max-w-7xl mx-auto px-6">
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {[
              {
                icon: Globe,
                title: 'Integrasi Semua Channel',
                description: 'Telepon, WhatsApp, Instagram, Email, dan Live Chat dalam satu kotak masuk (inbox). Agen tidak perlu berpindah tab.'
              },
              {
                icon: Zap,
                title: 'Otomatisasi Cerdas (ACD)',
                description: 'Distribusikan tiket secara otomatis ke agen yang paling tepat berdasarkan keahlian atau beban kerja saat ini.'
              },
              {
                icon: BarChart3,
                title: 'Laporan Siap Pakai',
                description: 'Hasilkan laporan kinerja harian, mingguan, hingga bulanan hanya dengan satu klik. Ekspor dalam PDF atau Excel.'
              },
              {
                icon: ShieldCheck,
                title: 'Keamanan Data Enterprise',
                description: 'Enkripsi end-to-end, kepatuhan GDPR, dan manajemen akses berbasis peran (RBAC) untuk melindungi data pelanggan.'
              },
              {
                icon: MessageSquare,
                title: 'Templat Balasan Cepat',
                description: 'Simpan jawaban untuk pertanyaan yang sering diajukan (FAQ) agar agen merespons lebih cepat dan konsisten.'
              },
              {
                icon: Headphones,
                title: 'Pemantauan Panggilan',
                description: 'Supervisor dapat mendengarkan panggilan secara real-time (barge-in) atau memberi arahan tersembunyi (whisper).'
              }
            ].map(({ icon: Icon, title, description }) => (
              <div key={title} className="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
                <div className="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <Icon className="h-7 w-7 text-[#FDB854]" />
                </div>
                <h4 className="text-xl font-bold text-[#1C2C1F] mb-4">{title}</h4>
                <p className="text-[#4F6854] leading-relaxed">{description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Integration Banner */}
      <section className="py-20 bg-[#1C2C1F] text-white text-center px-6">
        <h2 className="text-3xl md:text-4xl font-bold mb-6 text-[#EBF4E3]">Mudah Diintegrasikan dengan Tools Anda</h2>
        <p className="text-white/80 max-w-2xl mx-auto mb-10">
          OmniServe menyediakan lebih dari 50+ integrasi langsung dengan CRM, ERP, dan aplikasi produktivitas populer seperti Salesforce, Zendesk, Slack, dan lainnya.
        </p>
        <Link to="/use-case" className="inline-block bg-white text-[#1C2C1F] px-8 py-3 rounded-full font-bold hover:bg-[#FDB854] hover:text-white transition-colors shadow-lg">
          Lihat Studi Kasus
        </Link>
      </section>
    </div>
  );
}