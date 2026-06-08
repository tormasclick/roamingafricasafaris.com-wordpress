import { Binoculars, Award, Map, Accessibility, Users, Compass } from "lucide-react";

const highlights = [
  {
    icon: Award,
    title: "Operating Since 2006",
    desc: "Nearly two decades creating memorable East African safaris. Roaming Africa Tours and Safaris has guided travellers from over 60 countries across Kenya, Tanzania and Zanzibar.",
    accent: "from-primary/15 to-primary/5",
  },
  {
    icon: Map,
    title: "Destination Management Expertise",
    desc: "A full-service East African DMC handling permits, transfers, lodges, vehicles and ground logistics in-house — one trusted operator from arrival to departure.",
    accent: "from-secondary/15 to-secondary/5",
  },
  {
    icon: Binoculars,
    title: "Deep Local Knowledge",
    desc: "Our team lives and works in Nairobi, Mombasa, Arusha and Zanzibar. We know the parks, the seasons, the camps and the people behind every itinerary we build.",
    accent: "from-accent/15 to-accent/5",
  },
  {
    icon: Users,
    title: "Professional Safari Guides",
    desc: "KPSGA-certified, bronze and silver level driver-guides with years of experience reading wildlife behaviour and translating Kenya, Tanzania and Zanzibar for our guests.",
    accent: "from-primary/15 to-secondary/5",
  },
  {
    icon: Compass,
    title: "Tailor-Made Itineraries",
    desc: "Every journey is customised to your dates, budget and pace — private safaris, family travel, honeymoons, photography expeditions and corporate incentive groups.",
    accent: "from-secondary/15 to-accent/5",
  },
  {
    icon: Accessibility,
    title: "Accessible Travel Specialists",
    desc: "One of East Africa's most established accessible safari programmes — wheelchair-accessible vehicles, step-free lodges and trained guides for barrier-free travel.",
    accent: "from-accent/15 to-primary/5",
  },
];

const SafariHighlights = () => (
  <section className="py-20 bg-background">
    <div className="container mx-auto px-4">
      <div className="max-w-2xl mx-auto text-center mb-14">
        <span className="inline-block text-xs font-heading font-bold uppercase tracking-widest text-accent mb-3">
          Why travel with us
        </span>
        <h2 className="mb-4">Why Travel With Roaming Africa Tours &amp; Safaris</h2>
        <p className="text-muted-foreground text-sm">
          Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.
        </p>
      </div>

      <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {highlights.map(({ icon: Icon, title, desc, accent }, i) => (
          <article
            key={title}
            style={{ animationDelay: `${i * 80}ms` }}
            className={`group relative overflow-hidden rounded-2xl border border-border bg-gradient-to-br ${accent} p-7 hover:-translate-y-1.5 hover:shadow-xl transition-all duration-300 animate-fade-in-up`}
          >
            <div className="w-14 h-14 rounded-2xl bg-primary text-primary-foreground flex items-center justify-center mb-5 group-hover:rotate-6 transition-transform">
              <Icon className="w-7 h-7" />
            </div>
            <h3 className="text-lg mb-2 font-heading font-bold">{title}</h3>
            <p className="text-sm text-muted-foreground leading-relaxed">{desc}</p>
            <div className="absolute -right-10 -bottom-10 w-32 h-32 rounded-full bg-primary/5 group-hover:bg-primary/10 transition-colors" />
          </article>
        ))}
      </div>
    </div>
  </section>
);

export default SafariHighlights;
