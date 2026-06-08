import { Link } from "react-router-dom";
import { vehicles } from "@/data/vehicles";
import { Truck, Users, ArrowRight } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";

const CATEGORY_LABEL = {
  safari: "Safari Vehicles",
  "self-drive": "Self Drive Vehicles",
  bus: "Luxury Buses",
} as const;

const Vehicles = () => {
  const grouped = (["safari", "self-drive", "bus"] as const).map((cat) => ({
    key: cat,
    label: CATEGORY_LABEL[cat],
    items: vehicles.filter((v) => v.category === cat),
  }));

  return (
    <>
      <SEO
        title="Our Vehicles | Safari, Self Drive & Luxury Buses Kenya & Tanzania"
        description="Our complete fleet: Land Cruiser V8, Double Cabin, Overland Truck, Wheelchair Accessible Land Cruiser, Self Drive vehicles and 25/33/51 seater luxury buses for hire across Kenya, Tanzania and Zanzibar."
      />

      <PageHero>
        <h1 className="text-primary-foreground">Our Vehicles</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Our Vehicles" }]} />
      </div>

      <div className="container mx-auto px-4 py-10 space-y-12">
        <div className="max-w-3xl">
          <h2 className="mb-4">Reliable Safari, Self-Drive & Luxury Bus Hire</h2>
          <p className="text-muted-foreground leading-relaxed">
            Roaming Africa Tours and Safaris operates one of East Africa's most respected fleets — purpose-built safari 4×4s, fully equipped self-drive vehicles and modern luxury coaches. Every vehicle is maintained in-house, fully insured and supported by professional driver guides and 24/7 mechanical assistance across Kenya, Tanzania and Zanzibar.
          </p>
        </div>

        {grouped.map((group) => (
          <section key={group.key}>
            <h2 className="mb-6">{group.label}</h2>
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
              {group.items.map((v) => (
                <Link
                  key={v.id}
                  to={`/our-vehicles/${v.slug}`}
                  className="group bg-card border border-border rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                >
                  <div className="relative h-48 overflow-hidden">
                    <img src={v.image} alt={v.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                  </div>
                  <div className="p-5">
                    <h3 className="text-base font-heading font-bold mb-1 flex items-center gap-2">
                      <Truck className="w-4 h-4 text-primary flex-shrink-0" />{v.name}
                    </h3>
                    <p className="text-xs text-muted-foreground mb-2 flex items-center gap-1"><Users className="w-3 h-3" />{v.capacity}</p>
                    <p className="text-sm text-muted-foreground line-clamp-2">{v.shortDescription}</p>
                    <span className="mt-3 inline-flex items-center gap-1 text-sm font-heading font-bold text-primary">
                      Read More <ArrowRight className="w-4 h-4" />
                    </span>
                  </div>
                </Link>
              ))}
            </div>
          </section>
        ))}
      </div>
    </>
  );
};

export default Vehicles;

