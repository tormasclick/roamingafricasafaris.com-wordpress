import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import BookingFormTour from "@/components/BookingFormTour";
import SafariCard from "@/components/SafariCard";
import { safariPackages } from "@/data/safariPackages";
import { getDestinationImage } from "@/data/images";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { Award, Compass, Users, Camera, Binoculars, Map } from "lucide-react";

const PACKAGE_SLUGS = [
  "8-days-kenya-tanzania-safari",
  "7-days-kenya-family-safari",
  "7-days-highlights-of-kenya",
  "5-days-safari-to-masai-mara-and-lake-nakuru",
  // 5 Days Masai Mara Great Migration Photo Safari fallback to Mara/Nakuru
];

const faqs = [
  { q: "What is the Great Migration?", a: "The Great Wildebeest Migration is the year-round movement of over 1.5 million wildebeest, 300,000 zebras and 500,000 gazelles in a continuous clockwise loop through the Serengeti–Mara ecosystem, driven by rainfall and fresh grazing. It is the largest overland mammal migration on Earth." },
  { q: "When is the best time to see the Mara River crossings?", a: "The most dramatic Mara River crossings happen between July and October, when the herds move from Tanzania's northern Serengeti into Kenya's Masai Mara. August and September are peak crossing months." },
  { q: "When is the calving season in Serengeti?", a: "Calving season runs from late January through March in the southern Serengeti and Ndutu plains. Around 500,000 wildebeest calves are born within a 2–3 week window, drawing the highest predator concentrations of the year." },
  { q: "Should I go to Kenya or Tanzania for the Migration?", a: "Both are excellent — the Mara delivers the iconic river-crossing drama from July to October, while the Serengeti gives you calving (Jan–Mar), the rut and central plains action (Apr–Jun) and the northern crossings. A combined Kenya–Tanzania safari covers the full cycle." },
  { q: "How many days do I need for a Great Migration safari?", a: "A minimum of 5 days is recommended to give the wildlife time to come to you. 7–10 days lets you combine Masai Mara with Lake Nakuru, Amboseli or the Serengeti and Ngorongoro for a complete experience." },
  { q: "What lodges are best during the Migration?", a: "We recommend mobile migration camps that move with the herds (Kogatende, Serengeti North; Mara Triangle, Mara North Conservancy) plus established luxury camps such as Sanctuary Olonana, Mara Serena, Governors' Camp and Singita Mara River Tented Camp." },
  { q: "Is the Great Migration safari suitable for families?", a: "Yes — our 7 Days Kenya Family Safari and combo itineraries are tailored for families with children, with private 4×4 Land Cruisers, family-friendly lodges, shorter game-drive segments and naturalist guides who engage younger guests." },
];

const faqJsonLd = {
  "@context": "https://schema.org",
  "@type": "FAQPage",
  mainEntity: faqs.map((f) => ({
    "@type": "Question",
    name: f.q,
    acceptedAnswer: { "@type": "Answer", text: f.a },
  })),
};

const trust = [
  { icon: Award, title: "Operating Since 2006", desc: "Nearly two decades planning Migration safaris across Kenya and Tanzania." },
  { icon: Map, title: "Serengeti–Mara Specialists", desc: "Insider knowledge of crossing points, camp locations and seasonal herd movement." },
  { icon: Binoculars, title: "Expert Driver Guides", desc: "KPSGA-certified guides who track the herds daily during peak season." },
  { icon: Camera, title: "Photographer-Friendly", desc: "Private 4×4 Land Cruisers with pop-up roofs and beanbag camera supports." },
  { icon: Users, title: "Family & Honeymoon Itineraries", desc: "Customised migration trips for families, couples and small groups." },
  { icon: Compass, title: "Combined Kenya–Tanzania DMC", desc: "One operator handles permits, flights, lodges and ground transport across borders." },
];

