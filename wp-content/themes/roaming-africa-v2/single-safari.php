import { useParams, Link } from "react-router-dom";
import { getPackageBySlug, safariPackages } from "@/data/safariPackages";
import { getDestinationImage, getHeroImage } from "@/data/images";
import { whatsappLink } from "@/data/constants";
import { Clock, Check, X, MessageCircle } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SafariCard from "@/components/SafariCard";
import SEO from "@/components/SEO";
import ItineraryStrip from "@/components/ItineraryStrip";
import PricingTable from "@/components/PricingTable";
import BookingFormTour from "@/components/BookingFormTour";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";

const SafariDetail = () => {
  const { slug } = useParams<{ slug: string }>();
  const pkg = getPackageBySlug(slug || "");

  if (!pkg)
    return (
      <div className="container mx-auto px-4 py-20 text-center">
        <h1>Safari not found</h1>
        <Link to="/" className="text-primary">Return home</Link>
      </div>
    );

  const heroSlug = (pkg.destinations[0] || "").toLowerCase().replace(/\s/g, "-");
  const heroImg = getHeroImage(heroSlug) || getDestinationImage(pkg.image);

  const related = safariPackages.filter((p) => p.id !== pkg.id && p.country === pkg.country).slice(0, 3);

  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "TouristTrip",
    name: pkg.name,
    description: pkg.overview,
    touristType: "Safari",
    itinerary: { "@type": "ItemList", itemListElement: pkg.itinerary.map((d, i) => ({ "@type": "ListItem", position: i + 1, name: d.title })) },
    offers: pkg.price ? { "@type": "Offer", price: pkg.priceFrom, priceCurrency: "USD" } : undefined,
  };

  return (
    <>
      <SEO
        title={`${pkg.name} | ${pkg.duration} Safari — Roaming Africa Tours`}
        description={`${pkg.shortDescription} from ${pkg.price || "request"}. Expert guide, 4×4, full board.`}
        canonical={`https://kenya-journey-weaver.lovable.app/safari/${pkg.slug}`}
        jsonLd={jsonLd}
      />

      <div className="relative h-40 md:h-56 overflow-hidden">
        <img src={heroImg} alt={pkg.name} className="absolute inset-0 w-full h-full object-cover" />
        <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/40" />
        <div className="relative z-10 h-full flex items-end">
          <div className="container mx-auto px-4 pb-5 text-primary-foreground">
            <div className="flex items-center gap-2 opacity-80 text-xs mb-1.5"><Clock className="w-3.5 h-3.5" />{pkg.duration}</div>
            <h1 className="text-xl md:text-3xl font-heading font-bold leading-tight">{pkg.name}</h1>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[
          { label: `${pkg.country.charAt(0).toUpperCase() + pkg.country.slice(1)} Safaris`, href: `/${pkg.country}-safaris` },
          { label: pkg.name },
        ]} />
      </div>

      <div className="container mx-auto px-4 py-8">
        <div className="grid lg:grid-cols-3 gap-8">
          <div className="lg:col-span-2 space-y-10">
            <section>
              <h2 className="text-lg mb-3">Overview</h2>
              <p className="text-muted-foreground text-sm leading-relaxed">{pkg.overview}</p>
            </section>

            {/* Day-by-Day Itinerary — horizontal image strip */}
            <section>
              <h2 className="text-lg mb-2">Day-by-Day Itinerary</h2>
              <p className="text-muted-foreground text-sm mb-5">
                Tap any day for full details. Swipe horizontally on mobile.
              </p>
              <ItineraryStrip itinerary={pkg.itinerary} fallbackSlug={heroSlug} />
            </section>

            {/* Inclusions / Exclusions */}
            <div className="grid md:grid-cols-2 gap-6">
              <section>
                <h2 className="text-lg mb-3">Inclusions</h2>
                <ul className="space-y-2">
                  {pkg.inclusions.map((item) => (
                    <li key={item} className="flex items-start gap-2 text-sm"><Check className="w-4 h-4 text-primary flex-shrink-0 mt-0.5" />{item}</li>
                  ))}
                </ul>
              </section>
              <section>
                <h2 className="text-lg mb-3">Exclusions</h2>
                <ul className="space-y-2">
                  {pkg.exclusions.map((item) => (
                    <li key={item} className="flex items-start gap-2 text-sm"><X className="w-4 h-4 text-destructive flex-shrink-0 mt-0.5" />{item}</li>
                  ))}
                </ul>
              </section>
            </div>

            {/* Pricing & Availability — after Inclusions/Exclusions */}
            <PricingTable
              table={pkg.priceTable}
              priceFrom={pkg.priceFrom}
            />


            {/* FAQs */}
            {pkg.faqs.length > 0 && (
              <section>
                <h2 className="text-lg mb-4">Frequently Asked Questions</h2>
                <Accordion type="single" collapsible className="w-full">
                  {pkg.faqs.map((faq, i) => (
                    <AccordionItem key={i} value={`faq-${i}`}>
                      <AccordionTrigger className="text-left text-sm font-heading">{faq.question}</AccordionTrigger>
                      <AccordionContent className="text-muted-foreground text-sm leading-relaxed">{faq.answer}</AccordionContent>
                    </AccordionItem>
                  ))}
                </Accordion>
              </section>
            )}

            {/* Related Packages */}
            {related.length > 0 && (
              <section>
                <h2 className="text-lg mb-4">Related Safari Packages</h2>
                <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                  {related.map((r) => <SafariCard key={r.id} pkg={r} />)}
                </div>
              </section>
            )}
          </div>

          {/* Booking sidebar */}
          <aside>
            <div className="sticky top-24 space-y-3">
              <BookingFormTour
                subject={`Safari Enquiry — ${pkg.name}`}
                contextLine={`${pkg.duration} • ${pkg.destinations.join(", ")}`}
              />
              <a
                href={whatsappLink(`Hi! I'm interested in the ${pkg.name}. Please send more details.`)}
                target="_blank" rel="noopener noreferrer"
                className="whatsapp-btn w-full justify-center rounded-full text-sm"
              >
                <MessageCircle className="w-4 h-4" /> WhatsApp
              </a>
            </div>
          </aside>
        </div>
      </div>
    </>
  );
};

export default SafariDetail;
