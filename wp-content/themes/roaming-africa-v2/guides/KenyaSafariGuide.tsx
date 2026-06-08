import { Link } from "react-router-dom";
import { Clock, User, MapPin, Calendar, Camera, Compass } from "lucide-react";
import SEO from "@/components/SEO";
import Breadcrumbs from "@/components/Breadcrumbs";
import { getHeroImage, getDestinationImage } from "@/data/images";

const toc = [
  { id: "intro", label: "Introduction" },
  { id: "destinations", label: "Best Safari Destinations" },
  { id: "best-time", label: "Best Time to Visit" },
  { id: "wildlife", label: "Wildlife & The Big Five" },
  { id: "migration", label: "The Great Migration" },
  { id: "stays", label: "Accommodation Guide" },
  { id: "culture", label: "Culture & People" },
  { id: "beaches", label: "Coast & Beaches" },
  { id: "getting-around", label: "Getting Around" },
  { id: "visa", label: "Visas, Health & Safety" },
  { id: "packing", label: "Packing Guide" },
  { id: "budget", label: "Costs & Budgeting" },
  { id: "faqs", label: "Frequently Asked Questions" },
];

const parks = [
  { key: "masai-mara", name: "Maasai Mara National Reserve", blurb: "World-famous for the Great Migration (Jul–Oct) and Africa's highest concentration of big cats. The flagship of any Kenya safari." },
  { key: "amboseli", name: "Amboseli National Park", blurb: "Iconic herds of elephants framed by snow-capped Mount Kilimanjaro — Kenya's most photogenic park." },
  { key: "lake-nakuru", name: "Lake Nakuru National Park", blurb: "Pink flamingo flocks, fenced rhino sanctuary, and Rothschild's giraffe in the heart of the Rift Valley." },
  { key: "samburu", name: "Samburu National Reserve", blurb: "Arid northern wilderness home to the 'Special Five' — Grevy's zebra, reticulated giraffe, gerenuk, Beisa oryx and Somali ostrich." },
  { key: "tsavo", name: "Tsavo East & West", blurb: "Kenya's largest wilderness — red-dust elephants, Mzima Springs, and raw, uncrowded landscapes." },
  { key: "ol-pejeta", name: "Ol Pejeta Conservancy", blurb: "Home to the last two northern white rhinos on Earth and the Sweetwaters chimpanzee sanctuary." },
];