const GreatMigrationSafaris = () => {
  const packages = PACKAGE_SLUGS
    .map((s) => safariPackages.find((p) => p.slug === s))
    .filter(Boolean);

  return (
    <>
      <SEO
        title="Great Migration Safaris Kenya & Tanzania | Masai Mara & Serengeti Crossings"
        description="Witness the Great Wildebeest Migration on a tailor-made Kenya or Tanzania safari. Mara River crossings, Serengeti calving season and combined Masai Mara–Serengeti packages from East Africa's trusted DMC since 2006."
        keywords="Great Migration Kenya, Great Migration Tanzania, Great Wildebeest Migration, Masai Mara Migration Safari, Serengeti Migration Safari, River Crossing Safari, Migration Safari Packages"
        canonical="https://roamingafricatours.com/great-migration-safaris"
        jsonLd={faqJsonLd}
      />

      <PageHero imageKey="masai-mara">
        <p className="text-primary-foreground/80 text-sm mb-1">Kenya & Tanzania · Year-round</p>
        <h1 className="text-primary-foreground">Great Migration Safaris</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Great Migration Safaris" }]} />
      </div>

      <div className="container mx-auto px-4 py-10 grid lg:grid-cols-3 gap-10">
        <div className="lg:col-span-2 space-y-12">

          <section>
            <h2 className="mb-4">The Great Wildebeest Migration — East Africa's Greatest Wildlife Spectacle</h2>
            <p className="text-muted-foreground leading-relaxed mb-4">
              The Great Migration is the largest overland mammal movement on Earth — more than <strong>1.5 million wildebeest</strong>, 300,000 zebras and half a million gazelles moving in a continuous clockwise loop through the Serengeti–Mara ecosystem of Tanzania and Kenya. Roaming Africa Tours and Safaris has been planning Great Migration safaris since 2006, with intimate knowledge of where the herds are in every month of the year and the best lodges and mobile camps to follow them.
            </p>
            <p className="text-muted-foreground leading-relaxed">
              Our Great Migration safaris combine Kenya's <strong>Masai Mara</strong> with Tanzania's <strong>Serengeti</strong> and <strong>Ngorongoro Crater</strong> — letting you witness river crossings, calving season, dramatic predator action and endless plains in a single, seamless East African journey planned by your DMC of choice.
            </p>
          </section>

          <section>
            <h2 className="mb-4">Understanding the Great Migration Cycle</h2>
            <p className="text-muted-foreground leading-relaxed">
              The Migration follows rainfall and fresh grazing in a roughly circular route. Wildebeest, zebra and gazelle move through four distinct phases each year — calving in the southern Serengeti, movement through the central Serengeti and western corridor, the dramatic Mara River crossings in the north and the slow return south. Understanding where the herds are at any given moment is the key to planning the right Migration safari for your travel dates.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Calving Season in Serengeti (January – March)</h2>
            <p className="text-muted-foreground leading-relaxed">
              In the short-grass plains of the southern Serengeti and Ndutu, around <strong>500,000 wildebeest calves</strong> are born within a 2–3 week window in February. This concentration of newborns attracts the highest density of predators of the year — lion, cheetah, hyena and leopard hunt against a backdrop of green plains. Calving season delivers the most dramatic predator–prey action in Africa and is the perfect time for photographers and repeat safari travellers.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Movement Through Central Serengeti (April – June)</h2>
            <p className="text-muted-foreground leading-relaxed">
              As the short rains end, the herds begin moving north and west through the central Seronera region and into the Western Corridor. April and May are quieter, lower-cost months with lush green landscapes and the rutting season — male wildebeest fighting for breeding rights. The Grumeti River crossings happen here in late May and June, with giant crocodiles and the first big predator drama of the year.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Arrival in Masai Mara (July – October)</h2>
            <p className="text-muted-foreground leading-relaxed">
              From July, the front of the herd crosses into Kenya's <strong>Masai Mara</strong> via the Sand River and northern Serengeti. The Mara hosts the herds until late October, with the highest big-cat density in Africa — lion, cheetah and leopard concentrated alongside the wildebeest. Hot-air balloon safaris over the Mara at this time deliver some of the most iconic safari imagery on Earth.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Mara River Crossings — The Climax of the Migration</h2>
            <p className="text-muted-foreground leading-relaxed">
              The <strong>Mara River crossings</strong> between July and October are the iconic image of the Great Migration — thousands of wildebeest plunging from steep banks into crocodile-filled waters. Key crossing points include the Mara Triangle, Lookout Hill and the northern Serengeti's Kogatende area. Our experienced driver guides know each crossing site, the herd's behavioural patterns and the best vantage points for photography.
            </p>
          </section>

          <section>
            <h2 className="mb-3">Best Time to Witness the Migration</h2>
            <ul className="space-y-2 text-muted-foreground">
              <li><strong>January – March:</strong> Calving season, Southern Serengeti & Ndutu</li>
              <li><strong>April – June:</strong> Rut and western corridor, Grumeti crossings</li>
              <li><strong>July – October:</strong> Mara River crossings, Masai Mara & Northern Serengeti</li>
              <li><strong>November – December:</strong> Short rains, herds returning south through Loliondo</li>
            </ul>
          </section>

          <section>
            <h2 className="mb-3">Accommodation During the Migration</h2>
            <p className="text-muted-foreground leading-relaxed">
              We use a curated portfolio of mobile migration camps that relocate seasonally with the herds — Serengeti North in July–October, Ndutu and southern Serengeti in January–March — alongside established luxury camps in the Mara Triangle, Mara North Conservancy and the Olare Motorogi Conservancy. Lodges range from family-friendly tented camps to ultra-luxury offerings such as Singita, andBeyond Klein's Camp and Sanctuary Olonana.
            </p>
          </section>

          <section>
            <h2 className="mb-6">Why Travel With Roaming Africa Tours &amp; Safaris</h2>
            <div className="grid sm:grid-cols-2 gap-4">
              {trust.map(({ icon: Icon, title, desc }) => (
                <article key={title} className="bg-card border border-border rounded-xl p-5 flex gap-4">
                  <div className="w-12 h-12 rounded-lg bg-primary text-primary-foreground flex items-center justify-center flex-shrink-0">
                    <Icon className="w-6 h-6" />
                  </div>
                  <div>
                    <h3 className="font-heading font-bold text-base mb-1">{title}</h3>
                    <p className="text-sm text-muted-foreground">{desc}</p>
                  </div>
                </article>
              ))}
            </div>
          </section>

          <section>
            <h2 className="mb-6">Migration Safari Packages</h2>
            <div className="grid sm:grid-cols-2 gap-6">
              {packages.map((pkg) => pkg && <SafariCard key={pkg.id} pkg={pkg} />)}

              {/* Custom Masai Mara photo safari card — slug fallback to existing Mara/Nakuru */}
              <div className="group bg-card rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-border">
                <div className="relative overflow-hidden h-52">
                  <img
                    src={getDestinationImage("masai-mara")}
                    alt="5 Days Masai Mara Great Migration Photo Safari"
                    className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    loading="lazy"
                  />
                  <div className="absolute top-3 left-3 bg-primary text-primary-foreground text-xs font-heading font-bold px-3 py-1 rounded-full">Kenya</div>
                </div>
                <div className="p-5">
                  <h3 className="text-lg mb-2 group-hover:text-primary transition-colors">5 Days Masai Mara Great Migration Photo Safari</h3>
                  <p className="text-sm text-muted-foreground mb-4 line-clamp-2">
                    A dedicated 5-day photographic safari following the Migration herds in the Masai Mara, with private 4×4 vehicles, beanbag supports and morning balloon flight option.
                  </p>
                  <a href="/safari/5-days-safari-to-masai-mara-and-lake-nakuru" className="inline-flex items-center gap-1 text-sm font-heading font-bold text-primary hover:text-secondary">
                    View Details →
                  </a>
                </div>
              </div>
            </div>
          </section>

          <section>
            <h2 className="mb-4">Frequently Asked Questions</h2>
            <Accordion type="single" collapsible className="w-full">
              {faqs.map((f, i) => (
                <AccordionItem key={i} value={`faq-${i}`}>
                  <AccordionTrigger className="text-left">{f.q}</AccordionTrigger>
                  <AccordionContent className="text-muted-foreground">{f.a}</AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </section>

          <section id="booking">
            <h2 className="mb-4">Plan Your Great Migration Safari</h2>
            <BookingFormTour
              subject="Great Migration Safari Enquiry"
              contextLine="Tell us your travel dates and we'll match the herds to your itinerary."
            />
          </section>
        </div>

        <aside>
          <div className="sticky top-24">
            <BookingFormTour
              subject="Great Migration Safari Enquiry"
              contextLine="Kenya & Tanzania · Year-round Migration"
            />
          </div>
        </aside>
      </div>
    </>
  );
};

export default GreatMigrationSafaris;
