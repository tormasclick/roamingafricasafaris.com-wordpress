import { Link } from "react-router-dom";
import { whatsappLink, COMPANY, PHONE, EMAIL, ADDRESS, SITE_URL } from "@/data/constants";
import { MessageCircle, Award, Users, MapPin, Globe, Heart, Shield, Truck, Bed, Compass } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";


const stats = [
  { value: "15+", label: "Years of Experience" },
  { value: "5,000+", label: "Happy Travelers" },
  { value: "25+", label: "Curated Itineraries" },
  { value: "4", label: "Countries Covered" },
];

const services = [
  { icon: Compass, title: "Safari Itineraries", desc: "Tailor-made wildlife tours across Kenya, Tanzania and Zanzibar — from budget camping to luxury fly-in safaris." },
  { icon: Bed, title: "Hotel & Lodge Bookings", desc: "Handpicked safari lodges, tented camps and city hotels at preferred rates across East Africa." },
  { icon: Truck, title: "Safari Vehicle & Bus Hire", desc: "Well-maintained 4×4 Land Cruisers, tour vans, overland trucks and coaches with experienced driver-guides." },
];

const About = () => (
  <>
    <SEO
      title="About Us | Your Trusted East African Safari Operator"
      description={`Learn about ${COMPANY}, a Nairobi-based Destination Management Company offering safaris, hotel bookings and vehicle hire across Kenya, Tanzania and Zanzibar.`}
      canonical={`${SITE_URL}/about`}
    />

    <PageHero>
      <h1 className="text-primary-foreground">About Roaming Africa Tours & Safaris</h1>
    </PageHero>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "About" }]} />
    </div>

    <div className="container mx-auto px-4 py-12">
      <div className="max-w-5xl mx-auto space-y-12">
        <section>
          <h2 className="mb-4">Who We Are</h2>
          <p className="text-muted-foreground leading-relaxed mb-4">
            {COMPANY} is a leading Destination Management Company (DMC) based in Nairobi, Kenya, specialising in unforgettable wildlife adventures across East Africa. With over 15 years of experience and deep knowledge of Kenya, Tanzania and Zanzibar, we craft personalised safari itineraries that bring you face-to-face with Africa's most magnificent wildlife and landscapes.
          </p>
          <p className="text-muted-foreground leading-relaxed">
            From the sweeping plains of the Masai Mara and the snow-capped peaks of Kilimanjaro to the misty forests of Bwindi where mountain gorillas roam and the turquoise shores of Zanzibar, we open doors to experiences that stay with you forever. Our team of safari consultants, professional driver-guides and on-the-ground partners are passionate about sharing the very best of East Africa with travellers from around the world.
          </p>
        </section>

        {/* Stats */}
        <section className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {stats.map((s) => (
            <div key={s.label} className="bg-card border border-border rounded-xl p-6 text-center">
              <div className="text-3xl md:text-4xl font-heading font-bold text-primary mb-1">{s.value}</div>
              <div className="text-xs md:text-sm text-muted-foreground">{s.label}</div>
            </div>
          ))}
        </section>

        {/* Services */}
        <section>
          <h2 className="mb-6 text-center">What We Do</h2>
          <div className="grid md:grid-cols-3 gap-6">
            {services.map(({ icon: Icon, title, desc }) => (
              <div key={title} className="bg-card border border-border rounded-xl p-6">
                <div className="w-12 h-12 rounded-full bg-highlight/20 flex items-center justify-center mb-3">
                  <Icon className="w-6 h-6 text-primary" />
                </div>
                <h3 className="text-lg mb-2">{title}</h3>
                <p className="text-muted-foreground text-sm">{desc}</p>
              </div>
            ))}
          </div>
        </section>

        {/* Mission / Values / Promise */}
        <div className="grid md:grid-cols-3 gap-6">
          {[
            { icon: Globe, title: "Our Mission", desc: "To deliver authentic, sustainable and unforgettable safari experiences that showcase the best of East Africa while supporting local communities and conservation." },
            { icon: Heart, title: "Our Values", desc: "We believe in responsible tourism, fair and transparent pricing, exceptional service, and meaningful connections between travellers and the natural world." },
            { icon: Shield, title: "Our Promise", desc: "Every safari is backed by our commitment to safety, quality and personal attention — from your first enquiry to your return flight home." },
          ].map(({ icon: Icon, title, desc }) => (
            <div key={title} className="bg-card border border-border rounded-xl p-6">
              <Icon className="w-8 h-8 text-primary mb-3" />
              <h3 className="text-lg mb-2">{title}</h3>
              <p className="text-muted-foreground text-sm">{desc}</p>
            </div>
          ))}
        </div>

        {/* Why us */}
        <section className="section-beige rounded-xl p-8">
          <h2 className="mb-6 text-center">Why Travel With Us?</h2>
          <div className="grid md:grid-cols-2 gap-6">
            {[
              { icon: Award, text: "Licensed and registered Kenya safari operator" },
              { icon: Users, text: "Expert English-speaking professional driver-guides" },
              { icon: MapPin, text: "Locally based in Nairobi with offices serving Arusha" },
              { icon: Shield, text: "Endorsed by TripAdvisor, SafariBookings, Magical Kenya & Tanzania Tourism Board" },
              { icon: Truck, text: "Modern 4×4 fleet with pop-up roofs, charging ports and safety equipment" },
              { icon: Heart, text: "24/7 customer support before, during and after your safari" },
            ].map(({ icon: Icon, text }) => (
              <div key={text} className="flex items-center gap-3">
                <Icon className="w-6 h-6 text-primary flex-shrink-0" />
                <span className="text-sm">{text}</span>
              </div>
            ))}
          </div>
        </section>

        {/* Contact */}
        <section>
          <h2 className="mb-4">Contact Information</h2>
          <div className="space-y-2 text-muted-foreground">
            <p><strong>Phone:</strong> {PHONE}</p>
            <p><strong>Email:</strong> {EMAIL}</p>
            <p><strong>Office:</strong> {ADDRESS}</p>
          </div>
        </section>

        <div className="flex flex-col sm:flex-row gap-4 justify-center">
          <Link to="/booking" className="bg-safari-gold text-safari-dark px-8 py-3 rounded-lg font-heading font-bold text-center hover:brightness-110 transition-all">
            Plan My Safari
          </Link>
          <a href={whatsappLink("Hi! I'd like to learn more about Roaming Africa Tours.")} target="_blank" rel="noopener noreferrer" className="whatsapp-btn justify-center">
            <MessageCircle className="w-5 h-5" /> Chat on WhatsApp
          </a>
        </div>
      </div>
    </div>
  </>
);

export default About;
