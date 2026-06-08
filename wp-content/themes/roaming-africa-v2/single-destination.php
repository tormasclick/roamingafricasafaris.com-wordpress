import { useParams, Link } from "react-router-dom";
import { getDestinationBySlug, destinations } from "@/data/destinations";
import { safariPackages } from "@/data/safariPackages";
import { getHotelsByDestination } from "@/data/hotels";
import { getDestinationImage, getHeroImage } from "@/data/images";
import { whatsappLink } from "@/data/constants";
import { MessageCircle, MapPin, Calendar, Bed } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import ItineraryStrip from "@/components/ItineraryStrip";
import DestinationHighlights from "@/components/DestinationHighlights";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";

const DestinationDetail = () => {
  const { slug } = useParams<{ slug: string }>();
  const dest = getDestinationBySlug(slug || "");

  if (!dest)
    return (
      <div className="container mx-auto px-4 py-20 text-center">
        <h1>Destination not found</h1>
        <Link to="/destinations" className="text-primary">View all destinations</Link>
      </div>
    );

  const relatedPackages = safariPackages.filter((p) =>
    p.destinations.some((d) => d.toLowerCase().includes(dest.name.toLowerCase().split(" ")[0]))
  );
  const nearbyHotels = getHotelsByDestination(dest.id);
  const similar = destinations.filter((d) => d.country === dest.country && d.id !== dest.id).slice(0, 3);
  const heroImg = getHeroImage(dest.id);

  const minPrice = "$650";
  const maxPrice = "$4,500";

  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "TouristAttraction",
    name: dest.name,
    description: dest.shortDescription,
    image: heroImg,
    address: { "@type": "PostalAddress", addressCountry: dest.country },
  };

  return (
    <>
      <SEO
        title={`${dest.name} Safari | Tours, Lodges & Wildlife — Roaming Africa`}
        description={`Explore ${dest.name} with expert guides. ${dest.wildlife[0] || ""}. Safari packages from ${minPrice} to ${maxPrice} per person. Full board, 4×4 vehicles.`}
        canonical={`https://kenya-journey-weaver.lovable.app/destination/${dest.slug}`}
        jsonLd={jsonLd}
      />

      {/* Destination hero */}
      <div className="relative h-40 md:h-56 overflow-hidden">
        <img src={heroImg} alt={dest.name} className="absolute inset-0 w-full h-full object-cover" />
        <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/40" />
        <div className="relative z-10 h-full flex items-end">
          <div className="container mx-auto px-4 pb-5 text-primary-foreground">
            <div className="flex items-center gap-2 opacity-80 text-xs mb-1.5"><MapPin className="w-3.5 h-3.5" />{dest.country}</div>
            <h1 className="text-xl md:text-3xl font-heading font-bold leading-tight">{dest.name}</h1>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Destinations", href: "/destinations" }, { label: dest.name }]} />
      </div>

      <div className="container mx-auto px-4 py-8">
        <div className="grid lg:grid-cols-3 gap-8">
          <div className="lg:col-span-2 space-y-10">
            <section>
              <h2 className="text-lg mb-3">Overview</h2>
              <p className="text-muted-foreground text-sm leading-relaxed">{dest.overview}</p>
            </section>

            {/* Expanded SEO-rich Destination Highlights (6+ cards) */}
            <DestinationHighlights destination={dest} />

            {/* Price Range */}
            <section className="p-5 rounded-xl border border-border bg-muted/40">
              <h3 className="text-sm font-heading font-semibold mb-2">Price Range</h3>
              <p className="text-base font-heading font-semibold text-primary mb-2">
                From {minPrice} to {maxPrice} per person
              </p>
              <p className="text-xs text-muted-foreground">
                Includes 4×4 vehicle, professional driver-guide, full board accommodation and park fees.
              </p>
            </section>

            {/* Visual sample itinerary */}
            {relatedPackages[0] && (
              <section>
                <h2 className="text-lg mb-2 flex items-center gap-2">
                  <Calendar className="w-5 h-5 text-primary" />
                  Sample Itinerary — {relatedPackages[0].duration}
                </h2>
                <p className="text-muted-foreground text-sm mb-5">
                  A typical {dest.name} safari day-by-day. Tap any day for full details.
                </p>
                <ItineraryStrip
                  itinerary={relatedPackages[0].itinerary}
                  fallbackSlug={dest.image}
                />
                <div className="mt-4">
                  <Link
                    to={`/safari/${relatedPackages[0].slug}`}
                    className="inline-flex items-center gap-2 text-sm font-heading font-bold text-primary hover:text-accent"
                  >
                    View full safari package →
                  </Link>
                </div>
              </section>
            )}

            {/* Best Time */}
            <section>
              <h3 className="text-base mb-2 flex items-center gap-2"><Calendar className="w-4 h-4 text-primary" /> Best Time to Visit</h3>
              <p className="text-muted-foreground text-sm">{dest.bestTime}</p>
            </section>

            {/* Nearby Hotels */}
            {nearbyHotels.length > 0 && (
              <section>
                <h2 className="text-lg mb-4 flex items-center gap-2"><Bed className="w-5 h-5 text-primary" /> Nearby Hotels &amp; Lodges</h2>
                <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                  {nearbyHotels.slice(0, 6).map((hot) => (
                    <Link key={hot.id} to={`/hotel/${hot.slug}`} className="group bg-card border border-border rounded-xl overflow-hidden hover:shadow-md transition-all">
                      <div className="relative h-28 overflow-hidden">
                        <img src={getDestinationImage(hot.image)} alt={hot.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                        <span className="absolute top-2 right-2 text-[10px] font-heading font-bold px-2 py-0.5 rounded-full bg-accent text-accent-foreground uppercase">{hot.tier}</span>
                      </div>
                      <div className="p-3">
                        <h3 className="text-sm font-heading font-bold leading-snug mb-1">{hot.name}</h3>
                        <p className="text-xs text-muted-foreground">{hot.priceFrom && `From ${hot.priceFrom}/night`}</p>
                      </div>
                    </Link>
                  ))}
                </div>
              </section>
            )}

            {/* Similar Destinations */}
            {similar.length > 0 && (
              <section>
                <h2 className="text-lg mb-4">Similar Destinations</h2>
                <div className="grid sm:grid-cols-3 gap-3">
                  {similar.map((d) => (
                    <Link key={d.id} to={`/destination/${d.slug}`} className="group relative h-36 rounded-xl overflow-hidden shadow-md">
                      <img src={getDestinationImage(d.image)} alt={d.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                      <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent" />
                      <div className="absolute inset-x-0 bottom-0 p-3 text-primary-foreground">
                        <h3 className="text-sm font-heading font-bold">{d.name}</h3>
                      </div>
                    </Link>
                  ))}
                </div>
              </section>
            )}

            {/* FAQs */}
            {dest.faqs.length > 0 && (
              <section>
                <h2 className="text-lg mb-4">Frequently Asked Questions</h2>
                <Accordion type="single" collapsible className="w-full">
                  {dest.faqs.map((faq, i) => (
                    <AccordionItem key={i} value={`faq-${i}`}>
                      <AccordionTrigger className="text-left text-sm font-heading">{faq.question}</AccordionTrigger>
                      <AccordionContent className="text-muted-foreground text-sm leading-relaxed">{faq.answer}</AccordionContent>
                    </AccordionItem>
                  ))}
                </Accordion>
              </section>
            )}
          </div>

          {/* Tell Us About You sidebar */}
          <aside>
            <div className="bg-card border border-border rounded-xl p-5 sticky top-24 space-y-3">
              <h3 className="text-base text-center">Tell Us About You</h3>
              <p className="text-xs text-center text-muted-foreground">We reply within 1 hour 😎</p>
              <Link to="/booking" className="block w-full bg-accent text-accent-foreground py-3 rounded-full font-heading font-bold text-center text-sm hover:brightness-110 shadow-md">
                Make a Booking →
              </Link>
              <a
                href={whatsappLink(`Hi! I'm interested in visiting ${dest.name}. Can you help me plan?`)}
                target="_blank"
                rel="noopener noreferrer"
                className="whatsapp-btn w-full justify-center text-sm"
              >
                <MessageCircle className="w-4 h-4" /> Chat on WhatsApp
              </a>
            </div>
          </aside>
        </div>
      </div>
    </>
  );
};

export default DestinationDetail;
