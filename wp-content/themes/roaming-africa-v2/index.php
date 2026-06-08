import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { Search, MapPin, Calendar, Users, Clock, Compass, Shield, Award, Headphones, ArrowRight, MessageCircle, CheckCircle, Bed, Truck } from "lucide-react";
import { getFeaturedPackages, getDayTrips } from "@/data/safariPackages";
import { destinations } from "@/data/destinations";
import { getDestinationImage } from "@/data/images";
import { whatsappLink, COMPANY } from "@/data/constants";
import { hotels } from "@/data/hotels";
import { vehicles } from "@/data/vehicles";
import SafariCard from "@/components/SafariCard";
import HeroSlider from "@/components/HeroSlider";
import SafariHighlights from "@/components/SafariHighlights";
import SEO from "@/components/SEO";
import { format } from "date-fns";
import { cn } from "@/lib/utils";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { Calendar as CalendarWidget } from "@/components/ui/calendar";
import { Button } from "@/components/ui/button";

import tripadvisor from "@/assets/partners/tripadvisor.png";
import safaribookings from "@/assets/partners/safaribookings.png";
import touristlink from "@/assets/partners/touristlink.png";
import magicalkenya from "@/assets/partners/magicalkenya.png";
import safarideal from "@/assets/partners/safarideal.png";
import tanzaniatourism from "@/assets/partners/tanzaniatourism.png";
import tra from "@/assets/partners/tra.png";
import eawls from "@/assets/partners/eawls.png";
import yourafricansafari from "@/assets/partners/yourafricansafari.png";

const featured = getFeaturedPackages();
const topDestinations = destinations.slice(0, 8);

const partners = [
  { name: "TripAdvisor", img: tripadvisor },
  { name: "SafariBookings", img: safaribookings },
  { name: "TouristLink", img: touristlink },
  { name: "Magical Kenya", img: magicalkenya },
  { name: "SafariDeal", img: safarideal },
  { name: "Tanzania Tourism Board", img: tanzaniatourism },
  { name: "Tourism Regulatory Authority", img: tra },
  { name: "East African Wild Life Society", img: eawls },
  { name: "Your African Safari", img: yourafricansafari },
];

const jsonLd = {
  "@context": "https://schema.org",
  "@type": "TravelAgency",
  name: "Roaming Africa Tours and Safaris",
  url: "https://roamingafricatours.com",
  telephone: "+254722433910",
  email: "info@roamingafricatours.com",
  address: {
    "@type": "PostalAddress",
    streetAddress: "2nd Floor, Country Arcade, Ngong Road",
    addressLocality: "Nairobi",
    postalCode: "40-50105",
    addressCountry: "KE",
  },
  description: "Leading Destination Management Company (DMC) for Kenya, Tanzania, and Zanzibar safari tours.",
  sameAs: [
    "https://www.facebook.com/roamingafricatours",
    "https://x.com/roamingafricatours",
    "https://www.instagram.com/roamingafricatours",
    "https://www.youtube.com/roamingafricatours",
  ],
};

const TRAVEL_CATEGORIES: { label: string; href: string }[] = [
  { label: "Kenya Safari", href: "/kenya-safaris" },
  { label: "Tanzania Safari", href: "/tanzania-safaris" },
  { label: "Zanzibar Beach Holiday", href: "/tanzania-safaris/zanzibar" },
  { label: "Kenya & Tanzania Combined Safari", href: "/combo-safaris" },
  { label: "Mombasa Beach Holiday", href: "/kenya-safaris/mombasa-shore-excursions" },
  { label: "Diani Beach Holiday", href: "/hotels/kenya/diani" },
  { label: "Watamu Beach Holiday", href: "/hotels/kenya/watamu" },
  { label: "Malindi Beach Holiday", href: "/hotels/kenya/malindi" },
];

