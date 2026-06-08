import { Link } from "react-router-dom";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import { getHotelImage } from "@/data/images";
import { hotels, HOTEL_REGIONS } from "@/data/hotels";

const Hotels = () => {
  const kenya = HOTEL_REGIONS.filter((r) => r.country === "kenya");
  const tanzania = HOTEL_REGIONS.filter((r) => r.country === "tanzania");

  const Card = ({ region, label, country }: { region: string; label: string; country: string }) => {
    const count = hotels.filter((h) => h.region === region).length;
    return (
      <Link to={`/hotels/${country}/${region}`} className="group relative h-44 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all">
        <img src={getHotelImage(region, region)} alt={label} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
        <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent" />
        <div className="absolute inset-x-0 bottom-0 p-3 text-primary-foreground">
          <h3 className="text-base font-heading font-bold">{label}</h3>
          <p className="text-xs opacity-90">{count} hotels</p>
        </div>
      </Link>
    );
  };

  return (
    <>
      <SEO
        title="Hotels & Lodges – Safari Accommodation"
        description="Browse safari lodges, camps and hotels across Kenya and Tanzania by region. Budget, mid-range and luxury accommodation curated by Roaming Africa Tours."
        canonical="https://kenya-journey-weaver.lovable.app/hotels"
      />
      <PageHero>
        <h1 className="text-primary-foreground">Hotels & Safari Lodges</h1>
      </PageHero>
      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Hotels & Lodges" }]} />
      </div>

      <div className="container mx-auto px-4 py-8 space-y-10">
        <p className="text-muted-foreground text-sm max-w-3xl">
          Choose from our curated selection of safari lodges, tented camps and hotels across East Africa, organised by country and region.
        </p>

        <section>
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-lg">Kenya Hotels by Region</h2>
            <Link to="/hotels/kenya" className="text-sm text-primary font-heading">View all Kenya →</Link>
          </div>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {kenya.map((r) => <Card key={r.region} region={r.region} label={r.label} country="kenya" />)}
          </div>
        </section>

        <section>
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-lg">Tanzania Hotels by Region</h2>
            <Link to="/hotels/tanzania" className="text-sm text-primary font-heading">View all Tanzania →</Link>
          </div>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {tanzania.map((r) => <Card key={r.region} region={r.region} label={r.label} country="tanzania" />)}
          </div>
        </section>
      </div>
    </>
  );
};

export default Hotels;
