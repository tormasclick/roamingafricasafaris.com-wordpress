import { Link } from "react-router-dom";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import BookingFormTour from "@/components/BookingFormTour";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { Check, Users, Award, Briefcase, Plane, Mountain } from "lucide-react";

const faqs = [
  {
    question: "What is corporate incentive travel and why choose Kenya or Tanzania?",
    answer:
      "Corporate incentive travel is a reward-based programme used by businesses to motivate top performers, sales teams, and channel partners. Kenya and Tanzania deliver an unmatched 'wow factor' — the Great Migration, Mount Kilimanjaro views, Big Five game drives and Zanzibar's white-sand beaches — all wrapped in five-star service with easy English-language logistics, established luxury supply chains and competitive group rates versus comparable Asia or Caribbean programmes.",
  },
  {
    question: "What is the minimum group size for an incentive safari?",
    answer:
      "We design incentive programmes for groups from 10 to 250+ guests. Smaller groups (10–30) enjoy exclusive private camps; mid-size groups (30–80) use buy-out lodges and chartered light aircraft; larger groups (80+) are run as logistically choreographed waves across multiple parks with dedicated event managers.",
  },
  {
    question: "How far in advance should we book an incentive group?",
    answer:
      "For premium camps and seasonal availability (especially July–October migration), we recommend booking 9–12 months ahead. We can deliver shorter-lead programmes (3–6 months) using our established trade allocations with most major lodge groups across East Africa.",
  },
  {
    question: "Can you handle on-the-ground branding, gala dinners, and team-building?",
    answer:
      "Yes. As a full-service DMC, we deliver branded welcome receptions, themed bush gala dinners under the stars, Maasai cultural evenings, conservation team-building activities (rhino tracking, tree planting), CSR community visits, and luxury beach award ceremonies in Diani, Watamu or Zanzibar.",
  },
  {
    question: "Do you arrange international flights for incentive groups?",
    answer:
      "We do not issue international tickets, but we coordinate group-flight blocks with carriers like Kenya Airways, Emirates, Qatar, KLM and Lufthansa, plus all internal scheduled and chartered flights, airport VIP meet-and-greet, and visa support for every participant.",
  },
  {
    question: "What's the typical cost per delegate for an incentive safari?",
    answer:
      "Programmes typically range from USD 3,500–8,000+ per delegate (5–7 nights, land-only) depending on accommodation tier, group size, internal flight content, and branding/event production. We provide fully costed bespoke proposals within 48 hours.",
  },
];

