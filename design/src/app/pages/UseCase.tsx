import { Building2, ShoppingBag, Stethoscope, Briefcase } from 'lucide-react';
import { Link } from 'react-router';

export function UseCase() {
  return (
    <div className="flex-1 bg-white w-full">
      {/* Header Area */}
      <div className="bg-[#7A9E7E] py-24 relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-6 text-center relative z-10">
          <h1 className="text-4xl md:text-5xl font-bold text-white mb-6 drop-shadow-sm">
            Solusi <span className="text-[#FDB854]">Untuk Setiap Industri</span>
          </h1>
          <p className="text-[#EBF4E3] text-lg md:text-xl max-w-2xl mx-auto drop-shadow-sm">
            Pelajari bagaimana perusahaan di berbagai sektor menggunakan OmniServe untuk mentransformasi pengalaman pelanggan mereka.
          </p>
        </div>
        
        {/* Background shapes */}
        <div className="absolute top-10 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div className="absolute bottom-10 right-10 w-80 h-80 bg-[#1C2C1F]/20 rounded-full blur-3xl"></div>
      </div>

      {/* Use Cases Section */}
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-6">
          <div className="grid md:grid-cols-2 gap-12">
            
            {/* E-Commerce */}
            <div className="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-[#d2e3c9]">
              <div className="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
                <ShoppingBag className="w-10 h-10 text-[#FDB854]" />
              </div>
              <div>
                <h3 className="text-2xl font-bold text-[#1C2C1F] mb-3">E-Commerce & Ritel</h3>
                <p className="text-[#4F6854] mb-4">
                  Atasi lonjakan permintaan selama flash sale atau Harbolnas tanpa membuat pelanggan menunggu. Integrasikan status pengiriman secara langsung ke layar agen.
                </p>
                <ul className="list-disc list-inside text-[#415B45] space-y-1 ml-4 text-sm font-medium">
                  <li>Tingkatkan resolusi chat WhatsApp hingga 40%</li>
                  <li>Kurangi pengabaian keranjang belanja</li>
                </ul>
              </div>
            </div>

            {/* Financial */}
            <div className="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-[#d2e3c9]">
              <div className="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
                <Building2 className="w-10 h-10 text-[#415B45]" />
              </div>
              <div>
                <h3 className="text-2xl font-bold text-[#1C2C1F] mb-3">Layanan Keuangan</h3>
                <p className="text-[#4F6854] mb-4">
                  Keamanan setara perbankan untuk menangani informasi sensitif nasabah. Verifikasi identitas yang aman dan alur kerja pengaduan terstruktur.
                </p>
                <ul className="list-disc list-inside text-[#415B45] space-y-1 ml-4 text-sm font-medium">
                  <li>Kepatuhan penuh pada regulasi privasi data</li>
                  <li>Prioritas routing untuk nasabah VIP</li>
                </ul>
              </div>
            </div>

            {/* Healthcare */}
            <div className="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-[#d2e3c9]">
              <div className="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
                <Stethoscope className="w-10 h-10 text-[#7A9E7E]" />
              </div>
              <div>
                <h3 className="text-2xl font-bold text-[#1C2C1F] mb-3">Layanan Kesehatan</h3>
                <p className="text-[#4F6854] mb-4">
                  Permudah penjadwalan janji temu, konfirmasi asuransi, hingga konsultasi telemedis darurat tanpa membuat antrean telepon menumpuk.
                </p>
                <ul className="list-disc list-inside text-[#415B45] space-y-1 ml-4 text-sm font-medium">
                  <li>Notifikasi pengingat via WhatsApp Otomatis</li>
                  <li>Pusat panggilan 24/7 tanpa henti</li>
                </ul>
              </div>
            </div>

            {/* B2B Services */}
            <div className="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-[#d2e3c9]">
              <div className="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
                <Briefcase className="w-10 h-10 text-[#1C2C1F]" />
              </div>
              <div>
                <h3 className="text-2xl font-bold text-[#1C2C1F] mb-3">Layanan B2B</h3>
                <p className="text-[#4F6854] mb-4">
                  Bangun relasi mendalam dengan klien bisnis Anda melalui manajemen SLA (Service Level Agreement) yang presisi dan resolusi dukungan teknis tingkat tinggi.
                </p>
                <ul className="list-disc list-inside text-[#415B45] space-y-1 ml-4 text-sm font-medium">
                  <li>Manajemen SLA multi-tier</li>
                  <li>Eskalasi tiket cerdas ke tim teknis</li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </section>

      {/* Mini CTA */}
      <section className="bg-[#1C2C1F] py-16 text-center border-t border-[#415B45]">
        <h2 className="text-2xl font-bold text-[#EBF4E3] mb-6">Punya studi kasus khusus?</h2>
        <Link to="/harga" className="inline-block bg-[#FDB854] text-[#1C2C1F] px-8 py-3 rounded-full font-bold hover:bg-[#e89e3a] hover:text-white transition-colors shadow-lg">
          Konsultasi Gratis dengan Tim Kami
        </Link>
      </section>
    </div>
  );
}