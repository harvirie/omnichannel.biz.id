import Slider from 'react-slick';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

const customers = [
  {
    id: 1,
    name: "Kantor Imigrasi Tangerang",
    description: "Meningkatkan efisiensi layanan keimigrasian melalui integrasi saluran komunikasi terpusat untuk masyarakat.",
    image: "https://images.unsplash.com/photo-1636217432188-3a81bccad020?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxnb3Zlcm5tZW50JTIwb2ZmaWNlJTIwYnVpbGRpbmd8ZW58MXx8fHwxNzc4MTcyNDE5fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
  },
  {
    id: 2,
    name: "Kantor Imigrasi Bogor",
    description: "Mempercepat respons aduan dan permohonan paspor warga berkat fitur omnichannel dan analitik cerdas.",
    image: "https://images.unsplash.com/photo-1770775776141-6b3ac7ef9dd3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBpbW1pZ3JhdGlvbiUyMG9mZmljZXxlbnwxfHx8fDE3NzgxNzI0MjB8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
  },
  {
    id: 3,
    name: "ADHIMIX",
    description: "Mendigitalisasi koordinasi tim lapangan dan dukungan klien dengan performa stabil 24/7 di semua proyek.",
    image: "https://images.unsplash.com/photo-1766898211749-00820c5dc505?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjb25jcmV0ZSUyMG1peGVyJTIwY29uc3RydWN0aW9ufGVufDF8fHx8MTc3ODE3MjQxOXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
  },
  {
    id: 4,
    name: "PSC 119 Dinkes Kab. Bandung",
    description: "Mengamankan jalur komunikasi gawat darurat medis dengan stabilitas tanpa batas dan navigasi responsif yang andal.",
    image: "https://images.unsplash.com/photo-1721411480070-fcb558776d54?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbWVyZ2VuY3klMjBtZWRpY2FsJTIwYW1idWxhbmNlfGVufDF8fHx8MTc3ODE3MjQyMHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
  }
];

function NextArrow(props: any) {
  const { onClick } = props;
  return (
    <button 
      onClick={onClick}
      className="absolute top-1/2 -right-4 md:-right-12 -translate-y-1/2 z-10 bg-[#FDB854] hover:bg-[#e89e3a] transition-all text-white p-2 md:p-3 rounded-full shadow-lg"
    >
      <ChevronRight className="h-5 w-5 md:h-6 md:w-6" />
    </button>
  );
}

function PrevArrow(props: any) {
  const { onClick } = props;
  return (
    <button 
      onClick={onClick}
      className="absolute top-1/2 -left-4 md:-left-12 -translate-y-1/2 z-10 bg-[#FDB854] hover:bg-[#e89e3a] transition-all text-white p-2 md:p-3 rounded-full shadow-lg"
    >
      <ChevronLeft className="h-5 w-5 md:h-6 md:w-6" />
    </button>
  );
}

export function CustomersSection() {
  const settings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    nextArrow: <NextArrow />,
    prevArrow: <PrevArrow />,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false // Disable arrows on mobile to prefer swiping and dots
        }
      }
    ]
  };

  return (
    <section className="py-24 bg-[#EBF4E3] relative">
      <div className="max-w-6xl mx-auto px-6 md:px-12 relative z-10">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-5xl font-bold text-[#1C2C1F] mb-4">Dipercaya Oleh Berbagai Instansi</h2>
          <p className="text-[#4F6854] text-lg max-w-2xl mx-auto">
            Kami bangga dapat mendukung pelayanan terbaik yang diberikan oleh mitra dan pelanggan kami.
          </p>
        </div>

        <div className="relative px-2 md:px-0 pb-12">
          <Slider {...settings}>
            {customers.map((customer) => (
              <div key={customer.id} className="p-3">
                <div className="bg-white rounded-3xl overflow-hidden shadow-lg border border-[#d2e3c9] h-full flex flex-col group hover:-translate-y-2 transition-all duration-300">
                  <div className="relative h-48 overflow-hidden">
                    <img 
                      src={customer.image} 
                      alt={customer.name} 
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-[#1C2C1F]/80 to-transparent"></div>
                    <div className="absolute bottom-4 left-4 right-4">
                      <h3 className="text-white font-bold text-xl leading-tight drop-shadow-md">{customer.name}</h3>
                    </div>
                  </div>
                  <div className="p-6 flex-1 flex flex-col">
                    <p className="text-[#4F6854] text-sm leading-relaxed flex-1">
                      {customer.description}
                    </p>
                  </div>
                </div>
              </div>
            ))}
          </Slider>
        </div>
      </div>
      
      {/* Custom styles to adjust slick dots color to fit the theme */}
      <style dangerouslySetInnerHTML={{__html: `
        .slick-dots li button:before {
          color: #4F6854 !important;
          opacity: 0.25;
          font-size: 10px;
        }
        .slick-dots li.slick-active button:before {
          color: #FDB854 !important;
          opacity: 1;
        }
      `}} />
    </section>
  );
}