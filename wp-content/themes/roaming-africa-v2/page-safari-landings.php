import { Link } from "react-router-dom";
import { MessageCircle } from "lucide-react";
import SEO from "@/components/SEO";
import Breadcrumbs from "@/components/Breadcrumbs";
import SafariCard from "@/components/SafariCard";
import PageHero from "@/components/PageHero";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { getDestinationImage } from "@/data/images";
import { whatsappLink } from "@/data/constants";
import { safariPackages, type SafariPackage } from "@/data/safariPackages";
import { destinations } from "@/data/destinations";

interface Section {
  heading: string;
  body: string;
}
interface FAQ {
  q: string;
  a: string;
}
interface CustomCard {
  name: string;
  region?: string;
  duration?: string;
  priceFrom?: number;
  priceLabel?: string;
  blurb: string;
  href: string;
  image: string;
}
interface LandingProps {
  seoTitle: string;
  seoDesc: string;
  canonical: string;
  heroImage: string;
  h1: string;
  breadcrumbs: { label: string; href?: string }[];
  intro: string;
  sections: Section[];
  faqs: FAQ[];
  filter: (p: SafariPackage) => boolean;
  ctaSubject: string;
  packagesHeading?: string;
  packagesSubtext?: string;
  customCards?: CustomCard[];
  gallery?: { src: string; alt: string }[];
  galleryHeading?: string;
}

