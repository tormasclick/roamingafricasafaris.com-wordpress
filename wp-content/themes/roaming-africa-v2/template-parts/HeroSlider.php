import { useEffect, useState } from "react";
import { MessageCircle, ChevronDown, Send } from "lucide-react";
import { Link } from "react-router-dom";
import { whatsappLink } from "@/data/constants";
import masaiMara from "@/assets/destinations/masai-mara.jpg";
import amboseli from "@/assets/destinations/amboseli.jpg";
import zanzibar from "@/assets/destinations/zanzibar.jpg";
import ngorongoro from "@/assets/destinations/ngorongoro.jpg";

const slides = [
  {
    image: masaiMara,
    title: "Welcome to Roaming Africa Tours & Safaris",
    sub: "Leading DMC (Destination Management Company) and Tour Operator for Kenya, Tanzania and Zanzibar",
  },
  {
    image: amboseli,
    title: "Elephants Under Kilimanjaro",
    sub: "Amboseli National Park · Luxury Lodges",
  },
  {
    image: ngorongoro,
    title: "Tanzania Wildlife, Curated by Locals",
    sub: "Serengeti · Ngorongoro Crater",
  },
  {
    image: zanzibar,
    title: "Zanzibar Beaches, Effortlessly Planned",
    sub: "Beach Resorts · Stone Town · Spice Tours",
  },
];

const HeroSlider = () => {
  const [index, setIndex] = useState(0);

  useEffect(() => {
    const id = setInterval(() => setIndex((i) => (i + 1) % slides.length), 5000);
    return () => clearInterval(id);
  }, []);

  const scrollDown = () =>
    document.getElementById("safari-planner")?.scrollIntoView({ behavior: "smooth" });

  return (
    <section className="relative min-h-[55vh] md:min-h-[72vh] flex items-center justify-center overflow-hidden">
      {slides.map((s, i) => (
        <img
          key={i}
          src={s.image}
          alt={s.title}
          className={`absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ${
            i === index ? "opacity-100" : "opacity-0"
          }`}
          loading={i === 0 ? "eager" : "lazy"}
        />
      ))}

      <div className="absolute inset-0 bg-gradient-to-t from-black/75 via-black/35 to-black/55" />

      <div className="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <h1
          key={index}
          className="text-primary-foreground mb-3 animate-fade-in-up text-3xl md:text-5xl lg:text-6xl"
        >
          {slides[index].title}
        </h1>
        <p className="text-sm md:text-base text-primary-foreground/90 mb-6 max-w-xl mx-auto font-body">
          {slides[index].sub}
        </p>
        <div className="flex flex-wrap gap-3 justify-center">
          <Link
            to="/kenya-safaris"
            className="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-lg font-heading font-semibold text-sm shadow-md transition-all"
          >
            <Send className="w-4 h-4" /> Plan My Safari →
          </Link>
          <a
            href={whatsappLink("Hi! I'd like to plan a safari with Roaming Africa Tours.")}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-lg font-heading font-semibold text-sm hover:brightness-110 transition-all shadow-md"
          >
            <MessageCircle className="w-4 h-4" /> WhatsApp
          </a>
        </div>

        {/* Slide indicators */}
        <div className="mt-6 flex justify-center gap-2">
          {slides.map((_, i) => (
            <button
              key={i}
              onClick={() => setIndex(i)}
              aria-label={`Slide ${i + 1}`}
              className={`h-1.5 rounded-full transition-all ${
                i === index ? "w-8 bg-accent" : "w-3 bg-white/50 hover:bg-white/80"
              }`}
            />
          ))}
        </div>
      </div>

      <button
        onClick={scrollDown}
        className="absolute bottom-5 left-1/2 -translate-x-1/2 z-10 text-white/80 hover:text-white animate-bounce"
        aria-label="Scroll down"
      >
        <ChevronDown className="w-6 h-6" />
      </button>
    </section>
  );
};

export default HeroSlider;
