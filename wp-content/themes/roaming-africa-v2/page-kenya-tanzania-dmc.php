import { Link } from "react-router-dom";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import BookingFormTour from "@/components/BookingFormTour";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { Check, Building2, Users, Plane, Calendar, Shield, Globe, Star } from "lucide-react";
import { getDestinationImage } from "@/data/images";

const eastAfricaPackages = [
  { name: "8 Days Samburu & Masai Mara Safari by Air", price: 5190, image: "samburu", href: "/safari/8-days-samburu-masai-mara-by-air", blurb: "Fly-in safari combining the rugged beauty of Samburu with the legendary plains of the Masai Mara." },
  { name: "5 Days Safari to Masai Mara and Lake Nakuru", price: 2990, image: "masai-mara", href: "/safari/5-days-masai-mara-lake-nakuru", blurb: "Classic Kenya safari blending Big Five game drives with Nakuru's famous flamingo lake and rhino sanctuary." },
  { name: "12 Days Kenya & Tanzania Safari", price: 4780, image: "serengeti", href: "/safari/12-days-kenya-tanzania", blurb: "The ultimate East Africa cross-border adventure — Masai Mara, Serengeti, Ngorongoro and beyond." },
  { name: "8 Days Taita Hills & Amboseli Safari", price: 3180, image: "amboseli", href: "/safari/8-days-taita-amboseli", blurb: "Elephant herds at Amboseli with Kilimanjaro views, then exclusive game viewing in the Taita Hills sanctuary." },
];



const faqs = [
  {
    question: "What is a DMC and what does Roaming Africa Tours do as a Kenya/Tanzania DMC?",
    answer:
      "A Destination Management Company (DMC) is the in-country operational partner that handles every land-based service for inbound tour operators, corporates, and event planners. As an East Africa DMC, Roaming Africa provides ground handling, accommodation contracting, transport, guiding, MICE logistics, branding production, payment processing and 24/7 trip support across Kenya, Tanzania and Zanzibar.",
  },
  {
    question: "How is a DMC different from a regular tour operator?",
    answer:
      "Tour operators sell packaged trips to consumers. A DMC contracts directly with lodges, airlines and suppliers on behalf of trade partners (international agents, corporates, event planners) and delivers fully managed in-country execution at net rates with mark-up flexibility for the partner.",
  },
  {
    question: "Which countries do you cover?",
    answer:
      "We are fully licensed and bonded in Kenya and Tanzania, with operational coverage of Zanzibar, Uganda gorilla-trekking add-ons, Rwanda gorilla-trekking, and beach extensions to the Seychelles and Mauritius via partner DMCs.",
  },
  {
    question: "Do you work with international tour operators on a B2B basis?",
    answer:
      "Yes. The majority of our business is B2B inbound. We provide net-rate contracts, white-label proposals, dedicated reservations contacts and trade-only payment terms to over 180 international tour operators across Europe, North America, Asia and the GCC.",
  },
  {
    question: "What MICE and event capacity do you have?",
    answer:
      "We handle conferences from 20 to 800 delegates, including AGMs at Diani and Mombasa beach resorts, board retreats at exclusive-use camps, product launches at Karen Country Club and Hemingways Nairobi, and bush gala dinners for up to 300 guests in the Mara and Serengeti.",
  },
  {
    question: "How quickly can you turn around a proposal?",
    answer:
      "Standard FIT proposals within 24 hours. Complex group, MICE or incentive proposals (10+ delegates, multi-property, branded events) within 48–72 hours including costed itinerary, supplier confirmations and risk assessment.",
  },
];