const SafariLanding = ({
  seoTitle, seoDesc, canonical, heroImage, h1, breadcrumbs, intro, sections, faqs, filter, ctaSubject,
  packagesHeading = "Featured Packages", packagesSubtext, customCards, gallery, galleryHeading = "Gallery",
}: LandingProps) => {
  const packages = safariPackages.filter(filter);
  const faqJsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((f) => ({
      "@type": "Question",
      name: f.q,
      acceptedAnswer: { "@type": "Answer", text: f.a },
    })),
  };

  return (
    <>
      <SEO title={seoTitle} description={seoDesc} canonical={canonical} jsonLd={faqJsonLd} />

      <PageHero imageKey={heroImage}>
        <h1 className="text-primary-foreground">{h1}</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={breadcrumbs} />
      </div>

      <div className="container mx-auto px-4 py-10 max-w-5xl">
        <p className="text-muted-foreground leading-relaxed mb-10 text-base">{intro}</p>

        {sections.map((s) => (
          <section key={s.heading} className="mb-8">
            <h2 className="mb-3">{s.heading}</h2>
            <p className="text-muted-foreground leading-relaxed">{s.body}</p>
          </section>
        ))}

        {customCards && customCards.length > 0 && (
          <section className="mt-12">
            <h2 className="mb-2">{packagesHeading}</h2>
            {packagesSubtext && <p className="text-muted-foreground mb-6 max-w-3xl">{packagesSubtext}</p>}
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
              {customCards.map((c) => (
                <Link key={c.href} to={c.href} className="group bg-card border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-lg hover:border-primary transition-all">
                  <div className="relative h-44 overflow-hidden">
                    <img src={c.image} alt={c.name} loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    {c.duration && (
                      <span className="absolute top-3 left-3 bg-safari-dark/85 text-safari-cream text-[11px] font-heading font-bold px-2.5 py-1 rounded-full">{c.duration}</span>
                    )}
                  </div>
                  <div className="p-4">
                    {c.region && <p className="text-[11px] uppercase tracking-wide text-accent font-heading font-bold mb-1">{c.region}</p>}
                    <h3 className="font-heading font-bold text-base leading-snug mb-2">{c.name}</h3>
                    <p className="text-xs text-muted-foreground leading-relaxed line-clamp-3 mb-3">{c.blurb}</p>
                    <div className="flex items-center justify-between">
                      {c.priceLabel ? (
                        <span className="text-sm font-heading font-bold text-primary">{c.priceLabel}</span>
                      ) : c.priceFrom ? (
                        <span className="text-sm font-heading font-bold text-primary">From USD {c.priceFrom.toLocaleString()}</span>
                      ) : <span />}
                      <span className="text-xs font-heading font-bold text-primary group-hover:underline">View Details →</span>
                    </div>
                  </div>
                </Link>
              ))}
            </div>
          </section>
        )}

        {packages.length > 0 && (
          <section className="mt-12">
            <h2 className="mb-2">{packagesHeading}</h2>
            {packagesSubtext && <p className="text-muted-foreground mb-6 max-w-3xl">{packagesSubtext}</p>}
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
              {packages.map((pkg) => <SafariCard key={pkg.id} pkg={pkg} />)}
            </div>
          </section>
        )}


        {gallery && gallery.length > 0 && (
          <section className="mt-14">
            <h2 className="mb-6">{galleryHeading}</h2>
            <div className="grid grid-cols-2 lg:grid-cols-4 gap-3">
              {gallery.map((g, i) => (
                <div key={i} className="relative aspect-[4/3] overflow-hidden rounded-xl shadow-md group">
                  <img
                    src={g.src}
                    alt={g.alt}
                    loading="lazy"
                    className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                  />
                </div>
              ))}
            </div>
          </section>
        )}

        {faqs.length > 0 && (
          <section className="mt-14">
            <h2 className="mb-6">Frequently Asked Questions</h2>
            <Accordion type="single" collapsible className="w-full">
              {faqs.map((f, i) => (
                <AccordionItem key={i} value={`faq-${i}`}>
                  <AccordionTrigger className="text-left font-heading">{f.q}</AccordionTrigger>
                  <AccordionContent className="text-muted-foreground leading-relaxed">{f.a}</AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </section>
        )}

        {/* Destinations strip */}
        <section className="mt-14">
          <h2 className="text-lg mb-4">Explore Destinations</h2>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
            {destinations.slice(0, 8).map((d) => (
              <Link key={d.id} to={`/destination/${d.slug}`} className="group relative h-32 rounded-xl overflow-hidden shadow-md">
                <img src={getDestinationImage(d.image)} alt={d.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent" />
                <div className="absolute inset-x-0 bottom-0 p-2 text-primary-foreground">
                  <h3 className="text-sm font-heading font-bold leading-tight">{d.name}</h3>
                </div>
              </Link>
            ))}
          </div>
        </section>

        <div className="section-brown rounded-xl p-10 text-center mt-14">
          <h2 className="mb-4">Ready to Plan Your Safari?</h2>
          <p className="opacity-80 mb-6">Talk to a local expert. We design custom itineraries for every traveller.</p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link to="/booking" className="bg-safari-gold text-safari-dark px-8 py-3 rounded-lg font-heading font-bold hover:brightness-110 transition-all">
              Make a Booking →
            </Link>
            <a
              href={whatsappLink(`Hi! I'm interested in ${ctaSubject}. Please send details.`)}
              target="_blank" rel="noopener noreferrer"
              className="whatsapp-btn justify-center"
            >
              <MessageCircle className="w-5 h-5" /> Chat on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </>
  );
};

// ============= 12 PAGES =============

const kenyaCrumb = { label: "Kenya Safaris", href: "/kenya-safaris" };
const tzCrumb = { label: "Tanzania Safaris", href: "/tanzania-safaris" };

const inDest = (p: SafariPackage, keywords: string[]) =>
  p.destinations.some((d) => keywords.some((k) => d.toLowerCase().includes(k.toLowerCase())));

export const KenyaSafariTours = () => (
  <SafariLanding
    seoTitle="Kenya Safari Tours & Packages | Luxury Safaris in Kenya"
    seoDesc="Experience Kenya safari tours with expert guides, 4×4 Land Cruisers, and wildlife encounters across Masai Mara, Amboseli, Samburu, Tsavo, and Lake Nakuru. Book today."
    canonical="https://roamingafricatours.com/kenya-safaris"
    heroImage="masai-mara"
    h1="Kenya Safari Tours | Luxury Safari Packages in Kenya"
    breadcrumbs={[{ label: "Kenya Safaris" }]}
    intro="Discover the ultimate Kenya safari tours with Roaming Africa Tours and Safaris — East Africa's trusted locally owned safari operator. Our expertly designed safari packages in Kenya combine luxury, adventure, and unforgettable wildlife encounters across Kenya's most iconic national parks. Travel in comfort in our fully-equipped 4×4 Land Cruiser safari vehicles driven by professional, expert local guides. From the world-famous Masai Mara National Reserve to elephant-rich Amboseli, the flamingo paradise of Lake Nakuru, and the remote wilderness of Samburu, our Kenya safaris are crafted to deliver Africa's greatest wildlife experiences."
    sections={[
      { heading: "Luxury Game Drives Across Kenya's Top National Parks", body: "Our Kenya safari tours include guided game drives in Kenya's premier wildlife destinations. Witness the Big Five — lion, leopard, elephant, buffalo, and rhino — on open savannah plains. Experience the world-famous Great Wildebeest Migration in the Masai Mara between July and October. Photograph massive elephant herds against the backdrop of Mount Kilimanjaro in Amboseli. Discover northern Kenya's unique Samburu Special Five species found nowhere else on Earth. Every Kenya safari package includes professional guides, premium lodges, and all park entrance fees." },
      { heading: "Private, Family & Group Kenya Safari Packages", body: "Whether you are planning a private luxury Kenya safari, a family wildlife adventure, or a group safari tour, our itineraries are tailored to your exact needs. Choose from 2-day short safaris from Nairobi to 12-day grand Kenya adventures. We offer budget Kenya safaris, mid-range safari packages, and luxury fly-in safaris by light aircraft. All our Kenya safari holidays are fully customisable — tell us your dates, interests, and budget, and we design the perfect itinerary." },
      { heading: "Why Book Your Kenya Safari with Roaming Africa?", body: "As a locally owned Kenya safari operator, we offer insider knowledge, competitive pricing, and genuine expertise. Our fleet of custom 4×4 safari Land Cruisers features pop-up roofs, charging ports, cool boxes, and first aid kits. We handle everything — airport transfers, lodge bookings, park permits, and 24/7 support — so your Kenya safari experience is seamless from start to finish." },
    ]}
    faqs={[
      { q: "What is the best time for a Kenya safari?", a: "The dry seasons — June to October and January to February — offer the best Kenya safari conditions. Vegetation is low, animals congregate around water, and the Great Migration peaks in the Masai Mara from July to October." },
      { q: "How much does a Kenya safari cost?", a: "Kenya safari costs range from $640 per person for a 2-day Amboseli safari to over $5,000 for luxury 8-day fly-in experiences. Cost depends on duration, parks visited, accommodation level, and group size. Contact us for a personalised quote." },
      { q: "Do I need a visa for Kenya?", a: "Yes. Most nationalities require a Kenya e-visa ($51 single entry) available at etakenya.go.ke." },
      { q: "Are Kenya safaris safe?", a: "Yes, Kenya is a well-established and safe safari destination. All our vehicles are insured, guides are certified, and lodges are carefully vetted. We also provide 24/7 emergency support throughout your trip." },
      { q: "What should I pack for a Kenya safari?", a: "Pack neutral-coloured clothing (khaki, beige, green), a fleece for early morning drives, sunscreen, insect repellent, a hat, and a camera with zoom lens. We provide a detailed packing list at booking." },
      { q: "Can I do a Kenya safari on a budget?", a: "Yes, we offer Kenya safaris from $640 per person. Budget safaris use comfortable mid-range lodges and shared vehicles. Contact us for current budget safari availability." },
    ]}
    filter={(p) => p.country === "kenya" && p.category !== "day-trip" && !p.tags?.includes("golf")}
    packagesHeading="Explore Kenya Safari Trips"
    ctaSubject="a Kenya safari"
  />
);

export const KenyaDayTrips = () => (
  <SafariLanding
    seoTitle="Kenya Day Trips from Nairobi | Safari Day Excursions"
    seoDesc="Book Kenya day trips from Nairobi to Nairobi National Park, Amboseli, Lake Nakuru, and more. Expert-guided day safari excursions with pick-up and drop-off included."
    canonical="https://roamingafricatours.com/kenya-safaris/day-trips"
    heroImage="nairobi"
    h1="Kenya Day Trips from Nairobi | Guided Safari Day Excursions"
    breadcrumbs={[kenyaCrumb, { label: "Day Trips" }]}
    intro="Experience Kenya's incredible wildlife on a day trip from Nairobi with Roaming Africa Tours and Safaris. Our Kenya day safari excursions are perfect for travellers with limited time who want an authentic wildlife experience without an overnight stay. Depart from any Nairobi hotel in a comfortable 4×4 safari vehicle, explore one of Kenya's premier national parks with a professional guide, and return to Nairobi the same evening. Same-day safaris from Nairobi to Nairobi National Park, Amboseli, Lake Nakuru, and Lake Naivasha are available year-round."
    sections={[
      { heading: "Most Popular Kenya Day Safari Excursions", body: "Nairobi National Park Day Trip — Just 7 km from Nairobi's CBD, this is Africa's only national park bordering a capital city. See lions, rhinos, cheetahs, and giraffes with the city skyline as backdrop. Amboseli Day Safari — Drive south from Nairobi to Amboseli National Park for elephant herds and stunning Mount Kilimanjaro views. Lake Nakuru Day Trip — Explore Kenya's famous flamingo lake and rhino sanctuary, just 2 hours from Nairobi. Lake Naivasha Day Trip — Enjoy a boat ride among hippos and 350 bird species on this scenic Rift Valley lake." },
      { heading: "What's Included in Our Kenya Day Trips", body: "All Nairobi day trips include hotel pick-up and drop-off, transport in a 4×4 safari vehicle, a professional English-speaking guide, park entrance fees, bottled drinking water, and a picnic lunch where applicable. Our Kenya day excursions depart early morning to maximise wildlife viewing time in the parks." },
    ]}
    faqs={[
      { q: "What is the best day trip from Nairobi for wildlife?", a: "Nairobi National Park is the most accessible — 20 minutes from the city centre with lions, rhinos, and cheetahs. For a full day with elephants, Amboseli (4 hours from Nairobi) is the most spectacular." },
      { q: "How early do Kenya day trips depart from Nairobi?", a: "Most day trips depart between 6:00 AM and 7:00 AM from your hotel to maximise park time. Nairobi National Park trips can depart as late as 8:00 AM." },
      { q: "Can I do a day trip to the Masai Mara from Nairobi?", a: "The Masai Mara is 5–6 hours from Nairobi by road, making a comfortable day trip impossible. We recommend a minimum 2-day safari to the Mara. Fly-in day excursions (45-minute flight) are available from Wilson Airport." },
      { q: "Are day trips suitable for children?", a: "Yes, Kenya day trips are excellent for families with children. Nairobi National Park and Lake Naivasha are particularly child-friendly with close wildlife encounters." },
      { q: "What is the cost of a day trip from Nairobi?", a: "Nairobi National Park day trips start from $120 per person. Amboseli and Nakuru day trips start from $200 per person including park fees, guide, and transport. Contact us for current pricing." },
    ]}
    filter={(p) => p.country === "kenya" && (p.category === "day-trip" || p.dayTrip === true)}
    packagesHeading="Day Excursions From Nairobi City"
    packagesSubtext="All day trips include hotel pick-up and drop-off from any Nairobi hotel. Professional English-speaking guide. Guaranteed departures for 2+ passengers."
    ctaSubject="a Kenya day trip from Nairobi"
  />
);

export const KenyaFlyIn = () => (
  <SafariLanding
    seoTitle="Kenya Flying Safaris | Fly-In Safari Packages Kenya"
    seoDesc="Experience Kenya flying safaris by light aircraft to Masai Mara, Amboseli, and Samburu. Skip long road transfers and maximise your wildlife time with Kenya fly-in safari packages."
    canonical="https://roamingafricatours.com/kenya-safaris/fly-in"
    heroImage="masai-mara"
    h1="Kenya Flying Safaris | Fly-In Safari Packages by Light Aircraft"
    breadcrumbs={[kenyaCrumb, { label: "Flying Safaris" }]}
    intro="Discover Kenya's greatest wildlife destinations from the air on a Kenya flying safari. Our fly-in safari packages in Kenya use scheduled and charter light aircraft flights from Wilson Airport Nairobi to the Masai Mara, Amboseli, Samburu, Lewa, and other remote airstrips. A Kenya fly-in safari eliminates long road transfers, maximises your time in the bush, and adds the spectacular experience of viewing Kenya's landscapes from the air. Fly over the Great Rift Valley, watch wildlife patterns from above, and land directly in some of Africa's finest wilderness areas."
    sections={[
      { heading: "Kenya Fly-In Safari Destinations", body: "Masai Mara Flying Safari — The 45-minute flight from Nairobi to the Mara is one of Kenya's most popular fly-in routes. Land at one of several Mara airstrips and begin game drives immediately. Amboseli Flying Safari — Fly to Amboseli in 45 minutes for elephant herds and Kilimanjaro views without the 4-hour road drive. Samburu Flying Safari — Fly north to Samburu National Reserve for the Special Five in just 1 hour. Lewa & Laikipia Flying Safaris — Access exclusive private conservancies only reachable by light aircraft for a truly private Kenya safari." },
      { heading: "Why Choose a Kenya Fly-In Safari?", body: "Kenya flying safaris are ideal for travellers with limited time, those celebrating special occasions, and anyone seeking a premium safari experience. Flights operate on scheduled services by AirKenya Express and Safarilink Aviation, both with excellent safety records. Each light aircraft flight carries a maximum of 12 passengers offering aerial wildlife spotting en route." },
    ]}
    faqs={[
      { q: "Which airport do Kenya flying safaris depart from?", a: "Most Kenya fly-in safaris depart from Wilson Airport in Nairobi (5 km from the CBD), not Jomo Kenyatta International Airport. We arrange your transfer from JKIA or your hotel to Wilson Airport." },
      { q: "What is the luggage allowance on Kenya fly-in safaris?", a: "Light aircraft have a strict 15 kg soft bag limit. Hard-shell suitcases are not permitted. We advise using a soft duffel bag. Excess luggage can be stored securely in Nairobi." },
      { q: "How long is the flight from Nairobi to Masai Mara?", a: "The Nairobi–Masai Mara flight takes approximately 45 minutes with stunning aerial views of the Rift Valley and Mara ecosystem." },
      { q: "Are Kenya fly-in safaris more expensive than road safaris?", a: "Yes, return flights add approximately $300–$500 per person to safari costs. However the time saved (4–6 hours of driving each way) and the aerial experience make fly-in safaris excellent value for shorter itineraries." },
      { q: "Can I combine a fly-in safari with a beach holiday in Mombasa?", a: "Yes, we offer Nairobi–Masai Mara–Mombasa fly-in itineraries combining safari and coast in a single seamless trip. Contact us to design your Kenya fly-in and beach combination." },
    ]}
    filter={(p) => p.country === "kenya" && p.category === "fly-in"}
    packagesHeading="Kenya Flying Safari Packages"
    packagesSubtext="All fly-in safaris depart from Wilson Airport, Nairobi. Luggage limit 15 kg soft bag. Return flights, full board, and game drives included."
    ctaSubject="a Kenya flying safari"
  />
);

export const KenyaHelicopter = () => (
  <SafariLanding
    seoTitle="Helicopter Safaris in Kenya | Private Helicopter Game Drives"
    seoDesc="Experience helicopter safaris in Kenya for private aerial game viewing over Masai Mara, Amboseli, and Rift Valley. Exclusive Kenya helicopter safari packages for special occasions."
    canonical="https://roamingafricatours.com/kenya-safaris/helicopter"
    heroImage="amboseli"
    h1="Helicopter Safaris in Kenya | Exclusive Aerial Game Viewing"
    breadcrumbs={[kenyaCrumb, { label: "Helicopter Safaris" }]}
    intro="Experience Kenya's breathtaking wilderness from the ultimate vantage point on a helicopter safari in Kenya. Our private Kenya helicopter safaris offer exclusive aerial game viewing over the Masai Mara, Amboseli, the Great Rift Valley, and Mount Kenya. A Kenya helicopter game drive provides an unmatched perspective — spotting vast elephant herds, tracking lion prides from above, and witnessing the landscape's extraordinary scale in a way impossible from the ground. Helicopter safaris in Kenya are perfect for special occasions, anniversary celebrations, honeymoons, and discerning travellers seeking the ultimate African experience."
    sections={[
      { heading: "Kenya Helicopter Safari Experiences", body: "Masai Mara Helicopter Safari — Fly low over the Mara's iconic savannah plains, tracking wildlife movements and landing for private bush breakfasts or sundowners. Amboseli Helicopter Safari — Circle Mount Kilimanjaro by helicopter and land amid Amboseli's elephant herds for the most dramatic wildlife encounter available in Kenya. Great Rift Valley Helicopter Tour — Fly over Lake Nakuru, Lake Naivasha, and Hell's Gate for a panoramic Rift Valley aerial experience. Mount Kenya Aerial Safari — Circle Africa's second-highest mountain by helicopter before landing at a highland lodge." },
      { heading: "What to Expect on a Kenya Helicopter Safari", body: "All Kenya helicopter safaris are operated by licensed, experienced helicopter pilots with deep knowledge of wildlife viewing from the air. Helicopters carry 2–5 passengers depending on the model. Flights can be combined with ground game drives for a comprehensive Kenya safari experience. Private landings in the bush, champagne picnics, and customised flight paths are all available." },
    ]}
    faqs={[
      { q: "How much does a helicopter safari in Kenya cost?", a: "Kenya helicopter safaris are priced per flight hour. Rates typically start from $800–$1,200 per hour depending on helicopter type and number of passengers. Contact us for a detailed quotation based on your preferred experience." },
      { q: "How many people can join a Kenya helicopter safari?", a: "Most helicopters used for Kenya safaris carry 2–4 passengers plus the pilot. Larger groups can be accommodated using two helicopters flying together." },
      { q: "Is a helicopter safari in Kenya safe?", a: "Yes, all helicopter safaris are operated by CAA-licensed pilots and operators with comprehensive insurance. Safety briefings are provided before every flight." },
      { q: "Can I land in the Masai Mara by helicopter?", a: "Yes, with the appropriate permits we can arrange private helicopter landings in designated areas of the Masai Mara for bush breakfasts, sundowners, or photography sessions." },
      { q: "Is a helicopter safari suitable for a honeymoon?", a: "Absolutely. A Kenya helicopter safari is one of the most romantic and exclusive experiences available in Africa. We create bespoke honeymoon helicopter packages with champagne, private bush dining, and luxury lodge accommodation." },
    ]}
    filter={() => false}
    packagesHeading="Kenya Helicopter Safari Tours"
    customCards={[
      { name: "Mount Kenya Alpine Helicopter Tour", region: "Mount Kenya, Central Highlands", duration: "6 Hours", priceFrom: 15800, blurb: "Soar above Africa's second-highest peak — glaciers, alpine lakes and a champagne breakfast on the moorlands.", href: "/kenya-helicopter-tours/mount-kenya-alpine-helicopter-tour", image: getDestinationImage("nairobi") },
      { name: "Lake Bogoria Helicopter Safari", region: "Lake Bogoria", duration: "4 Hours", priceFrom: 12000, blurb: "Aerial views of flamingo flocks, geyser landings and a gourmet picnic on the Rift Valley floor.", href: "/kenya-helicopter-tours/lake-bogoria-helicopter-safari", image: getDestinationImage("lake-nakuru") },
      { name: "Mount Ololokwe Samburu Helicopter Safari", region: "Samburu and Shaba", duration: "3 Hours", priceFrom: 9000, blurb: "Land on the flat sacred summit of Ololokwe for sundowners with 360° views over northern Kenya.", href: "/kenya-helicopter-tours/mount-ololokwe-samburu-helicopter-safari", image: getDestinationImage("samburu") },
      { name: "Lake Magadi Helicopter Safari from Nairobi", region: "Lake Magadi", duration: "3 Hours", priceFrom: 9000, blurb: "A dramatic flight over Nairobi National Park and the Rift Valley to soak in Magadi's hot springs.", href: "/kenya-helicopter-tours/lake-magadi-helicopter-safari", image: getDestinationImage("nairobi") },
      { name: "Lake Logipi Helicopter Safari", region: "Lake Logipi, Suguta Valley", duration: "5 Hours", priceFrom: 14000, blurb: "Expedition flight to Kenya's most remote alkaline lake, fringed by lava flows and Cathedral Rock.", href: "/kenya-helicopter-tours/lake-logipi-helicopter-safari", image: getDestinationImage("lake-turkana") },
    ]}
    ctaSubject="a Kenya helicopter safari"
    galleryHeading="Kenya Helicopter Safari Gallery"
    gallery={[
      { src: "https://images.unsplash.com/photo-1473445730015-841f29a9490b?w=900&q=80&auto=format&fit=crop", alt: "Private helicopter on Kenyan savannah airstrip" },
      { src: "https://images.unsplash.com/photo-1534294668821-28a3054f4256?w=900&q=80&auto=format&fit=crop", alt: "Aerial view of the Great Rift Valley lakes" },
      { src: "https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=900&q=80&auto=format&fit=crop", alt: "Helicopter flight over Amboseli elephants with Mount Kilimanjaro" },
      { src: "https://images.unsplash.com/photo-1521651201144-634f700b36ef?w=900&q=80&auto=format&fit=crop", alt: "Sunrise aerial safari over the Masai Mara plains" },
    ]}
  />
);



export const KenyaGolf = () => (
  <SafariLanding
    seoTitle="Golf Safaris in Kenya | Play Golf Among Africa's Wildlife"
    seoDesc="Combine world-class golf with Kenya safari on our exclusive golf safari packages. Play at Kenya's top courses in the Rift Valley, Nairobi, and Mount Kenya region."
    canonical="https://roamingafricatours.com/kenya-safaris/golf"
    heroImage="nairobi"
    h1="Golf Safaris in Kenya | Tee Off Among Africa's Wildlife"
    breadcrumbs={[kenyaCrumb, { label: "Golf Safaris" }]}
    intro="Experience the extraordinary combination of world-class golf and authentic African wildlife on a Kenya golf safari. Kenya boasts some of Africa's most spectacular golf courses — set in the Rift Valley with views of flamingo lakes, on the slopes of Mount Kenya, and in Nairobi's leafy suburbs where warthogs roam the fairways. Our golf safaris in Kenya combine rounds at Kenya's finest courses with game drives in the Masai Mara, Amboseli, or Lake Nakuru. A Kenya golf safari is the ultimate experience for golfers who want more than just the course."
    sections={[
      { heading: "Kenya's Top Golf Courses", body: "Karen Country Club — Nairobi's most prestigious golf club, founded in 1937, set in the leafy Karen suburb with wildlife-friendly fairways. Muthaiga Golf Club — One of Africa's oldest golf clubs, established in 1913, in Nairobi's diplomatic quarter. Fairmont Mount Kenya Safari Club Golf Course — A 9-hole course at 2,165m altitude on the equator with Mount Kenya views — one of Africa's most unique golfing experiences. Rift Valley Sports Club, Nakuru — Play beside Lake Nakuru with flamingos in view across the Rift Valley." },
      { heading: "Our Kenya Golf Safari Packages", body: "Our Kenya golf safari packages combine 2–4 rounds of golf at Kenya's finest courses with 2–5 nights of wildlife game drives. Choose from Nairobi-based golf with a Masai Mara extension, or a Mount Kenya golf and safari combination. All packages include green fees, golf cart hire, safari game drives, full board accommodation, and airport transfers. Golf and safari in Kenya — the perfect combination for the discerning traveller." },
    ]}
    faqs={[
      { q: "What is the best time for a golf safari in Kenya?", a: "Kenya's climate is ideal for golf year-round. The long dry season (June–October) offers consistent conditions. Avoid April–May during the long rains for the best course conditions." },
      { q: "Do I need to bring my own golf clubs to Kenya?", a: "Most major Kenya courses offer club hire. However for the best experience we recommend bringing your own clubs. We advise on airline golf bag policies and baggage costs." },
      { q: "What is the handicap requirement for Kenya golf courses?", a: "Most Kenyan clubs welcome all handicaps. Some prestigious clubs like Muthaiga request a handicap certificate. Contact us for specific club requirements at booking." },
      { q: "Can I combine golf with a Masai Mara safari?", a: "Yes, our most popular combination is 2 days of golf in Nairobi followed by a 3-day Masai Mara safari. We handle all logistics and ensure a seamless transition between golf and safari." },
      { q: "Are caddies available at Kenya golf courses?", a: "Yes, caddies are available at all major Kenya golf courses. Tipping your caddie is customary and appreciated. We advise on appropriate caddie fees." },
    ]}
    filter={(p) => p.tags?.includes("golf") === true}
    packagesHeading="Golf Safari Packages in Kenya"
    packagesSubtext="All Kenya golf safari packages include green fees, transport, full board accommodation, and professional caddy service."
    ctaSubject="a Kenya golf safari"
  />
);

export const KenyaAccessible = () => (
  <SafariLanding
    seoTitle="Accessible Safaris Kenya | Wheelchair Friendly Safari Packages"
    seoDesc="Kenya accessible safaris for wheelchair users and travellers with mobility needs. Modified 4×4 vehicles, accessible lodges, and expert guides ensure everyone can enjoy an East Africa wildlife safari."
    canonical="https://roamingafricatours.com/kenya-safaris/accessible"
    heroImage="amboseli"
    h1="Accessible Safaris in Kenya | Wheelchair Friendly Wildlife Tours"
    breadcrumbs={[kenyaCrumb, { label: "Accessible Safaris" }]}
    intro="Many safari experiences simply aren't designed with accessibility in mind. At Roaming Africa Tours & Safaris, we believe everyone deserves the opportunity to experience the beauty of Africa — and we've spent years carefully developing accessible Kenya safari experiences that let wheelchair users, seniors, slow walkers and travellers needing additional support enjoy world-class wildlife viewing, luxury lodges, game drives, cultural encounters and the Big Five without being excluded because of mobility challenges. Our Kenya accessible safari packages cover the Maasai Mara, Amboseli, Lake Nakuru and Ol Pejeta in modified 4×4 Land Cruisers fitted with hydraulic ramps and secure wheelchair anchoring, with personally inspected wheelchair-friendly lodges featuring roll-in showers and step-free pathways. From dignified accessible airport transfers to inclusive Maasai cultural visits, we plan every detail around your independence, comfort and adventure. This is inclusive travel in Kenya done properly — no compromises, just the same life-changing accessible Maasai Mara safari and wildlife-friendly Kenya tourism experience, designed around you."
    sections={[
      { heading: "Our Accessible Safari Vehicles", body: "Our fleet of wheelchair friendly safari vehicles in Kenya includes specially modified Land Cruisers designed in consultation with disability travel specialists. Each vehicle features a hydraulic entry ramp, reinforced wheelchair anchoring points, non-slip flooring, extra-wide doors for easy wheelchair transfer, a pop-up roof for game viewing, and spacious interiors for comfortable accessible game drives. Our driver-guides are trained in accessible safari operations and committed to ensuring every guest enjoys an unforgettable wildlife experience with full dignity and independence." },
      { heading: "Accessible Safari Lodges in Kenya", body: "We carefully select wheelchair accessible safari lodges for every itinerary across the Maasai Mara, Amboseli, Lake Nakuru and Ol Pejeta. Our preferred properties — including Mara Serena Safari Lodge, Sarova Mara Game Camp and Mara Leisure Camp — offer step-free room access, roll-in showers, lowered bed heights, wide doorways and fully accessible dining areas. We personally inspect and verify accessibility standards at every lodge we recommend for Kenya disability safaris and inclusive travel in Kenya." },
      { heading: "Who Are Our Accessible Kenya Safaris For?", body: "Our accessible tourism Kenya packages are designed for wheelchair users, travellers with limited mobility, senior travellers, guests with visual or hearing impairments, and anyone recovering from injury or surgery who still wants to experience an unforgettable Kenya wildlife safari. We work closely with each guest before travel — every accessible Maasai Mara safari and wheelchair friendly Kenya safari is planned around your specific needs, with no detail overlooked." },
    ]}
    faqs={[
      { q: "Are Kenya national parks accessible for wheelchair users?", a: "Yes — game drives in Kenya's national parks are conducted from vehicles, so wheelchair users experience exactly the same wildlife encounters as other guests. Park roads are manageable in our modified accessible safari vehicles." },
      { q: "Do you have accessible safari lodges near the Maasai Mara?", a: "Yes. We work with several Maasai Mara lodges that have been verified for wheelchair access including roll-in showers, step-free pathways and accessible dining — including Mara Serena Safari Lodge, Sarova Mara Game Camp and Mara Leisure Camp." },
      { q: "Can a guest with a manual or power wheelchair join a Kenya safari?", a: "Yes — both manual and power wheelchairs are accommodated. Please share your wheelchair type and dimensions at booking so we can confirm vehicle anchoring and lodge selection." },
      { q: "Are accessible Kenya safaris more expensive than standard safaris?", a: "Modified vehicle hire adds a modest premium. We work hard to keep our wheelchair accessible safari Kenya prices as close to standard rates as possible. Contact us for a personalised quote." },
      { q: "Can you arrange accessible airport transfers in Nairobi?", a: "Yes — fully accessible airport transfers from JKIA and Wilson Airport are arranged in adapted vehicles. Please advise your requirements at booking." },
    ]}
    filter={(p) => p.country === "kenya" && (p.tags?.includes("accessible") ?? false)}
    ctaSubject="an accessible Kenya safari"
    packagesHeading="Our Flagship Kenya Accessible Safari Packages"
    packagesSubtext="Three carefully designed accessible safari packages — choose the duration and style that suits you best. Every itinerary is fully customisable around your accessibility needs."
  />
);

export const KenyaMombasaShore = () => (
  <SafariLanding
    seoTitle="Mombasa Shore Excursions | Cruise Ship Tours from Mombasa Port"
    seoDesc="Book Mombasa shore excursions for cruise ship passengers. Expert-guided day tours to Tsavo, Mombasa Old Town, Diani Beach, and Shimba Hills with guaranteed return to port."
    canonical="https://roamingafricatours.com/kenya-safaris/mombasa-shore-excursions"
    heroImage="mombasa"
    h1="Mombasa Shore Excursions | Cruise Ship Day Tours from Mombasa Port"
    breadcrumbs={[kenyaCrumb, { label: "Mombasa Shore Excursions" }]}
    intro="Welcome aboard Kenya's most celebrated port city. Our Mombasa shore excursions are specifically designed for cruise ship passengers arriving at Mombasa Kilindini Harbour. We offer a range of Mombasa cruise ship day tours guaranteeing your safe and timely return to the ship before departure. Whether you want to explore Mombasa Old Town, embark on a Tsavo East safari day trip, relax on the white sands of Diani Beach, or explore Shimba Hills National Reserve, our expert local guides ensure an unforgettable Kenya day experience."
    sections={[
      { heading: "Our Mombasa Shore Excursion Options", body: "Mombasa City & Old Town Tour (half day) — Explore Fort Jesus (a UNESCO World Heritage Site built by the Portuguese in 1593), the narrow streets of Mombasa Old Town with its carved wooden doors and Swahili architecture, and the vibrant Biashara Street spice and fabric market. Tsavo East National Park Safari (full day) — Drive 2 hours to Tsavo East for a full morning game drive watching Kenya's famous red elephants, lions, and giraffes. Lunch at a park lodge. Return to Mombasa port by 5:00 PM. Diani Beach Excursion (half or full day) — Drive 30 minutes south to Kenya's finest beach for swimming, snorkelling over coral reefs, and optional watersports. Shimba Hills National Reserve (half day) — Visit this coastal forest reserve for sable antelope, elephants, and excellent birdwatching just 45 minutes from Mombasa." },
      { heading: "Why Choose Our Mombasa Shore Excursions?", body: "We specialise in Mombasa cruise ship excursions and understand the importance of punctual port return. All our Mombasa shore tours are timed with port schedules and include a minimum 1-hour buffer before ship departure. Our drivers carry mobile communication and track traffic conditions in real time. We have an outstanding record of on-time port returns for cruise passengers." },
    ]}
    faqs={[
      { q: "How do I book a Mombasa shore excursion?", a: "Book directly with us by email or WhatsApp at least 48 hours before your ship arrives in Mombasa. We arrange port pick-up, full guided tour, and guaranteed port return." },
      { q: "Where do you meet cruise ship passengers in Mombasa?", a: "We meet you at the designated tour operator meeting point inside Kilindini Harbour, just outside the cruise terminal. Your guide will carry a Roaming Africa Tours sign." },
      { q: "Is it safe to go on a Tsavo safari as a shore excursion?", a: "Yes, Tsavo East National Park is safe, well-managed, and only 2 hours from Mombasa port. Our shore excursion itineraries are carefully timed to ensure comfortable return well before ship departure." },
      { q: "What if my ship departs early — can you accommodate schedule changes?", a: "Yes, we work flexibly with cruise ship schedules. Provide your ship's port schedule at booking and we time all excursions accordingly with a safe departure buffer." },
      { q: "Can I book a private shore excursion just for my cabin group?", a: "Yes, all our Mombasa shore excursions are private — your vehicle is exclusively for your group. We do not combine guests from different ships or cabins." },
    ]}
    filter={(p) => inDest(p, ["mombasa", "tsavo", "diani"])}
    ctaSubject="a Mombasa shore excursion"
  />
);

export const TanzaniaSafariTours = () => (
  <SafariLanding
    seoTitle="Tanzania Safari Tours | 4×4 Safari Packages in Tanzania"
    seoDesc="Explore Tanzania safari tours — Serengeti, Ngorongoro Crater, Tarangire, and Zanzibar. Budget to luxury Tanzania safari packages with expert guides and 4×4 Land Cruisers."
    canonical="https://roamingafricatours.com/tanzania-safaris"
    heroImage="serengeti"
    h1="Tanzania Safari Tours | Serengeti, Ngorongoro & Beyond"
    breadcrumbs={[{ label: "Tanzania Safaris" }]}
    intro="Tanzania safari tours offer some of the world's most extraordinary wildlife experiences across Africa's most celebrated national parks and conservation areas. Explore the Serengeti National Park — home to the world-famous Great Wildebeest Migration and the highest lion density in Africa. Descend into the Ngorongoro Crater, a UNESCO World Heritage Site sheltering 25,000 animals in a collapsed volcanic caldera. Discover Tarangire's ancient baobab landscape and massive elephant herds. Visit Lake Manyara's tree-climbing lions and flamingos. As your trusted Tanzania safari operator, Roaming Africa Tours and Safaris creates seamless, personalised Tanzania safari packages for every budget and travel style."
    sections={[
      { heading: "Tanzania's Northern Safari Circuit", body: "The Northern Tanzania Safari Circuit covers the country's most iconic destinations — Tarangire National Park, Lake Manyara National Park, Serengeti National Park, and the Ngorongoro Conservation Area. Most of our Tanzania safari tours follow this circuit, which can be completed in 5–7 days. Starting and ending in Arusha, the circuit passes through stunning Maasai country and dramatic Rift Valley landscapes." },
      { heading: "Tanzania's Southern Safari Circuit", body: "For adventurous travellers seeking exclusivity, our Southern Tanzania safari covers Nyerere National Park (formerly Selous — Africa's largest game reserve), Ruaha National Park, and Udzungwa Mountains. The Southern Circuit has far fewer visitors than the north, offering a genuine wilderness experience with exceptional wild dog, lion, and elephant sightings. Boat safaris on the Rufiji River are a Southern Circuit highlight." },
    ]}
    faqs={[
      { q: "What is the best time for a Tanzania safari?", a: "The dry season (June–October) is best for game viewing across Tanzania. January–March offers the Serengeti calving season with newborn wildebeest and concentrated predator action in the southern plains." },
      { q: "How many days do I need for a Tanzania safari?", a: "Minimum 5 days for the northern circuit. We recommend 6–7 days for a comfortable pace with adequate game drive time in each park." },
      { q: "Do I need a Tanzania visa?", a: "Yes, most nationalities need a Tanzania e-visa ($50 single entry) available at evisa.immigration.go.tz. Apply at least 2 weeks before travel." },
      { q: "Can I add Zanzibar to my Tanzania safari?", a: "Yes, this is our most popular combination. Scheduled flights from Kilimanjaro Airport or Arusha to Zanzibar take 45 minutes. We arrange all logistics." },
      { q: "What is the difference between the Northern and Southern Circuit?", a: "The Northern Circuit (Serengeti, Ngorongoro, Tarangire) is more accessible and visited. The Southern Circuit (Nyerere, Ruaha) is more remote, exclusive, and uncrowded with exceptional predator and wild dog sightings." },
    ]}
    filter={(p) => p.country === "tanzania"}
    packagesHeading="Explore Tanzania Safari Deals"
    ctaSubject="a Tanzania safari"
  />
);

export const TanzaniaFlyIn = () => (
  <SafariLanding
    seoTitle="Tanzania Flying Safaris | Fly-In Safari Packages Tanzania"
    seoDesc="Experience Tanzania flying safaris by light aircraft to the Serengeti, Ngorongoro, and Ruaha. Skip long road transfers on a Tanzania fly-in safari from Arusha or Kilimanjaro."
    canonical="https://roamingafricatours.com/tanzania-safaris/fly-in"
    heroImage="serengeti"
    h1="Tanzania Flying Safaris | Fly-In Safari Packages by Light Aircraft"
    breadcrumbs={[tzCrumb, { label: "Flying Safaris" }]}
    intro="Our Tanzania flying safaris use scheduled and charter light aircraft to connect Tanzania's greatest wildlife destinations without long road transfers. A Tanzania fly-in safari lets you cover more ground in less time — fly from Arusha or Kilimanjaro Airport directly to the Serengeti, Ngorongoro, Ruaha, or Nyerere in a fraction of the road transfer time. With aerial views of the Serengeti's endless plains, Ngorongoro's caldera, and the Southern Highlands, a Tanzania flying safari adds an extraordinary dimension to your East Africa adventure."
    sections={[
      { heading: "Tanzania Fly-In Safari Routes", body: "Arusha to Serengeti — Fly directly from Arusha to Seronera, Kogatende, or Grumeti airstrips. Flights take 45–75 minutes depending on destination. Kilimanjaro to Zanzibar — A 45-minute scenic flight from Kilimanjaro International Airport to Zanzibar combines a safari finish with Indian Ocean beach relaxation. Arusha to Ruaha — The 2-hour charter flight to Msembe airstrip in Ruaha National Park opens up Southern Tanzania's extraordinary wilderness. Serengeti to Serengeti — Fly between the north and central Serengeti to follow the Migration without long game-drive transfers." },
    ]}
    faqs={[
      { q: "Which airlines operate Tanzania flying safaris?", a: "Coastal Aviation, Auric Air, and Air Excel are Tanzania's main scheduled safari airlines operating between Arusha, Kilimanjaro, Zanzibar, Serengeti, and other airstrips." },
      { q: "What is the baggage limit on Tanzania safari flights?", a: "Soft bags only, maximum 15 kg per person. No hard-shell luggage on light aircraft. Excess bags can be stored at your Arusha hotel." },
      { q: "Is it possible to fly between Serengeti camps to follow the Migration?", a: "Yes, flying between the central Serengeti (Seronera) and northern Serengeti (Kogatende) to follow the Migration is a popular and efficient strategy, especially on 7+ day Tanzania safari itineraries." },
      { q: "How do Tanzania flying safaris compare in cost to road safaris?", a: "Internal flights add $200–$600 per person to safari costs depending on route and season. For 7+ day itineraries, the time saved and additional destinations accessible easily justify the premium." },
      { q: "Can I fly directly from Zanzibar to the Serengeti?", a: "Yes, direct charter flights from Zanzibar to Serengeti airstrips are available, making Zanzibar-first, safari-second itineraries very efficient." },
    ]}
    filter={(p) => p.country === "tanzania" && p.category === "fly-in"}
    ctaSubject="a Tanzania flying safari"
  />
);

export const TanzaniaHelicopter = () => (
  <SafariLanding
    seoTitle="Tanzania Helicopter Safaris | Aerial Game Viewing in Serengeti"
    seoDesc="Experience Tanzania helicopter safaris over the Serengeti and Ngorongoro Crater. Private aerial game viewing, helicopter bush landings, and exclusive Tanzania helicopter tour packages."
    canonical="https://roamingafricatours.com/tanzania-safaris/helicopter"
    heroImage="serengeti"
    h1="Tanzania Helicopter Safaris | Aerial Wildlife Viewing in the Serengeti"
    breadcrumbs={[tzCrumb, { label: "Helicopter Safaris" }]}
    intro="View the Serengeti's endless plains, the Ngorongoro Crater's perfect bowl, and Tanzania's extraordinary wildlife from the air on a Tanzania helicopter safari. Our private Tanzania helicopter tours provide an unparalleled aerial perspective — tracking Migration herds from above, spotting lion prides on the open plains, and landing in remote wilderness areas impossible to reach by vehicle. A Serengeti helicopter safari is the ultimate Tanzania luxury experience for special occasions, anniversaries, and discerning wildlife travellers."
    sections={[
      { heading: "Tanzania Helicopter Safari Experiences", body: "Serengeti Helicopter Safari — Fly over the Serengeti's famous savannah, track the Migration herds, and land for a private bush breakfast or sundowner. Ngorongoro Crater Helicopter Tour — Hover over the crater rim and descend into the caldera for a perspective no ground vehicle can match. Kilimanjaro Aerial Safari — Circle Africa's highest mountain by helicopter, viewing Kilimanjaro's glaciers and the surrounding Amboseli ecosystem. Southern Serengeti Calving Season — Fly over the December–March calving season spectacle with thousands of newborn wildebeest in aerial panorama." },
    ]}
    faqs={[
      { q: "How much does a Tanzania helicopter safari cost?", a: "Tanzania helicopter safaris are priced per flight hour from approximately $1,000–$1,500 per hour depending on helicopter type. Contact us for a detailed quote based on your preferred experience and duration." },
      { q: "Can I land inside the Serengeti by helicopter?", a: "Yes, with Tanzania National Parks Authority (TANAPA) permits, private helicopter landings in designated areas of the Serengeti are available." },
      { q: "Is a Tanzania helicopter safari available year-round?", a: "Yes, helicopter safaris operate year-round. The dry season (June–October) offers clearest visibility. Calving season (January–March) in the southern Serengeti is spectacular from the air." },
      { q: "How many people can join a Tanzania helicopter safari?", a: "Most helicopters carry 2–4 passengers plus the pilot. We can arrange tandem helicopters for larger groups." },
      { q: "Can a Tanzania helicopter safari be combined with a Zanzibar beach holiday?", a: "Yes, we can design itineraries combining a Serengeti helicopter safari with Zanzibar beach accommodation for the ultimate Tanzania luxury experience." },
    ]}
    filter={() => false}
    packagesHeading="Tanzania Helicopter Safari Tours"
    customCards={[
      { name: "3 Days Ngorongoro & Serengeti Helicopter Safari", region: "Ngorongoro Crater, Serengeti Park", duration: "3 Days", priceLabel: "Enquire for Pricing", blurb: "An unforgettable helicopter safari over Ngorongoro Crater and Serengeti — unparalleled views and aerial photography.", href: "/tanzania-helicopter-tours/ngorongoro-serengeti-3day-helicopter-safari", image: getDestinationImage("ngorongoro") },
      { name: "Lake Natron Helicopter Safari", region: "Day Trip Tanzania, Lake Natron", duration: "Full Day", priceFrom: 11700, blurb: "Fly low over the red volcanic waters of Lake Natron through the Great Rift Valley — algae, flamingos and Ol Doinyo Lengai.", href: "/tanzania-helicopter-tours/lake-natron-helicopter-safari", image: getDestinationImage("ngorongoro") },
      { name: "Kilimanjaro Helicopter Safari", region: "Moshi, Northern Tanzania", duration: "Half Day", priceFrom: 4500, blurb: "From Moshi Airport, skirt the mountain range, view every climbing route and fly over Lake Chala.", href: "/tanzania-helicopter-tours/kilimanjaro-helicopter-safari", image: getDestinationImage("tarangire") },
      { name: "Ngorongoro Crater Helicopter Safari", region: "Ngorongoro Crater", duration: "Half Day", priceFrom: 9000, blurb: "An unforgettable aerial experience over the Ngorongoro Crater — unparalleled views of this natural wonder.", href: "/tanzania-helicopter-tours/ngorongoro-crater-helicopter-safari", image: getDestinationImage("ngorongoro") },
      { name: "3 Days Helicopter Safari to Nyerere National Park", region: "Nyerere National Park", duration: "3 Days", priceLabel: "From USD 13,500 per person", blurb: "Aerial views, Rufiji boat safaris and game drives in Africa's largest, wildest game reserve.", href: "/tanzania-helicopter-tours/nyerere-3day-helicopter-safari", image: getDestinationImage("serengeti") },
    ]}
    ctaSubject="a Tanzania helicopter safari"
    galleryHeading="Tanzania Helicopter Safari Gallery"
    gallery={[
      { src: "https://images.unsplash.com/photo-1534294668821-28a3054f4256?w=900&q=80&auto=format&fit=crop", alt: "Aerial view of the Serengeti plains and Migration herds" },
      { src: "https://images.unsplash.com/photo-1534476478164-b15bfe571b17?w=900&q=80&auto=format&fit=crop", alt: "Helicopter flight over the Ngorongoro Crater rim" },
      { src: "https://images.unsplash.com/photo-1589182337358-2cb63099350c?w=900&q=80&auto=format&fit=crop", alt: "Helicopter circling Mount Kilimanjaro's glaciers" },
      { src: "https://images.unsplash.com/photo-1473445730015-841f29a9490b?w=900&q=80&auto=format&fit=crop", alt: "Private helicopter landed for a Serengeti bush picnic" },
    ]}
  />
);


export const TanzaniaZanzibar = () => (
  <SafariLanding
    seoTitle="Zanzibar Beach Holidays | Indian Ocean Beach Packages Tanzania"
    seoDesc="Book Zanzibar beach holidays with Roaming Africa. White sand beaches, turquoise Indian Ocean, Stone Town UNESCO heritage, and luxury resorts. Perfect safari and beach combinations."
    canonical="https://roamingafricatours.com/tanzania-safaris/zanzibar"
    heroImage="zanzibar"
    h1="Zanzibar Beach Holidays | Indian Ocean Paradise off Tanzania"
    breadcrumbs={[tzCrumb, { label: "Zanzibar Beach Holidays" }]}
    intro="Zanzibar beach holidays offer the perfect finale to any East Africa safari. This Indian Ocean archipelago — Tanzania's semi-autonomous Spice Island — is famous worldwide for its pristine white sand beaches, turquoise warm waters, vibrant coral reefs, and the UNESCO-listed Stone Town with its rich Swahili, Arab, and Portuguese heritage. Our Zanzibar holiday packages include a range of options from intimate boutique beach villas to all-inclusive resorts, combined with cultural experiences including spice plantation tours, Stone Town walking tours, and dolphin swimming at Kizimkazi. A Zanzibar beach holiday paired with a Kenya or Tanzania safari is East Africa's most popular and perfect travel combination."
    sections={[
      { heading: "Zanzibar's Best Beaches", body: "Nungwi Beach (North) — Famous for its stunning sunsets and lively beach bars. The calm lagoon makes it ideal for swimming year-round. Kendwa Beach (North) — A quieter alternative to Nungwi with the same beautiful sand and excellent snorkelling. Paje Beach (East Coast) — Zanzibar's kitesurfing capital with consistent trade winds and a relaxed backpacker-meets-boutique atmosphere. Matemwe Beach (Northeast) — The most serene and upscale area of Zanzibar, home to some of the island's finest boutique resorts. Stone Town — Not a beach, but essential. Walk Freddie Mercury's birthplace, explore the old slave market, and dine in rooftop spice restaurants." },
      { heading: "Combining Zanzibar with Your East Africa Safari", body: "We specialise in seamlessly combining Zanzibar beach holidays with Kenya and Tanzania safari packages. After your Masai Mara or Serengeti adventure, fly to Zanzibar from Nairobi, Kilimanjaro, or Arusha (45–120 minutes). Arrive sun-kissed from the bush and unwind on Zanzibar's world-class beaches. We handle all flights, transfers, and Zanzibar accommodation booking as part of your complete East Africa itinerary." },
    ]}
    faqs={[
      { q: "What is the best time to visit Zanzibar?", a: "The best time for Zanzibar beach holidays is June–October (long dry season) and December–February (short dry season). Avoid April–May during the long rains when some beaches close. October–March is best for diving on the east coast reefs." },
      { q: "How do I get from the Serengeti to Zanzibar?", a: "Scheduled flights from Kilimanjaro Airport or Arusha to Zanzibar take approximately 45–60 minutes. We arrange all bookings as part of your safari-beach package." },
      { q: "Is Zanzibar suitable for families?", a: "Yes, Zanzibar is excellent for families. The north and west coast beaches have calm, shallow lagoons safe for children. Most resorts offer kids clubs and family rooms." },
      { q: "Do I need a separate visa for Zanzibar?", a: "A Tanzania mainland visa covers Zanzibar. If flying directly to Zanzibar without entering Tanzania mainland, you receive a Tanzania visa on arrival at Zanzibar Airport." },
      { q: "What cultural experiences are available in Zanzibar?", a: "Stone Town walking tours, spice plantation half-day tours, sunset dhow cruises, dolphin swimming at Kizimkazi, and cooking classes featuring Swahili cuisine are all highly recommended." },
    ]}
    filter={(p) => inDest(p, ["zanzibar"]) || p.category === "beach"}
    ctaSubject="a Zanzibar beach holiday"
  />
);

export const TanzaniaAccessible = () => (
  <SafariLanding
    seoTitle="Tanzania Accessible Safaris | Wheelchair Friendly Safari Packages"
    seoDesc="Tanzania accessible safaris for wheelchair users and travellers with mobility needs. Modified vehicles, accessible lodges in Serengeti and Ngorongoro, and expert guides for inclusive Tanzania wildlife tours."
    canonical="https://roamingafricatours.com/tanzania-safaris/accessible"
    heroImage="ngorongoro"
    h1="Tanzania Accessible Safaris | Inclusive Wildlife Tours for All Abilities"
    breadcrumbs={[tzCrumb, { label: "Accessible Safaris" }]}
    intro="Roaming Africa Tours and Safaris is committed to making Tanzania's extraordinary wildlife accessible to every traveller. Our Tanzania accessible safaris are designed specifically for wheelchair users, elderly guests, travellers with mobility impairments, and anyone with accessibility requirements. We operate modified accessible safari vehicles for Tanzania with wheelchair ramps, securing systems, and wide-entry configurations. We personally select wheelchair accessible lodges in Tanzania — including properties in the Serengeti, Ngorongoro, and Tarangire — where facilities have been verified to meet accessibility standards. A Tanzania disability safari with us is planned with the same care and attention to detail as any luxury safari."
    sections={[
      { heading: "Accessible Destinations in Tanzania", body: "Serengeti Accessible Safari — Our modified vehicles handle Serengeti's game tracks comfortably, providing full wildlife access. Ngorongoro Accessible Safari — The crater floor is accessible by vehicle with our modified 4×4. Selected rim lodges have wheelchair-accessible rooms. Tarangire Accessible Safari — Flat game tracks make Tarangire an excellent accessible Tanzania park. Zanzibar Accessible Beach Holiday — Several Zanzibar resorts have wheelchair accessible rooms and beach access." },
      { heading: "Our Commitment to Inclusive Safari Travel", body: "We work with disability travel specialists and our guides receive ongoing training in accessible safari operations. Every Tanzania accessible safari itinerary is individually planned in consultation with the guest. We discuss vehicle configurations, lodge room specifications, dining accessibility, and activity options before confirming any booking. Our goal is an experience with no compromises." },
    ]}
    faqs={[
      { q: "Is it possible to do a Tanzania safari in a wheelchair?", a: "Absolutely. Tanzania safaris are vehicle-based, meaning wheelchair users access exactly the same wildlife experiences as all other guests. Our modified vehicles ensure comfort and safety throughout." },
      { q: "Which Tanzania lodges are wheelchair accessible?", a: "We work with a curated list of accessible lodges in the Serengeti, Ngorongoro, and Tarangire that have been personally inspected. These include properties with roll-in showers, wide doorways, and step-free access. Contact us for specific lodge recommendations." },
      { q: "Do your accessible vehicles have air conditioning?", a: "Our accessible safari vehicles are open 4×4 Land Cruisers with pop-up roofs. Air conditioning is not standard on open safari vehicles, but natural airflow keeps conditions comfortable. We advise on appropriate clothing for open-vehicle safaris." },
      { q: "Can a guest with a power wheelchair join a Tanzania safari?", a: "Yes, we accommodate power wheelchairs. Please provide the chair dimensions and weight at booking so we can verify vehicle and lodge compatibility." },
      { q: "How do I request an accessible Tanzania safari?", a: "Contact us directly by email or WhatsApp with your accessibility requirements, preferred travel dates, and destinations. We will design a personalised accessible Tanzania safari itinerary for your review." },
    ]}
    filter={(p) => p.country === "tanzania" && (p.tags?.includes("accessible") ?? false)}
    ctaSubject="an accessible Tanzania safari"
  />
);