const KenyaSafariGuide = () => (
  <>
    <SEO
      title="The Ultimate Kenya Safari Travel Guide (2026)"
      description="Plan the perfect Kenya safari — best parks, ideal months, wildlife, lodges, costs, packing list and FAQs from a Nairobi-based DMC."
      canonical="https://roamingafricatours.com/resources/kenya-safari-guide"
      keywords="Kenya safari guide, Kenya travel guide, Masai Mara safari, Amboseli, best time Kenya safari, Kenya safari cost, Big Five Kenya"
    />

    <div className="relative h-[55vh] min-h-[360px] overflow-hidden">
      <img src={getHeroImage("masai-mara")} alt="Lion at sunrise in the Maasai Mara, Kenya" className="absolute inset-0 w-full h-full object-cover" />
      <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/40" />
      <div className="absolute inset-x-0 bottom-0 container mx-auto px-4 pb-10 text-primary-foreground">
        <span className="text-xs uppercase tracking-widest text-accent font-bold">Travel Guide</span>
        <h1 className="mt-2 max-w-3xl text-3xl md:text-5xl">The Ultimate Kenya Safari Travel Guide</h1>
        <div className="flex items-center gap-5 mt-4 text-sm opacity-90">
          <span className="flex items-center gap-1.5"><User className="w-4 h-4" /> Roaming Africa Editorial</span>
          <span className="flex items-center gap-1.5"><Clock className="w-4 h-4" /> 15 min read</span>
        </div>
      </div>
    </div>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "Resources", href: "/resources" }, { label: "Kenya Safari Guide" }]} />
    </div>

    <article className="container mx-auto px-4 py-10 max-w-3xl">
      <nav aria-label="In this guide" className="mb-10 -mx-4 px-4 overflow-x-auto">
        <ul className="flex gap-2 whitespace-nowrap pb-2">
          {toc.map((t) => (
            <li key={t.id}>
              <a href={`#${t.id}`} className="inline-block text-xs px-3 py-1.5 rounded-full bg-muted text-muted-foreground hover:bg-primary hover:text-primary-foreground transition-colors">
                {t.label}
              </a>
            </li>
          ))}
        </ul>
      </nav>

      <div className="space-y-14 text-sm [&_section]:scroll-mt-24">

        <section id="intro">
          <h2 className="text-2xl mb-3">Introduction to Kenya</h2>
          <p className="text-muted-foreground leading-relaxed">
            Kenya is the birthplace of the modern safari — a country where snow-capped peaks, equatorial forests, the Great Rift Valley and the Indian Ocean meet within a single border. From the legendary Maasai Mara to the elephant-dotted plains of Amboseli, from the flamingo-pink shores of Lake Nakuru to the white-sand beaches of Diani, Kenya packs more landscapes, more wildlife and more cultures into one trip than almost anywhere on Earth.
          </p>
          <p className="text-muted-foreground leading-relaxed mt-3">
            This guide distils everything our DMC team at Roaming Africa Tours & Safaris wishes every traveller knew before stepping off the plane in Nairobi — when to come, where to go, what to pack, what it costs, and how to make every day count.
          </p>
        </section>

        <section id="destinations">
          <h2 className="text-2xl mb-4 flex items-center gap-2"><MapPin className="w-5 h-5 text-primary" /> Best Safari Destinations</h2>
          <div className="grid sm:grid-cols-2 gap-5">
            {parks.map((p) => (
              <div key={p.key} className="rounded-xl overflow-hidden border border-border bg-card">
                <img src={getDestinationImage(p.key)} alt={p.name} className="w-full h-40 object-cover" loading="lazy" />
                <div className="p-4">
                  <h3 className="text-base font-heading font-bold mb-1.5">{p.name}</h3>
                  <p className="text-xs text-muted-foreground leading-relaxed">{p.blurb}</p>
                </div>
              </div>
            ))}
          </div>
        </section>

        <section id="best-time">
          <h2 className="text-2xl mb-3 flex items-center gap-2"><Calendar className="w-5 h-5 text-primary" /> Best Time to Visit Kenya</h2>
          <div className="overflow-x-auto">
            <table className="w-full text-xs border border-border rounded-lg overflow-hidden">
              <thead className="bg-muted">
                <tr><th className="p-2 text-left">Months</th><th className="p-2 text-left">Season</th><th className="p-2 text-left">What to Expect</th></tr>
              </thead>
              <tbody>
                <tr className="border-t border-border"><td className="p-2 font-bold">Jan–Feb</td><td className="p-2">Short dry</td><td className="p-2 text-muted-foreground">Clear Kilimanjaro views, calving season in southern Mara/Serengeti.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Mar–May</td><td className="p-2">Long rains (green)</td><td className="p-2 text-muted-foreground">Lush, quiet parks, lower rates, excellent birding.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Jun</td><td className="p-2">Early dry</td><td className="p-2 text-muted-foreground">Migration herds arriving in the Mara from the south.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Jul–Oct</td><td className="p-2">Peak dry</td><td className="p-2 text-muted-foreground">Great Migration river crossings, best big-cat sightings, peak rates.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Nov–Dec</td><td className="p-2">Short rains</td><td className="p-2 text-muted-foreground">Brief afternoon showers, fewer crowds, good value.</td></tr>
              </tbody>
            </table>
          </div>
        </section>

        <section id="wildlife">
          <h2 className="text-2xl mb-3 flex items-center gap-2"><Camera className="w-5 h-5 text-primary" /> Wildlife & The Big Five</h2>
          <img src={getDestinationImage("amboseli")} alt="Elephant herd in Amboseli with Mount Kilimanjaro" className="w-full h-56 object-cover rounded-xl mb-4" loading="lazy" />
          <p className="text-muted-foreground leading-relaxed">
            Kenya is one of the few countries where you can realistically tick off the Big Five — lion, leopard, elephant, buffalo and rhino — in a single week. Beyond the headline species, plan for cheetah on the Mara plains, reticulated giraffe in Samburu, flamingos at Nakuru and Bogoria, hippos and crocodiles along the Mara River, and 1,100+ recorded bird species nationwide.
          </p>
        </section>

        <section id="migration">
          <h2 className="text-2xl mb-3">The Great Migration in Kenya</h2>
          <img src={getHeroImage("masai-mara")} alt="Wildebeest crossing the Mara River" className="w-full h-56 object-cover rounded-xl mb-4" loading="lazy" />
          <p className="text-muted-foreground leading-relaxed">
            Between July and October, 1.5 million wildebeest, 200,000 zebra and 500,000 gazelle thunder north from the Serengeti into the Maasai Mara — the most spectacular wildlife event on Earth. The Mara River crossings, where herds plunge through crocodile-filled waters, peak from late July to early September. Book river-facing camps 9–12 months ahead.
          </p>
        </section>

        <section id="stays">
          <h2 className="text-2xl mb-3">Accommodation Guide</h2>
          <p className="text-muted-foreground leading-relaxed">
            Kenya covers every comfort tier — honest budget tented camps inside the Mara, mid-range lodges with pools and full-board meals, and design-led tented camps such as Angama Mara, Sanctuary Olonana, Saruni Mara and Ol Donyo. Conservancies neighbouring the main parks offer exclusivity, walking safaris and night drives that are not permitted inside national reserves.
          </p>
        </section>

        <section id="culture">
          <h2 className="text-2xl mb-3">Culture & People</h2>
          <p className="text-muted-foreground leading-relaxed">
            Kenya is home to 44 recognised tribes including the Maasai, Samburu, Kikuyu, Luo, Turkana and Swahili-speaking coastal communities. A respectful village visit, a coffee with a Maasai elder or a Swahili cooking class on the coast adds depth no game drive can replicate.
          </p>
        </section>

        <section id="beaches">
          <h2 className="text-2xl mb-3">Coast & Beaches</h2>
          <img src={getDestinationImage("mombasa")} alt="White sand beach on the Kenyan coast" className="w-full h-56 object-cover rounded-xl mb-4" loading="lazy" />
          <p className="text-muted-foreground leading-relaxed">
            Pair your safari with 3–4 nights at the coast — Diani's powder-white sand, Watamu's marine park, or historic Lamu Old Town. Direct flights from Nairobi take 45–60 minutes.
          </p>
        </section>

        <section id="getting-around">
          <h2 className="text-2xl mb-3 flex items-center gap-2"><Compass className="w-5 h-5 text-primary" /> Getting Around</h2>
          <p className="text-muted-foreground leading-relaxed">
            Most travellers combine 4×4 road safaris with short scheduled bush flights. Nairobi's JKIA handles international arrivals; Wilson Airport (15 min away) handles safari flights. Driving the classic Mara–Nakuru–Amboseli circuit takes 5–7 hours per leg.
          </p>
        </section>

        <section id="visa">
          <h2 className="text-2xl mb-3">Visas, Health & Safety</h2>
          <ul className="list-disc pl-5 space-y-1.5 text-muted-foreground">
            <li><strong>Visa:</strong> Most travellers apply for the electronic Travel Authorization (eTA) online — approval takes 1–3 days.</li>
            <li><strong>Yellow Fever:</strong> Required if arriving from a yellow-fever country.</li>
            <li><strong>Malaria:</strong> Prophylaxis recommended for safari areas; consult your travel doctor.</li>
            <li><strong>Safety:</strong> Wildlife areas and main tourist routes are well managed. Our vehicles and drivers are fully vetted and insured.</li>
          </ul>
        </section>

        <section id="packing">
          <h2 className="text-2xl mb-3">Packing Guide</h2>
          <ul className="list-disc pl-5 space-y-1 text-muted-foreground">
            <li>Neutral safari clothing in layers (mornings are cold, midday is hot).</li>
            <li>Wide-brim hat, polarised sunglasses, high-SPF sunscreen.</li>
            <li>Binoculars (8×42 recommended) and a camera with 100–400mm zoom.</li>
            <li>Soft-sided duffel for fly-in safaris (15kg limit).</li>
            <li>Power bank, universal adapter (Type G), insect repellent with DEET.</li>
          </ul>
        </section>

        <section id="budget">
          <h2 className="text-2xl mb-3">Costs & Budgeting</h2>
          <p className="text-muted-foreground leading-relaxed">
            Budget road safaris start around <strong>$250–$350</strong> per person per day. Mid-range lodge safaris average <strong>$450–$700</strong>. Luxury tented camps and conservancies start at <strong>$900</strong> and climb to <strong>$2,500+</strong> per person per night. Park fees, vehicle, guide, accommodation and full board are typically included.
          </p>
        </section>

        <section id="faqs">
          <h2 className="text-2xl mb-3">Frequently Asked Questions</h2>
          <div className="space-y-4 text-muted-foreground">
            <div><p className="font-heading font-bold text-foreground">Do I need a visa for Kenya?</p><p>Most travellers apply for an eTA online before arrival — the process takes 1–3 days.</p></div>
            <div><p className="font-heading font-bold text-foreground">Is Kenya safe for safari?</p><p>Wildlife areas and main tourist routes are well managed. Our drivers are vetted and vehicles fully insured.</p></div>
            <div><p className="font-heading font-bold text-foreground">How many days do I need?</p><p>7–10 days is ideal for a Mara + Amboseli + Nakuru circuit, with an optional Diani beach extension.</p></div>
            <div><p className="font-heading font-bold text-foreground">What's the best month for the Great Migration?</p><p>August and September give the highest probability of witnessing a Mara River crossing.</p></div>
            <div><p className="font-heading font-bold text-foreground">Is Kenya child-friendly?</p><p>Yes — most lodges welcome children 6+, and family-friendly properties accept all ages with private vehicles.</p></div>
          </div>
        </section>

        <div className="mt-10 p-6 rounded-2xl bg-primary text-primary-foreground text-center">
          <h3 className="text-lg mb-2">Ready to plan your Kenya safari?</h3>
          <p className="text-sm opacity-90 mb-4">Get a tailored itinerary from our Nairobi DMC team within 1 hour.</p>
          <Link to="/booking" className="inline-block bg-accent text-accent-foreground px-6 py-2.5 rounded-full font-heading font-bold text-sm">
            Request a Custom Quote
          </Link>
        </div>
      </div>
    </article>
  </>
);

export default KenyaSafariGuide;