const KenyaTanzaniaDMC = () => {
  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((f) => ({
      "@type": "Question",
      name: f.question,
      acceptedAnswer: { "@type": "Answer", text: f.answer },
    })),
  };

  const services = [
    { icon: Plane, title: "Corporate Travel", text: "End-to-end corporate travel programmes including airport meet-and-greet, VIP transfers, executive vehicles, conference logistics and 24/7 trip support across Nairobi, Mombasa, Arusha, Dar es Salaam and Zanzibar." },
    { icon: Users, title: "MICE Services", text: "Meetings, Incentives, Conferences and Events from 20 to 800 delegates. Venue sourcing, AV and production partners, branded materials, themed dinners, partner programmes and full delegate management." },
    { icon: Star, title: "Incentive Travel", text: "Bespoke safari and beach incentive programmes for sales teams, channel partners and top performers. Branded vehicles, exclusive-use camps, bush gala dinners and awards ceremonies." },
    { icon: Globe, title: "Group Travel", text: "FIT, club, association and affinity group travel from 6 to 200 pax. Block accommodation rates, dedicated tour leaders, themed itineraries and group dining curation." },
    { icon: Building2, title: "Luxury Travel", text: "Hand-curated luxury itineraries using exclusive-use private camps, fly-in safaris, helicopter transfers, private chefs, butler service and bespoke cultural experiences." },
    { icon: Shield, title: "VIP Services", text: "VIP airport fast-track, immigration meet-and-greet, private terminal access at JKIA and Wilson, armoured-vehicle options, close-protection, and discreet trip management for HNW clients and dignitaries." },
    { icon: Calendar, title: "Event Logistics", text: "Full event production — venue, AV, staging, branding, F&B, transport waves, ushering, security and post-event reporting. From product launches to international conferences." },
  ];

  return (
    <>
      <SEO
        title="Kenya & Tanzania Destination Management Company | East Africa DMC"
        description="Leading Kenya & Tanzania Destination Management Company delivering corporate travel, MICE, incentive, group and luxury programmes. Trusted by 180+ international operators across East Africa."
        keywords="kenya destination management company, tanzania destination management company, east africa destination management company, corporate travel management east africa"
        canonical="https://every-page-grabber.lovable.app/kenya-tanzania-dmc"
        jsonLd={jsonLd}
      />

      <PageHero imageKey="serengeti">
        <h1>Kenya & Tanzania Destination Management Company</h1>
        <p>Your trusted East Africa Destination Management Company — corporate travel, MICE, incentives, groups and luxury.</p>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Kenya & Tanzania Destination Management Company" }]} />
      </div>


      <div className="container mx-auto px-4 py-10 grid lg:grid-cols-3 gap-10">
        <div className="lg:col-span-2 space-y-10">
          <section>
            <h2 className="mb-3">Who We Are</h2>
            <p className="text-sm text-muted-foreground leading-relaxed mb-3">
              Roaming Africa Tours & Safaris is an established East Africa Destination Management Company
              headquartered in Nairobi, with operational hubs in Mombasa, Arusha and Zanzibar. We are licensed
              by the Kenya Tourism Regulatory Authority (TRA), bonded members of the Kenya Association of Tour
              Operators (KATO), and accredited by the Tanzania Association of Tour Operators (TATO).
            </p>
            <p className="text-sm text-muted-foreground leading-relaxed">
              For more than a decade we have served as the in-country execution partner for international tour
              operators, corporate travel managers, event agencies and luxury concierge services. Our reputation
              is built on transparent net-rate pricing, contracted allocations with over 200 vetted properties,
              and a 24/7 operations team that ensures every transfer, briefing and dinner runs on schedule.
            </p>
          </section>

          <section>
            <h2 className="mb-4">Destination Management Services</h2>
            <div className="grid sm:grid-cols-2 gap-4">
              {services.map((s) => (
                <div key={s.title} className="bg-card border border-border rounded-xl p-5">
                  <s.icon className="w-6 h-6 text-primary mb-2" />
                  <h3 className="text-sm font-heading font-bold mb-1.5">{s.title}</h3>
                  <p className="text-xs text-muted-foreground leading-relaxed">{s.text}</p>
                </div>
              ))}
            </div>
          </section>

          <section>
            <h2 className="mb-3">Why Work With Us</h2>
            <ul className="space-y-2 text-sm">
              {[
                "Fully licensed and bonded — KATO, TATO, TRA, IATA-affiliated payment processing",
                "Net B2B rates with contracted allocations at 200+ lodges, camps, hotels and beach resorts",
                "24/7 in-house operations desk with dedicated account managers per partner",
                "Established MICE production team — venue, AV, F&B, branding, transport waves",
                "Comprehensive risk management including AMREF Flying Doctors evacuation cover",
                "Multi-currency invoicing in USD, EUR and GBP with flexible trade payment terms",
                "Multilingual guides — English, French, Spanish, German, Italian, Mandarin on request",
                "Sustainable tourism commitment — partner of Ecotourism Kenya and community-revenue programmes",
              ].map((b) => (
                <li key={b} className="flex items-start gap-2"><Check className="w-4 h-4 text-primary flex-shrink-0 mt-0.5" />{b}</li>
              ))}
            </ul>
          </section>

          <section>
            <h2 className="mb-4">Frequently Asked Questions</h2>
            <Accordion type="single" collapsible className="w-full">
              {faqs.map((f, i) => (
                <AccordionItem key={i} value={`faq-${i}`}>
                  <AccordionTrigger className="text-left text-sm font-heading">{f.question}</AccordionTrigger>
                  <AccordionContent className="text-muted-foreground text-sm leading-relaxed">{f.answer}</AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </section>

          <section>
            <h2 className="mb-2">East Africa Safari Packages</h2>
            <p className="text-sm text-muted-foreground mb-6">Hand-picked corporate and leisure itineraries our Destination Management Company executes year-round across Kenya and Tanzania.</p>
            <div className="grid sm:grid-cols-2 gap-5">
              {eastAfricaPackages.map((p) => (
                <Link key={p.name} to={p.href} className="group bg-card border border-border rounded-xl overflow-hidden hover:border-primary hover:shadow-lg transition-all">
                  <div className="relative h-40 overflow-hidden">
                    <img src={getDestinationImage(p.image)} alt={p.name} loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <span className="absolute top-3 right-3 bg-safari-gold text-safari-dark text-xs font-heading font-bold px-3 py-1 rounded-full">From ${p.price.toLocaleString()}</span>
                  </div>
                  <div className="p-4">
                    <h3 className="font-heading font-bold text-sm leading-snug mb-1.5">{p.name}</h3>
                    <p className="text-xs text-muted-foreground leading-relaxed mb-3">{p.blurb}</p>
                    <span className="text-xs font-heading font-bold text-primary group-hover:underline">View Details →</span>
                  </div>
                </Link>
              ))}
            </div>
          </section>

          <section>

            <h2 className="mb-4">Related Services</h2>
            <div className="grid sm:grid-cols-3 gap-4 text-sm">
              <Link to="/incentive-safaris-kenya-tanzania" className="bg-card border border-border rounded-xl p-4 hover:border-primary">
                <h3 className="font-heading font-bold mb-1">Incentive Safaris</h3>
                <p className="text-xs text-muted-foreground">Reward-based corporate programmes.</p>
              </Link>
              <Link to="/kenya-safaris/helicopter" className="bg-card border border-border rounded-xl p-4 hover:border-primary">
                <h3 className="font-heading font-bold mb-1">Helicopter Tours</h3>
                <p className="text-xs text-muted-foreground">VIP aerial experiences across East Africa.</p>
              </Link>
              <Link to="/our-vehicles" className="bg-card border border-border rounded-xl p-4 hover:border-primary">
                <h3 className="font-heading font-bold mb-1">Our Fleet</h3>
                <p className="text-xs text-muted-foreground">Safari, vans, buses and special vehicles.</p>
              </Link>
            </div>
          </section>
        </div>

        <aside>
          <div className="sticky top-24">
            <BookingFormTour
              subject="DMC / Trade Enquiry"
              contextLine="B2B partner / DMC services enquiry"
            />
          </div>
        </aside>
      </div>
    </>
  );
};

export default KenyaTanzaniaDMC;