const Index = () => {
  const navigate = useNavigate();
  const [plannerDate, setPlannerDate] = useState<Date>();
  const [plannerDest, setPlannerDest] = useState("");
  const [plannerAdults, setPlannerAdults] = useState("2");
  const [plannerChildren, setPlannerChildren] = useState("0");

  const handleCheckAvailability = () => {
    const cat = TRAVEL_CATEGORIES.find((c) => c.label === plannerDest);
    if (cat) {
      navigate(cat.href);
      return;
    }
    const params = new URLSearchParams();
    if (plannerDest) params.set("destination", plannerDest);
    if (plannerDate) params.set("date", format(plannerDate, "yyyy-MM-dd"));
    if (plannerAdults) params.set("adults", plannerAdults);
    if (plannerChildren) params.set("children", plannerChildren);
    navigate(`/booking?${params.toString()}`);
  };

  return (
    <>
      <SEO
        title="Best African Safari Tours & Holiday Packages"
        description="Roaming Africa Tours & Safaris offers expertly planned safari holidays across Kenya and Tanzania. Book Masai Mara, Serengeti, Amboseli, Ngorongoro, Zanzibar beach holidays and more."
        jsonLd={jsonLd}
      />

      {/* HERO SLIDER */}
      <HeroSlider />

      {/* SAFARI PLANNER */}
      <section id="safari-planner" className="relative -mt-10 z-20 px-4">
        <div className="container mx-auto max-w-5xl bg-popover rounded-2xl shadow-2xl p-6 border border-border">
          <h2 className="text-xl text-center mb-4 font-heading font-bold">Plan Your Safari</h2>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div className="flex flex-col">
              <label className="text-xs font-heading font-bold text-muted-foreground mb-1">Destination</label>
              <div className="flex items-center gap-2 border border-border rounded-lg px-3 py-2.5 bg-background">
                <MapPin className="w-4 h-4 text-primary flex-shrink-0" />
                <select value={plannerDest} onChange={(e) => setPlannerDest(e.target.value)} className="text-sm bg-transparent outline-none w-full">
                  <option value="">Choose a holiday type</option>
                  {TRAVEL_CATEGORIES.map((c) => (
                    <option key={c.label} value={c.label}>{c.label}</option>
                  ))}
                </select>
              </div>
            </div>
            <div className="flex flex-col">
              <label className="text-xs font-heading font-bold text-muted-foreground mb-1">Travel Date</label>
              <Popover>
                <PopoverTrigger asChild>
                  <Button variant="outline" className={cn("w-full justify-start text-left font-normal text-sm h-[42px]", !plannerDate && "text-muted-foreground")}>
                    <Calendar className="mr-2 h-4 w-4 text-primary" />
                    {plannerDate ? format(plannerDate, "MMM d, yyyy") : "When?"}
                  </Button>
                </PopoverTrigger>
                <PopoverContent className="w-auto p-0" align="start">
                  <CalendarWidget mode="single" selected={plannerDate} onSelect={setPlannerDate} initialFocus className="p-3 pointer-events-auto" disabled={(date) => date < new Date()} />
                </PopoverContent>
              </Popover>
            </div>
            <div className="flex flex-col">
              <label className="text-xs font-heading font-bold text-muted-foreground mb-1">Adults</label>
              <div className="flex items-center gap-2 border border-border rounded-lg px-3 py-2.5 bg-background">
                <Users className="w-4 h-4 text-primary flex-shrink-0" />
                <input type="number" min="1" max="20" value={plannerAdults} onChange={(e) => setPlannerAdults(e.target.value)} className="text-sm bg-transparent outline-none w-full" />
              </div>
            </div>
            <div className="flex flex-col">
              <label className="text-xs font-heading font-bold text-muted-foreground mb-1">Children</label>
              <div className="flex items-center gap-2 border border-border rounded-lg px-3 py-2.5 bg-background">
                <Users className="w-4 h-4 text-primary flex-shrink-0" />
                <input type="number" min="0" max="10" value={plannerChildren} onChange={(e) => setPlannerChildren(e.target.value)} className="text-sm bg-transparent outline-none w-full" />
              </div>
            </div>
          </div>
          <div className="mt-4 flex justify-center">
            <button onClick={handleCheckAvailability} className="bg-accent text-accent-foreground px-8 py-3 rounded-full font-heading font-bold flex items-center gap-2 hover:brightness-110 transition-all shadow-md">
              <Search className="w-5 h-5" /> Make a Booking
            </button>
          </div>
        </div>
      </section>

      {/* SAFARI HIGHLIGHTS */}
      <SafariHighlights />

      {/* FEATURED DEALS */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-center mb-4">Best Featured Safari Deals</h2>
          <p className="text-center text-muted-foreground mb-12 max-w-2xl mx-auto">Explore our most popular safari packages across East Africa. Each tour is carefully designed to showcase the best wildlife and landscapes.</p>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {featured.map((pkg) => (
              <SafariCard key={pkg.id} pkg={pkg} />
            ))}
          </div>
          <div className="mt-10 text-center">
            <Link to="/kenya-safaris" className="inline-flex items-center gap-2 bg-primary text-primary-foreground px-8 py-3 rounded-full font-heading font-bold hover:bg-secondary transition-all shadow-md">
              View All Safaris <ArrowRight className="w-5 h-5" />
            </Link>
          </div>
        </div>
      </section>

      {/* POPULAR DESTINATIONS */}
      <section className="section-green py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-center mb-4 text-primary-foreground">Popular Safari Destinations</h2>
          <p className="text-center text-primary-foreground opacity-80 mb-12 max-w-2xl mx-auto">From the iconic Masai Mara to the exotic beaches of Zanzibar, discover East Africa's most spectacular destinations.</p>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {topDestinations.map((dest) => (
              <Link key={dest.id} to={`/destination/${dest.slug}`} className="group relative rounded-2xl overflow-hidden h-64 block shadow-lg hover:shadow-xl transition-shadow">
                <img src={getDestinationImage(dest.image)} alt={dest.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" width={400} height={256} />
                <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent" />
                <div className="absolute bottom-0 left-0 right-0 p-4">
                  <h3 className="text-primary-foreground text-lg">{dest.name}</h3>
                  <p className="text-primary-foreground opacity-70 text-sm">{dest.country}</p>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* HOTELS & LODGES */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-center mb-4">Hotels & Safari Lodges</h2>
          <p className="text-center text-muted-foreground mb-12 max-w-2xl mx-auto">Browse our curated selection of safari lodges, tented camps and hotels across East Africa.</p>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {hotels.slice(0, 4).map((hotel) => (
              <Link key={hotel.id} to={`/hotel/${hotel.slug}`} className="group bg-card border border-border rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div className="relative h-40 overflow-hidden">
                  <img src={getDestinationImage(hotel.image)} alt={hotel.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                  <span className="absolute top-3 right-3 text-xs font-heading font-bold px-3 py-1 rounded-full bg-accent text-accent-foreground">{hotel.tier}</span>
                </div>
                <div className="p-4">
                  <h3 className="text-sm font-heading font-bold mb-1 flex items-center gap-1.5"><Bed className="w-4 h-4 text-primary" />{hotel.name}</h3>
                  <p className="text-xs text-muted-foreground">{hotel.location} • {hotel.priceFrom && `From ${hotel.priceFrom}/night`}</p>
                </div>
              </Link>
            ))}
          </div>
          <div className="mt-10 text-center">
            <Link to="/hotels" className="inline-flex items-center gap-2 bg-primary text-primary-foreground px-8 py-3 rounded-full font-heading font-bold hover:bg-secondary transition-all shadow-md">
              Browse All Hotels <ArrowRight className="w-5 h-5" />
            </Link>
          </div>
        </div>
      </section>

      {/* SAFARI VEHICLES */}
      <section className="section-beige py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-center mb-4">Safari Vehicles & Tour Buses</h2>
          <p className="text-center text-muted-foreground mb-12 max-w-2xl mx-auto">Hire reliable safari vehicles in Nairobi and Arusha. All vehicles come with experienced professional driver guides.</p>
          <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {vehicles.slice(0, 3).map((v) => (
              <Link key={v.id} to={`/vehicle/${v.slug}`} className="group bg-card border border-border rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div className="h-40 overflow-hidden">
                  <img src={v.image} alt={v.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                </div>
                <div className="p-4">
                  <h3 className="text-sm font-heading font-bold mb-1 flex items-center gap-1.5"><Truck className="w-4 h-4 text-primary" />{v.name}</h3>
                  <p className="text-xs text-muted-foreground">{v.capacity}</p>
                </div>
              </Link>
            ))}
          </div>
          <div className="mt-10 text-center">
            <Link to="/vehicles" className="inline-flex items-center gap-2 bg-primary text-primary-foreground px-8 py-3 rounded-full font-heading font-bold hover:bg-secondary transition-all shadow-md">
              View All Vehicles <ArrowRight className="w-5 h-5" />
            </Link>
          </div>
        </div>
      </section>

      {/* HOW BOOKING WORKS */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-center mb-4">How Booking Works</h2>
          <p className="text-center text-muted-foreground mb-12 max-w-2xl mx-auto">Book your dream safari in 4 simple steps.</p>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { step: "1", title: "Choose Your Safari", desc: "Browse our curated safari packages or use the planner above to find your ideal adventure." },
              { step: "2", title: "Select Dates & Details", desc: "Pick your travel dates, number of travelers, and accommodation preferences." },
              { step: "3", title: "Review & Pay", desc: "Review your booking summary and choose your preferred payment method." },
              { step: "4", title: "Get Confirmation", desc: "Receive your confirmed itinerary and prepare for an unforgettable safari!" },
            ].map((item) => (
              <div key={item.step} className="text-center p-6 bg-card rounded-2xl shadow-md border border-border hover:shadow-lg transition-shadow">
                <div className="w-14 h-14 mx-auto mb-4 rounded-full bg-accent flex items-center justify-center text-accent-foreground font-heading font-bold text-xl">{item.step}</div>
                <h3 className="text-lg mb-2">{item.title}</h3>
                <p className="text-muted-foreground text-sm">{item.desc}</p>
              </div>
            ))}
          </div>
          <div className="text-center mt-8">
            <Link to="/booking" className="inline-flex items-center gap-2 bg-accent text-accent-foreground px-8 py-3 rounded-full font-heading font-bold text-base hover:brightness-110 transition-all shadow-md">
              Book Your Safari Now <ArrowRight className="w-5 h-5" />
            </Link>
          </div>
        </div>
      </section>

      {/* PARTNERS */}
      <section className="py-16">
        <div className="container mx-auto px-4">
          <h2 className="text-center mb-4">Recommended and Endorsed By</h2>
          <p className="text-center text-muted-foreground mb-12">We are proud to be recognized by leading travel organizations and platforms.</p>
          <div className="flex flex-wrap items-center justify-center gap-8 md:gap-12">
            {partners.map((p) => (
              <img key={p.name} src={p.img} alt={p.name} className="h-12 md:h-16 object-contain hover:scale-110 transition-transform duration-300" loading="lazy" />
            ))}
          </div>
        </div>
      </section>

      {/* FINAL CTA */}
      <section className="section-brown py-16">
        <div className="container mx-auto px-4 text-center">
          <h2 className="mb-4">Ready to Start Your African Safari Adventure?</h2>
          <p className="opacity-80 mb-8 max-w-2xl mx-auto">Let our experienced safari experts help you plan the trip of a lifetime.</p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link to="/booking" className="bg-accent text-accent-foreground px-8 py-3 rounded-full font-heading font-bold text-base hover:brightness-110 transition-all shadow-md">
              Plan Your Safari
            </Link>
            <a
              href={whatsappLink("Hi! I need help planning my East Africa safari.")}
              target="_blank"
              rel="noopener noreferrer"
              className="whatsapp-btn text-base justify-center rounded-full"
            >
              <MessageCircle className="w-5 h-5" /> Inquire on WhatsApp
            </a>
          </div>
        </div>
      </section>
    </>
  );
};

export default Index;
