import { Link } from "react-router-dom";
import { BookOpen, Globe, Binoculars } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";

const resources = [
  {
    category: "Safari Planning Guides",
    icon: BookOpen,
    items: [
      { title: "Kenya Safari Cost Guide", desc: "Detailed breakdown of what a Kenya safari costs, from budget to luxury options.", slug: "kenya-safari-cost-guide" },
      { title: "Best Time to Visit East Africa", desc: "Month-by-month guide to weather, wildlife, and seasons across Kenya and Tanzania.", slug: "best-time-visit-east-africa" },
      { title: "What to Pack for Safari", desc: "Complete packing list with essential clothing, gear, and accessories for your African safari.", slug: "what-to-pack-safari" },
    ],
  },
  {
    category: "Travel Information",
    icon: Globe,
    items: [
      { title: "Visa Requirements for East Africa", desc: "Everything you need to know about visas for Kenya and Tanzania.", slug: "visa-requirements" },
      { title: "Health and Vaccination Guide", desc: "Recommended vaccinations, malaria prevention, and health tips for East African travel.", slug: "health-vaccination-guide" },
      { title: "Travel Insurance for Safari", desc: "Why travel insurance is essential and what to look for in a safari travel policy.", slug: "travel-insurance" },
    ],
  },
  {
    category: "Wildlife Guides",
    icon: Binoculars,
    items: [
      { title: "The Big Five Wildlife Guide", desc: "Learn about Africa's iconic Big Five: lion, leopard, elephant, buffalo, and rhino.", slug: "big-five-guide" },
      { title: "Great Migration Guide", desc: "Complete guide to the Great Wildebeest Migration across the Serengeti-Mara ecosystem.", slug: "great-migration-guide" },
      { title: "Wildlife Photography Guide", desc: "Tips, gear, and techniques for capturing stunning wildlife photos on your East Africa safari.", slug: "wildlife-photography-guide" },
    ],
  },
];

const Resources = () => (
  <>
    <SEO title="Safari Resource Center | Planning Guides & Travel Tips" description="Comprehensive safari resource center with planning guides, travel information, wildlife guides, and expert tips for your East African adventure." />

    <div className="section-green py-16">
      <div className="container mx-auto px-4 text-center">
        <h1 className="text-primary-foreground mb-4">Resource Center</h1>
        <p className="text-primary-foreground opacity-80 max-w-2xl mx-auto">Your comprehensive guide to planning the perfect East African safari adventure.</p>
      </div>
    </div>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "Resources" }]} />
    </div>

    <div className="container mx-auto px-4 py-12 space-y-16">
      {resources.map(({ category, icon: Icon, items }) => (
        <section key={category}>
          <div className="flex items-center gap-3 mb-8">
            <Icon className="w-8 h-8 text-primary" />
            <h2>{category}</h2>
          </div>
          <div className="grid md:grid-cols-3 gap-6">
            {items.map((item) => (
              <Link key={item.slug} to={`/resources/${item.slug}`} className="bg-card border border-border rounded-xl p-6 hover:shadow-lg transition-shadow group">
                <h3 className="text-lg mb-2 group-hover:text-primary transition-colors">{item.title}</h3>
                <p className="text-muted-foreground text-sm">{item.desc}</p>
              </Link>
            ))}
          </div>
        </section>
      ))}
    </div>
  </>
);

export default Resources;
