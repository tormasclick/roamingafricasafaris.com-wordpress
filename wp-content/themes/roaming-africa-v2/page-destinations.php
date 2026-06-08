import { Link } from "react-router-dom";
import { destinations } from "@/data/destinations";
import { safariPackages } from "@/data/safariPackages";
import { getDestinationImage } from "@/data/images";
import { Clock, MapPin, ArrowRight } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";

const getDestinationPrice = (destName: string): number | undefined => {
  const key = destName.toLowerCase().split(" ")[0];
  const matches = safariPackages.filter(
    (p) => p.priceFrom && p.destinations.some((d) => d.toLowerCase().includes(key))
  );
  if (!matches.length) return undefined;
  return Math.min(...matches.map((p) => p.priceFrom as number));
};

const Destinations = () => (
  <>
    <SEO title="Safari Destinations in East Africa" description="Explore top safari destinations across Kenya and Tanzania. From the Masai Mara to Zanzibar, find your perfect African safari destination." />

    <div className="section-green py-16">
      <div className="container mx-auto px-4 text-center">
        <h1 className="text-primary-foreground mb-4">Safari Destinations</h1>
        <p className="text-primary-foreground opacity-80 max-w-2xl mx-auto">Discover the most spectacular wildlife and landscape destinations across East Africa.</p>
      </div>
    </div>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "Destinations" }]} />
    </div>

    <div className="container mx-auto px-4 py-12">
      <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        {destinations.map((dest) => {
          const price = getDestinationPrice(dest.name);
          return (
            <div key={dest.id} className="group bg-card rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-border flex flex-col">
              <Link to={`/destination/${dest.slug}`} className="relative h-52 overflow-hidden block">
                <img src={getDestinationImage(dest.image)} alt={dest.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" width={400} height={208} />
                <div className="absolute top-3 left-3 bg-primary text-primary-foreground text-xs font-heading font-bold px-3 py-1 rounded-full">{dest.country}</div>
                {price && (
                  <div className="absolute top-3 right-3 bg-accent text-accent-foreground text-xs font-heading font-bold px-3 py-1 rounded-full">
                    From ${price}
                  </div>
                )}
              </Link>
              <div className="p-5 flex flex-col flex-1">
                <div className="flex items-center gap-3 text-muted-foreground text-xs mb-2">
                  {dest.tourCount && <span className="flex items-center gap-1"><Clock className="w-3.5 h-3.5" />{dest.tourCount}+ tours</span>}
                  <span className="flex items-center gap-1"><MapPin className="w-3.5 h-3.5" />{dest.country}</span>
                </div>
                <h2 className="text-xl mb-2 group-hover:text-primary transition-colors">
                  <Link to={`/destination/${dest.slug}`}>{dest.name}</Link>
                </h2>
                <p className="text-muted-foreground text-sm line-clamp-2 mb-4 flex-1">{dest.shortDescription}</p>
                <div className="flex items-center gap-2 mt-auto">
                  <Link
                    to={`/destination/${dest.slug}`}
                    className="flex-1 inline-flex items-center justify-center gap-1 text-sm font-heading font-bold text-primary hover:text-secondary transition-colors"
                  >
                    Discover {dest.name.split(" ")[0]} <ArrowRight className="w-4 h-4" />
                  </Link>
                  <Link to="/booking" className="flex-1 inline-flex items-center justify-center bg-accent text-accent-foreground text-sm font-heading font-bold px-4 py-2 rounded-full hover:brightness-110 transition-all shadow-md">
                    Book Now
                  </Link>
                </div>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  </>
);

export default Destinations;
