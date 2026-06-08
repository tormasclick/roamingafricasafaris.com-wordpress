import { Link } from "react-router-dom";
import { whatsappLink } from "@/data/constants";
import { MessageCircle } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import SafariCard from "@/components/SafariCard";
import { getPackagesByCountry } from "@/data/safariPackages";
import { getDestinationImage } from "@/data/images";

const faqs = [
  { q: "Do I need two separate visas for a Kenya-Tanzania combo safari?", a: "Yes, you need a Kenya e-visa ($51) and a separate Tanzania single-entry visa ($50). We advise on all visa requirements at booking." },
  { q: "How do we cross the border between Kenya and Tanzania?", a: "We use the Namanga border crossing, a major and well-managed crossing. Your guide handles all paperwork and the crossing typically takes 30–60 minutes." },
  { q: "Is it possible to fly between Kenya and Tanzania rather than driving?", a: "Yes, flights between Nairobi, Kilimanjaro Airport, and Arusha are available and can replace long road transfers." },
  { q: "Can we start this combo safari in Tanzania?", a: "Yes, both directions are available — start in either Nairobi or Arusha." },
  { q: "What is included in the combo safari price?", a: "All combo safaris include 4×4 safari vehicle, professional driver guide, full board accommodation, all meals, park fees for both countries, and border crossing assistance." },
];

const ComboSafaris = () => {
  const combos = getPackagesByCountry("combo");

  return (
    <>
      <SEO
        title="Kenya & Tanzania Combo Safaris | Two Countries, One Epic Safari"
        description="Experience the ultimate East African adventure with Kenya-Tanzania combo safaris. Masai Mara, Serengeti, Ngorongoro & more in one seamless journey."
        canonical="https://roamingafricatours.com/combo-safaris"
      />

      <PageHero>
        <h1 className="text-primary-foreground">Kenya & Tanzania Combo Safaris</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Combo Safaris" }]} />
      </div>

      <div className="container mx-auto px-4 py-12 space-y-10">
        <div className="max-w-4xl">
          <h2 className="mb-4">Two countries, one epic safari — Kenya and Tanzania combined.</h2>
          <p className="text-muted-foreground leading-relaxed">
            Experience the ultimate East African adventure with our Kenya-Tanzania Combo Safaris, seamlessly blending the best of both countries' iconic wildlife, landscapes, and cultures in one unforgettable journey. Start in Kenya's Masai Mara and cross into Tanzania's Serengeti, or begin in Tanzania and finish in Kenya. Our combo safaris are the best way to witness the Great Wildebeest Migration on both sides of the border.
          </p>
        </div>

        {combos.length > 0 && (
          <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {combos.map((pkg) => <SafariCard key={pkg.id} pkg={pkg} />)}
          </div>
        )}

        <section>
          <h2 className="mb-6">Frequently Asked Questions</h2>
          <div className="space-y-4">
            {faqs.map((f) => (
              <div key={f.q} className="bg-card border border-border rounded-lg p-5">
                <h3 className="text-base mb-2">{f.q}</h3>
                <p className="text-muted-foreground text-sm">{f.a}</p>
              </div>
            ))}
          </div>
        </section>

        <div className="section-brown rounded-xl p-10 text-center">
          <h2 className="mb-4">Want a Custom Combo Safari?</h2>
          <p className="opacity-80 mb-6">We can create a bespoke itinerary combining any destinations across East Africa.</p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link to="/booking" className="bg-accent text-accent-foreground px-8 py-3 rounded-full font-heading font-bold hover:brightness-110 transition-all shadow-md">Make a Booking</Link>
            <a href={whatsappLink("Hi! I'm interested in a combo Kenya-Tanzania safari.")} target="_blank" rel="noopener noreferrer" className="whatsapp-btn justify-center rounded-full">
              <MessageCircle className="w-5 h-5" /> Chat on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </>
  );
};

export default ComboSafaris;
