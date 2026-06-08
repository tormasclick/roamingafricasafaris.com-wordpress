import {
  Binoculars, Camera, Mountain, Sunrise, Compass, TreePine,
  Bird, Waves, Tent, Users,
} from "lucide-react";
import type { Destination } from "@/data/destinations";

interface Props {
  destination: Destination;
}

/**
 * Generates 6–10 SEO-rich, destination-specific highlight cards
 * from the destination's wildlife list and travel tips, plus
 * curated narrative blurbs per destination key.
 */
const narratives: Record<string, { title: string; desc: string; icon: typeof Binoculars }[]> = {
  "masai-mara": [
    { icon: Binoculars, title: "The Great Migration", desc: "Witness over 1.5 million wildebeest, zebras and gazelles thunder across the Mara River between July and October. The Masai Mara hosts the climactic crossings of one of Earth's greatest wildlife spectacles, with crocodile-filled rivers and dramatic stampedes that draw photographers from around the world." },
    { icon: Camera, title: "Africa's Highest Lion Density", desc: "The Mara supports the highest lion density of any savannah ecosystem on the continent. Famous prides like the Marsh Pride and Black Rock Pride are documented continuously, giving visitors near-guaranteed sightings of hunting lions, cubs and territorial males in golden grasslands." },
    { icon: Sunrise, title: "Hot Air Balloon Safari", desc: "Float silently over the plains at sunrise on a hot air balloon safari followed by a champagne bush breakfast. The Mara is one of only a handful of African ecosystems where this iconic experience runs daily — a bucket-list activity for honeymooners and photographers." },
    { icon: Users, title: "Maasai Cultural Encounters", desc: "Visit authentic Maasai manyatta villages and meet the warriors and elders who have coexisted with the Mara's wildlife for centuries. Experience traditional jumping dances, beadwork, and learn about the Maasai's evolving role in conservation and community tourism." },
    { icon: Mountain, title: "Mara Triangle & Conservancies", desc: "Beyond the main reserve, private conservancies like Mara North, Olare Motorogi, and Naboisho offer exclusive game drives, night drives and walking safaris — experiences not permitted inside the public reserve. Conservancies cap vehicle numbers, delivering a more intimate wilderness." },
    { icon: Bird, title: "Over 470 Bird Species", desc: "The Mara is a world-class birding destination with raptors, ostriches, secretary birds, kori bustards, and dazzling lilac-breasted rollers. November to April brings Eurasian migrants, while resident species can be ticked off year-round across the savannah, river and woodland habitats." },
    { icon: Compass, title: "Big Cat Photography Hotspot", desc: "Cheetahs hunt on the Mara's open plains in daylight, leopards lounge in sausage trees along the Talek River, and lions stalk through long grass. Few destinations on Earth combine the Big Cat trifecta with this consistency, making it the world's premier predator photography location." },
  ],
  amboseli: [
    { icon: Mountain, title: "Kilimanjaro Backdrop", desc: "Amboseli is the only place on Earth where you can photograph free-ranging African elephants framed by the snow-capped peak of Mount Kilimanjaro, Africa's highest mountain at 5,895m. Clearest views are in the first hour after sunrise — a photographer's dream." },
    { icon: Binoculars, title: "1,600+ Free-Ranging Elephants", desc: "Amboseli protects one of Africa's best-studied elephant populations — 1,600 individuals organised into well-documented family groups including some of the largest tuskers left on the continent. Herds of 50 to 100 elephants congregate daily at the park's permanent swamps." },
    { icon: Camera, title: "Observation Hill Panorama", desc: "Climb Observation Hill, the only point in the park where you may step out of your vehicle, for sweeping 360-degree views over Amboseli's swamps, plains and the silhouette of Kilimanjaro. A perfect spot for sundowners and photography." },
    { icon: Bird, title: "Over 420 Bird Species", desc: "Amboseli's wetlands attract grey crowned cranes, African fish eagles, pelicans, herons, kingfishers and African jacanas. Birders can tick over 100 species in a single morning around Enkongo Narok and Longinye swamps." },
    { icon: Users, title: "Authentic Maasai Communities", desc: "The land surrounding Amboseli is owned by Maasai communities who lease grazing rights for conservation. Visit Maasai bomas, learn about pastoralist culture, and experience how indigenous land stewardship protects this ecosystem and its iconic elephants." },
    { icon: Sunrise, title: "Year-Round Big Cat Sightings", desc: "Beyond elephants, Amboseli hosts lions, cheetahs and hyenas hunting across the dry lake bed and grasslands. Cheetah sightings are particularly reliable in the dry season when herbivore concentrations peak around the swamps." },
  ],
  "lake-nakuru": [
    { icon: Bird, title: "Flamingo Spectacle", desc: "Lake Nakuru is internationally recognised for its spectacular flamingo populations — both lesser and greater flamingos — that paint the alkaline lake's shores pink. Seasonal blue-green algae blooms attract enormous flocks, creating one of Africa's most iconic wildlife scenes." },
    { icon: Binoculars, title: "Rhino Sanctuary", desc: "Lake Nakuru is one of Kenya's most successful rhino sanctuaries, protecting over 100 black and white rhinos behind a fully fenced perimeter and intensive anti-poaching cover. Few parks anywhere in Africa offer better odds of sighting both rhino species in a single morning game drive." },
    { icon: TreePine, title: "Rothschild's Giraffes", desc: "Introduced to protect a critically endangered subspecies, Rothschild's giraffes — distinguished by their pale lower legs — thrive in Nakuru's acacia woodlands. The park is one of only a handful of places where the species can be seen reliably in the wild." },
    { icon: Mountain, title: "Baboon Cliff Viewpoint", desc: "The Baboon Cliff overlook offers a breathtaking elevated vista of the entire lake, the flamingo flocks and the Rift Valley escarpment. It is the most photographed viewpoint in the park and a must-stop on every game drive." },
    { icon: Camera, title: "Tree-Climbing Lions", desc: "Nakuru's lions have developed the unusual habit of resting in the broad branches of acacia and yellow-bark fever trees — behaviour shared with only a handful of African lion populations. Patient visitors are rewarded with extraordinary photo opportunities." },
    { icon: Bird, title: "450+ Bird Species", desc: "Beyond flamingos, Lake Nakuru records over 450 bird species including African fish eagles, pelicans, cormorants, marabou storks and seasonal migrants — making it one of East Africa's most accessible birding destinations and an EAA Important Bird Area." },
  ],
  samburu: [
    { icon: Binoculars, title: "The Samburu Special Five", desc: "Samburu is the only place in Kenya where you can reliably see all five of the Special Five species: reticulated giraffe, Grevy's zebra, Beisa oryx, gerenuk and Somali ostrich. These dry-country endemics evolved unique adaptations to the arid northern frontier." },
    { icon: Waves, title: "Ewaso Ng'iro River Life", desc: "The life-giving Ewaso Ng'iro River cuts through the reserve and acts as the centre of all wildlife activity. Elephants drink and bathe daily, crocodiles bask on sandbanks, and leopards stalk along the wooded riverbanks at dawn and dusk." },
    { icon: Camera, title: "Big Cat Sanctuary", desc: "Samburu is one of Kenya's best leopard destinations — the rocky doum palm-lined riverbanks provide perfect ambush cover. Lions and cheetahs hunt across the open plains, and wild dog packs are increasingly seen as conservation efforts succeed." },
    { icon: Users, title: "Samburu Tribal Culture", desc: "Visit traditional Samburu manyattas to meet a colourful pastoralist people closely related to the Maasai. Learn about their warrior age-grade system, witness traditional jumping dances, and discover how Samburu communities now lead northern Kenya's conservation movement." },
    { icon: Mountain, title: "Buffalo Springs & Shaba", desc: "Cross the river into adjoining Buffalo Springs National Reserve and Shaba National Reserve (made famous by Joy Adamson of 'Born Free') for varied volcanic landscapes, hidden springs, and far fewer vehicles than the Mara — a true off-the-beaten-track Kenya safari." },
    { icon: Bird, title: "365+ Bird Species", desc: "Samburu's varied habitats — riverine forest, doum palm groves, semi-desert scrub and rocky outcrops — host over 365 bird species including the vulturine guineafowl, palm-nut vulture and several dry-country specials found nowhere else in Kenya." },
  ],
  serengeti: [
    { icon: Binoculars, title: "Endless Plains & Migration", desc: "The Serengeti's name comes from the Maasai word 'siringet' meaning 'endless plains'. Across 14,763 sq km, the world-famous Great Migration follows an annual circular route — calving in the south, river crossings in the north — driven by 1.5 million wildebeest." },
    { icon: Camera, title: "Mara River Crossings", desc: "Between July and October, the Mara River in northern Serengeti hosts the most dramatic act of the Migration: panicked wildebeest leap into crocodile-filled water in their hundreds. The Kogatende area offers world-class crossing viewing with fewer vehicles than the Kenyan side." },
    { icon: Sunrise, title: "Hot Air Balloon Safari", desc: "Drift over the plains at sunrise on a Serengeti balloon safari ending with a champagne bush breakfast in the wilderness. Multiple operators run from Seronera, central Serengeti and the Western Corridor — a once-in-a-lifetime addition to any itinerary." },
    { icon: Mountain, title: "Seronera Wildlife Hub", desc: "Central Serengeti's Seronera Valley acts as a year-round wildlife magnet with permanent water sources, resident lions, leopards in sausage trees, and consistent cheetah and hyena sightings — the perfect base when the Migration is elsewhere in the ecosystem." },
    { icon: Bird, title: "500+ Bird Species", desc: "From kori bustards (the world's heaviest flying bird) to lilac-breasted rollers, secretary birds and migrating European storks, the Serengeti's varied habitats record over 500 bird species — a paradise for birders combining game drives with checklist building." },
    { icon: Tent, title: "Mobile Migration Camps", desc: "Mobile tented camps follow the Migration's path, repositioning seasonally so guests always sleep close to the herds. Combining mobile and permanent camps in a single itinerary delivers the most intimate Serengeti safari experience possible." },
  ],
  ngorongoro: [
    { icon: Mountain, title: "World's Largest Intact Caldera", desc: "The Ngorongoro Crater is the world's largest unbroken volcanic caldera — 19 km wide, 600m deep, with steep walls forming a natural amphitheatre. Formed 3 million years ago when a giant volcano collapsed, it now shelters Africa's most concentrated permanent wildlife population." },
    { icon: Binoculars, title: "Big Five in One Day", desc: "Roughly 25,000 large animals live permanently inside the crater, including lions, elephants, black rhinos, buffaloes and leopards. Ngorongoro is one of very few places on Earth where you can realistically tick off all the Big Five in a single morning game drive." },
    { icon: Camera, title: "Black Rhino Stronghold", desc: "Ngorongoro is one of the safest places in Africa to see endangered black rhinos in their natural habitat. The crater's enclosed walls and intensive anti-poaching protection mean sightings — though never guaranteed — are far more reliable than almost anywhere else." },
    { icon: Users, title: "Maasai Pastoralism in Harmony", desc: "Unlike most African protected areas, the Ngorongoro Conservation Area is a multi-use landscape where Maasai pastoralists graze cattle alongside wildlife. Visit a traditional boma to experience how indigenous land use and conservation can coexist." },
    { icon: Bird, title: "Lake Magadi Flamingos", desc: "The crater floor's soda lake, Lake Magadi, attracts large flocks of pink lesser flamingos that contrast spectacularly with the green crater walls. The lake is also a hub for grey crowned cranes, blacksmith plovers and waterfowl." },
    { icon: Compass, title: "Olduvai Gorge Cradle", desc: "Just outside the crater lies Olduvai Gorge — one of the most important paleoanthropological sites on Earth, where the Leakeys uncovered the earliest evidence of human evolution. Combine your safari with a visit to the on-site museum." },
  ],
  zanzibar: [
    { icon: Waves, title: "World-Class Indian Ocean Beaches", desc: "Zanzibar's east coast beaches — Paje, Jambiani, Matemwe — feature powder-white sand and translucent turquoise lagoons protected by coral reefs. The west coast offers calmer, deeper water perfect for sunsets and dhow cruises from Stone Town." },
    { icon: Camera, title: "Stone Town UNESCO Heritage", desc: "Stone Town is a living UNESCO World Heritage Site — a labyrinth of narrow alleys, intricately carved doors, Arabian palaces, Portuguese forts and Swahili coral-stone houses reflecting 1,000 years of Indian Ocean trade." },
    { icon: Tent, title: "Spice Tour & Plantations", desc: "Known as the Spice Island, Zanzibar's interior is dotted with working spice plantations growing cloves, nutmeg, cinnamon, vanilla and cardamom. Guided spice tours include tastings and traditional Swahili lunches in farming villages." },
    { icon: Waves, title: "Mnemba Atoll Snorkelling", desc: "The Mnemba Atoll Marine Conservation Area offers some of East Africa's finest snorkelling and diving — vibrant coral gardens, pods of dolphins, turtles, and the chance to spot whale sharks in season." },
    { icon: Users, title: "Swahili Culture & Cuisine", desc: "Experience the cultural fusion of African, Arab, Indian and European influences in Zanzibari food, music and architecture. Sample biryani, octopus curry and freshly grilled seafood at Forodhani Gardens' nightly food market in Stone Town." },
    { icon: Sunrise, title: "Sunset Dhow Cruises", desc: "Sail traditional wooden dhows from Stone Town's harbour at sunset for spectacular views of the Old Fort, House of Wonders and the Indian Ocean — a quintessential Zanzibar experience usually paired with sundowner drinks." },
  ],
  tsavo: [
    { icon: Binoculars, title: "Red Elephants of Tsavo", desc: "Tsavo's signature 'red elephants' are coated in the park's iron-rich red volcanic dust from daily bathing — an unmistakable look found nowhere else in Africa. The park protects one of Kenya's largest elephant populations." },
    { icon: Mountain, title: "Kenya's Largest Wilderness", desc: "Tsavo East and Tsavo West together cover 22,000 sq km — larger than Wales — offering vast wilderness, far fewer vehicles than the Mara, and an authentic untamed safari experience. The Yatta Plateau in Tsavo East is the world's longest lava flow." },
    { icon: Waves, title: "Mzima Springs Crystal Pools", desc: "Tsavo West's Mzima Springs gush 50 million gallons of crystal-clear water daily from the volcanic Chyulu Hills. An underwater viewing chamber lets you observe hippos and fish below the surface — a unique safari activity." },
    { icon: Camera, title: "Ngulia Rhino Sanctuary", desc: "The fenced Ngulia Rhino Sanctuary within Tsavo West protects a critical breeding population of endangered black rhinos. Combined with the park's lions, leopards and elephants, it makes Tsavo a complete Big Five destination." },
    { icon: Compass, title: "Combine with Mombasa Coast", desc: "Tsavo lies between Nairobi and Mombasa, making it the perfect pre- or post-beach safari. Many travellers combine 2 nights in Tsavo East with a Diani Beach holiday for a complete bush-and-beach Kenya experience." },
    { icon: Bird, title: "500+ Bird Species", desc: "Tsavo's varied habitats — semi-arid scrub, rivers, hills and lava landscapes — support over 500 bird species including ostriches, secretary birds, vultures, and dry-country specials such as the golden pipit and golden-breasted starling." },
  ],
  "nairobi-np": [
    { icon: Camera, title: "Wildlife Against City Skyline", desc: "Nairobi National Park is the only national park on Earth that shares a fence with a major capital city. Photograph lions, giraffes and rhinos with Nairobi's downtown skyline as backdrop — a uniquely African juxtaposition." },
    { icon: Binoculars, title: "Critical Rhino Sanctuary", desc: "Despite its compact size, the park protects over 100 black and white rhinos — one of Kenya's most important breeding populations. Early morning game drives offer the best chance of multiple rhino sightings." },
    { icon: Users, title: "David Sheldrick Elephant Orphanage", desc: "At the park's main gate, the world-famous David Sheldrick Wildlife Trust rehabilitates orphaned baby elephants. A daily 11 AM–12 PM public visit lets guests meet the calves and learn about Kenya's anti-poaching successes." },
    { icon: TreePine, title: "Giraffe Centre & Karen", desc: "Combine the park with the AFEW Giraffe Centre in Karen — feed endangered Rothschild's giraffes by hand from an elevated platform — and the Karen Blixen Museum, set in the author's former coffee farm." },
    { icon: Sunrise, title: "Half-Day Safari Convenience", desc: "Just 20 minutes from Nairobi CBD, the park is perfect for travellers on long layovers, business trips, or as the first safari of a longer Kenya adventure. Half-day and full-day game drives depart from any city hotel." },
    { icon: Bird, title: "500+ Bird Species", desc: "Nairobi NP is a top urban birding site with over 500 species recorded, including the rare grey-crested helmet-shrike and seasonal migrants. The Hippo Pools picnic area is a favourite hotspot for kingfishers and waterbirds." },
  ],
  "mombasa-diani": [
    { icon: Waves, title: "20 km of Powder White Sand", desc: "Diani Beach is consistently rated among Africa's finest beaches — a 20 km strip of fine white sand fringed by a protected coral reef. The reef creates a calm shallow lagoon perfect for swimming, kite-surfing and stand-up paddleboarding." },
    { icon: Camera, title: "Mombasa Old Town & Fort Jesus", desc: "Explore Mombasa's UNESCO-listed Old Town, a 1,000-year-old Swahili coastal trading hub of narrow streets, carved doors and Indian-influenced architecture. Tour 16th-century Portuguese Fort Jesus and learn the layered history of Indian Ocean trade." },
    { icon: TreePine, title: "Colobus Monkey Sanctuary", desc: "Diani is one of the last strongholds of the endangered Angola colobus monkey. The Colobus Conservation Trust runs guided forest walks and rehabilitates injured monkeys — a meaningful and family-friendly conservation experience." },
    { icon: Users, title: "Swahili Coastal Culture", desc: "Sample fresh seafood, Swahili curries, biryani and coconut rice in beachfront restaurants. Visit traditional dhow-building yards, ancient mosques and Mombasa's vibrant spice markets for an authentic taste of East African coastal life." },
    { icon: Waves, title: "Marine Safaris & Dhow Cruises", desc: "Book glass-bottom boat trips over the coral reef, snorkel with parrotfish and turtles, sail traditional dhows at sunset, or visit Wasini Island and Kisite Marine Park for dolphin tours and seafood lunches under the palms." },
    { icon: Sunrise, title: "Perfect Safari Add-On", desc: "Mombasa and Diani are the natural finale to any Kenya safari. Combine 4–6 days in Masai Mara, Amboseli or Tsavo with 3–5 nights on the coast — connected by short flights or the SGR train from Nairobi (4.5 hours)." },
  ],
};

