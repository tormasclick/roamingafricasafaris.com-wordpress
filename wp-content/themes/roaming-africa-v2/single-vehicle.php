import { useParams, Link } from "react-router-dom";
import { getVehicleBySlug } from "@/data/vehicles";
import { whatsappLink } from "@/data/constants";
import { MessageCircle, Users, ArrowRight } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import BookingFormVehicle from "@/components/BookingFormVehicle";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";

const VehicleDetail = () => {
  const { slug } = useParams<{ slug: string }>();
  const vehicle = getVehicleBySlug(slug || "");

  if (!vehicle)
    return (
      <div className="container mx-auto px-4 py-20 text-center">
        <h1>Vehicle not found</h1>
        <Link to="/our-vehicles" className="text-primary">Browse Vehicles</Link>
      </div>
    );

  const faqJsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: vehicle.faqs.map((f) => ({
      "@type": "Question",
      name: f.question,
      acceptedAnswer: { "@type": "Answer", text: f.answer },
    })),
  };

  const paragraphs = vehicle.overview.split("\n\n");

  return (
    <>
      <SEO
        title={vehicle.seo.title}
        description={vehicle.seo.description}
        keywords={vehicle.seo.focusKeyword}
        canonical={vehicle.seo.canonical}
        jsonLd={faqJsonLd}
      />

      <PageHero imageUrl={vehicle.image}>
        <p className="text-primary-foreground/80 text-sm mb-1 flex items-center gap-1">
          <Users className="w-4 h-4" />
          {vehicle.passengerCount}
        </p>
        <h1 className="text-primary-foreground">{vehicle.name}</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Our Vehicles", href: "/our-vehicles" }, { label: vehicle.name }]} />
      </div>

      <div className="container mx-auto px-4 py-10">
        <div className="grid lg:grid-cols-3 gap-10">
          <div className="lg:col-span-2 space-y-10">
            <section>
              <h2 className="mb-4">Vehicle Overview</h2>
              <div className="space-y-4">
                {paragraphs.map((p, i) => (
                  <p key={i} className="text-muted-foreground leading-relaxed">{p}</p>
                ))}
              </div>
            </section>

            <section>
              <h2 className="mb-4">Gallery</h2>
              <div className="grid grid-cols-2 gap-3">
                {vehicle.gallery.map((src, i) => (
                  <div key={i} className="aspect-[4/3] overflow-hidden rounded-xl">
                    <img
                      src={src}
                      alt={`${vehicle.name} photo ${i + 1}`}
                      loading="lazy"
                      className="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                    />
                  </div>
                ))}
              </div>
            </section>

            <section>
              <h2 className="mb-4">Frequently Asked Questions</h2>
              <Accordion type="single" collapsible className="w-full">
                {vehicle.faqs.map((f, i) => (
                  <AccordionItem key={i} value={`faq-${i}`}>
                    <AccordionTrigger className="text-left">{f.question}</AccordionTrigger>
                    <AccordionContent className="text-muted-foreground">{f.answer}</AccordionContent>
                  </AccordionItem>
                ))}
              </Accordion>
            </section>

            <section id="booking">
              <h2 className="mb-4">Make a Booking</h2>
              <BookingFormVehicle
                heading={`Book the ${vehicle.name}`}
                subject={`Vehicle Booking — ${vehicle.name}`}
                ctaLabel="Make a Booking"
              />
            </section>
          </div>

          <aside className="space-y-6">
            <div className="bg-card border border-border rounded-xl p-6 sticky top-24 space-y-4">
              <h3 className="text-center">Hire This Vehicle</h3>
              <p className="text-center text-sm text-muted-foreground">{vehicle.passengerCount}</p>
              <a
                href="#booking"
                className="block w-full bg-primary text-primary-foreground py-3 rounded-full font-heading font-bold text-center hover:bg-secondary transition-all shadow-md"
              >
                Make a Booking
              </a>
              <a
                href={whatsappLink(`Hi! I'd like to hire the ${vehicle.name}. Please send availability and rates.`)}
                target="_blank"
                rel="noopener noreferrer"
                className="whatsapp-btn w-full justify-center rounded-full"
              >
                <MessageCircle className="w-5 h-5" /> Book via WhatsApp
              </a>
              <Link to="/our-vehicles" className="block text-center text-sm text-primary font-heading font-bold hover:underline">
                View All Vehicles <ArrowRight className="w-3.5 h-3.5 inline" />
              </Link>
            </div>
          </aside>
        </div>
      </div>
    </>
  );
};

export default VehicleDetail;
