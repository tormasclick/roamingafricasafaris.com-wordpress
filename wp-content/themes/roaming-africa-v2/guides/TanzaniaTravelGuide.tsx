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
  { id: "zanzibar", label: "Zanzibar & The Coast" },
  { id: "kilimanjaro", label: "Climbing Kilimanjaro" },
  { id: "stays", label: "Accommodation Guide" },
  { id: "culture", label: "Culture & People" },
  { id: "getting-around", label: "Getting Around" },
  { id: "visa", label: "Visas, Health & Safety" },
  { id: "packing", label: "Packing Guide" },
  { id: "budget", label: "Costs & Budgeting" },
  { id: "faqs", label: "Frequently Asked Questions" },
];

const parks = [
  { key: "serengeti", name: "Serengeti National Park", blurb: "30,000 sq km of endless plains, the stage for the Great Migration and arguably Africa's greatest wildlife park." },
  { key: "ngorongoro", name: "Ngorongoro Crater", blurb: "A UNESCO World Heritage Site — a collapsed volcanic caldera packed with all of the Big Five within 260 sq km." },
  { key: "tarangire", name: "Tarangire National Park", blurb: "Ancient baobabs and enormous elephant herds — Tanzania's most underrated park, especially Jun–Oct." },
  { key: "lake-manyara", name: "Lake Manyara National Park", blurb: "Famous for tree-climbing lions, soda-lake flamingos and groundwater forests." },
  { key: "nyerere-national-park", name: "Nyerere National Park (Selous)", blurb: "Tanzania's largest park — boat safaris on the Rufiji, wild dogs and unfenced wilderness in the south." },
  { key: "grumeti-game-reserve", name: "Grumeti Game Reserve", blurb: "Exclusive western Serengeti — fewer vehicles, dramatic Grumeti River crossings (Jun–Jul) and luxury-only camps." },
];

