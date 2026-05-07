import { Check } from 'lucide-react';

export function Harga() {
  const plans = [
    {
      name: 'Starter',
      price: 'Rp 299.000',
      period: '/agen/bulan',
      desc: 'Sempurna untuk tim kecil yang baru memulai layanan pelanggan digital.',
      color: 'bg-white',
      textColor: 'text-[#1C2C1F]',
      btnColor: 'bg-[#EBF4E3] text-[#415B45] hover:bg-[#d2e3c9]',
      features: [
        'Hingga 5 saluran komunikasi',
        'Kotak masuk terpusat',
        'Laporan standar',
        'Dukungan email 24/7'
      ]
    },
    {
      name: 'Pro',
      price: 'Rp 799.000',
      period: '/agen/bulan',
      desc: 'Fitur lanjutan untuk tim yang sedang berkembang pesat.',
      color: 'bg-[#1C2C1F]',
      textColor: 'text-white',
      btnColor: 'bg-[#FDB854] text-white hover:bg-[#e89e3a]',
      popular: true,
      features: [
        'Semua saluran tidak terbatas',
        'Otomatisasi & Routing (ACD)',
        'Analitik Real-time & Custom',
        'Prioritas dukungan live chat',
        'Integrasi CRM (Salesforce, dll)'
      ]
    },
    {
      name: 'Enterprise',
      price: 'Custom',
      period: '',
      desc: 'Skalabilitas dan keamanan maksimal untuk korporasi besar.',
      color: 'bg-[#F4F9F0]',
      textColor: 'text-[#1C2C1F]',
      btnColor: 'bg-[#415B45] text-white hover:bg-[#2C4131]',
      features: [
        'SLA 99.9% Uptime',
        'Dedicated Account Manager',
        'Keamanan berbasis peran (RBAC)',
        'On-premise deployment option',
        'Pelatihan agen eksklusif'
      ]
    }
  ];

  return (
    <div className="flex-1 bg-white w-full">
      <div className="py-20 text-center max-w-3xl mx-auto px-6">
        <h1 className="text-4xl md:text-5xl font-bold text-[#1C2C1F] mb-6">
          Harga Transparan, <span className="text-[#7A9E7E]">Tanpa Biaya Tersembunyi</span>
        </h1>
        <p className="text-[#4F6854] text-lg">
          Pilih paket yang paling sesuai dengan kebutuhan pusat layanan pelanggan Anda. Semua paket dilengkapi dengan uji coba gratis 14 hari.
        </p>
      </div>

      <div className="max-w-7xl mx-auto px-6 pb-24">
        <div className="grid md:grid-cols-3 gap-8 items-stretch">
          {plans.map((plan) => (
            <div 
              key={plan.name} 
              className={`${plan.color} ${plan.textColor} rounded-3xl p-8 border ${plan.popular ? 'border-[#FDB854] shadow-2xl relative transform md:-translate-y-4' : 'border-[#d2e3c9] shadow-md'} flex flex-col`}
            >
              {plan.popular && (
                <div className="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#FDB854] text-white px-4 py-1 rounded-full text-sm font-bold shadow-md">
                  Paling Populer
                </div>
              )}
              
              <h3 className="text-2xl font-bold mb-2">{plan.name}</h3>
              <p className={`mb-6 text-sm ${plan.popular ? 'text-white/80' : 'text-[#4F6854]'}`}>{plan.desc}</p>
              
              <div className="mb-8">
                <span className="text-4xl font-extrabold">{plan.price}</span>
                <span className={`text-sm font-medium ${plan.popular ? 'text-white/80' : 'text-[#415B45]'}`}>{plan.period}</span>
              </div>
              
              <ul className="space-y-4 mb-8 flex-1">
                {plan.features.map((feat) => (
                  <li key={feat} className="flex items-start gap-3">
                    <Check className={`w-5 h-5 shrink-0 ${plan.popular ? 'text-[#FDB854]' : 'text-[#7A9E7E]'}`} />
                    <span className="font-medium text-sm md:text-base">{feat}</span>
                  </li>
                ))}
              </ul>
              
              <button className={`w-full py-4 rounded-xl font-bold transition-all ${plan.btnColor}`}>
                {plan.name === 'Enterprise' ? 'Hubungi Sales' : 'Mulai Uji Coba Gratis'}
              </button>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}