const IncentiveSafaris = () => {
  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((f) => ({
      "@type": "Question",
      name: f.question,
      acceptedAnswer: { "@type": "Answer", text: f.answer },
    })),
  };

  return (
    <>
      <SEO
        title="Incentive Safaris Kenya & Tanzania | Corporate Incentive Travel East Africa"
        description="Award-winning incentive travel in Kenya & Tanzania. Luxury safari incentives, beach rewards, gala dinners & MICE logistics for corporate groups of 10–250+ delegates."
        keywords="incentive travel kenya, incentive travel tanzania, corporate safari kenya, corporate incentive travel east africa, group incentive tours kenya, executive travel kenya"
        canonical="https://every-page-grabber.lovable.app/incentive-safaris-kenya-tanzania"
        jsonLd={jsonLd}
      />

      <PageHero imageKey="masai-mara">
        <h1>Incentive Safaris Kenya & Tanzania</h1>
        <p>Reward your top performers with the trip they will talk about for the rest of their careers.</p>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Incentive Safaris Kenya & Tanzania" }]} />
      </div>

      <div className="container mx-auto px-4 py-10 grid lg:grid-cols-3 gap-10">
        <div className="lg:col-span-2 space-y-10">
          <section>
            <h2 className="mb-3">Introduction</h2>
            <p className="text-muted-foreground leading-relaxed text-sm">
              Roaming Africa Tours & Safaris is a specialist East African DMC delivering bespoke corporate incentive
              travel across Kenya, Tanzania and Zanzibar. Our incentive programmes combine the raw drama of the
              African wilderness with five-star logistics — from chartered light aircraft and buy-out luxury camps
              to themed bush gala dinners and bespoke conservation team-building. We have produced incentives for
              Fortune 500 sales teams, European pharma channel partners, GCC family offices and global tech
              accelerators, and our reputation rests on flawless execution measured by zero last-minute changes,
              dedicated 24/7 trip directors and transparent costed proposals.
            </p>
          </section>

          <section>
            <h2 className="mb-4">Why Kenya & Tanzania for Incentive Travel</h2>
            <div className="grid sm:grid-cols-2 gap-4">
              {[
                { icon: Mountain, title: "Iconic 'wow' destinations", text: "Maasai Mara, Serengeti, Ngorongoro, Amboseli with Kilimanjaro, Diani Beach and Zanzibar — all bookable in a single 7-night programme." },
                { icon: Award, title: "Mature luxury supply chain", text: "Over 200 vetted 4-, 5- and 6-star camps, lodges and beach resorts with established corporate buy-out capacity." },
                { icon: Plane, title: "Easy international access", text: "Daily direct flights from Europe, Middle East, USA and Asia into Nairobi (NBO), Kilimanjaro (JRO) and Zanzibar (ZNZ)." },
                { icon: Users, title: "English-language operations", text: "Every guide, lodge manager and ground handler operates in English with multilingual support on request." },
              ].map((item) => (
                <div key={item.title} className="bg-card border border-border rounded-xl p-5">
                  <item.icon className="w-6 h-6 text-primary mb-2" />
                  <h3 className="text-sm font-heading font-bold mb-1">{item.title}</h3>
                  <p className="text-xs text-muted-foreground leading-relaxed">{item.text}</p>
                </div>
              ))}
            </div>
          </section>

          <section>
            <h2 className="mb-3">Benefits for Corporates</h2>
            <p className="text-sm text-muted-foreground leading-relaxed mb-4">
              A well-executed safari incentive measurably outperforms cash bonuses on motivation, retention and
              brand affinity. Delegates return home as evangelists, generating organic social-media reach worth
              tens of thousands of impressions, and the shared bush experience builds cross-team bonds that desk
              retreats simply cannot match.
            </p>
            <ul className="space-y-2 text-sm">
              {[
                "Verifiable ROI on sales-incentive programmes — typical 20–35% lift in following-quarter pipeline",
                "Bespoke corporate branding throughout — vehicle decals, branded welcome packs, customised menus",
                "Dedicated event manager and 24/7 trip director on every programme",
                "Full risk management, evacuation cover, and AMREF Flying Doctors membership for every delegate",
                "Transparent costed proposals with no hidden margins or surprise extras",
                "Tax-deductible business expense in most jurisdictions when structured as a recognition programme",
              ].map((b) => (
                <li key={b} className="flex items-start gap-2"><Check className="w-4 h-4 text-primary flex-shrink-0 mt-0.5" />{b}</li>
              ))}
            </ul>
          </section>

          <section>
            <h2 className="mb-3">Team Building Opportunities</h2>
            <p className="text-sm text-muted-foreground leading-relaxed mb-4">
              Move beyond trust falls and breakout rooms. East Africa offers conservation-led team-building that
              ties directly to corporate ESG narratives:
            </p>
            <div className="grid sm:grid-cols-2 gap-3">
              {[
                "Rhino tracking on foot with Lewa Wildlife Conservancy rangers",
                "Tree-planting with Maasai community-based forestry groups",
                "Anti-poaching K9 unit demonstrations and fundraising challenges",
                "Cooking competitions led by lodge head chefs over open fires",
                "Hot-air balloon teams over the Mara at sunrise",
                "Maasai warrior training — spear-throwing, fire-starting, beadwork",
              ].map((t) => (
                <div key={t} className="bg-muted/40 border border-border rounded-lg px-4 py-3 text-sm flex items-start gap-2">
                  <Check className="w-4 h-4 text-primary flex-shrink-0 mt-0.5" />{t}
                </div>
              ))}
            </div>
          </section>

          <section>
            <h2 className="mb-3">Luxury Safari Incentives</h2>
            <p className="text-sm text-muted-foreground leading-relaxed">
              For C-suite and top-tier reward programmes we deploy fly-in safaris using exclusive-use camps such
              as Angama Mara, Sanctuary Olonana, Singita Grumeti, Sasakwa Lodge, Cottar's 1920s Camp, and
              Roving Bushtops. Programmes include scenic helicopter transfers, hosted Champagne sundowners on
              private kopjes, bush breakfasts in the Serengeti, and private chef-led tasting menus paired with
              South African and French wines.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Beach & Safari Incentives</h2>
            <p className="text-sm text-muted-foreground leading-relaxed">
              Our most-requested format pairs 3–4 nights of high-octane safari with 2–3 nights of beach decompression
              on Diani Beach (Kenya's south coast) or in Zanzibar's Matemwe, Kendwa or Michamvi peninsulas. The
              beach segment hosts the gala dinner, awards ceremony and free-time activities — kitesurfing,
              spice-island tours, dhow sunset cruises and Stone Town heritage walks.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Suggested Incentive Packages</h2>
            <div className="grid sm:grid-cols-2 gap-4">
              {[
                { title: "5-Night Kenya Classic Incentive", text: "Nairobi → Maasai Mara (3 nights, fly-in) → Diani Beach (2 nights). Bush gala dinner, conservation activity, awards on the beach." },
                { title: "6-Night Tanzania Premier Incentive", text: "Arusha → Ngorongoro (1) → Serengeti (3, fly-in) → Zanzibar (2). Balloon safari add-on, Stone Town gala." },
                { title: "7-Night Kenya & Tanzania Bucket-List", text: "Mara → Serengeti → Zanzibar. Two-country migration experience plus beach awards programme." },
                { title: "4-Night Express Recognition Trip", text: "Nairobi → Maasai Mara fly-in (3 nights). Perfect for time-poor top-performer rewards." },
              ].map((p) => (
                <div key={p.title} className="bg-card border border-border rounded-xl p-5">
                  <Briefcase className="w-5 h-5 text-accent mb-2" />
                  <h3 className="text-sm font-heading font-bold mb-1.5">{p.title}</h3>
                  <p className="text-xs text-muted-foreground leading-relaxed">{p.text}</p>
                </div>
              ))}
            </div>
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
            <h2 className="mb-4">Related Experiences</h2>
            <div className="grid sm:grid-cols-3 gap-4 text-sm">
              <Link to="/kenya-tanzania-dmc" className="bg-card border border-border rounded-xl p-4 hover:border-primary">
                <h3 className="font-heading font-bold mb-1">Kenya & Tanzania DMC</h3>
                <p className="text-xs text-muted-foreground">Full destination management services.</p>
              </Link>
              <Link to="/kenya-safaris/helicopter" className="bg-card border border-border rounded-xl p-4 hover:border-primary">
                <h3 className="font-heading font-bold mb-1">Helicopter Safaris</h3>
                <p className="text-xs text-muted-foreground">Exclusive aerial experiences for VIPs.</p>
              </Link>
              <Link to="/combo-safaris" className="bg-card border border-border rounded-xl p-4 hover:border-primary">
                <h3 className="font-heading font-bold mb-1">Combo Safaris</h3>
                <p className="text-xs text-muted-foreground">Multi-country safari combinations.</p>
              </Link>
            </div>
          </section>
        </div>

        <aside>
          <div className="sticky top-24">
            <BookingFormTour
              subject="Incentive Safari Enquiry"
              contextLine="Corporate incentive group enquiry"
            />
          </div>
        </aside>
      </div>
    </>
  );
};

export default IncentiveSafaris;