const TanzaniaTravelGuide = () => (
  <>
    <SEO
      title="The Ultimate Tanzania Travel Guide (2026)"
      description="Plan the perfect Tanzania safari — Serengeti, Ngorongoro, Zanzibar, Kilimanjaro, best months, costs, lodges, packing list and FAQs from a local DMC."
      canonical="https://roamingafricatours.com/resources/tanzania-travel-guide"
      keywords="Tanzania travel guide, Tanzania safari guide, Serengeti, Ngorongoro Crater, Zanzibar, Kilimanjaro climb, Great Migration Tanzania"
    />

    <div className="relative h-[55vh] min-h-[360px] overflow-hidden">
      <img src={getHeroImage("serengeti")} alt="Wildebeest migration on the Serengeti plains, Tanzania" className="absolute inset-0 w-full h-full object-cover" />
      <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/40" />
      <div className="absolute inset-x-0 bottom-0 container mx-auto px-4 pb-10 text-primary-foreground">
        <span className="text-xs uppercase tracking-widest text-accent font-bold">Travel Guide</span>
        <h1 className="mt-2 max-w-3xl text-3xl md:text-5xl">The Ultimate Tanzania Travel Guide</h1>
        <div className="flex items-center gap-5 mt-4 text-sm opacity-90">
          <span className="flex items-center gap-1.5"><User className="w-4 h-4" /> Roaming Africa Editorial</span>
          <span className="flex items-center gap-1.5"><Clock className="w-4 h-4" /> 16 min read</span>
        </div>
      </div>
    </div>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "Resources", href: "/resources" }, { label: "Tanzania Travel Guide" }]} />
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
          <h2 className="text-2xl mb-3">Introduction to Tanzania</h2>
          <p className="text-muted-foreground leading-relaxed">
            Tanzania is East Africa's safari heavyweight — home to the Serengeti, the Ngorongoro Crater, Africa's tallest mountain (Kilimanjaro, 5,895 m), and the spice-island beaches of Zanzibar. More than 25% of the country is protected wilderness, including the largest concentration of wildlife on the continent.
          </p>
          <p className="text-muted-foreground leading-relaxed mt-3">
            This guide is written by our Roaming Africa Tours & Safaris team in Nairobi and Arusha — combining decades of in-country experience to help you plan the perfect Tanzania trip, from northern circuit classics to off-the-grid southern parks and the white-sand finale of Zanzibar.
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
          <h2 className="text-2xl mb-3 flex items-center gap-2"><Calendar className="w-5 h-5 text-primary" /> Best Time to Visit Tanzania</h2>
          <div className="overflow-x-auto">
            <table className="w-full text-xs border border-border rounded-lg overflow-hidden">
              <thead className="bg-muted">
                <tr><th className="p-2 text-left">Months</th><th className="p-2 text-left">Season</th><th className="p-2 text-left">What to Expect</th></tr>
              </thead>
              <tbody>
                <tr className="border-t border-border"><td className="p-2 font-bold">Jan–Feb</td><td className="p-2">Short dry</td><td className="p-2 text-muted-foreground">Calving season in southern Serengeti — incredible predator action.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Mar–May</td><td className="p-2">Long rains</td><td className="p-2 text-muted-foreground">Lush green, lowest rates, some camps closed. Excellent for birding.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Jun–Jul</td><td className="p-2">Dry / migration moving</td><td className="p-2 text-muted-foreground">Grumeti River crossings in western Serengeti.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Aug–Oct</td><td className="p-2">Peak dry</td><td className="p-2 text-muted-foreground">Migration in northern Serengeti, Mara River crossings, peak rates.</td></tr>
                <tr className="border-t border-border"><td className="p-2 font-bold">Nov–Dec</td><td className="p-2">Short rains</td><td className="p-2 text-muted-foreground">Migration heading south, brief showers, good value.</td></tr>
              </tbody>
            </table>
          </div>
        </section>

        <section id="wildlife">
          <h2 className="text-2xl mb-3 flex items-center gap-2"><Camera className="w-5 h-5 text-primary" /> Wildlife & The Big Five</h2>
          <img src={getDestinationImage("ngorongoro")} alt="Lions on the Ngorongoro Crater floor" className="w-full h-56 object-cover rounded-xl mb-4" loading="lazy" />
          <p className="text-muted-foreground leading-relaxed">
            Tanzania hosts an estimated 4 million large animals, including the world's largest lion population, the densest elephant herds in Tarangire, and rare species like wild dog (Nyerere/Ruaha), tree-climbing lions (Manyara) and black rhino (Ngorongoro). The Ngorongoro Crater is one of the few places on Earth where all of the Big Five can be ticked off in a single morning drive.
          </p>
        </section>

        <section id="migration">
          <h2 className="text-2xl mb-3">The Great Migration in Tanzania</h2>
          <img src={getHeroImage("serengeti")} alt="Wildebeest herd on the Serengeti plains" className="w-full h-56 object-cover rounded-xl mb-4" loading="lazy" />
          <p className="text-muted-foreground leading-relaxed">
            Unlike Kenya, Tanzania hosts the migration year-round — only the location changes. Dec–Mar: calving in the southern Serengeti (Ndutu). Apr–May: herds move north-west through central Serengeti. Jun–Jul: Grumeti River crossings. Aug–Oct: Mara River crossings in northern Serengeti. Choosing the right camp for the right month is everything — our team books migration camps on a season-by-season basis.
          </p>
        </section>

        <section id="zanzibar">
          <h2 className="text-2xl mb-3">Zanzibar & The Coast</h2>
          <img src={getDestinationImage("zanzibar")} alt="Dhow boats on Zanzibar's turquoise water" className="w-full h-56 object-cover rounded-xl mb-4" loading="lazy" />
          <p className="text-muted-foreground leading-relaxed">
            Pair 5–7 days of safari with 3–5 nights on Zanzibar — UNESCO-listed Stone Town, spice plantation tours, snorkelling at Mnemba Atoll, and barefoot beach resorts from Nungwi in the north to Paje and Jambiani on the east coast. Direct flights from Arusha and the Serengeti take 1–2 hours.
          </p>
        </section>

        <section id="kilimanjaro">
          <h2 className="text-2xl mb-3">Climbing Kilimanjaro</h2>
          <p className="text-muted-foreground leading-relaxed">
            Africa's highest summit (5,895 m) is non-technical but altitude is the great equaliser. The most successful routes are <strong>Machame</strong> (7 days, scenic), <strong>Lemosho</strong> (8 days, highest success rate) and <strong>Rongai</strong> (6–7 days, quieter, approached from the north). Best months: Jan–Feb and Jun–Oct.
          </p>
        </section>

        <section id="stays">
          <h2 className="text-2xl mb-3">Accommodation Guide</h2>
          <p className="text-muted-foreground leading-relaxed">
            Tanzania spans the full spectrum — mobile tented camps that follow the migration ($600–$900 pppn), classic lodges around Ngorongoro and central Serengeti ($350–$600), and ultra-luxury private concessions in Grumeti, Singita and Klein's Camp ($2,000–$4,500). Our team matches camps to your travel style, dates and budget — not the other way around.
          </p>
        </section>

        <section id="culture">
          <h2 className="text-2xl mb-3">Culture & People</h2>
          <p className="text-muted-foreground leading-relaxed">
            Tanzania is home to 120+ ethnic groups including the Maasai, Hadzabe (one of Africa's last hunter-gatherer communities, near Lake Eyasi), Datoga blacksmiths and the Swahili-speaking coastal communities. Kiswahili is the national language — learning a few words goes a long way.
          </p>
        </section>

        <section id="getting-around">
          <h2 className="text-2xl mb-3 flex items-center gap-2"><Compass className="w-5 h-5 text-primary" /> Getting Around</h2>
          <p className="text-muted-foreground leading-relaxed">
            Most international travellers fly into <strong>Kilimanjaro International (JRO)</strong> for the northern circuit, or <strong>Julius Nyerere International (DAR)</strong> for southern parks and Zanzibar. Bush flights between Arusha, the Serengeti, Selous/Nyerere and Zanzibar are operated by Coastal, Auric and Regional Air. Road safaris on the northern circuit are well-paved between Arusha–Manyara–Ngorongoro but rough into the Serengeti.
          </p>
        </section>

        <section id="visa">
          <h2 className="text-2xl mb-3">Visas, Health & Safety</h2>
          <ul className="list-disc pl-5 space-y-1.5 text-muted-foreground">
            <li><strong>Visa:</strong> Most nationalities can apply for the eVisa online or get a visa on arrival ($50–$100 USD cash).</li>
            <li><strong>Yellow Fever:</strong> Required if arriving from a yellow-fever country (including Kenya).</li>
            <li><strong>Malaria:</strong> Prophylaxis recommended for all safari areas and Zanzibar.</li>
            <li><strong>Safety:</strong> Tanzania is politically stable and very safe in tourist areas. Standard precautions apply in Dar es Salaam and Stone Town.</li>
          </ul>
        </section>

        <section id="packing">
          <h2 className="text-2xl mb-3">Packing Guide</h2>
          <ul className="list-disc pl-5 space-y-1 text-muted-foreground">
            <li>Neutral safari clothing — avoid blue/black (attracts tsetse flies).</li>
            <li>Fleece or down jacket for cold Ngorongoro mornings and high-altitude camps.</li>
            <li>Soft duffel under 15 kg for internal bush flights — hard suitcases not accepted.</li>
            <li>Reef-safe sunscreen for Zanzibar; modest cover-ups for Stone Town.</li>
            <li>Binoculars, camera with zoom, head torch, universal adapter (Type G/D).</li>
          </ul>
        </section>

        <section id="budget">
          <h2 className="text-2xl mb-3">Costs & Budgeting</h2>
          <p className="text-muted-foreground leading-relaxed">
            Northern circuit budget camping safaris start around <strong>$300–$400</strong> per person per day. Mid-range lodge safaris average <strong>$550–$850</strong>. Migration-season tented camps and southern circuit fly-in safaris average <strong>$900–$1,800</strong>. Ultra-luxury private concessions run <strong>$2,500–$4,500+</strong>. Park fees alone are $70–$100 per person per day in the main parks.
          </p>
        </section>

        <section id="faqs">
          <h2 className="text-2xl mb-3">Frequently Asked Questions</h2>
          <div className="space-y-4 text-muted-foreground">
            <div><p className="font-heading font-bold text-foreground">Kenya or Tanzania — which is better?</p><p>Tanzania has bigger parks and the year-round migration; Kenya has higher big-cat density, more variety of landscapes and easier logistics. Many of our guests do both in one trip.</p></div>
            <div><p className="font-heading font-bold text-foreground">How many days do I need?</p><p>6–8 days for the classic northern circuit (Tarangire, Manyara, Serengeti, Ngorongoro), plus 4–5 nights on Zanzibar.</p></div>
            <div><p className="font-heading font-bold text-foreground">Is Zanzibar safe?</p><p>Yes — Zanzibar is very safe. Dress modestly in Stone Town (it's a conservative Muslim culture); resort beaches are relaxed.</p></div>
            <div><p className="font-heading font-bold text-foreground">When is the cheapest time to visit?</p><p>April–May (long rains) offers the best value, but expect daily showers and some remote camps closed.</p></div>
            <div><p className="font-heading font-bold text-foreground">Can I combine Tanzania with Kenya?</p><p>Yes — a 10–14 day Kenya–Tanzania combo (Maasai Mara → Serengeti → Ngorongoro → Zanzibar) is one of our most popular itineraries.</p></div>
          </div>
        </section>

        <div className="mt-10 p-6 rounded-2xl bg-primary text-primary-foreground text-center">
          <h3 className="text-lg mb-2">Ready to plan your Tanzania safari?</h3>
          <p className="text-sm opacity-90 mb-4">Get a tailored itinerary from our DMC team within 1 hour.</p>
          <Link to="/booking" className="inline-block bg-accent text-accent-foreground px-6 py-2.5 rounded-full font-heading font-bold text-sm">
            Request a Custom Quote
          </Link>
        </div>
      </div>
    </article>
  </>
);

export default TanzaniaTravelGuide;