const fallbackIconForWildlife = (name: string) => {
  const t = name.toLowerCase();
  if (/bird|flamingo|eagle|ostrich/.test(t)) return Bird;
  if (/elephant|rhino|buffalo|hippo/.test(t)) return Binoculars;
  if (/giraffe|tree|forest/.test(t)) return TreePine;
  if (/fish|crocodile|water|reef/.test(t)) return Waves;
  if (/maasai|samburu|people|village|culture/.test(t)) return Users;
  return Camera;
};

const DestinationHighlights = ({ destination }: Props) => {
  const curated = narratives[destination.id] || narratives[destination.slug];

  // If we don't have curated narrative, synthesise from data so every page has 6+ cards.
  const cards =
    curated ||
    [
      ...destination.wildlife.slice(0, 6).map((w) => ({
        icon: fallbackIconForWildlife(w),
        title: w,
        desc: `${w} are a signature wildlife sight in ${destination.name}. ${destination.shortDescription} Travellers visiting in the right season have excellent chances of close, photographic encounters with expert local guides who know the best spots and timings.`,
      })),
      ...destination.travelTips.slice(0, 4).map((tip) => ({
        icon: Compass,
        title: tip.split(/[.,—-]/)[0].slice(0, 60),
        desc: `${tip} Our local guides know ${destination.name} intimately and structure each itinerary around insider knowledge gathered over years of operating in the region.`,
      })),
    ].slice(0, 8);

  return (
    <section>
      <h2 className="text-lg mb-2">Destination Highlights</h2>
      <p className="text-muted-foreground text-sm mb-6 max-w-3xl">
        Discover what makes {destination.name} one of East Africa's most rewarding safari
        destinations — curated experiences, wildlife, and cultural encounters our local
        team recommends to every traveller.
      </p>
      <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {cards.map(({ icon: Icon, title, desc }) => (
          <article
            key={title}
            className="group bg-card border border-border rounded-2xl p-5 hover:shadow-lg hover:-translate-y-0.5 transition-all"
          >
            <div className="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
              <Icon className="w-5 h-5" />
            </div>
            <h3 className="text-base font-heading font-bold mb-2">{title}</h3>
            <p className="text-sm text-muted-foreground leading-relaxed">{desc}</p>
          </article>
        ))}
      </div>
    </section>
  );
};

export default DestinationHighlights;
